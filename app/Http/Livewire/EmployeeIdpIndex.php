<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Idp;
use App\Models\User;
use Livewire\Component;

class EmployeeIdpIndex extends Component
{
    public $idp_id,$name,$position,$yearinPosition,$yearJoined,$supervisor,$user_id,$purpose_meet,$purpose_improve,$purpose_obtain,$purpose_others,$purpose_explain,$compfunction0,$compfunctiondesc0,$compfunction1,$compfunctiondesc1,$diffunction0,$diffunctiondesc0,$diffunction1,$diffunctiondesc1,$career,$created_at,$submit_status;
    public $competency = [' ',' ',' '];
    public $sug = [' ',' ',' '];
    public $dev_act = [' ',' ',' '];
    public $target_date = [' ',' ',' '];
    public $responsible = [' ',' ',' '];
    public $support = [' ',' ',' '];
    public $status = [' ',' ',' '];
    public $search = '';
    public $start_date = '';
    public $end_date = '';
    public $filterStatus = '';
    
        protected function rules()
    {
        return [
            'user_id' => 'required',
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
    }
    public function keep(){
        $validatedData = $this->validate([
            'user_id' => 'required|numeric',
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

            'competency.0' => 'required|distinct',
            'sug.0' => 'required',
            'dev_act.0' => 'required',
            'target_date.0' => 'required',
            'responsible.0' => 'required',
            'support.0' => 'required',

            'competency.1' => 'required|distinct',
            'sug.1' => 'required',
            'dev_act.1' => 'required',
            'target_date.1' => 'required',
            'responsible.1' => 'required',
            'support.1' => 'required',


            'competency.2' => 'required|distinct',
            'sug.2' => 'required',
            'dev_act.2' => 'required',
            'target_date.2' => 'required',
            'responsible.2' => 'required',
            'support.2' => 'required',


        ]);

        $this->purpose_meet = $validatedData['purpose_meet'];
        $this->purpose_improve = $validatedData['purpose_improve'];
        $this->purpose_obtain = $validatedData['purpose_obtain'];
        $this->purpose_others = $validatedData['purpose_others'];
        $this->purpose_explain = $validatedData['purpose_explain'];
        $this->user_id = $validatedData['user_id'];
        $this->competency = $validatedData['competency'];
        $this->sug = $validatedData['sug'];
        $this->dev_act = $validatedData['dev_act'];
        $this->target_date = $validatedData['target_date'];
        $this->responsible = $validatedData['responsible'];
        $this->support = $validatedData['support'];
        $this->status = ["Ongoing","Ongoing","Ongoing"];

        $this->dispatchBrowserEvent('open-create2');


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
        $idp->user_id = $this->user_id;
        $idp->competency = $this->competency;
        $idp->sug = $this->sug;
        $idp->dev_act = $this->dev_act;
        $idp->target_date = $this->target_date;
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
        $this->compfunction0 = $validatedData['compfunction0'];
        $this->compfunctiondesc0 = $validatedData['compfunctiondesc0'];
        $this->compfunction1 = $validatedData['compfunction1'];
        $this->compfunctiondesc1 = $validatedData['compfunctiondesc1'];
        $this->diffunction0 = $validatedData['diffunction0'];
        $this->diffunctiondesc0 = $validatedData['diffunctiondesc0'];
        $this->diffunction1 = $validatedData['diffunction1'];
        $this->diffunctiondesc1 = $validatedData['diffunctiondesc1'];
        $this->career = $validatedData['career'];
        $this->getUser();
        session()->flash('message','IDP Added Successfully');
        $this->dispatchBrowserEvent('open-show-modal');
    }
    public static function year($year){
        $pieces = explode("-", $year);
        $current_year = date('Y');
        return $current_year - $pieces[0];
    }

    public function show($id){
        $idp = Idp::select('idps.id as idp_id','name','position','yearinPosition','yearJoined','supervisor','user_id','purpose_meet','purpose_improve','purpose_obtain','purpose_others','purpose_explain','competency','sug','dev_act','target_date','responsible','support','status','compfunction0','compfunctiondesc0','compfunction1','compfunctiondesc1','diffunction0','diffunctiondesc0','diffunction1','diffunctiondesc1','career','idps.created_at','submit_status')
                        ->join('users', 'users.id', '=', 'idps.user_id')
                        ->where('idps.id', $id)
                        ->first();
        if($idp){
            $this->idp_id = $idp->idp_id;
            $pieces = explode("-", $idp->created_at);
            $this->created_at = $pieces[0];
            $this->user_id = $idp->user_id;
            $this->name = $idp->name;
            $this->position = $idp->position;
            $this->yearinPosition = $this->year($idp->yearinPosition);
            $this->yearJoined = $this->year($idp->yearJoined);
            $this->college = $idp->college;
            $this->supervisor = $idp->supervisor;
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
        }else{
            return redirect()->to('/empIDP')->with('message','No results found');
        }
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
            }else{
                $this->purpose_meet = false;
            }

            if ($idp->purpose_improve == "/"){
                $this->purpose_improve = $idp->purpose_improve;
            }else{
                $this->purpose_improve = false;
            }

            if ($idp->purpose_obtain == "/"){
                $this->purpose_obtain = $idp->purpose_obtain;
            }else{ 
                $this->purpose_obtain = false;
            }

            if ($idp->purpose_others == "/"){
                $this->purpose_others = $idp->purpose_others;
                $this->purpose_explain = $idp->purpose_explain;
            }else{
                $this->purpose_others = false;
            }
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
        }else{
            return redirect()->to('/empIDP')->with('message','No results found');
        }
    }
    public function next(){
        $validatedData = $this->validate([
            'user_id' => 'required|numeric',
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

            'competency.0' => 'required|distinct',
            'sug.0' => 'required',
            'dev_act.0' => 'required',
            'target_date.0' => 'required',
            'responsible.0' => 'required',
            'support.0' => 'required',

            'competency.1' => 'required|distinct',
            'sug.1' => 'required',
            'dev_act.1' => 'required',
            'target_date.1' => 'required',
            'responsible.1' => 'required',
            'support.1' => 'required',


            'competency.2' => 'required|distinct',
            'sug.2' => 'required',
            'dev_act.2' => 'required',
            'target_date.2' => 'required',
            'responsible.2' => 'required',
            'support.2' => 'required',

        ]);
        $this->dispatchBrowserEvent('open-nextUpdate-modal');
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
        $idp->user_id = $this->user_id;
        $idp->competency = $this->competency;
        $idp->sug = $this->sug;
        $idp->dev_act = $this->dev_act;
        $idp->target_date = $this->target_date;
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
        session()->flash('message','IDP Updated Successfully');
        $this->dispatchBrowserEvent('open-show-modal');
    }
    public function submit(){
        $list = Idp::find($this->idp_id);
        if($list->user_id != auth()->user()->id)
        {
            abort(403, 'Unauthorized Action');
        }

        $list->submit_status = 'Pending';
        $list->save();
        session()->flash('message',$list->certificate_title.' Submitted');
        $this->dispatchBrowserEvent('close-modal');
            

    }
    public function removeSubmit(){
        $list = Idp::find($this->idp_id);
        if($list->user_id != auth()->user()->id)
        {
            abort(403, 'Unauthorized Action');
        }
        if ($list->submit_status == 'Pending') {
            session()->flash('message','Removed the Submission of your IDP');
            $this->dispatchBrowserEvent('close-modal');
            $list->submit_status = 'Not Submitted';
            $list->save();
        }else{
            session()->flash('message','You can no longer Remove the Submission');
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function render()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status', 'idps.created_at','idps.updated_at','submit_status')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('users.id',auth()->user()->id)
                ->where('submit_status', 'like', '%'.$this->filterStatus.'%')
                ->where('name', 'like', '%'.$this->search.'%')
                ->whereBetween('idps.created_at',[$start_date,$end_date])
                ->orderBy('idps.created_at','desc')
                ->paginate(10);
        } else {
            $lists = Idp::select('idps.id as idp_id','user_id','name','competency','status', 'idps.created_at','idps.updated_at','submit_status')
                ->join('users', 'users.id', '=', 'idps.user_id')
                ->where('users.id',auth()->user()->id)
                ->where('submit_status', 'like', '%'.$this->filterStatus.'%')
                ->WhereRaw("LOWER(competency) LIKE '%".strtolower($this->search)."%'")
                ->orderBy('idps.created_at','desc')
                ->paginate(10);
        }
        

            return view('livewire.employee-idp-index', [
            'idps' => $lists
        ]);
    }
}
