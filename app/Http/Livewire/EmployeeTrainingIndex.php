<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ListOfTraining;
use Illuminate\Support\Facades\File;

class EmployeeTrainingIndex extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name, $certificate_type, $certificate_title, $level, $date_covered, $venue, $sponsors, $num_hours, $type, $certificate, $status , $attendance_form ,$ListOfTraining_id, $user_id, $photo;

    public $search = '';
    public $start_date = '';
    public $end_date = '';
    public $updateMode = false;

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

    public function closeModal()
    {
        $this->updateMode = false;
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
    }

    public function render()
    {
        $lists = ListOfTraining::select('list_of_trainings.id as training_id','user_id','name', 'certificate_title','certificate_type', 'date_covered', 'level', 'num_hours','venue','sponsors','type','certificate','attendance_form','status')
                                    ->join('users', 'users.id', '=', 'list_of_trainings.user_id')
                                    ->where('users.id',auth()->user()->id)
                                    ->orderBy('date_covered','asc')
                                    ->paginate(10);
        return view('livewire.employee-training-index', ['trainings' => $lists]);
    }
}
