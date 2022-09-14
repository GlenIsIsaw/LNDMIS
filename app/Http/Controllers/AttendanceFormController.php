<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;

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

    public function edit($id){
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
}
