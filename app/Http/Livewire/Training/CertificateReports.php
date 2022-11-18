<?php

namespace App\Http\Livewire\Training;

use ZipArchive;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class CertificateReports extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $certificate;
    public $start_date, $end_date, $filter_certificate_title, $name, $certificate_name, $certificate_title, $user_id, $training_id, $fileType;
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
    public function fileType($filename){
        $array = explode(".", $filename);
        return strtolower(end($array));

    }
    public function getInfo(){

            $lists = ListOfTraining::select('name', 'certificate_title','date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->get();

        $this->certificate = $lists;
        //dd($this->training);
    }
    public function show(int $id){
        $lists = ListOfTraining::select('users.id As user_id','name', 'certificate_title','certificate', 'specify_date')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->where('college_id',auth()->user()->college_id)
        ->where('status','Approved')
        ->where('list_of_trainings.id', $id)
        ->orderBy('name','asc')
        ->first();

        
        $this->fileType = $this->fileType($lists->certificate);
        $this->certificate_name = $lists->certificate;
        $this->certificate_title = $lists->certificate_title;
        $this->user_id = $lists->user_id;

    }
    public function printquery(){

        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->get();
        }else {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->get();
        }

        return $lists->toArray();
    }
    public static function year($date){
        $pieces = explode("-", $date);
        return $pieces[0];
    }
    public function print(){
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('list_of_trainings.id',$this->training_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->first();
        }else {
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('list_of_trainings.id',$this->training_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->first();
        }


        //dd($lists);
        $ext = $this->fileType($lists->certificate);
        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/Certificates');
        $originalPath = storage_path('app/public/users/'.$lists->user_id.'/'.$lists->certificate);
        $path = storage_path('app/public/users/'.auth()->user()->id.'/Certificates/'.$lists->name.'_'.$lists->certificate_title.'.'.$ext);

        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        File::copy($originalPath, $path);
        
    }
    public function printAll(){
        $id = [];
        $filename = [];
        $i = 0;
        foreach ($this->printquery() as $value) {
           $id[$i] = $value['training_id'];
           $ext = $this->fileType($value['certificate']);
           $filename[$i] = storage_path('app/public/users/'.auth()->user()->id.'/Certificates/'.$value['name'].'_'.$value['certificate_title'].'.'.$ext);
           $i++;
        }
        //dd($id);
        //dd($filename);
        foreach ($id as $item) {
            $this->training_id = $item;
            //dd($this->idp_id);
            $this->print();
        }
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
        
        $zipname = storage_path('app/public/users/'.auth()->user()->id.'/Certificates/Certificate_'.$daterange.'.zip');
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
        $this->dispatchBrowserEvent('close-modal');
        
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
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->paginate(10);
        }else {

            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','certificate', 'specify_date')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->paginate(10);
        }
        return view('livewire.training.certificate-reports', ['trainings' => $lists]);
    }
}
