<?php

namespace App\Http\Controllers;

use App\Models\AttendanceForm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class ListOfTrainingController extends Controller
{
    public function empindex(){
        $lists = DB::table('list_of_trainings')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->where('users.id',auth()->user()->id)
                    ->orderBy('date_covered','asc')
                    ->select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form')
                    ->get();

        return view('employee.trainingsindex', [
            'lists' => $lists
        ]);
    }
    public function destroy($id){
        if(auth()->user()->role_as == 0)
        {
            $list = ListOfTraining::find($id);
            if($list->user_id != auth()->id()){
                abort(403, 'Unauthorized Action');
            }
        }


        ListOfTraining::where('id',$id)->delete();
        return redirect('/trainings')->with('message','Training Delete Successfully');
    }
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
                    ->select('list_of_trainings.id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','attendance_form')
                    ->get();

        return view('trainings.index', [
            'lists' => $lists
        ]);
    }
    public function show($id){


            $training = DB::table('list_of_trainings')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('list_of_trainings.id', $id)
                ->select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form')
                ->first();


        if(auth()->user()->role_as == 0)
        {
            if($training->user_id != auth()->id())
            {
                abort(403, 'Unauthorized Action');
            }
        }

        return view('trainings.show', ['training' => $training]);
    }
    public function printall(Request $request){

        $listObject = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('teacher', 'Yes')
                        ->orderBy('name','asc')
                        ->select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                        ->get();

        $grouped = $listObject->groupBy('name');

        $list = $grouped->toArray();
        $templateProcessor = new TemplateProcessor(storage_path('Certificate.docx'));

        $templateProcessor->setValue('deptname',auth()->user()->college);
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
        $templateProcessor->setValue('coordname',auth()->user()->name);

        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= auth()->user()->name.'signature';
            $file-> move(public_path('images'), $filename);
        }
        else{
            $templateProcessor->setValue('coordsignature'," ");
        }
        $templateProcessor->setImageValue('coordsignature', array('path' => public_path('images/'.$filename), 'width' => 100, 'height' => 50, 'ratio' => false));
        File::delete('images/'.$filename);
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
            'certificate_type' => 'required'


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
        return redirect('/training')->with('mssg', 'Updated') ;
    }

    public function update(Request $request, $id){
        $list = ListOfTraining::find($id);
        
        if(auth()->user()->role_as == 0)
        {
            if($list->user_id != auth()->id()){
                abort(403, 'Unauthorized Action');
            }
        }

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
