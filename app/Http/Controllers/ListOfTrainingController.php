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
}
