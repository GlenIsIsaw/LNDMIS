<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;


class IDPController extends Controller
{
    public function year($year){
        $pieces = explode("-", $year);
        $current_year = date('Y');
        return $current_year - $pieces[0];
    }
    public function print($id){
        $document = DB::table('idps')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('idps.id', $id)
                //->select('list_of_trainings.id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate')
                ->first();


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

            'compe0' => $document->competency1,
            'prio0' => $document->sug1,
            'devact0' => $document->dev_act1,
            'date0' => $document->target_date1,
            'person0' => $document->responsible1,
            'supp0' => $document->support1,
            'complestat0' => $document->status1,

            'compe1' => $document->competency2,
            'prio1' => $document->sug2,
            'devact1' => $document->dev_act2,
            'date1' => $document->target_date2,
            'person1' => $document->responsible2,
            'supp1' => $document->support2,
            'complestat1' => $document->status2,

            'compe2' => $document->competency3,
            'prio2' => $document->sug3,
            'devact2' => $document->dev_act3,
            'date2' => $document->target_date3,
            'person2' => $document->responsible3,
            'supp2' => $document->support3,
            'complestat2' => $document->status3,

            'compfunctiondesc0' => $document->compfunctiondesc0,
            'compfunctiondesc1' => $document->compfunctiondesc1,

            'diffunctiondesc0' => $document->difffunctiondesc0,
            'diffunctiondesc1' => $document->difffunctiondesc1,

            'career' => $document->career
            
        ];

        $templateProcessor = new TemplateProcessor(storage_path('IDP.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }


        //$templateProcessor->setImageValue('signature', array('path' => $document->signature, 'width' => 100, 'height' => 50, 'ratio' => false));
        $templateProcessor->saveAs($document->name.'idp'.'.docx');
        return response()->download(public_path($document->name.'idp'.'.docx'))->deleteFileAfterSend(true);
    }
}
