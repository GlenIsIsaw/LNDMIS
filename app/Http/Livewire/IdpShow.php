<?php

namespace App\Http\Livewire;

use ZipArchive;
use Carbon\Carbon;
use App\Models\Idp;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class IdpShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    public $idp_id,$comment, $name,$position,$yearinPosition,$yearJoined,$supervisor,$user_id,$purpose_meet,$purpose_improve,$purpose_obtain,$purpose_others,$purpose_explain,$compfunction0,$compfunctiondesc0,$compfunction1,$compfunctiondesc1,$diffunction0,$diffunctiondesc0,$diffunction1,$diffunctiondesc1,$career,$created_at, $year,$submit_status, $mySignature,$checkmySignature, $year_table, $id_array;
    public $competency = [' ',' ',' '];
    public $sug = [' ',' ',' '];
    public $dev_act = [' ',' ',' '];
    public $target_date = [' ',' ',' '];
    public $responsible = ['',' ',' '];
    public $input = [];
    public $support = [' ',' ',' '];
    public $status = [' ',' ',' '];
    public $search,$start_date,$end_date,$filter_status, $filter_competency, $filter_completion_status;
    protected $queryString = ['search','filter_status','filter_competency','filter_completion_status'];
    public $query = [];
    public $table = 'Current IDP';

    public $state = null;
    public $next = null;

    protected $listeners = [
        'createIDP' => 'createButton',
        'clearIDP' => 'clear',
        'passIdp' => 'pass'
    ];
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }

    public function pass($string2){
        $this->table = $string2;
    }

    public function after(){
        ++$this->next;
    }
    public function back(){
        --$this->next;
    }
    public function createButton(){
        $nextYear = date('Y') + 1;
        $idpYear = Idp::select('year')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('users.id',auth()->user()->id)
            ->where('year', 'like', '%'.$nextYear.'%')
            ->first();
        if($idpYear){
            session()->flash('message','You already have an IDP for year '.$nextYear);
        }else{
            $this->next = 0;
            $this->state = 'create';

        }

    }
    public function updateButton(){
        $this->next = 0;
        $this->state = 'edit';

    }
    public function showButton(){
        $this->state = 'show';

    }
    public function clear(){
        $this->next = null;
        $this->state = null;
    }
    public function backButton(){
        $this->resetInput();
        $this->clear();
    }
    

    public function checkCoord(){
        if(auth()->user()->role_as == 0)
        {
            return true;
        }
        else{ 
            return false;
        }
    }
    public function checkTable(){
        if($this->table == 'My IDPs'){
            $this->query = ['users.id',auth()->user()->id];
        }
        if($this->table == 'Submitted IDPs'){
            $this->query = ['submit_status','Pending'];

        }
        if($this->table == 'Approved IDPs'){
            $this->query = ['submit_status','Approved'];

        }
        if($this->table == 'Current IDP'){
            $this->query = ['users.id',auth()->user()->id];
            //$this->year = date('Y');
            
        }
    }
    public function checkUpdatedTable(){
        if($this->table == 'My IDPs'){
            $this->clear();
            $this->query = ['users.id',auth()->user()->id];

        }
        if($this->table == 'Submitted IDPs'){
            $this->clear();
            $this->query = ['submit_status','Pending'];

        }
        if($this->table == 'Approved IDPs'){
            $this->clear();
            $this->query = ['submit_status','Approved'];

            
        }
        if($this->table == 'Current IDP'){
            $this->clear();
            $this->query = ['users.id',auth()->user()->id];
            $this->year_table = date('Y');
        }
    }
    
        protected function rules()
    {
        return [
            'purpose_meet' => 'max:1',
            'purpose_obtain' => 'max:1',
            'purpose_improve' => 'max:1',
            'purpose_others' => 'max:1',
            'purpose_explain' => 'max:255',
            'competency' => 'required',
            'sug' => 'required',
            'dev_act' => 'required',
            'target_date' => 'required',
            'responsible' => 'required',
            'support' => 'required',
            'status' => 'required',

            'competency.*' => 'required|distinct',
            'sug.*' => 'required',
            'dev_act.*' => 'required',
            'target_date.*' => 'required',
            'responsible.*' => 'required',
            'support.*' => 'required',
            'status.*' => 'required',

            'compfunction0' => 'required',
            'compfunctiondesc0' => 'required',
            'compfunction1' => 'required',
            'compfunctiondesc1' => 'required',

            'diffunction0' => 'required',
            'diffunctiondesc0' => 'required',
            'diffunction1' => 'required',
            'diffunctiondesc1' => 'required',
            'career' => 'required',

        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function getUser(){
        $user = User::find($this->user_id);
        $this->name = $user->name;
        $this->position = $user->position;
        $this->yearinPosition = $this->year($user->yearinPosition);
        $this->yearJoined = $this->year($user->yearJoined);
        $this->college = $user->college;
        $this->supervisor = $user->supervisor;
    }

    public function resetInput()
    {
        $this->idp_id = '';
        $this->purpose_meet = '';
        $this->purpose_improve = '';
        $this->purpose_obtain = '';
        $this->purpose_others = '';
        $this->purpose_explain = '';
        $this->user_id = '';
        $this->competency = [' ',' ',' '];
        $this->sug = [' ',' ',' '];
        $this->dev_act = [' ',' ',' '];
        $this->target_date = [' ',' ',' '];
        $this->responsible = [' ',' ',' '];
        $this->support = [' ',' ',' '];
        $this->status = [' ',' ',' '];
        $this->input = [];
        $this->compfunction0 = '';
        $this->compfunctiondesc0 = '';
        $this->compfunction1 = '';
        $this->compfunctiondesc1 = '';
        $this->diffunction0 = '';
        $this->diffunctiondesc0 = '';
        $this->diffunction1 = '';
        $this->diffunctiondesc1 = '';
        $this->career = '';
        $this->name = '';
        $this->position = '';
        $this->yearinPosition = '';
        $this->yearJoined = '';
        $this->supervisor = '';
        $this->comment = '';
        $this->mySignature = '';
        $this->checkmySignature = '';
        $this->year = null;
    }
    public function resetFilter(){
        $this->start_date = null;
        $this->end_date = null;
        $this->search = null;
        $this->filter_status = null;
        $this->filter_completion_status = null;
        $this->filter_competency = null;
    }
    public function keep(){
        $validatedData = $this->validate([
            'purpose_meet' => 'max:1',
            'purpose_obtain' => 'max:1',
            'purpose_improve' => 'max:1',
            'purpose_others' => 'max:1',
            'purpose_explain' => 'max:255',
            'competency' => 'required',
            'sug' => 'required',
            'dev_act' => 'required',
            'input' => 'required',
            'support' => 'required',

            'competency.0' => 'required|distinct',
            'sug.0' => 'required',
            'dev_act.0' => 'required',
            'input.0' => 'required',
            'support.0' => 'required',

            'competency.1' => 'required|distinct',
            'sug.1' => 'required',
            'dev_act.1' => 'required',
            'input.1' => 'required',
            'support.1' => 'required',


            'competency.2' => 'required|distinct',
            'sug.2' => 'required',
            'dev_act.2' => 'required',
            'input.2' => 'required',
            'support.2' => 'required',


        ]);

        $this->purpose_meet = $validatedData['purpose_meet'];
        $this->purpose_improve = $validatedData['purpose_improve'];
        $this->purpose_obtain = $validatedData['purpose_obtain'];
        $this->purpose_others = $validatedData['purpose_others'];
        $this->purpose_explain = $validatedData['purpose_explain'];
        $this->user_id = auth()->user()->id;
        $this->competency = $validatedData['competency'];
        $this->sug = $validatedData['sug'];
        $this->input = $validatedData['input'];
        $this->dev_act = $validatedData['dev_act'];
        $this->support = $validatedData['support'];
        $this->status = ["Ongoing","Ongoing","Ongoing"];
        


            
        $this->transfer();
        $this->after();


    }
    public function transfer(){
        $i = 0;
        foreach ($this->input as $value) {
            $array = [];
            $j = 0;
            
            foreach ($value as $key => $item) {
                if($item){
                    $array[$j] = $key;
                    $j++;
                }
            }
            $this->responsible[$i] = implode(", ",$array);
            $i++;
        }
    }
    public function store(){
        $validatedData = $this->validate([
            'compfunction0' => 'required|different:compfunction1',
            'compfunctiondesc0' => 'required',
            'compfunction1' => 'required|different:compfunction0',
            'compfunctiondesc1' => 'required',

            'diffunction0' => 'required|different:diffunction1',
            'diffunctiondesc0' => 'required',
            'diffunction1' => 'required|different:diffunction0',
            'diffunctiondesc1' => 'required',
            'career' => 'required',

        ]);
        $idp = new Idp();
        if($this->purpose_meet != null){
            $idp->purpose_meet =  $this->purpose_meet;
        }
        if($this->purpose_improve != null){
            $idp->purpose_improve = $this->purpose_improve;
        }
        if($this->purpose_obtain != null){
            $idp->purpose_obtain = $this->purpose_obtain;
        }
        if($this->purpose_others != null){
            $idp->purpose_others = $this->purpose_others;
            $idp->purpose_explain = $this->purpose_explain;
        }
        $idp->year = date('Y') + 1;
        $idp->user_id = auth()->user()->id;
        $idp->competency = $this->competency;
        $idp->sug = $this->sug;
        $idp->dev_act = $this->dev_act;
        $idp->target_date = ["December ".$this->year,"December ".$this->year,"December ".$this->year];
        $idp->responsible = $this->responsible;
        $idp->support = $this->support;
        $idp->status = $this->status;
        $idp->compfunction0 = $validatedData['compfunction0'];
        $idp->compfunctiondesc0 = $validatedData['compfunctiondesc0'];
        $idp->compfunction1 = $validatedData['compfunction1'];
        $idp->compfunctiondesc1 = $validatedData['compfunctiondesc1'];
        $idp->diffunction0 = $validatedData['diffunction0'];
        $idp->diffunctiondesc0 = $validatedData['diffunctiondesc0'];
        $idp->diffunction1 = $validatedData['diffunction1'];
        $idp->diffunctiondesc1 = $validatedData['diffunctiondesc1'];
        $idp->career = $validatedData['career'];
        $idp->save();
        $this->getUser();
        session()->flash('message','IDP Added Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public static function year($year){
        $pieces = explode("-", $year);
        $current_year = date('Y');
        return $current_year - $pieces[0];
    }

    public function show($id){
        $idp = Idp::select('idps.id as idp_id','name','position','yearinPosition','yearJoined','supervisor','user_id','purpose_meet','purpose_improve','purpose_obtain','purpose_others','purpose_explain','competency','sug','dev_act','target_date','responsible','support','status','compfunction0','compfunctiondesc0','compfunction1','compfunctiondesc1','diffunction0','diffunctiondesc0','diffunction1','diffunctiondesc1','career','idps.created_at','submit_status','year')
                        ->join('users', 'users.id', '=', 'idps.user_id')
                        ->join('colleges', 'colleges.id', '=', 'users.college_id')
                        ->where('idps.id', $id)
                        ->first();
        $supervisor = User::select('name')
                            ->join('colleges', 'colleges.id', '=', 'users.college_id')
                            ->where('users.id','=',$idp->supervisor)
                            ->first();
        
        if($idp){
            $this->idp_id = $idp->idp_id;
            $pieces = explode("-", $idp->created_at);
            $this->created_at = $pieces[0];
            $this->year = $idp->year;
            $this->user_id = $idp->user_id;
            $this->name = $idp->name;
            $this->position = $idp->position;
            $this->yearinPosition = $this->year($idp->yearinPosition);
            $this->yearJoined = $this->year($idp->yearJoined);
            $this->college = $idp->college_name;
            if($supervisor){
                $this->supervisor = $supervisor->name;
            }else{
                $this->supervisor = 'No Supervisor';
            }
            $this->purpose_meet = $idp->purpose_meet;  
            $this->purpose_improve = $idp->purpose_improve;
            $this->purpose_obtain = $idp->purpose_obtain;
            $this->purpose_others = $idp->purpose_others;
            $this->purpose_explain = $idp->purpose_explain;
            $this->competency = $idp->competency;
            $this->sug = $idp->sug;
            $this->dev_act = $idp->dev_act;
            $this->target_date = $idp->target_date;
            $this->responsible = $idp->responsible;
            $this->support = $idp->support;
            $this->status = $idp->status;
            $this->compfunction0 = $idp->compfunction0;
            $this->compfunctiondesc0 = $idp->compfunctiondesc0;
            $this->compfunction1 = $idp->compfunction1;
            $this->compfunctiondesc1 = $idp->compfunctiondesc1;
            $this->diffunction0 = $idp->diffunction0;
            $this->diffunctiondesc0 = $idp->diffunctiondesc0;
            $this->diffunction1 = $idp->diffunction1;
            $this->diffunctiondesc1 = $idp->diffunctiondesc1;
            $this->career = $idp->career;
            $this->submit_status = $idp->submit_status;
            $this->showButton();
        }else{
            return redirect()->to('/empIDP')->with('message','No results found');
        }
    }
    public function getTraining(){
        
    }
    public function getId($id){
        $this->idp_id = $id;
    }
    public function destroy()
    {
        Idp::find($this->idp_id)->delete();
        session()->flash('message','IDP Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit($id){
        $idp = Idp::select('idps.id as idp_id','user_id','purpose_meet','purpose_improve','purpose_obtain','purpose_others','purpose_explain','competency','sug','dev_act','target_date','responsible','support','status','compfunction0','compfunctiondesc0','compfunction1','compfunctiondesc1','diffunction0','diffunctiondesc0','diffunction1','diffunctiondesc1','career','idps.created_at')
                        ->join('users', 'users.id', '=', 'idps.user_id')
                        ->where('idps.id', $id)
                        ->first();
        if($idp){
            $this->idp_id = $idp->idp_id;
            $this->user_id = $idp->user_id;
            if ($idp->purpose_meet == "/"){
                $this->purpose_meet = $idp->purpose_meet;
            }

            if ($idp->purpose_improve == "/"){
                $this->purpose_improve = $idp->purpose_improve;
            }

            if ($idp->purpose_obtain == "/"){
                $this->purpose_obtain = $idp->purpose_obtain;
            }

            if ($idp->purpose_others == "/"){
                $this->purpose_others = $idp->purpose_others;
                $this->purpose_explain = $idp->purpose_explain;
            }
            $array = [];
            $i = 0;
            foreach ($idp->responsible as $key => $value) {
                $string = explode(", ", $value);
                foreach ($string as $item) {
                    $this->input[$key][$item] = $item;
                }
                
                $i++;
            }
            
            //dd($this->input);
            $this->competency = $idp->competency;
            $this->sug = $idp->sug;
            $this->dev_act = $idp->dev_act;
            $this->target_date = $idp->target_date;
            $this->responsible = $idp->responsible;
            $this->support = $idp->support;
            $this->status = $idp->status;
            $this->compfunction0 = $idp->compfunction0;
            $this->compfunctiondesc0 = $idp->compfunctiondesc0;
            $this->compfunction1 = $idp->compfunction1;
            $this->compfunctiondesc1 = $idp->compfunctiondesc1;
            $this->diffunction0 = $idp->diffunction0;
            $this->diffunctiondesc0 = $idp->diffunctiondesc0;
            $this->diffunction1 = $idp->diffunction1;
            $this->diffunctiondesc1 = $idp->diffunctiondesc1;
            $this->career = $idp->career;
            $this->updateButton();
        }else{
            return redirect()->to('/IDP')->with('message','No results found');
        }
    }
    public function next(){
        $validatedData = $this->validate([
            'purpose_meet' => 'max:1',
            'purpose_obtain' => 'max:1',
            'purpose_improve' => 'max:1',
            'purpose_others' => 'max:1',
            'purpose_explain' => 'max:255',
            'competency' => 'required',
            'sug' => 'required',
            'dev_act' => 'required',
            'responsible' => 'required',
            'support' => 'required',

            'competency.0' => 'required|distinct',
            'sug.0' => 'required',
            'dev_act.0' => 'required',
            'input.0' => 'required',
            'support.0' => 'required',

            'competency.1' => 'required|distinct',
            'sug.1' => 'required',
            'dev_act.1' => 'required',
            'input.1' => 'required',
            'support.1' => 'required',


            'competency.2' => 'required|distinct',
            'sug.2' => 'required',
            'dev_act.2' => 'required',
            'input.2' => 'required',
            'support.2' => 'required',

        ]);
        $this->after();
    }
    public function update(){
        $validatedData = $this->validate([
            'compfunction0' => 'required|different:compfunction1',
            'compfunctiondesc0' => 'required',
            'compfunction1' => 'required|different:compfunction0',
            'compfunctiondesc1' => 'required',

            'diffunction0' => 'required|different:diffunction1',
            'diffunctiondesc0' => 'required',
            'diffunction1' => 'required|different:diffunction0',
            'diffunctiondesc1' => 'required',
            'career' => 'required',

        ]);
        $idp = Idp::find($this->idp_id);
        if ($this->purpose_meet == "/"){
            $idp->purpose_meet =  $this->purpose_meet;
        }else{
            $idp->purpose_meet =  " ";
        }

        if ($this->purpose_improve == "/"){
            $idp->purpose_improve = $this->purpose_improve;
        }else{
            $idp->purpose_improve = ' ';
        }

        if ($this->purpose_obtain == "/"){
            $idp->purpose_obtain = $this->purpose_obtain;
        }else{ 
            $idp->purpose_obtain = ' ';
        }

        if ($this->purpose_others == "/"){
            $idp->purpose_others = $this->purpose_others;
            $idp->purpose_explain = $this->purpose_explain;
        }else{
            $idp->purpose_others = ' ';
            $idp->purpose_explain = ' ';
        }
        $this->transfer();
        $idp->competency = $this->competency;
        $idp->sug = $this->sug;
        $idp->dev_act = $this->dev_act;
        $idp->responsible = $this->responsible;
        $idp->support = $this->support;
        $idp->status = $this->status;
        $idp->compfunction0 = $this->compfunction0;
        $idp->compfunctiondesc0 = $this->compfunctiondesc0;
        $idp->compfunction1 = $this->compfunction1;
        $idp->compfunctiondesc1 = $this->compfunctiondesc1;
        $idp->diffunction0 = $this->diffunction0;
        $idp->diffunctiondesc0 = $this->diffunctiondesc0;
        $idp->diffunction1 = $this->diffunction1;
        $idp->diffunctiondesc1 = $this->diffunctiondesc1;
        $idp->career = $this->career;
        
        $this->getUser();
        $idp->save();
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message','IDP Updated Successfully');
        
    }
    public function submit(){
        $list = Idp::find($this->idp_id);
        //dd(auth()->user()->id);
        if($list->user_id == auth()->user()->id)
        {
            $list->submit_status = 'Pending';
            $list->save();
            session()->flash('message',$list->certificate_title.' Submitted');
            $this->dispatchBrowserEvent('close-modal');
        }else {
            session()->flash('message','You do not have the authority to Submit this IDP');
            $this->dispatchBrowserEvent('close-modal');
        }

    }
    public function removeSubmit(){
        $list = Idp::find($this->idp_id);
        if($list->user_id == auth()->user()->id)
        {
            if ($list->submit_status == 'Pending') {
                session()->flash('message','Removed the Submission of your IDP');
                $this->dispatchBrowserEvent('close-modal');
                $list->submit_status = 'Not Submitted';
                $list->save();
            }else{
                session()->flash('message','You can no longer Remove the Submission');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You do not have the authority to Remove the Submission');
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function reject(){
        if(!$this->checkCoord())
        {
            $list = Idp::find($this->idp_id);
            if ($list->submit_status == 'Pending') 
            {
                $list->submit_status = 'Rejected';
                $list->comment = $this->comment;
                $list->save();
                $this->comment = '';
                $this->dispatchBrowserEvent('close-modal');
                session()->flash('message','Rejected the Submission');
            }else{
                $this->dispatchBrowserEvent('close-modal');
                session()->flash('message','The IDP is not submitted');
            }
        }else {
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','You do not have the authority to reject this Submission');
        }
    }
    public function approve(){
        if(!$this->checkCoord())
        {
            $list = Idp::find($this->idp_id);
            $list->submit_status = 'Approved';
            $list->comment = $this->comment;
            $list->status = ["Completed","Completed","Completed"];
            $list->save();
            $this->comment = '';
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','Approved the Submission');
        }else {
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','You do not have the authority to approve this Submission');
        }
    }
    public function showComment(int $id){
        $lists = Idp::select('comment')
                ->where('idps.id', $id)
                ->first();
        $this->comment = $lists->comment;
    }
    public function signature(int $id){
        $this->idp_id = $id;
        $idp = Idp::select('signature')
                        ->join('users', 'users.id', '=', 'idps.user_id')
                        ->where('idps.id', $id)
                        ->first();

            if($idp->signature){
                $this->checkmySignature = true;
            }else{
                $this->checkmySignature = false;
            }
    }
    public function print(){
        $document = Idp::join('users', 'users.id', '=', 'idps.user_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('idps.id', $this->idp_id)
                ->first();
        $supervisor = User::select('name')
                    ->join('colleges', 'colleges.id', '=', 'users.college_id')
                    ->where('users.id','=',$document->supervisor)
                    ->first();
        
                
        $array = [
            'college' => $document->college,
            'ename' => $document->name,
            'position' => $document->position,
            'pyear' => $this->year($document->yearinPosition),
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
        if($supervisor){
            $templateProcessor->setValue('sname', $supervisor->name);
        }else{
            $templateProcessor->setValue('sname', 'No Supervisor');
        }
        for ($i=0; $i < 3; $i++) { 
            $templateProcessor->setValue('compe'.$i, $document->competency[$i]);
            $templateProcessor->setValue('prio'.$i, $document->sug[$i]);
            $templateProcessor->setValue('devact'.$i, $document->dev_act[$i]);
            $templateProcessor->setValue('date'.$i, $document->target_date[$i]);
            $templateProcessor->setValue('person'.$i, $document->responsible[$i]);
            $templateProcessor->setValue('supp'.$i, $document->support[$i]);
            $templateProcessor->setValue('complestat'.$i, $document->status[$i]);
        }
            $pieces = explode("-", $document->created_at);

            if($this->mySignature == '1'){
                $templateProcessor->setImageValue('esign', array('path' => public_path('storage/users/'.$document->user_id.'/'.$document->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue('edate',date('F j, Y'));
            }else{
                $templateProcessor->setValue('esign'," ");
                $templateProcessor->setValue('edate'," ");
            }
       
            $templateProcessor->setValue('ssign'," ");
            $templateProcessor->setValue('sdate'," ");
        
            $templateProcessor->setValue('hsign'," ");
            $templateProcessor->setValue('hdate'," ");
        

        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/Idp');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/Idp/'.$document->name.'_IDP_'.$document->year.'.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);
        $this->dispatchBrowserEvent('close-modal');
        return $path;
        //return response()->download(storage_path('app/public/users/'.auth()->user()->id.'/Idp'.$document->name.'_IDP_'.$pieces[0].'.docx'))->deleteFileAfterSend(true);
    }
    public function download(){
        $path = $this->print();
        return response()->download($path)->deleteFileAfterSend(true);
    }
    public function printall(){
        $id = [];
        $filename = [];
        $i = 0;
        foreach ($this->allIdp() as $value) {
           $id[$i] = $value['idp_id'];
           $filename[$i] = storage_path('app/public/users/'.auth()->user()->id.'/Idp/'.$value['name'].'_IDP_'.$value['year'].'.docx');
           $i++;
        }
        //dd($filename);
        foreach ($id as $item) {
            $this->idp_id = $item;
            //dd($this->idp_id);
            $this->print();
        }
        $zipname = storage_path('app/public/users/'.auth()->user()->id.'/Idp/Idp.zip');
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($filename as $file) {
        $path = $file;
        if(file_exists($path)){
            $zip->addFromString(basename($path),  file_get_contents($path));  
            }
            File::delete($path);
        }

        $zip->close();
        return response()->download($zipname)->deleteFileAfterSend(true);
        
    }

    public function updatedTable($value){
        $this->checkUpdatedTable();
    }
    public function updatedYear_table($value){
        $this->checkUpdatedTable();
    }
    public function updatingSearch($value){
        $this->resetPage();
    }
    public function updatingFilterStatus($value){
        $this->resetPage();
    }
    public function updatingFilterCompetency($value){
        $this->resetPage();
    }
    public function updatingFilterCompletionStatus($value){
        $this->resetPage();
    }
    public function allIdp(){
                $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status', 'idps.created_at','idps.updated_at','submit_status','comment','year')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where($this->query[0],$this->query[1])
                ->where('year', 'like', '%'.$this->year_table.'%')
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->search)."%'")
                ->where('competency', 'like', '%'.$this->filter_competency.'%')
                ->where('status', 'like', '%'.$this->filter_completion_status.'%')
                ->where('submit_status', 'like', '%'.$this->filter_status.'%')
                ->orderBy('idps.updated_at','desc')
                ->get();

        return $lists;
    }
    public function render()
    {
        $this->notification();
        $this->checkTable();
        $this->dispatchBrowserEvent('toggle');
        if($this->table == 'Current IDP'){
            $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status', 'idps.created_at','idps.updated_at','submit_status','comment','year')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('college_id',auth()->user()->college_id)
            ->where($this->query[0],$this->query[1])
            ->where('year', 'like', '%'.date('Y').'%')
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->search)."%'")
            ->where('competency', 'like', '%'.$this->filter_competency.'%')
            ->where('status', 'like', '%'.$this->filter_completion_status.'%')
            ->where('submit_status', 'like', '%'.$this->filter_status.'%')
            ->orderBy('idps.updated_at','desc')
            ->paginate(3);
        }else{
            $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status', 'idps.created_at','idps.updated_at','submit_status','comment','year')
            ->join('users', 'users.id', '=', 'idps.user_id')
            ->where('college_id',auth()->user()->college_id)
            ->where($this->query[0],$this->query[1])
            ->where('year', 'like', '%'.$this->year_table.'%')
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->search)."%'")
            ->where('competency', 'like', '%'.$this->filter_competency.'%')
            ->where('status', 'like', '%'.$this->filter_completion_status.'%')
            ->where('submit_status', 'like', '%'.$this->filter_status.'%')
            ->orderBy('idps.updated_at','desc')
            ->paginate(3);
        }


        

            return view('livewire.idp-show', [
            'idps' => $lists
        ]);
    }
}
