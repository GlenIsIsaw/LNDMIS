<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\College;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ListOfTraining;
use App\Models\User;
use PhpOffice\PhpWord\TemplateProcessor;

class AttendanceReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $attendance;
    public $count = 1;
    public $name, $start_date, $end_date, $competency, $mySignature;

    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function attendance(){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','status')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('college_id',auth()->user()->college_id)
        ->where('status','Approved')
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
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','status')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->where('teacher',$choice)
            ->where('status','Approved')
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
            ->where('college_id',auth()->user()->college_id)
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->whereBetween('date_covered',[$start_date,$end_date])
            ->where('status','Approved')
            ->get();
        

        //dd($lists->toArray());

        $start_month = strftime("%B",strtotime($this->start_date));
        $end_month = strftime("%B",strtotime($this->end_date));
        $year = $this->year($this->end_date);
        $values = $lists->toArray();
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
            
        }else{
            $templateProcessor->setValue('coorsign'," ");
        }
        $templateProcessor->setValue("coorname", auth()->user()->name);

        $templateProcessor->saveAs(public_path('LND-Monitoring_'.$daterange.'.docx'));
        $this->resetFilter();
        $this->dispatchBrowserEvent('close-modal');
        return response()->download(public_path('LND-Monitoring_'.$daterange.'.docx'))->deleteFileAfterSend(true);

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
    public function render()
    {   
        $this->attendance();
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','status')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->whereBetween('date_covered',[$start_date,$end_date])
            ->where('status','Approved')
            ->paginate(10);
        }else{
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title', 'date_covered','venue','sponsors','competency','attendance_forms.id as att_id','status')
            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
            ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
            ->where('college_id',auth()->user()->college_id)
            ->where('name', 'like', '%'.$this->name.'%')
            ->where('competency', 'like', '%'.$this->competency.'%')
            ->where('status','Approved')
            ->paginate(10);
        }
        if($lists->currentPage() != 1){
            $this->count = ($lists->currentPage() * 10) - 1;
        } else{
            $this->count = 1;
        }
        
        return view('livewire.attendance-reports' ,['trainings' => $lists]);
    }
}
