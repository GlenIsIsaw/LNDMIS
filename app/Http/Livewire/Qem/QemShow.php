<?php

namespace App\Http\Livewire\Qem;


use ZipArchive;
use Carbon\Carbon;
use App\Models\Qem;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class QemShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $currentUrl, $toggle, $training_id, $name, $certificate_title,$filter_certificate_title,$filter_name,$start_date, $end_date, $date_covered, $date_eval, $venue, $sponsors, $remarks, $total_average, $rating, $qem_id, $supervisor, $mySignature;
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
            for ($i=0; $i < 4; $i++) { 
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
        $arr = [];
        $supervisor = User::select('name', 'signature')
            ->join('colleges', 'colleges.id', '=', 'users.college_id')
            ->where('users.id','=',$id)
            ->first();
        if($supervisor){
            return $supervisor;
        }else{
            $arr['name'] = null;
            $arr['signature'] = null;
            return $arr;
        }
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
        
        //$qem->supervisor = $this->getSupervisor($this->training_id);
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
                $qem->supervisor = auth()->user()->id;
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
            ->where('qems.id', $id)
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
        $qem = Qem::find($this->qem_id);
        Qem::find($this->qem_id)->delete();
        $training = ListOfTraining::find($qem->list_of_training_id);
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
                    ->where('qems.id',$id)
                    ->first();
        //dd($qem);
        if ($qem) {
            $this->qem_id = $qem->qem_id;
            $this->name = $qem->name;
            $this->certificate_title = $qem->certificate_title;
            $this->remarks = $qem->remarks;
            $this->date_covered = $qem->date_covered;
            $this->date_eval = $this->split($qem->date_eval);
            $this->venue = $qem->venue;
            $this->sponsors = $qem->sponsors;
            $this->content = json_decode($qem->content, true);
            $this->benefits = json_decode($qem->benefits, true);
            $this->realization = json_decode($qem->realization, true);
            $this->total_average = $qem->total_average;
            $this->supervisor = $this->getSupervisor($qem->supervisor)['name'];
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
                    $list->supervisor = auth()->user()->id;
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
        $this->filter_name = null;
        $this->filter_certificate_title = null;
        $this->start_date = null;
        $this->end_date = null;
    }

    public function getId($id){
        $this->training_id = $id;
    }
    public function printQuery(){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('college_id',auth()->user()->college_id)
        ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
        ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
        ->where('qems.status','Approved')
        ->orderBy('list_of_trainings.updated_at','desc')
        ->get();

        return $lists;
    }
    public function split($string){
        $date = str_split($string, 10);
        return $date[0];
    }

    public function print(){
        $qems = Qem::select('list_of_trainings.id as training_id','user_id','name','date_covered', 'certificate_title','venue','sponsors', 'qems.id AS qem_id', 'content','benefits', 'realization', 'qems.supervisor As sup_id','total_average', 'remarks', 'qems.created_at As date_eval', 'college_name', 'qems.status As qem_status')
                ->join('list_of_trainings', 'list_of_trainings.id', '=', 'qems.list_of_training_id')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->where('qems.id',$this->qem_id)
                ->first();
        
        $qem = $qems->toArray();
        $content = json_decode($qem['content'],true);
        $benefits = json_decode($qem['benefits'],true);
        $realization = json_decode($qem['realization'],true);
        $array = [$content, $benefits, $realization];
        $templateProcessor = new TemplateProcessor(storage_path('QEM.docx'));

        $templateProcessor->setValue('college', $qem['college_name']);
        $templateProcessor->setValue('name', $qem['name']);
        $templateProcessor->setValue('certificate_title', $qem['certificate_title']);
        $templateProcessor->setValue('date_eval', $this->split($qem['date_eval']));
        $templateProcessor->setValue('date_covered', $qem['date_covered']);

        $templateProcessor->setValue('venue', $qem['venue']);
        $templateProcessor->setValue('sponsors', $qem['sponsors']);

        foreach ($array as $key => $value) {
            foreach ($value as $num => $item) {
                if($num == 'total'){
                    $templateProcessor->setValue("total#$key", $item);
                    continue;
                }
                if($num == 'average'){
                    $templateProcessor->setValue("ave#$key", $item);
                    continue;
                }
                if($item == 3){
                    $templateProcessor->setValue("ve#$key#$num", '/');
                    $templateProcessor->setValue("e#$key#$num", ' ');
                    $templateProcessor->setValue("ne#$key#$num", ' ');
                }elseif($item == 2){
                    $templateProcessor->setValue("e#$key#$num", '/');
                    $templateProcessor->setValue("ve#$key#$num", ' ');
                    $templateProcessor->setValue("ne#$key#$num", ' ');
                }elseif($item == 1){
                    $templateProcessor->setValue("ne#$key#$num", '/');
                    $templateProcessor->setValue("ve#$key#$num", ' ');
                    $templateProcessor->setValue("e#$key#$num", ' ');
                }
                else {
                    $templateProcessor->setValue("ve#$key#$num", ' ');
                    $templateProcessor->setValue("e#$key#$num", ' ');
                    $templateProcessor->setValue("ne#$key#$num", ' ');
                }
                $templateProcessor->setValue("num#$key#$num", $item);
            }

        }
        $this->total_average = $qem['total_average'];
        $this->rating();
        $templateProcessor->setValue("total_average", $this->total_average.' - '.$this->rating);
        $templateProcessor->setValue("remarks", $qem['remarks']);
        $supervisor = $this->getSupervisor($qem['sup_id']);
        
        if($qem['qem_status'] == 'Approved'){
            if($supervisor['signature']){
                
                $templateProcessor->setImageValue('signature', array('path' => public_path('storage/users/'.$qem['sup_id'].'/'.$supervisor->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else{
                session()->flash('message','The Supervisor has no signature');
                $templateProcessor->setValue('signature'," ");
            }
            $templateProcessor->setValue("supervisor", $supervisor->name);
            
        }else{
            $templateProcessor->setValue('signature'," ");
            $templateProcessor->setValue("supervisor", " ");
        }
        $this->total_average = null;
        $this->rating = null;

        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/Qem');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/Qem/'.$qem['certificate_title'].'_Qem.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);
        
        return $path;
        
    }
    public function download(){
        $path = $this->print();
        //$this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        return response()->download($path)->deleteFileAfterSend(true);
    }
    public static function year($date){
        $pieces = explode("-", $date);
        return $pieces[0];
    }
    public function dateRange(){
        $daterange = '';
        if ($this->start_date && $this->end_date) {
            $start_month = strftime("%B",strtotime($this->start_date));
            $end_month = strftime("%B",strtotime($this->end_date));
            $year = $this->year($this->end_date);
            $daterange = '';
        
            if ($start_month == $end_month) {
                $daterange = $start_month.' '.$this->year($this->end_date);
            }else {
                $daterange = $start_month.' - '.$end_month.' '.$year;
            }
        }else{
            $daterange = 'All';
        }

        return $daterange;
    }
    public function downloadAll(){
        $id = [];
        $filename = [];
        $i = 0;
        foreach ($this->printQuery() as $value) {
           $id[$i] = $value['qem_id'];
           $filename[$i] = storage_path('app/public/users/'.auth()->user()->id.'/Qem/'.$value['certificate_title'].'_Qem.docx');
           $i++;
        }
        //dd($id);
        //dd($filename);
        foreach ($id as $item) {
            $this->qem_id = $item;
            //dd($this->idp_id);
            $this->print();
        }
        $daterange = $this->dateRange();

        $zipname = storage_path('app/public/users/'.auth()->user()->id.'/Qem/Qem_'.$daterange.'.zip');
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
        $this->dispatchBrowserEvent('close-modal');
        return response()->download($zipname)->deleteFileAfterSend(true);
    }

    public function printQemReports(){
        $qems = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name','college_name','signature','date_covered', 'certificate_title','certificate','venue','sponsors', 'competency','knowledge_acquired', 'outcome','personal_action',  'content','benefits', 'realization', 'qems.supervisor As sup_id','total_average', 'remarks', 'qems.created_at As date_eval')
                ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('colleges', 'colleges.id', '=', 'users.college_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->where('college_id',auth()->user()->college_id)
                ->where('qems.status','Approved')
                ->orderBy('name', 'asc')
                ->get();
        $qem = $qems->toArray();

        $daterange = $this->dateRange();
        //dd($qem);
        $templateProcessor = new TemplateProcessor(storage_path('QEM-Report.docx'));
        $templateProcessor->setValue("college", $qem[0]['college_name']);
        $templateProcessor->setValue("date_range", $daterange);
        $templateProcessor->cloneBlock("qem", count($qem), true, true);
        for ($i=1; $i <= count($qem); $i++) { 
            $content = json_decode($qem[$i-1]['content'],true);
            $benefits = json_decode($qem[$i-1]['benefits'],true);
            $realization = json_decode($qem[$i-1]['realization'],true);
            $array = [$content, $benefits, $realization];
            
            
            
            
            $templateProcessor->setValue("name#$i", $qem[$i-1]['name']);
            $templateProcessor->setValue("certificate_title#$i", $qem[$i-1]['certificate_title']);
            $templateProcessor->setValue("date_eval#$i", $this->split($qem[$i-1]['date_eval']));
            $templateProcessor->setValue("date_covered#$i", $qem[$i-1]['date_covered']);

            $templateProcessor->setValue("venue#$i", $qem[$i-1]['venue']);
            $templateProcessor->setValue("sponsors#$i", $qem[$i-1]['sponsors']);

            foreach ($array as $key => $value) {
                foreach ($value as $num => $item) {
                    if($num == 'total'){
                        $templateProcessor->setValue("total#$key#$i", $item);
                        continue;
                    }
                    if($num == 'average'){
                        $templateProcessor->setValue("ave#$key#$i", $item);
                        continue;
                    }
                    if($item == 3){
                        $templateProcessor->setValue("ve#$key#$num#$i", '/');
                        $templateProcessor->setValue("e#$key#$num#$i", ' ');
                        $templateProcessor->setValue("ne#$key#$num#$i", ' ');
                    }elseif($item == 2){
                        $templateProcessor->setValue("e#$key#$num#$i", '/');
                        $templateProcessor->setValue("ve#$key#$num#$i", ' ');
                        $templateProcessor->setValue("ne#$key#$num#$i", ' ');
                    }elseif($item == 1){
                        $templateProcessor->setValue("ne#$key#$num#$i", '/');
                        $templateProcessor->setValue("ve#$key#$num#$i", ' ');
                        $templateProcessor->setValue("e#$key#$num#$i", ' ');
                    }
                    else {
                        $templateProcessor->setValue("ve#$key#$num#$i", ' ');
                        $templateProcessor->setValue("e#$key#$num#$i", ' ');
                        $templateProcessor->setValue("ne#$key#$num#$i", ' ');
                    }
                    $templateProcessor->setValue("num#$key#$num#$i", $item);
                }

            }
            $this->total_average = $qem[$i-1]['total_average'];
            $this->rating();
            $templateProcessor->setValue("total_average#$i", $this->total_average.' - '.$this->rating);
            $templateProcessor->setValue("remarks#$i", $qem[$i-1]['remarks']);
            $this->total_average = null;
            $this->rating = null;

            $templateProcessor->setValue("competency#$i", $qem[$i-1]['competency']);
            $templateProcessor->setValue("knowledge_acquired#$i", $qem[$i-1]['knowledge_acquired']);
            $templateProcessor->setValue("outcome#$i", $qem[$i-1]['outcome']);
            $templateProcessor->setValue("personal_action#$i", $qem[$i-1]['personal_action']);

            $templateProcessor->setImageValue("certificate#$i", array('path' => public_path('storage/users/'.$qem[$i-1]['user_id'].'/'.$qem[$i-1]['certificate']), 'width' => 700, 'height' => 500, 'ratio' => false));


            $supervisor = $this->getSupervisor($qem[$i-1]['sup_id']);
            $templateProcessor->setValue("sname#$i", $supervisor['name']);


            if ($supervisor['signature']) {
                $templateProcessor->setImageValue("ssign#$i", array('path' => public_path('storage/users/'.$qem[$i-1]['sup_id'].'/'.$supervisor->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue("sdate#$i", date('F j, Y'));
            } else {
                $templateProcessor->setValue("ssign#$i", ' ');
                $templateProcessor->setValue("sdate#$i", ' ');
            }

            if($qem[$i-1]['signature']){
                $templateProcessor->setImageValue("esign#$i", array('path' => public_path('storage/users/'.$qem[$i-1]['user_id'].'/'.$qem[$i-1]['signature']), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue("edate#$i", date('F j, Y'));
            }else{
                $templateProcessor->setValue("esign#$i", ' ');
                $templateProcessor->setValue("edate#$i", ' ');
            }
            
        }
        
        
        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/QemReports');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/QemReports/'.'QemReports_'.$daterange.'.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);

        $this->dispatchBrowserEvent('close-modal');
        return response()->download($path)->deleteFileAfterSend(true);
        
    }
    public function updatingFilterCertificateTitle($value){
        $this->resetPage();
    }
    public function updatingFilterName($value){
        $this->resetPage();
    }
    public function updatingEndDate($value){
        $this->resetPage();
    }
    public function mount()
    {
        $this->currentUrl = url()->current();
    }
    public function render()
    {
        $this->notification();
        $this->checkTable();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            if ($this->table == 'Training Need QEM') {
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->whereBetween('qems.created_at',[$start_date,$end_date])
                    ->where('list_of_trainings.status','Approved')
                    ->where('qem',0)
                    ->orderBy('list_of_trainings.updated_at','desc')
                    ->paginate(3);
            }elseif ($this->table == 'Not Submitted QEM') {
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id', 'qems.created_at As date_created')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->whereBetween('qems.created_at',[$start_date,$end_date])
                    ->where('qems.status','Not Submitted')
                    ->orderBy('qems.updated_at','desc')
                    ->paginate(3);

            }
            else{
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id', 'qems.created_at As date_created')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->whereBetween('qems.created_at',[$start_date,$end_date])
                    ->where($this->query[0],$this->query[1])
                    ->where('list_of_trainings.status','Approved')
                    ->orderBy('qems.updated_at','desc')
                    ->paginate(3);
            }
        }else {
            if ($this->table == 'Training Need QEM') {
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('idps', 'idps.id', '=', 'attendance_forms.idp_id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->where('list_of_trainings.status','Approved')
                    ->where('qem',0)
                    ->orderBy('list_of_trainings.updated_at','desc')
                    ->paginate(3);
            }elseif ($this->table == 'Not Submitted QEM') {
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id', 'qems.created_at As date_created')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->where('qems.status','Not Submitted')
                    ->orderBy('qems.updated_at','desc')
                    ->paginate(3);

            }
            else{
                $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','date_covered', 'certificate_title','venue','sponsors', 'attendance_forms.competency AS trainCompetency','qem', 'qems.status AS confirmation_status', 'qems.id AS qem_id', 'qems.created_at As date_created')
                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                    ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                    ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                    ->where('college_id',auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                    ->where($this->query[0],$this->query[1])
                    ->orderBy('qems.updated_at','desc')
                    ->paginate(3);
            }
        }



        return view('livewire.qem.qem-show', ['trainings' => $lists]);
    }
}
