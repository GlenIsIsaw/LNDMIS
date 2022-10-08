<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Idp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;


class IDPController extends Controller
{
    public static function year($year){
        $pieces = explode("-", $year);
        $current_year = date('Y');
        return $current_year - $pieces[0];
    }
    public function print(Request $request, $id){
        $document = DB::table('idps')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('idps.id', $id)
                ->first();
        $this->check($document->user_id);
                $competency = json_decode($document->competency, true);
                $sug = json_decode($document->sug, true);
                $dev_act = json_decode($document->dev_act, true);
                $target_date = json_decode($document->target_date, true);
                $responsible = json_decode($document->responsible, true);
                $support = json_decode($document->support, true);
                $status = json_decode($document->status, true);
        $array = [
            'college' => $document->college,
            'ename' => $document->name,
            'position' => $document->position,
            'pyear' => $this->year($document->yearinPosition),
            'sname' => $document->supervisor,
            'ayear' => $this->year($document->yearJoined),
            'meet' => $document->purpose_meet,
            'improve' => $document->purpose_improve,
            'obtain' => $document->purpose_obtain,
            'others' => $document->purpose_others,
            'explain' => $document->purpose_explain,

            'compfunction0' => $document->compfunction0,
            'compfunctiondesc0' => $document->compfunctiondesc0,
            'compfunction1' => $document->compfunction1,
            'compfunctiondesc1' => $document->compfunctiondesc1,

            'diffunction0' => $document->diffunction0,
            'diffunctiondesc0' => $document->diffunctiondesc0,
            'diffunction1' => $document->diffunction1,
            'diffunctiondesc1' => $document->diffunctiondesc1,

            'career' => $document->career
            
        ];

        $templateProcessor = new TemplateProcessor(storage_path('IDP.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }
        for ($i=0; $i < 3; $i++) { 
            $templateProcessor->setValue('compe'.$i, $competency[$i]);
            $templateProcessor->setValue('prio'.$i, $sug[$i]);
            $templateProcessor->setValue('devact'.$i, $dev_act[$i]);
            $templateProcessor->setValue('date'.$i, $target_date[$i]);
            $templateProcessor->setValue('person'.$i, $responsible[$i]);
            $templateProcessor->setValue('supp'.$i, $support[$i]);
            $templateProcessor->setValue('complestat'.$i, $status[$i]);
        }
        if($request->file('esign')){
            $file= $request->file('esign');
            $filename= $document->name.'esign';
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
            $filename= $document->name.'ssign';
            $file-> move(public_path('images'), $filename);
            $templateProcessor->setImageValue('ssign', array('path' => public_path('images/'.$filename), 'width' => 100, 'height' => 50, 'ratio' => false));
            $templateProcessor->setValue('sdate',date('F j, Y'));
            File::delete('images/'.$filename);
        }
        else{
            $templateProcessor->setValue('ssign'," ");
            $templateProcessor->setValue('sdate'," ");
        }

        if($request->file('hsign')){
            $file= $request->file('hsign');
            $filename= $document->name.'hsign';
            $file-> move(public_path('images'), $filename);
            $templateProcessor->setImageValue('hsign', array('path' => public_path('images/'.$filename), 'width' => 100, 'height' => 50, 'ratio' => false));
            $templateProcessor->setValue('hdate',date('F j, Y'));
            File::delete('images/'.$filename);
        }
        else{
            $templateProcessor->setValue('hsign'," ");
            $templateProcessor->setValue('hdate'," ");
        }


        //$templateProcessor->setImageValue('signature', array('path' => $document->signature, 'width' => 100, 'height' => 50, 'ratio' => false));
        $templateProcessor->saveAs($document->name.'_Individual_Development_Plan'.'.docx');
        return response()->download(public_path($document->name.'_Individual_Development_Plan'.'.docx'))->deleteFileAfterSend(true);
    }
}
