<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class ListOfTrainingController extends Controller
{
    public function edit($id){
        $training = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('list_of_trainings.id', $id)
                        ->select('list_of_trainings.id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate')
                        ->first();

        return view('trainings.edit', ['training' => $training]);
    }
    public function index(){
        $lists = DB::table('list_of_trainings')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->orderBy('name','asc')
                    ->select('list_of_trainings.id','name', 'certificate_title', 'date_covered', 'level', 'num_hours','certificate')
                    ->get();

        return view('trainings.index', [
            'lists' => $lists
        ]);
    }
    public function show($id){
        $training = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('list_of_trainings.id', $id)
                        ->select('list_of_trainings.id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate')
                        ->first();
        //Storage::copy(storage_path("users/".$training->name."/".$training->certificate), public_path("Image/".$training->certificate));
        //dd($training);
        return view('trainings.show', ['training' => $training]);
    }
    public function printall(){

        $listObject = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('teacher', 'Yes')
                        ->orderBy('name','asc')
                        ->select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                        ->get();

        $grouped = $listObject->groupBy('name');

        $list = $grouped->toArray();

        $templateProcessor = new TemplateProcessor(storage_path('Certificate.docx'));

        $templateProcessor->setValue('deptname','Institute of Computer Studies');
        $templateProcessor->setValue('year',date('Y'));
        $templateProcessor->setValue('daterange',request('range1').' to '.request('range2').' '.date('Y'));


        $replacements = array();
        $i = 0;
        foreach($list as $name => $cert) {
            $replacements[] = array(
                'name' => $name,
                'certificate_title' => '${certificate_title_'.$i.'}',
                'date_covered' => '${date_covered_'.$i.'}',
                'level' => '${level_'.$i.'}',
                'num_hours' => '${num_hours_'.$i.'}'
    );
                $i++;
}
        $templateProcessor->cloneBlock('table', count($replacements), true, false, $replacements);

        $i = 0;
        foreach($list as $group) 
        {
            $values = array();
            foreach($group as $row) 
            {
                $values[] = array(
                    "certificate_title_{$i}" => $row->certificate_title,
                    "date_covered_{$i}" => $row->date_covered,
                    "level_{$i}" => $row->level,
                    "num_hours_{$i}" => $row->num_hours);
            }
            $templateProcessor->cloneRowAndSetValues("certificate_title_{$i}", $values);

            $i++;
        }
        $listObject = DB::table('users')
                        ->join('list_of_trainings', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('teacher', 'No')
                        ->orderBy('name','asc')
                        ->select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                        ->get();

        $grouped = $listObject->groupBy('name');

        $list = $grouped->toArray();

        $replacements = array();
        $i = 0;
        foreach($list as $name => $cert) {
            $replacements[] = array(
                'name2' => $name,
                'certificate_title2' => '${certificate_title2_'.$i.'}',
                'date_covered2' => '${date_covered2_'.$i.'}',
                'level2' => '${level2_'.$i.'}',
                'num_hours2' => '${num_hours2_'.$i.'}'
    );
                $i++;
}
        $templateProcessor->cloneBlock('table2', count($replacements), true, false, $replacements);

        $i = 0;
        foreach($list as $group) 
        {
            $values = array();
            foreach($group as $row) 
            {
                $values[] = array(
                    "certificate_title2_{$i}" => $row->certificate_title,
                    "date_covered2_{$i}" => $row->date_covered,
                    "level2_{$i}" => $row->level,
                    "num_hours2_{$i}" => $row->num_hours);
            }
            $templateProcessor->cloneRowAndSetValues("certificate_title2_{$i}", $values);

            $i++;
        }
        $templateProcessor->setValue('facultypercentage',100 .'%');
        $templateProcessor->setValue('nonpercentage',100 .'%');
        $templateProcessor->setValue('coordname','Bryan Arellano');

    
        $templateProcessor->saveAs('ListOfTrainings.docx');
        return response()->download(public_path('ListOfTrainings.docx'))->deleteFileAfterSend(true);
    }

    public function create(){
        return view('trainings.create');
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'user_id' => 'required',
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',
            'photo' => 'required',


        ]);
        $list = new ListOfTraining();
        $list->user_id = request('user_id');
        $list->certificate_title = request('certificate_title');
        $list->level = request('level');
        $list->date_covered = request('date_covered');
        $list->certificate_type = request('certificate_type');
        $list->venue = request('venue');
        $list->sponsors = request('sponsors');
        $list->type = request('type');
        $list->num_hours = request('num_hours');



        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('Ymd') . request('certificate_title');
            $file-> move(storage_path('app/public/users/'.auth()->user()->name), $filename);
            $list['certificate']= $filename;
        }
        
        $list->save();
        return redirect('/trainings')->with('mssg', 'Updated') ;
    }

    public function update(Request $request, $id){
        $formFields = $request->validate([
            'user_id' => 'required',
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',


        ]);
        $list = ListOfTraining::find($id);
        $list->user_id = request('user_id');
        $list->certificate_title = request('certificate_title');
        $list->level = request('level');
        $list->date_covered = request('date_covered');
        $list->certificate_type = request('certificate_type');
        $list->venue = request('venue');
        $list->sponsors = request('sponsors');
        $list->type = request('type');
        $list->num_hours = request('num_hours');



        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('Ymd') . request('certificate_title');
            $file-> move(storage_path('app/public/users/'.auth()->user()->name), $filename);
            $list->certificate = $filename;
        }
        
        $list->save();
        return back()->with('mssg', 'Updated') ;
    }
}
