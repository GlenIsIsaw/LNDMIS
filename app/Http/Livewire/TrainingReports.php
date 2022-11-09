<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

use function PHPUnit\Framework\isEmpty;

class TrainingReports extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $seminar;
    public $filter_status,$filter_certificate_type, $filter_level, $filter_type, $start_date, $end_date, $filter_certificate_title, $name, $mySignature;
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

            $lists = ListOfTraining::select('name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->where('status','Approved')
                ->orderBy('name','asc')
                ->get();

        $this->seminar = $lists;
        //dd($this->training);
    }
    public static function year($date){
        $pieces = explode("-", $date);
        return $pieces[0];
    }
    public function userTeachTrainNum($choice){
        $check = '';
        $count = 0;
            $s_date = Carbon::parse($this->start_date)->toDateTimeString();
            $e_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->whereBetween('list_of_trainings.date_covered',[$s_date,$e_date])
                ->where('status','Approved')
                ->where('teacher',$choice)
                ->orderBy('name','asc')
                ->get();
        foreach ($lists as $key => $value) {
            if ($check == $value->name) {
                continue;
            }else {
                $check = $value->name;
                $count++;
            }
        }
        return $count;
    }
    public function userTeachNum($choice){
        $user = User::where('college_id',auth()->user()->college_id)
                    ->where('teacher',$choice)
                    ->get();
        return count($user->toArray());
    }
    public function percentage($int1, $int2){
        $percentage = ($int1/$int2) * 100;

        return round($percentage, 2);
    }
    public function printquery($choice){
        $validatedData = $this->validate([            
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
            $s_date = Carbon::parse($this->start_date)->toDateTimeString();
            $e_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('name', 'certificate_title', 'date_covered', 'level', 'num_hours')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->whereBetween('list_of_trainings.date_covered',[$s_date,$e_date])
                ->where('status','Approved')
                ->where('teacher',$choice)
                ->orderBy('name','asc')
                ->get();

            return $lists;
    }
    public function printAll(){
        $validatedData = $this->validate([            
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $listObject = $this->printquery('Yes');
        $listObject2 = $this->printquery('No');
        //dd($listObject);
        //if (!$listObject->isEmpty() && !$listObject2->isEmpty()) {
        
            $grouped = $listObject->groupBy('name');
            $list = $grouped->toArray();
            //dd($list);
            foreach ($list as $name => $value) {
                foreach ($value as $key => $item) {
                    $list[$name][$key]['date_covered'] = strftime("%B %e,%G",strtotime($item['date_covered']));
                }
                
            }
            //dd($list);
            $start_month = strftime("%B",strtotime($this->start_date));
            $end_month = strftime("%B",strtotime($this->end_date));
            $year = $this->year($this->end_date);
            $daterange = '';
            $templateProcessor = new TemplateProcessor(storage_path('Certificate.docx'));
            if ($start_month == $end_month) {
                $daterange = $start_month.' '.$this->year($this->end_date);
            }else {
                $daterange = $start_month.' - '.$end_month.' '.$year;
            }
            $templateProcessor->setValue('deptname',auth()->user()->college_name);
            $templateProcessor->setValue('year',$year);
            $templateProcessor->setValue('daterange', $daterange);


            $replacements = array();
            $i = 0;
            foreach($list as $name => $cert) {
                $replacements[] = array(
                    'name' => $name,
                    'certificate_title' => '${certificate_title_'.$i.'}',
                    'date_covered' => '${date_covered_'.$i.'}',
                    'level' => '${level_'.$i.'}',
                    'num_hours' => '${num_hours_'.$i.'}'
                );
                    $i++;
            }
            $templateProcessor->cloneBlock('table', count($replacements), true, false, $replacements);

            $i = 0;
            foreach($list as $group) 
            {
                $values = array();
                foreach($group as $row) 
                {
                    $values[] = array(
                        "certificate_title_{$i}" => $row['certificate_title'],
                        "date_covered_{$i}" => $row['date_covered'],
                        "level_{$i}" => $row['level'],
                        "num_hours_{$i}" => $row['num_hours']);
                }
                $templateProcessor->cloneRowAndSetValues("certificate_title_{$i}", $values);

                $i++;
            }
            

            $grouped = $listObject2->groupBy('name');

            $list = $grouped->toArray();
            foreach ($list as $name => $value) {
                foreach ($value as $key => $item) {
                    $list[$name][$key]['date_covered'] = strftime("%B %e,%G",strtotime($item['date_covered']));
                }
                
            }

            $replacements = array();
            $i = 0;
            foreach($list as $name => $cert) {
                $replacements[] = array(
                    'name2' => $name,
                    'certificate_title2' => '${certificate_title2_'.$i.'}',
                    'date_covered2' => '${date_covered2_'.$i.'}',
                    'level2' => '${level2_'.$i.'}',
                    'num_hours2' => '${num_hours2_'.$i.'}'
                );
                    $i++;
            }
            $templateProcessor->cloneBlock('table2', count($replacements), true, false, $replacements);

            $i = 0;
            foreach($list as $group) 
            {
                $values = array();
                foreach($group as $row) 
                {
                    $values[] = array(
                        "certificate_title2_{$i}" => $row['certificate_title'],
                        "date_covered2_{$i}" => $row['date_covered'],
                        "level2_{$i}" => $row['level'],
                        "num_hours2_{$i}" => $row['num_hours']);
                }
                $templateProcessor->cloneRowAndSetValues("certificate_title2_{$i}", $values);

                $i++;
            }
            $templateProcessor->setValue('facultypercentage', $this->percentage($this->userTeachTrainNum('Yes'),$this->userTeachNum('Yes')).'%');
            $templateProcessor->setValue('nonpercentage', $this->percentage($this->userTeachTrainNum('No'),$this->userTeachNum('No')). '%');
            $templateProcessor->setValue('coordname',auth()->user()->name);
            
            if($this->mySignature == '1'){
                if(auth()->user()->signature){
                    $templateProcessor->setImageValue('coordsignature', array('path' => public_path('storage/users/'.auth()->user()->id.'/'.auth()->user()->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
                }else{
                    session()->flash('message','You have no signature');
                    $templateProcessor->setValue('coordsignature'," ");
                }
                
            }else{
                $templateProcessor->setValue('coordsignature'," ");
            }
            $path = 'app/public/users/'.auth()->user()->id.'/ListOfTrainings_'.$daterange.'.docx';
            $templateProcessor->saveAs(storage_path($path));
            $this->resetFilter();
            $this->dispatchBrowserEvent('close-modal');
            return response()->download(storage_path($path))->deleteFileAfterSend(true);
            /*} else {
            $this->resetFilter();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','You have no data to print');
            
        }*/
    }
    public function resetFilter(){
        $this->filter_status = null;
        $this->filter_certificate_type = null;
        $this->filter_level = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->filter_certificate_title = null;
        $this->name = null;
        $this->mySignature = null;
    }

    public function updatingName($value){
        $this->resetPage();
    }
    public function updatingEndDate($value){
        $this->resetPage();
    }
    public function updatingFilterStatus($value){
        $this->resetPage();
    }
    public function updatingFilterLevel($value){
        $this->resetPage();
    }
    public function updatingFilterCertificateType($value){
        $this->resetPage();
    }
    public function updatingFilterCertificateTitle($value){
        $this->resetPage();
    }
    public function updatingFilterType($value){
        $this->resetPage();
    }
    public function mount()
    {
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
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(5);
        }else {
 
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level','num_hours','venue','sponsors','type','certificate')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->filter_certificate_title)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('certificate_type', 'like', '%'.$this->filter_certificate_type.'%')
                ->where('type', 'like', '%'.$this->filter_type.'%')
                ->where('status','Approved')
                ->orderBy('list_of_trainings.updated_at','desc')
                ->paginate(5);
        }
        return view('livewire.training-reports', ['trainings' => $lists]);
    }
}
