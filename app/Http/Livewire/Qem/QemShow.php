<?php

namespace App\Http\Livewire\Qem;


use App\Models\Qem;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class QemShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentUrl, $toggle, $training_id, $name, $certificate_title, $date_covered, $date_eval, $venue, $sponsors, $remarks, $total_average, $rating, $qem_id, $supervisor;
    public $content, $benefits, $realization = [];
    public $query = [];
    public $table = 'Training Need QEM';
    public $state = null;
    public $next = null;

    protected $listeners = [
        'toggle' => 'open'
    ];

    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function next(){
        ++$this->next;
    }
    public function back(){
        $this->total_average = null;
        --$this->next;
    }

    public function checkTable(){
        if($this->table == 'Pending QEM'){

            $this->query = ['qems.status','Pending'];
        }
        if($this->table == 'Approved QEM'){

            $this->query = ['qems.status','Approved'];
        }

    } 
    public function SubmitQEM(){
        $this->backButton();
        $this->table = 'Not Submitted QEM';
    }
    public function trainingNeedQem(){
        $this->backButton();
        $this->table = 'Training Need QEM';
    }
    public function PendingQem(){
        $this->backButton();
        $this->table = 'Pending QEM';
    }
    public function ApprovedQem(){
        $this->backButton();
        $this->table = 'Approved QEM';
    }

    public function createButton($id){
        $this->next = 0;
        $this->state = 'create';

        $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
        ->where('college_id',auth()->user()->college_id)
        ->where('list_of_trainings.status','Approved')
        ->where('list_of_trainings.id',$id)
        ->orderBy('list_of_trainings.updated_at','desc')
        ->first();

        //dd(date('F'.' '.'j'.', '.'Y'));
        $this->training_id = $lists->training_id;
        $this->name = $lists->name;
        $this->certificate_title = $lists->certificate_title;

        //dd($lists);



    }
    public function updateButton(){
        $this->next = 0;
        $this->state = 'edit';

    }

    public function showButton(){
        $this->state = 'show';

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

    public function backButton(){
        $this->resetInput();
        $this->clear();
    }
    public function clear(){
        $this->state = null;
        $this->next = null;
    }
    /*
    protected function rules()
    {
        return [
            'content' => 'required',
            'content.*' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    */

    public function part1(){
        $validatedData = $this->validate([
            'content' => 'required',
            'content.0' => 'required',
            'content.1' => 'required',
            'content.2' => 'required',
        ]);
        
        $sum = 0;
        $count = 0;
            for ($i=0; $i < 3; $i++) { 
                if ($this->content[$i] != 'on') {
                    $sum += $this->content[$i];
                    $count++;
                }
                
            }
        $this->content['total'] = $sum;
        if ($count) {
            $this->content['average'] = round($sum/$count, 2);
        }else {
            $this->content['average'] = 0;
        }
        
        
        //dd($this->content);
        ++$this->next;
    }
    public function part2(){
        $validatedData = $this->validate([
            'benefits' => 'required',
            'benefits.0' => 'required',
            'benefits.1' => 'required',
            'benefits.2' => 'required',
        ]);


        $sum = 0;
        $count = 0;
            for ($i=0; $i < 3; $i++) { 
                if ($this->benefits[$i] != 'on') {
                    $sum += $this->benefits[$i];
                    $count++;
                }
                
            }
        $this->benefits['total'] = $sum;
        if ($count) {
            $this->benefits['average'] = round($sum/$count, 2);
        }else {
            $this->benefits['average'] = 0;
        }

        //dd($this->benefits);
        ++$this->next;
    }
    public function part3(){
        $validatedData = $this->validate([
            'realization' => 'required',
            'realization.0' => 'required',
            'realization.1' => 'required',
            'realization.2' => 'required',
        ]);


        $sum = 0;
        $count = 0;
            for ($i=0; $i < 3; $i++) { 
                if ($this->realization[$i] != 'on') {
                    $sum += $this->realization[$i];
                    $count++;
                }
                
            }
        $this->realization['total'] = $sum;
        if ($count) {
            $this->realization['average'] = round($sum/$count, 2);
        }else {
            $this->realization['average'] = 0;
        }
        //dd($this->realization);
        $count = 0;
        if ($this->realization['average']) {
            $count++;
        }
        if ($this->benefits['average']) {
            $count++;
        }
        if ($this->content['average']) {
            $count++;
        }

        $rateSum = $this->realization['average'] + $this->benefits['average'] + $this->content['average'];
        if ($count) {
            $this->total_average = round($rateSum / $count, 2);
        }else {
            $this->total_average = 0;
        }
        //dd($this->total_average);
        $this->rating();
        ++$this->next;
        

    }
    public function rating(){

        if($this->total_average >= 2.61 && $this->total_average <= 3.0){
            $this->rating = 'Very Effective';
        }
        if($this->total_average >= 1.81 && $this->total_average <= 2.60){
            $this->rating = 'Effective';
        }
        if($this->total_average >= 1.0 && $this->total_average <= 1.80){
            $this->rating = 'Not Effective';
        }
        if(!$this->total_average){
            $this->rating = 'No Rating';
        }


    }
    public function getSupervisor($id){
        $idp = ListOfTraining::select('supervisor')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('colleges', 'colleges.id', '=', 'users.college_id')
        ->where('list_of_trainings.id', $id)
        ->first();
        $supervisor = User::select('name')
            ->join('colleges', 'colleges.id', '=', 'users.college_id')
            ->where('users.id','=',$idp->supervisor)
            ->first();

        return $supervisor->name;
    } 
    public function store(){
        $validatedData = $this->validate([
            'remarks' => Rule::requiredIf($this->rating == 'Not Effective'),
        ]);
        //dd($this->getSupervisor($this->training_id));
        //dd(json_encode($this->content));
        $qem = new Qem();
        $qem->list_of_training_id = $this->training_id;
        $qem->content = json_encode($this->content);
        $qem->benefits = json_encode($this->benefits);
        $qem->realization = json_encode($this->realization);
        
        $qem->supervisor = $this->getSupervisor($this->training_id);
        $qem->total_average = $this->total_average;
        if ($this->rating == 'Not Effective') {
            $qem->remarks = $this->remarks;
        }else {
            $qem->remarks = ' ';
        }

        $check = Qem::where('list_of_training_id', $this->training_id)
                    ->first();
        if($check){
            session()->flash('message','The Training already has a QEM');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
        }else {

            if (auth()->user()->role_as == 2) {
                $qem->status = 'Approved';
            }
            $qem->save();
            $training = ListOfTraining::find($this->training_id);
            $training->qem = 1;
            $training->save();
            session()->flash('message','QEM Created Successfuly');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
        }


    }
    public function edit($id){
        $qem = Qem::select('qems.id As qem_id', 'name', 'list_of_trainings.id As training_id','certificate_title', 'content','benefits', 'realization', 'supervisor','total_average', 'remarks')
            ->join('list_of_trainings', 'list_of_trainings.id', '=', 'qems.list_of_training_id')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->where('qems.list_of_training_id','=', $id)
            ->first();
        
        if ($qem) {
            $this->qem_id = $qem->qem_id;
            $this->name = $qem->name;
            $this->certificate_title = $qem->certificate_title;
            $this->remarks = $qem->remarks;
            //$this->rating = $qem->rating;
            $this->content = json_decode($qem->content, true);
            $this->benefits = json_decode($qem->benefits, true);
            $this->realization = json_decode($qem->realization, true);
            $this->updateButton();
        } else {
            session()->flash('message','No Data');
            $this->backButton();
        }
        
    }
    public function update(){
        $validatedData = $this->validate([
            'remarks' => Rule::requiredIf($this->rating == 'Not Effective'),
        ]);
        //dd($this->getSupervisor($this->training_id));
        //dd(json_encode($this->content));
        $qem = Qem::find($this->qem_id);
        $qem->content = json_encode($this->content);
        $qem->benefits = json_encode($this->benefits);
        $qem->realization = json_encode($this->realization);
        $qem->total_average = $this->total_average;
        if ($this->rating == 'Not Effective') {
            $qem->remarks = $this->remarks;
        }else {
            $qem->remarks = ' ';
        }

        $qem->save();

        session()->flash('message','QEM Updated Successfuly');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    

    public function destroy()
    {
        $qem = Qem::select('qems.id As qem_id')
                        ->join('list_of_trainings', 'list_of_trainings.id', '=', 'qems.list_of_training_id')
                        ->where('qems.list_of_training_id','=',$this->training_id)
                        ->first();
        Qem::find($qem->qem_id)->delete();
        $training = ListOfTraining::find($this->training_id);
        $training->qem = 0;
        $training->save();
        session()->flash('message','Qem Deleted Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function show(int $id){
        $qem = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency', 'content','benefits', 'realization', 'supervisor','total_average', 'remarks', 'qems.created_at As date_eval')
                    ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->where('college_id',auth()->user()->college_id)
                    ->where('list_of_trainings.status','Approved')
                    ->where('list_of_trainings.id',$id)
                    ->first();
        //dd($qem);
        if ($qem) {
            $this->qem_id = $qem->qem_id;
            $this->name = $qem->name;
            $this->certificate_title = $qem->certificate_title;
            $this->remarks = $qem->remarks;
            $this->date_covered = $qem->date_covered;
            $this->date_eval = $qem->date_eval;
            $this->venue = $qem->venue;
            $this->sponsors = $qem->sponsors;
            $this->content = json_decode($qem->content, true);
            $this->benefits = json_decode($qem->benefits, true);
            $this->realization = json_decode($qem->realization, true);
            $this->total_average = $qem->total_average;
            $this->supervisor = $qem->supervisor;
            $this->rating();
            //dd($this->content);
            $this->showButton();
        } else {
            session()->flash('message','No Data');
            $this->backButton();
        }

    }
    public function getQemId(int $id){
        $this->qem_id = $id;
    }
    public function submit(){
        $list = Qem::find($this->qem_id);
        if(auth()->user()->role_as == 1)
        {
            if ($list->status == 'Not Submitted'){
                    session()->flash('message','Qem Submitted');
                    $list->status = 'Pending';
                    $list->save();
                    $this->backButton();
                    $this->dispatchBrowserEvent('close-modal');


            }else{
                session()->flash('message','The training has already been submitted or accepted');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You do not have the authority to submit this');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function approve(){
        $list = Qem::find($this->qem_id);
        if(auth()->user()->role_as == 2)
        {
            if ($list->status == 'Pending'){
                    session()->flash('message','Qem Approved');
                    $list->status = 'Approved';
                    $list->save();
                    $this->backButton();
                    $this->dispatchBrowserEvent('close-modal');
            }else{
                session()->flash('message','The training has already been approved');
                $this->dispatchBrowserEvent('close-modal');
            }
        }else{
            session()->flash('message','You do not have the authority to approve this');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->training_id = null;
        $this->qem_id = null;
        $this->name = null;
        $this->certificate_title = null;
        $this->date_covered = null;
        $this->date_eval = null;
        $this->venue = null;
        $this->sponsors = null;
        $this->remarks = null;
        $this->rating = null;
        $this->content = [];
        $this->benefits = [];
        $this->realization = [];
        $this->supervisor = null;
        $this->resetErrorBag();
    }
    public function resetFilter(){

    }
    public function getId($id){
        $this->training_id = $id;
    }
    public function mount()
    {
        $this->currentUrl = url()->current();
        /*
        $lists = ListOfTraining::join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
            ->where('college_id',auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('list_of_trainings.status','Approved')
            ->orderBy('list_of_trainings.updated_at','desc')
            ->get();
            */
    }
    public function render()
    {
        $this->notification();
        $this->checkTable();
        $this->dispatchBrowserEvent('toggle');

        if ($this->table == 'Training Need QEM') {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('list_of_trainings.status','Approved')
                ->where('qem',0)
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(10);
        }elseif ($this->table == 'Not Submitted QEM') {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                ->where('college_id',auth()->user()->college_id)
                ->where('qems.status','Not Submitted')
                ->where('list_of_trainings.status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(10);

        }
        else{
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                ->where('college_id',auth()->user()->college_id)
                ->where($this->query[0],$this->query[1])
                ->where('list_of_trainings.status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(10);
        }



        return view('livewire.qem.qem-show', ['trainings' => $lists]);
    }
}
