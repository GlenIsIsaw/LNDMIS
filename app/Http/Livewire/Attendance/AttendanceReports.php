<?php

namespace App\Http\Livewire\Attendance;

use ZipArchive;
use Carbon\Carbon;
use App\Models\User;
use App\Models\College;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Http\Livewire\Training\TrainingShow;

class AttendanceReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $attendance;
    public $count = 1;
    public $name, $start_date, $end_date, $competency, $mySignature;
    public $toggle , $currentUrl;
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
    public function attendance(){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('college_id',auth()->user()->college_id)
        ->where('list_of_trainings.status','Approved')
        ->where('qems.status','Approved')
        ->orderBy('name','asc')
        ->get();

        $this->attendance = $lists;
         
    }
    public function resetFilter(){
        $this->name = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->competency = null;
        $this->mySignature = null;
    }
    public static function year($date){
        $pieces = explode("-", $date);
        return $pieces[0];
    }
    public function userTeachTrainNum($choice){
        $check = '';
        $count = 0;
        $start_date = Carbon::parse($this->start_date)->toDateTimeString();
        $end_date = Carbon::parse($this->end_date)->toDateTimeString();
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
                ->where('college_id',auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
                ->where('competency', 'like', '%'.$this->competency.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->where('teacher',$choice)
                ->where('list_of_trainings.status','Approved')
                ->where('qems.status','Approved')
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
    public function printall(){
        $validatedData = $this->validate([            
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);


            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('name', 'certificate_title', 'date_covered','competency')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->whereBetween('date_covered',[$start_date,$end_date])
            ->where('list_of_trainings.status','Approved')
            ->where('qems.status','Approved')
            ->orderBy('name','asc')
            ->get();
        

        //dd($lists->toArray());
        if ($lists->isEmpty()) {
            $this->resetFilter();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','You have no data to print');
        } else {        

        $start_month = strftime("%B",strtotime($this->start_date));
        $end_month = strftime("%B",strtotime($this->end_date));
        $year = $this->year($this->end_date);
        $values = $lists->toArray();
        //dd($values);
        $daterange = '';
        foreach ($values as $key => $item) {
            $values[$key]['date_covered'] = strftime("%B %e,%G",strtotime($item['date_covered']));
        }
        //dd($values);
        $templateProcessor = new TemplateProcessor(storage_path('LD-Monitoring.docx'));
        if ($start_month == $end_month) {
            $daterange = $start_month.' '.$this->year($this->end_date);
        }else {
            $daterange = $start_month.' - '.$end_month.' '.$year;
        }
        $templateProcessor->setValue('dateRange', $daterange);
        //dd($values);
        foreach ($values as $num => $value) {
            foreach ($value as $key => $item) {
                $values[$num][$key] = TrainingShow::xmlEntities(htmlentities($item));
            }
        }
        $templateProcessor->cloneRowAndSetValues('name', $values);
        $college = College::select('college_name')
            ->where('id',auth()->user()->college_id)
            ->first();
        $templateProcessor->setValue('college', $college->college_name);
        $i = 1;
        foreach ($values as $item) {
            $templateProcessor->setValue("count#$i", $i);
            $templateProcessor->setValue("year#$i", $year);
            $i++;
        }

        $templateProcessor->setValue('facultyPercentage', $this->percentage($this->userTeachTrainNum('Yes'),$this->userTeachNum('Yes')));
        $templateProcessor->setValue('nonPercentage', $this->percentage($this->userTeachTrainNum('No'),$this->userTeachNum('No')));

        if($this->mySignature == '1'){
            if(auth()->user()->signature){
                $templateProcessor->setImageValue('coorsign', array('path' => public_path('storage/users/'.auth()->user()->id.'/'.auth()->user()->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else{
                session()->flash('message','You have no signature');
                $templateProcessor->setValue('coorsign'," ");
            }
        }else {
            $templateProcessor->setValue('coorsign'," ");
        }
            
        $templateProcessor->setValue("coorname", auth()->user()->name);
        $path = 'app/public/users/'.auth()->user()->id.'/LND-Monitoring_'.$daterange.'.docx';
        $templateProcessor->saveAs(storage_path($path));

        $this->resetFilter();
        $this->dispatchBrowserEvent('close-modal');
        return response()->download(storage_path($path))->deleteFileAfterSend(true);
        }
    }
    public function getSupervisor($id){
        $arr = [];
        $college = College::select('supervisor')
                    ->where('id',$id)
                    ->first();
        $supervisor = User::select('users.id As id','name', 'signature')
            ->join('colleges', 'colleges.id', '=', 'users.college_id')
            ->where('users.id','=',$college->supervisor)
            ->first();
        if($supervisor){
            $arr = $supervisor->toArray();
            return $arr;
        }else{
            $arr['id'] = null;
            $arr['name'] = null;
            $arr['signature'] = null;
            return $arr;
        }
    } 
    public function split($string){
        $date = str_split($string, 10);
        return $date[0];
    }

    public function printLndReports(){
        $validatedData = $this->validate([            
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ]);
        $start_date = Carbon::parse($this->start_date)->toDateTimeString();
        $end_date = Carbon::parse($this->end_date)->toDateTimeString();
        $lists = ListOfTraining::select('user_id','name','college_id','signature', 'certificate_title', 'date_covered','certificate', 'competency', 'venue', 'sponsors', 'knowledge_acquired', 'outcome', 'personal_action', 'attendance_forms.created_at As edate')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->whereBetween('date_covered',[$start_date,$end_date])
            ->where('list_of_trainings.status','Approved')
            ->where('qems.status','Approved')
            ->orderBy('name','asc')
            ->get();

        //dd($lists->toArray());
        if ($lists->isEmpty()) {
            $this->resetFilter();
            $this->dispatchBrowserEvent('close-modal');
            session()->flash('message','You have no data to print');
        } else {        

        $start_month = strftime("%B",strtotime($this->start_date));
        $end_month = strftime("%B",strtotime($this->end_date));
        $year = $this->year($this->end_date);
        $values = $lists->toArray();
        //dd($values);
        $daterange = '';
        foreach ($values as $key => $item) {
            $values[$key]['date_covered'] = strftime("%B %e,%G",strtotime($item['date_covered']));
        }
        //dd($values);
        $templateProcessor = new TemplateProcessor(storage_path('LD-Monitoring.docx'));
        if ($start_month == $end_month) {
            $daterange = $start_month.' '.$this->year($this->end_date);
        }else {
            $daterange = $start_month.' - '.$end_month.' '.$year;
        }
        $templateProcessor->setValue('dateRange', $daterange);
        foreach ($values as $num => $value) {
            foreach ($value as $key => $item) {
                $values[$num][$key] = TrainingShow::xmlEntities(htmlentities($item));
            }
        }
        $templateProcessor->cloneRowAndSetValues('name', $values);
        $college = College::select('college_name')
            ->where('id',auth()->user()->college_id)
            ->first();
        $templateProcessor->setValue('college', $college->college_name);
        $i = 1;
        foreach ($values as $item) {
            $templateProcessor->setValue("count#$i", $i);
            $templateProcessor->setValue("year#$i", $year);
            $i++;
        }

        $templateProcessor->setValue('facultyPercentage', $this->percentage($this->userTeachTrainNum('Yes'),$this->userTeachNum('Yes')));
        $templateProcessor->setValue('nonPercentage', $this->percentage($this->userTeachTrainNum('No'),$this->userTeachNum('No')));

            if(auth()->user()->signature){
                $templateProcessor->setImageValue('coorsign', array('path' => public_path('storage/users/'.auth()->user()->id.'/'.auth()->user()->signature), 'width' => 100, 'height' => 50, 'ratio' => false));
            }else{
                session()->flash('message','You have no signature');
                $templateProcessor->setValue('coorsign'," ");
            }
        $templateProcessor->setValue("coorname", auth()->user()->name);
        
        $foldername = storage_path('app/public/users/'.auth()->user()->id.'/LND-Monitoring-Reports');
        $path = storage_path('app/public/users/'.auth()->user()->id.'/LND-Monitoring-Reports/LND-Monitoring_'.$daterange.'.docx');
        if(!is_dir($foldername))
		{
			mkdir($foldername, 0777, true);
		}
        $templateProcessor->saveAs($path);

        //dd('dfd');

        $templateProcessor = new TemplateProcessor(storage_path('LND-Monitoring-Reports.docx'));
        $templateProcessor->cloneBlock("training", count($values), true, true);
        $college = College::select('college_name')
        ->where('id',auth()->user()->college_id)
        ->first();
    $templateProcessor->setValue('college', $college->college_name);
        
        for ($i=1; $i <= count($values); $i++) { 
            $templateProcessor->setValue("name#$i", $values[$i-1]['name']);
            $templateProcessor->setValue("certificate_title#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['certificate_title'])));
            $templateProcessor->setValue("date_covered#$i", $values[$i-1]['date_covered']);
            $templateProcessor->setValue("venue#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['venue'])));
            $templateProcessor->setValue("sponsors#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['sponsors'])));
            $templateProcessor->setValue("competency#$i", $values[$i-1]['competency']);
            $templateProcessor->setValue("knowledge_acquired#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['knowledge_acquired'])));
            $templateProcessor->setValue("outcome#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['outcome'])));
            $templateProcessor->setValue("personal_action#$i", TrainingShow::xmlEntities(htmlentities($values[$i-1]['personal_action'])));

            if ($values[$i-1]['signature']) {
                $templateProcessor->setImageValue("esign#$i", array('path' => public_path('storage/users/'.$values[$i-1]['user_id'].'/'.$values[$i-1]['signature']), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue("edate#$i", $this->split($values[$i-1]['edate']));
            } else {
                $templateProcessor->setValue("esign#$i", ' ');
                $templateProcessor->setValue("edate#$i", $this->split($values[$i-1]['edate']));
            }

            $supervisor = $this->getSupervisor($values[$i-1]['college_id']);
            if ($supervisor['signature']) {
                $templateProcessor->setImageValue("ssign#$i", array('path' => public_path('storage/users/'.$supervisor['id'].'/'.$supervisor['signature']), 'width' => 100, 'height' => 50, 'ratio' => false));
                $templateProcessor->setValue("sdate#$i", date('F j, Y'));
            } else {
                $templateProcessor->setValue("sdate#$i", ' ');
                $templateProcessor->setValue("ssign#$i", ' ');
            }
            
            

            $templateProcessor->setImageValue("certificate#$i", array('path' => public_path('storage/users/'.$values[$i-1]['user_id'].'/'.$values[$i-1]['certificate']), 'width' => 600, 'height' => 500, 'ratio' => false));
        }
        

        $path2 = storage_path('app/public/users/'.auth()->user()->id.'/LND-Monitoring-Reports/Attendance_Reports_with_Certificates_'.$daterange.'.docx');
        $templateProcessor->saveAs($path2);
        //dd($path2);
        $zipname = storage_path('app/public/users/'.auth()->user()->id.'/LND-Monitoring-Reports_'.$daterange.'.zip');
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        $zip->addFromString(basename($path),  file_get_contents($path));  
        File::delete($path);

        $zip->addFromString(basename($path2),  file_get_contents($path2));  
        File::delete($path2);

        $zip->close();
        $this->dispatchBrowserEvent('close-modal');
        $this->resetFilter();
        return response()->download($zipname)->deleteFileAfterSend(true);
        }
    }

    public function updatedName($value){
        $this->resetPage();
    }
    public function updatedCompetency($value){
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
        $this->attendance();
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','specify_date')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->whereBetween('date_covered',[$start_date,$end_date])
            ->where('list_of_trainings.status','Approved')
            ->where('qems.status','Approved')
            ->orderBy('name','asc')
            ->paginate(10);
        }else{
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','specify_date')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->join('qems', 'qems.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->name)."%'")
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('list_of_trainings.status','Approved')
            ->where('qems.status','Approved')
            ->orderBy('name','asc')
            ->paginate(10);
        }
        if($lists->currentPage() != 1){
            $this->count = ($lists->currentPage() * 10) - 1;
        } else{
            $this->count = 1;
        }
        
        return view('livewire.attendance.attendance-reports' ,['trainings' => $lists]);
    }
}
