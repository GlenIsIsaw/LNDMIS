<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\AttendanceForm;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;

class EmployeeTrainingIndex extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name,$comment , $certificate_type, $certificate_title, $level, $date_covered, $venue, $sponsors, $num_hours, $type, $certificate, $status , $attendance_form ,$ListOfTraining_id, $user_id, $photo;
    public $competency, $knowledge_acquired, $outcome, $personal_action, $att_id;
    public $search = '';
    public $start_date = '';
    public $end_date = '';
    public $filterStatus = '';

    protected function rules()
    {
        return [
            'user_id' => 'required',
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',

        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {   
        
        $validatedData = $this->validate([
            'user_id' => 'required',
            'certificate_title' => 'required',
            'level' => 'required',
            'date_covered' => 'required',
            'num_hours' => 'required',
            'venue' => 'required',
            'sponsors' => 'required',
            'type' => 'required',
            'certificate_type' => 'required',
            'photo' => 'required|image'
        ]);
        $list = new ListOfTraining();
        $list->user_id = $this->user_id;
        $list->certificate_title = $this->certificate_title;
        $list->level = $this->level;
        $list->date_covered = $this->date_covered;
        $list->certificate_type = $this->certificate_type;
        $list->venue = $this->venue;
        $list->sponsors = $this->sponsors;
        $list->type = $this->type;
        $list->num_hours = $this->num_hours;


        if($this->photo){
            $user = User::find($this->user_id);
            $filename = date('Ymd').$this->certificate_title;
            $this->photo->storeAs('public/users/'.$user->name, $filename);
            $list->certificate = $filename;
        }

        $list->save();
        session()->flash('message','Training Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function show(int $id)
    {
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                            ->where('list_of_trainings.id', $id)
                                            ->first();
        
        if($lists){
            
            $this->name = $lists->name;
            $this->certificate_type = $lists->certificate_type;
            $this->certificate_title = $lists->certificate_title;
            $this->level = $lists->level;
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->type = $lists->type;
            $this->certificate = $lists->certificate;
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }
    public function edit(int $id)
    {

        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                            ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                            ->where('list_of_trainings.id', $id)
                                            ->first();
        
        if($lists){
            
            $this->name = $lists->name;
            $this->certificate_type = $lists->certificate_type;
            $this->certificate_title = $lists->certificate_title;
            $this->level = $lists->level;
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->type = $lists->type;
            $this->certificate = $lists->certificate;
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
            $this->certificate = $lists->certificate;
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        $list = ListOfTraining::find($this->ListOfTraining_id);
        $list->user_id = $this->user_id;
        $list->certificate_title = $this->certificate_title;
        $list->level = $this->level;
        $list->date_covered = $this->date_covered;
        $list->certificate_type = $this->certificate_type;
        $list->venue = $this->venue;
        $list->sponsors = $this->sponsors;
        $list->type = $this->type;
        $list->num_hours = $this->num_hours;


        if($this->photo){
            $user = User::find($this->user_id);
            File::delete(storage_path('app/public/users/'.$user->name.'/'.$list->certificate));
            $filename = date('Ymd').$this->certificate_title;
            $this->photo->storeAs('public/users/'.$user->name, $filename);
            $list->certificate = $filename;
        }

        $list->save();
        session()->flash('message','ListOfTraining Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $ListOfTraining_id)
    {
        $this->ListOfTraining_id = $ListOfTraining_id;
    }

    public function destroy()
    {
        ListOfTraining::find($this->ListOfTraining_id)->delete();
        session()->flash('message','ListOfTraining Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function createAttendanceForm($id){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','name','certificate_title')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('list_of_trainings.id', $id)
                                    ->first();
        if($lists){
            $this->ListOfTraining_id = $lists->training_id;
            $this->name = $lists->name;
            $this->certificate_title = $lists->certificate_type;
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }

    public function storeAttendanceForm(){
        $validatedData = $this->validate([
            'ListOfTraining_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
            'outcome' => 'required',
            'personal_action' => 'required'
        ]);
        $list = new AttendanceForm();
        $list->list_of_training_id = $this->ListOfTraining_id;
        $list->competency =$this->competency;
        $list->knowledge_acquired =$this->knowledge_acquired;
        $list->outcome =$this->outcome;
        $list->personal_action =$this->personal_action;

        $train = ListOfTraining::find($this->ListOfTraining_id);
        $train->attendance_form = 1;
        
        $list->save();
        $train->save();
        session()->flash('message','Attendance Form Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function showAttendanceForm($id){
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','competency','attendance_forms.id as att_id','knowledge_acquired','outcome','personal_action','attendance_form','status')
                                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
                                ->where('list_of_trainings.id', $id)
                                ->first();
        if($lists){
            $this->name = $lists->name;
            $this->certificate_type = $lists->certificate_type;
            $this->certificate_title = $lists->certificate_title;
            $this->level = $lists->level;
            $this->date_covered = $lists->date_covered;
            $this->venue = $lists->venue;
            $this->sponsors = $lists->sponsors;
            $this->num_hours = $lists->num_hours;
            $this->type = $lists->type;
            $this->certificate = $lists->certificate;
            $this->status = $lists->status;
            $this->attendance_form = $lists->attendance_form;
            $this->ListOfTraining_id = $lists->training_id;
            $this->user_id = $lists->user_id;
            $this->att_id = $lists->att_id;
            $this->certificate = $lists->certificate;
            $this->competency = $lists->competency;
            $this->knowledge_acquired = $lists->knowledge_acquired;
            $this->outcome = $lists->outcome;
            $this->personal_action = $lists->personal_action;
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }
    public function editAttendanceForm($id){
        $lists = AttendanceForm::select('list_of_trainings.id as training_id','certificate_title','attendance_forms.id as att_id','competency','knowledge_acquired','outcome','personal_action','attendance_form')       
                                ->join('list_of_trainings', 'list_of_trainings.id', '=', 'attendance_forms.list_of_training_id')
                                ->where('attendance_forms.id', $id)
                                ->first();
        if($lists){
            $this->att_id = $lists->att_id;

            $this->competency = $lists->competency;
            $this->knowledge_acquired = $lists->knowledge_acquired;
            $this->outcome = $lists->outcome;
            $this->personal_action = $lists->personal_action;
        }else{
            return redirect()->to('/empTraining')->with('message','No results found');
        }
    }
    public function updateAttendanceForm(){
        $validatedData = $this->validate([
            'ListOfTraining_id' => 'required',
            'competency' => 'required',
            'knowledge_acquired' => 'required',
            'outcome' => 'required',
            'personal_action' => 'required'
        ]);
        $list = AttendanceForm::find($this->att_id);
        $list->competency =$this->competency;
        $list->knowledge_acquired =$this->knowledge_acquired;
        $list->outcome =$this->outcome;
        $list->personal_action =$this->personal_action;

        
        $list->save();
        session()->flash('message','Attendance Form Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function deleteAttendanceForm(int $id)
    {
        $this->att_id = $id;
    }
    public function destroyAttendanceForm(){
        $check = AttendanceForm::find($this->att_id);
        $lists = ListOfTraining::find($check->list_of_training_id);

        $lists->attendance_form = 0;
        $lists->status = 'Not Submitted';

        $lists->save();
        AttendanceForm::where('id',$this->att_id)->delete();
        session()->flash('message','Attendance Form Deleted Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->certificate_type = '';
        $this->certificate_title = '';
        $this->level = '';
        $this->date_covered = '';
        $this->venue = '';
        $this->sponsors = '';
        $this->num_hours = '';
        $this->type = '';
        $this->certificate = '';
        $this->status = '';
        $this->attendance_form = '';
        $this->ListOfTraining_id = '';
        $this->user_id = '';
        $this->photo = '';
        $this->competency ='';
        $this->knowledge_acquired ='';
        $this->outcome ='';
        $this->personal_action ='';
    }
    public function reject($id){
        $list = ListOfTraining::find($id);
        $list->status = 'Rejected';
        $list->save();
        return redirect(route('training.queue'))->with('message', 'Sucessfully Rejected');
    }
    public function approve($id){
        $list = ListOfTraining::find($id);
        $list->status = 'Approved';
        $list->save();
        return redirect(route('training.queue'))->with('message', 'Sucessfully Approved');
    }
    public function submit(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if($list->user_id != auth()->user()->id)
        {
            abort(403, 'Unauthorized Action');
        }
        if ($list->attendance_form == 1) {
            session()->flash('message',$list->certificate_title.' Submitted');
            $this->dispatchBrowserEvent('show-modal');
            $list->status = 'Pending';
            $list->save();
        }else{
            session()->flash('message','No Attendance Form/Cannot submit');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function removeSubmit(){
        $list = ListOfTraining::find($this->ListOfTraining_id);
        if($list->user_id != auth()->user()->id)
        {
            abort(403, 'Unauthorized Action');
        }
        if ($list->status == 'Pending') {
            session()->flash('message','Removed the Submission of '.$list->certificate_title);
            $this->dispatchBrowserEvent('close-modal');
            $list->status = 'Not Submitted';
            $list->save();
        }else{
            session()->flash('message','You can no longer Remove the Submission');
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    
    public function printAttendanceForm(){


        $training = DB::table('list_of_trainings')
        ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
        ->join('attendance_forms', 'attendance_forms.list_of_training_id', '=', 'list_of_trainings.id')
        ->where('list_of_trainings.id', $this->ListOfTraining_id)
        ->select('name', 'certificate_title', 'date_covered','college', 'level','venue','sponsors','competency','knowledge_acquired','outcome','personal_action')
        ->first();
        

        $array = [
            'name' => $training->name,
            'certificate_title' => $training->certificate_title,
            'date_covered' => $training->date_covered,
            'venue' => $training->venue,
            'sponsors' => $training->sponsors,
            'competency' => $training->competency,
            'knowledge_acquired' => $training->knowledge_acquired,
            'outcome' => $training->outcome,
            'personal_action' => $training->personal_action
        ];

        $templateProcessor = new TemplateProcessor(storage_path('Attendance-Report.docx'));
        foreach($array as $varname=>$value){
            $templateProcessor->setValue($varname, $value);
        }
            $templateProcessor->setValue('college',$training->college);

                $templateProcessor->setValue('esign'," ");
                $templateProcessor->setValue('edate'," ");
                $templateProcessor->setValue('ssign'," ");
                $templateProcessor->setValue('sdate'," ");

        $templateProcessor->saveAs($training->name.'_Attendance_Report.docx');
        return response()->download(public_path($training->name.'_Attendance_Report.docx'))->deleteFileAfterSend(true);
    }

    public function render()
    {
        if ($this->start_date || $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('users.id',auth()->user()->id)
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->search)."%'")
                ->where('status', 'like', '%'.$this->filterStatus.'%')
                ->whereBetween('date_covered',[$start_date,$end_date])
                ->orderBy('date_covered','asc')
                ->paginate(10);
        }else{
            $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                ->where('users.id',auth()->user()->id)
                ->WhereRaw("LOWER(certificate_title) LIKE '%".strtolower($this->search)."%'")
                ->where('status', 'like', '%'.$this->filterStatus.'%')
                ->orderBy('date_covered','desc')
                ->paginate(10);
        }

                                    
        return view('livewire.employee-training-index', ['trainings' => $lists]);
    }
}
