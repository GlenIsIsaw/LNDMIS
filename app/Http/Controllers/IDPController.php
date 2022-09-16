<?php

namespace App\Http\Controllers;

use App\Models\Idp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;


class IDPController extends Controller
{
    public function check($id){
        if(auth()->user()->role_as == 0)
        {
            if($id != auth()->id())
            {
                abort(403, 'Unauthorized Action');
            }
        }
    }
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
        if($request->has('purpose_meet') && !empty($request->input('purpose_meet'))) {
            $info->purpose_meet = request('purpose_meet');
        }else{
            $info->purpose_meet = " ";
        }
        if($request->has('purpose_improve') && !empty($request->input('purpose_improve'))) {
            $info->purpose_improve = request('purpose_improve');
        }else{
            $info->purpose_improve = " ";
        }
        if($request->has('purpose_obtain') && !empty($request->input('purpose_obtain'))) {
            $info->purpose_obtain = request('purpose_obtain');
        }else{
            $info->purpose_obtain = " ";
        }
        if($request->has('purpose_others') && !empty($request->input('purpose_others'))) {
            $info->purpose_others = request('purpose_others');
            $info->purpose_explain = request('purpose_explain');
        }else{
            $info->purpose_others = " ";
            $info->purpose_explain = " ";
        }
        $info->competency = request('competency');
        $info->sug = request('sug');
        $info->dev_act = request('dev_act');
        $info->target_date = request('target_date');
        $info->responsible = request('responsible');
        $info->support = request('support');
        $info->status = request('status');
        $info->compfunction0 = request('compfunction0');
        $info->compfunctiondesc0 = request('compfunctiondesc0');
        $info->compfunction1 = request('compfunction1');
        $info->compfunctiondesc1 = request('compfunctiondesc1');
        $info->diffunction0 = request('diffunction0');
        $info->diffunctiondesc0 = request('diffunctiondesc0');
        $info->diffunction1 = request('diffunction1');
        $info->diffunctiondesc1 = request('diffunctiondesc1');
        $info->career = request('career');
        $info->save();
        return redirect('/idp')->with('mssg', 'IDP Created') ;
    }

    public function empindex(){
        $lists = Idp::select('idps.id as idp_id','user_id','name', 'idps.created_at')
                    ->join('users', 'users.id', '=', 'idps.user_id')
                    ->where('users.id',auth()->user()->id)
                    ->orderBy('idps.created_at','desc')
                    ->filter(request(['search']))
                    ->get();
        return view('employee.idpindex', [
            'idps' => $lists
        ]);
    }
    public function show($id){
        $training = DB::table('idps')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('idps.id', $id)
            ->select('idps.id as idp_id','name','position','yearinPosition','yearJoined','supervisor','user_id','purpose_meet','purpose_improve','purpose_obtain','purpose_others','purpose_explain','competency','sug','dev_act','target_date','responsible','support','status','compfunction0','compfunctiondesc0','compfunction1','compfunctiondesc1','diffunction0','diffunctiondesc0','diffunction1','diffunctiondesc1','career','idps.created_at')
            ->first();


    $this->check($training->user_id);

    return view('idp.show', ['idp' => $training]);

    }
    public function edit($id){
        $training = DB::table('idps')
        ->join('users', 'users.id', '=', 'idps.user_id')
        ->where('idps.id', $id)
        ->select('idps.id as idp_id','name','position','yearinPosition','yearJoined','supervisor','user_id','purpose_meet','purpose_improve','purpose_obtain','purpose_others','purpose_explain','competency','sug','dev_act','target_date','responsible','support','status','compfunction0','compfunctiondesc0','compfunction1','compfunctiondesc1','diffunction0','diffunctiondesc0','diffunction1','diffunctiondesc1','career','idps.created_at')
        ->first();

        $this->check($training->user_id);
        return view('idp.edit', ['idp' => $training]);

    }
    public function update(Request $request, $id){
        $info = Idp::find($id);
        $this->check($info->user_id);
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
        $info->user_id = request('user_id');
        if($request->has('purpose_meet') && !empty($request->input('purpose_meet'))) {
            $info->purpose_meet = request('purpose_meet');
        }else{
            $info->purpose_meet = " ";
        }
        if($request->has('purpose_improve') && !empty($request->input('purpose_improve'))) {
            $info->purpose_improve = request('purpose_improve');
        }else{
            $info->purpose_improve = " ";
        }
        if($request->has('purpose_obtain') && !empty($request->input('purpose_obtain'))) {
            $info->purpose_obtain = request('purpose_obtain');
        }else{
            $info->purpose_obtain = " ";
        }
        if($request->has('purpose_others') && !empty($request->input('purpose_others'))) {
            $info->purpose_others = request('purpose_others');
            $info->purpose_explain = request('purpose_explain');
        }else{
            $info->purpose_others = " ";
            $info->purpose_explain = " ";
        }

            

        $info->competency = request('competency');
        $info->sug = request('sug');
        $info->dev_act = request('dev_act');
        $info->target_date = request('target_date');
        $info->responsible = request('responsible');
        $info->support = request('support');
        $info->status = request('status');
        $info->compfunction0 = request('compfunction0');
        $info->compfunctiondesc0 = request('compfunctiondesc0');
        $info->compfunction1 = request('compfunction1');
        $info->compfunctiondesc1 = request('compfunctiondesc1');
        $info->diffunction0 = request('diffunction0');
        $info->diffunctiondesc0 = request('diffunctiondesc0');
        $info->diffunction1 = request('diffunction1');
        $info->diffunctiondesc1 = request('diffunctiondesc1');
        $info->career = request('career');
        $info->save();
        return redirect('/idp')->with('mssg', 'IDP Updated') ;
    }
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
