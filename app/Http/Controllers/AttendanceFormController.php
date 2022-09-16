<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class AttendanceFormController extends Controller
{
    public function create(){
        return view('attendanceforms.create');
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'list_of_training_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
            'outcome' => 'required',
            'personal_action' => 'required'


        ]);
        $list = new AttendanceForm();
        $list->list_of_training_id = request('list_of_training_id');
        $list->competency = request('competency');
        $list->knowledge_acquired = request('knowledge_acquired');
        $list->outcome = request('outcome');
        $list->personal_action = request('personal_action');

        $train = ListOfTraining::find(request('list_of_training_id'));
        $train->attendance_form = 1;
        
        $list->save();
        $train->save();
        return redirect('/training')->with('mssg', 'Updated') ;
    }

    public function show($id){
        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $id)
        ->select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','competency','attendance_forms.id as att_id','knowledge_acquired','outcome','personal_action','attendance_form')
        ->first();

        if(auth()->user()->role_as == 0)
        {
            if($training->user_id != auth()->id())
            {
                abort(403, 'Unauthorized Action');
            }
        }

        return view('attendanceforms.show', ['training' => $training]);
    }

    public function edit($id){
        $list = AttendanceForm::find($id);
            
            if(auth()->user()->role_as == 0)
            {   
                $lists = ListOfTraining::find($list->list_of_training_id);
                if($lists->user_id != auth()->id()){
                    abort(403, 'Unauthorized Action');
                }
            }
        $training = DB::table('attendance_forms')
            ->join('list_of_trainings', 'list_of_trainings.id', '=', 'attendance_forms.list_of_training_id')
            ->where('attendance_forms.id', $id)
            ->select('list_of_trainings.id as training_id','certificate_title','attendance_forms.id as att_id','competency','knowledge_acquired','outcome','personal_action','attendance_form')
            ->first();

        return view('attendanceforms.edit', ['attendance' => $training]);
    }

        public function update(Request $request, $id){
            $list = AttendanceForm::find($id);
            
            if(auth()->user()->role_as == 0)
            {   
                $lists = ListOfTraining::find($list->list_of_training_id);
                if($lists->user_id != auth()->id()){
                    abort(403, 'Unauthorized Action');
                }
            }
    
            $formFields = $request->validate([
                'list_of_training_id' => 'required',
                'competency' => 'required',
                'knowledge_acquired' => 'required',
                'outcome' => 'required',
                'personal_action' => 'required'
    
    
            ]);
    
            $list->list_of_training_id = request('list_of_training_id');
            $list->competency = request('competency');
            $list->knowledge_acquired = request('knowledge_acquired');
            $list->outcome = request('outcome');
            $list->personal_action = request('personal_action');
            
            $list->save();
            return back()->with('mssg', 'Updated') ;
        
    }
    public function destroy($id){

        $check = AttendanceForm::find($id);
        $lists = ListOfTraining::find($check->list_of_training_id);
        if(auth()->user()->role_as == 0)
        {

            if($lists->user_id != auth()->id()){
                abort(403, 'Unauthorized Action');
            }
        }
        $lists->attendance_form = 0;

        $lists->save();
        AttendanceForm::where('id',$id)->delete();
        if(auth()->user()->role_as == 0)
        {
            return redirect('/training')->with('message','Training Deleted Successfully');
        }else{
            return redirect('/trainings')->with('message','Training Deleted Successfully');
        }
        
    }
    public function print(Request $request,$id)
    {
        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $id)
        ->select('name', 'certificate_title', 'date_covered', 'level','venue','sponsors','competency','knowledge_acquired','outcome','personal_action')
        ->first();

        $array = [
            'name' => $training->name,
            'certificate_title' => $training->certificate_title,
            'date_covered' => $training->date_covered,
            'venue' => $training->venue,
            'sponsors' => $training->sponsors,
            'competency' => $training->competency,
            'knowledge_acquired' => $training->knowledge_acquired,
            'outcome' => $training->outcome,
            'personal_action' => $training->personal_action
        ];

        $templateProcessor = new TemplateProcessor(storage_path('Attendance-Report.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }
            $templateProcessor->setValue('college',auth()->user()->college);
            if($request->file('esign')){
                $file= $request->file('esign');
                $filename= auth()->user()->name.'esign';
                $file-> move(public_path('images'), $filename);
                $templateProcessor->setImageValue('esign', array('path' => public_path('images/'.$filename), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue('edate',date('F j, Y'));
                File::delete('images/'.$filename);
            }
            else{
                $templateProcessor->setValue('esign'," ");
                $templateProcessor->setValue('edate'," ");
            }

            if($request->file('ssign')){
                $file= $request->file('ssign');
                $filename= auth()->user()->name.'ssign';
                $file-> move(public_path('images'), $filename);
                $templateProcessor->setImageValue('ssign', array('path' => public_path('images/'.$filename), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue('sdate',date('F j, Y'));
                File::delete('images/'.$filename);
            }
            else{
                $templateProcessor->setValue('ssign'," ");
                $templateProcessor->setValue('sdate'," ");
            }
        $templateProcessor->saveAs($training->name.'_Attendance_Report.docx');
        return response()->download(public_path($training->name.'_Attendance_Report.docx'))->deleteFileAfterSend(true);
    }
}
