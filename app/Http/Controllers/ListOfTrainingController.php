<?php

namespace App\Http\Controllers;

use App\Models\AttendanceForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ListOfTraining;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class ListOfTrainingController extends Controller
{
    public function queue(){
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('status','Pending')
                                    ->where('college',auth()->user()->college)
                                    ->whereBetween('date_covered',[$start_date,$end_date])
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
        } else {
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('status','Pending')
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
                                    
        }
        return view('trainings.queue', [
            'lists' => $lists
        ]);
    }
    public function check($id){
        if(auth()->user()->role_as == 0)
        {
            
            if($id != auth()->id()){
                abort(403,'Unauthorized entry');
            }
        }
    }
    public function reject($id){
        $list = ListOfTraining::find($id);
        $list->status = 'Rejected';
        $list->save();
        return redirect(route('training.queue'))->with('message', 'Sucessfully Rejected');
    }
    public function approve($id){
        $list = ListOfTraining::find($id);
        $list->status = 'Approved';
        $list->save();
        return redirect(route('training.queue'))->with('message', 'Sucessfully Approved');
    }
    public function submit($id){
        $list = ListOfTraining::find($id);
        if($list->user_id != auth()->id())
        {
            abort(403, 'Unauthorized Action');
        }
        if ($list->attendance_form == 0) {
            return redirect()->back()->with('message', ' Cannot be submitted missing Attendance Form');
        }
        $list->status = 'Pending';
        $list->save();

        return redirect()->back()->with('message', 'Sucessfully Submitted');
    }
    public function empindex(Request $request){
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('users.id',auth()->user()->id)
                                    ->whereBetween('date_covered',[$start_date,$end_date])
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
        } else {
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('users.id',auth()->user()->id)
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
                                    
        }


        return view('employee.trainingsindex', [
            'lists' => $lists
        ]);
    }
    public function destroy($id){
        $list = ListOfTraining::find($id);
        $this->check($list->user_id);
        if(auth()->user()->role_as == 0)
        {
            if ($list->status == 'Approved') {
                return redirect()->back()->with('message', 'Unauthorized Action');
            }
        }

        $user = User::find($list->user_id);
        File::delete(storage_path('app/public/users/'.$user->name.'/'.$list->certificate));
        ListOfTraining::where('id',$id)->delete();
        return redirect(route('training.empindex'))->with('message', $list->certitficate_title.'Deleted');
    }
    public function edit($id){
        $training = DB::table('list_of_trainings')
                        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                        ->where('list_of_trainings.id', $id)
                        ->select('list_of_trainings.id','name','user_id', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate')
                        ->first();
        $this->check($training->user_id);
        return view('trainings.edit', ['training' => $training]);
    }
    public function index(){
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('status','Approved')
                                    ->where('college',auth()->user()->college)
                                    ->whereBetween('date_covered',[$start_date,$end_date])
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
        } else {
            $lists = ListOfTraining::select('list_of_trainings.id','name', 'certificate_title', 'date_covered','venue','sponsors', 'level', 'num_hours','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('status','Approved')
                                    ->orderBy('date_covered','asc')
                                    ->filter(request(['level','search']))
                                    ->get();
                                    
        }


        return view('trainings.index', [
            'lists' => $lists
        ]);
    }
    public function show($id){

            $training = DB::table('list_of_trainings')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('list_of_trainings.id', $id)
                ->select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                ->first();

        $this->check($training->user_id);
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



        $user = User::find($list->user_id);
        if($request->file('photo')){
            $file= $request->file('photo');
            $filename= date('Ymd') . request('certificate_title');
            $file-> move(storage_path('app/public/users/'.$user->name), $filename);
            $list['certificate']= $filename;
        }
        
        $list->save();
        return redirect(route('training.show',$list->id))->with('message', 'List of Trainings Created');
    }

    public function update(Request $request, $id){
        $list = ListOfTraining::find($id);
        
        $this->check($list->user_id);
        $request->validate([
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


        $user = User::find($list->user_id);
        if($request->file('photo')){
            File::delete(storage_path('app/public/users/'.$user->name.'/'.$list->certificate));
            $file= $request->file('photo');
            $filename= date('Ymd') . request('certificate_title');
            $file-> move(storage_path('app/public/users/'.$user->name), $filename);
            $list->certificate = $filename;
        }
        
        $list->save();
        return redirect(route('training.show',$list->id))->with('message', 'List of Trainings Updated');
    }
}
