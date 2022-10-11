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
    public function print(Request $request,$id)
    {
        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $id)
        ->select('name', 'certificate_title', 'date_covered','college', 'level','venue','sponsors','competency','knowledge_acquired','outcome','personal_action')
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
            $templateProcessor->setValue('college',$training->college);
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
