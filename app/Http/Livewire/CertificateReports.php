<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use PhpOffice\PhpWord\TemplateProcessor;

class CertificateReports extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $certificate;
    public $start_date, $end_date, $filter_certificate_title, $name, $certificate_name, $certificate_title, $user_id;
    public $toggle, $currentUrl;
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
    public function getInfo(){

            $lists = ListOfTraining::select('name', 'certificate_title','date_covered','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->get();

        $this->certificate = $lists;
        //dd($this->training);
    }
    public function show(int $id){
        $lists = ListOfTraining::select('users.id As user_id','name', 'certificate_title','certificate')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->where('college_id',auth()->user()->college_id)
        ->where('status','Approved')
        ->where('list_of_trainings.id', $id)
        ->orderBy('list_of_trainings.updated_at','desc')
        ->first();

        $this->certificate_name = $lists->certificate;
        $this->certificate_title = $lists->certificate_title;
        $this->user_id = $lists->user_id;

    }
    public function printquery(){

        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('user_id','name', 'certificate_title','date_covered','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('certificate_title', 'like', '%'.$this->filter_certificate_title.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->get();
        }else {
            $lists = ListOfTraining::select('user_id','name', 'certificate_title','date_covered','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('certificate_title', 'like', '%'.$this->filter_certificate_title.'%')
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->get();
        }

        return $lists->toArray();
    }
    public static function year($date){
        $pieces = explode("-", $date);
        return $pieces[0];
    }
    public function printAll(){
        $certificates = $this->printquery();
        //dd($certificates);

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
        if ($this->name) {
            $name = $this->name;
        }else {
            $name = '';
        }
        if ($this->filter_certificate_title) {
            $certificate_title = $this->filter_certificate_title;
        }else {
            $certificate_title = '';
        }
        $templateProcessor = new TemplateProcessor(storage_path('Certificate Summary.docx'));
        $templateProcessor->cloneBlock('section', count($certificates), true, true);
        $i = 1;
        foreach ($certificates as $key => $value) {
            $templateProcessor->setValue("name#$i", $value['name']);
            $templateProcessor->setValue("certificate_title#$i", $value['certificate_title']);
            $templateProcessor->setValue("date_covered#$i", strftime("%B %e,%G",strtotime($value['date_covered'])));
            $templateProcessor->setImageValue("certificate#$i", array('path' => public_path('storage/users/'.$value['user_id'].'/'.$value['certificate']), 'width' => 800, 'height' => 450, 'ratio' => false));
            $i++;
        }
        $path = 'app/public/users/'.auth()->user()->id.'/Certificate_'.$name.$certificate_title.$daterange.'.docx';
        $templateProcessor->saveAs(storage_path($path));
            $this->dispatchBrowserEvent('close-modal');
            $this->resetFilter();
            return response()->download(storage_path($path))->deleteFileAfterSend(true);
    }
    public function resetFilter(){

        $this->start_date = null;
        $this->end_date = null;
        $this->filter_certificate_title = null;
        $this->name = null;

    }
    public function resetInput(){


        $this->certificate_name = '';
        $this->certificate_title = '';
        $this->user_id = '';

    }
    public function updatingFilterCertificateTitle($value){
        $this->resetPage();
    }
    public function updatingName($value){
        $this->resetPage();
    }
    public function updatingEndDate($value){
        $this->resetPage();
    }
    public function mount(){
        $this->currentUrl = url()->current();
            //dd($this->currentUrl);
    }
    public function render()
    {
        $this->getInfo();
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('certificate_title', 'like', '%'.$this->filter_certificate_title.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(10);
        }else {

            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('name', 'like', '%'.$this->name.'%')
                ->where('certificate_title', 'like', '%'.$this->filter_certificate_title.'%')
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(10);
        }
        return view('livewire.certificate-reports', ['trainings' => $lists]);
    }
}
