<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ListOfTraining;
use Illuminate\Validation\Rule;
use App\Models\IncomingTrainings;
use Illuminate\Support\Facades\File;

class IncomingTrainingsShow extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $name, $date, $file, $toggle, $currentUrl, $fileType, $start_date, $end_date, $invitation_id, $sponsor, $venue, $level, $level_others, $free, $amount, $date_covered;
    public $filter_name, $filter_level, $filter_free;

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
    public function next(){
        ++$this->next;
    }
    public function back(){
        --$this->next;
    }
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function createButton(){
        $this->resetInput();
        $this->state = 'create';
    }
    public function showButton(){
        $this->state = 'show';
    }
    public function editButton(){
        $this->state = 'edit';
    }
    public function backButton(){
        $this->resetInput();
        $this->clear();
    }
    public function resetInput(){
        $this->name = null;
        $this->date = null;
        $this->file = null;
        $this->fileType = null;
        $this->invitation_id = null;
        $this->sponsor = null;
        $this->venue = null;
        $this->level = null;
        $this->level_others = null;
        $this->free = null;
        $this->amount = null;
        $this->date_covered = null;
    }
    public function clear(){
        $this->state = null;
        $this->next = 0;
    }
    public function part1(){
        $validatedData = $this->validate([
            'name' => 'required|string',
            'sponsor' => 'required|string',
            'venue' => 'required|string',
            'level' => 'required',
            'level_others' => Rule::requiredIf($this->level == 'Others'),

        ]);

        $this->next();
    }
    public function part2(){
        $validatedData = $this->validate([

            'date_covered' => 'required',
            'date' => 'required|date|after:now',
            'free' => 'required',
            'amount' => Rule::requiredIf($this->free == 'No'),
        ]);

        $this->next();
    }
    public function store(){
        $validatedData = $this->validate([
            'file' => 'required|mimes:jpeg,png,jpg,svg,pdf'
        ]);
            $user_id = auth()->user()->id;
            $list = new IncomingTrainings();
            $list->name = $this->name;
            $list->date = $this->date;
            $list->sponsor = $this->sponsor;
            $list->venue = $this->venue;
            if($this->level == 'Others'){
                $list->level = $this->level.':'.$this->level_others;
            }else{
                $list->level = $this->level;
            }
            
            $list->date_covered = $this->date_covered;
            if ($this->free == 'Yes') {
                $list->free = 0;
            } else {
                $list->free = 1;
                $list->amount = $this->amount;
            }
            
            $list->college_id = auth()->user()->college_id;
            $list->file = 'File Added';

            $list->save();

            if($validatedData['file']){
                $ext = $this->file->getClientOriginalExtension();
                $lists = IncomingTrainings::find($list->id);
                $filename = date('Ymd').$list->id.".".$ext;
                $folderPath = storage_path('app/public/users/IncomingTrainings');
                if(!is_dir($folderPath))
        		{
        			mkdir($folderPath, 0755);
        		}
                $validatedData['file']->storeAs('public/users/IncomingTrainings', $filename);
                $lists->file = $filename;
                $lists->save();
            }

            
            session()->flash('message','Incoming Invitation Added Successfully');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
    }
    public function fileType($filename){
        $array = explode(".", $filename);
        return strtolower(end($array));

    }
    public function downloadCert(){
        //dd('Pangit ako');
        return response()->download(storage_path("app/public/users/IncomingTrainings/".$this->file), $this->name.".".$this->fileType);
    }
    public function show(int $id){
        $lists = IncomingTrainings::where('college_id',auth()->user()->college_id)
                ->where('id', $id)
                ->first();

        
        $this->fileType = $this->fileType($lists->file);
        $this->name = $lists->name;
        $this->date = $lists->date;
        $this->file = $lists->file;
        $this->sponsor = $lists->sponsor;
        $this->venue = $lists->venue;
        $this->level = $lists->level;
        $this->date_covered = $lists->date_covered;
        $this->free = $lists->free;
        $this->amount = $lists->amount;
        
        if($this->state == null){
            $this->showButton();
        }
        //dd($this->fileType);

    }
    public function resetFile(){
        $this->file = null;
    }
    public function update(){
        $validatedData = $this->validate([
            'name' => 'required',
            'date' => 'required|date|after:now',
        ]);
            $user_id = auth()->user()->id;
            $list = IncomingTrainings::find($this->invitation_id);
            $list->name = $this->name;
            $list->date = $this->date;
            $list->sponsor = $this->sponsor;
            $list->venue = $this->venue;
            if($this->level == 'Others'){
                $list->level = $this->level.':'.$this->level_others;
            }else{
                $list->level = $this->level;
            }
            
            $list->date_covered = $this->date_covered;
            if ($this->free == 'Yes') {
                $list->free = 0;
            } else {
                $list->free = 1;
                $list->amount = $this->amount;
            }
            //$list->college_id = auth()->user()->college_id;
            //$list->file = 'File Added';

            $list->save();
            if($this->file){
                $ext = $this->file->getClientOriginalExtension();
                $lists = IncomingTrainings::find($list->id);
                File::delete(storage_path('app/public/users/IncomingTrainings/'.$this->name));
                $filename = date('Ymd').$list->id.".".$ext;
                $this->file->storeAs('public/users/IncomingTrainings', $filename);
                $lists->file = $filename;
                $lists->save();
            }

            
            session()->flash('message','Incoming Invitation Updated Successfully');
            $this->backButton();
            $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $id){
        $list = IncomingTrainings::where('college_id',auth()->user()->college_id)
                ->where('id', $id)
                ->first();

        
        $this->fileType = $this->fileType($list->file);
        $this->invitation_id = $id;
        $this->name = $list->name;
        $this->date = $list->date;
        $this->sponsor = $list->sponsor;
        $this->venue = $list->venue;
        $this->level = $list->level;
        $this->date_covered = $list->date_covered;
        $this->free = 'No';
        if ($list->free == 0) {
            $this->free = 'Yes';
            $this->amount = $list->amount;
        }else {
            $list->free = 'No';
            $this->amount = $list->amount;
        }
        //$this->file = $list->file;
        $this->editButton();
        //dd($this->fileType);

    }
    public function destroy(){
        $list = IncomingTrainings::where('id','=',$this->invitation_id)
        ->first();
        File::delete(storage_path('app/public/users/IncomingTrainings/'.$list->name));
        IncomingTrainings::find($this->invitation_id)->delete();
        session()->flash('message','Invitation Deleted Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function getId($id){
        $this->invitation_id = $id;
    }
    public function resetFilter(){
        $this->filter_name = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->filter_level = null;
        $this->filter_free = null;

    }
    public function updatingFilterName($value){
        $this->resetPage();
    }
    public function updatingFilterLevel($value){
        $this->resetPage();
    }
    public function updatingFilterFree($value){
        $this->resetPage();
    }
    public function updatingEndDate($value){
        $this->resetPage();
    }
    public function mount()
    {
        $this->currentUrl = url()->current();
        //dd($this->currentUrl);
    }
    public function render()
    {
        //dd(date('Y-m-d'));
        $this->notification();
        $this->dispatchBrowserEvent('toggle');

            if ($this->start_date && $this->end_date) {
                $start_date = Carbon::parse($this->start_date)->toDateTimeString();
                $end_date = Carbon::parse($this->end_date)->toDateTimeString();
                $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
                    ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                    ->where('level', 'like', '%'.$this->filter_level.'%')
                    ->where('free', 'like', '%'.$this->filter_free.'%')
                    ->whereBetween('date',[$start_date,$end_date])
                    ->orderBy('updated_at')
                    ->paginate(3);
            }else{
                $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                ->where('level', 'like', '%'.$this->filter_level.'%')
                ->where('free', 'like', '%'.$this->filter_free.'%')
                ->orderBy('updated_at')
                ->paginate(3);
            }
        
            //dd($lists);
        return view('livewire.incoming-trainings-show', ['trainings' => $lists]);
    }
}
