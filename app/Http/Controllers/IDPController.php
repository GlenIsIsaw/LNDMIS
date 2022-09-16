<?php

namespace App\Http\Controllers;

use App\Models\Idp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;


class IDPController extends Controller
{
    public function create(){
        return view('idp.create');
    }
    public function store(Request $request){
        $formFields = $request->validate([
            'user_id' => 'required',
            'competency' => 'required',
            'sug' => 'required',
            'dev_act' => 'required',
            'target_date' => 'required',
            'responsible' => 'required',
            'support' => 'required',
            'status' => 'required',
            'compfunctiondesc0' => 'required',
            'compfunctiondesc1' => 'required',
            'diffunctiondesc0' => 'required',
            'diffunctiondesc1' => 'required',
            'career' => 'required',
        ]);

        $info = new Idp();
        $info->user_id = request('user_id');
        $info->purpose_meet = ' '.request('purpose_meet');
        $info->purpose_improve = ' '.request('purpose_improve');
        $info->purpose_obtain = ' '.request('purpose_obtain');
        $info->purpose_others = ' '.request('purpose_others');
        $info->competency = request('competency');
        $info->sug = request('sug');
        $info->dev_act = request('dev_act');
        $info->target_date = request('target_date');
        $info->responsible = request('responsible');
        $info->support = request('support');
        $info->status = request('status');
        $info->compfunctiondesc0 = request('compfunction1').' - '.request('compfunctiondesc0');
        $info->compfunctiondesc1 = request('compfunction2').' - '.request('compfunctiondesc1');
        $info->diffunctiondesc0 = request('diffunction1').' - '.request('diffunctiondesc0');
        $info->diffunctiondesc1 = request('diffunction2').' - '.request('diffunctiondesc1');
        $info->career = request('career');
        $info->save();
        return redirect('/home')->with('mssg', 'IDP Created') ;
    }
    
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

        if($document->esign == ' '){
            $templateProcessor->setValue('esign', $document->esign);
            $templateProcessor->setValue('edate', $document->edate);
        } else{

        }
        if($document->ssign == ' '){
            $templateProcessor->setValue('ssign', $document->ssign);
            $templateProcessor->setValue('sdate', $document->sdate);
        } else{
            
        }
        if($document->hsign == ' '){
            $templateProcessor->setValue('hsign', $document->hsign);
            $templateProcessor->setValue('hdate', $document->hdate);
        } else{
            
        }


        //$templateProcessor->setImageValue('signature', array('path' => $document->signature, 'width' => 100, 'height' => 50, 'ratio' => false));
        $templateProcessor->saveAs($document->name.'_Individual_Development_Plan'.'.docx');
        return response()->download(public_path($document->name.'_Individual_Development_Plan'.'.docx'))->deleteFileAfterSend(true);
    }
}
