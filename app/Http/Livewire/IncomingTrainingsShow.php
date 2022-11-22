<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ListOfTraining;
use App\Models\IncomingTrainings;

class IncomingTrainingsShow extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $name, $date, $file, $toggle, $currentUrl, $fileType, $start_date, $end_date, $filter_name;

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
    public function createButton(){
        $this->state = 'create';
    }
    public function showButton(){
        $this->state = 'show';
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
    }
    public function clear(){
        $this->state = null;
    }
    public function store(){
        $validatedData = $this->validate([
            'name' => 'required',
            'date' => 'required|date|after:now',
            'file' => 'required|mimes:jpeg,png,jpg,svg,pdf'
        ]);
            $user_id = auth()->user()->id;
            $list = new IncomingTrainings();
            $list->name = $this->name;
            $list->date = $this->date;
            $list->college_id = auth()->user()->college_id;
            $list->file = 'File Added';

            $list->save();

            if($validatedData['file']){
                $ext = $this->file->getClientOriginalExtension();
                $lists = IncomingTrainings::find($list->id);
                $filename = date('Ymd').$list->id.".".$ext;
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
        
        $this->showButton();
        //dd($this->fileType);

    }
    public function resetFilter(){
        $this->filter_name = null;
        $this->start_date = null;
        $this->end_date = null;

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
        //dd($this->currentUrl);
    }
    public function render()
    {
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        if ($this->start_date && $this->end_date) {
            $start_date = Carbon::parse($this->start_date)->toDateTimeString();
            $end_date = Carbon::parse($this->end_date)->toDateTimeString();
            $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
                ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
                ->whereBetween('date',[$start_date,$end_date])
                ->paginate(5);
        }else{
            $lists = IncomingTrainings::where('college_id', auth()->user()->college_id)
            ->WhereRaw("LOWER(name) LIKE '%".strtolower($this->filter_name)."%'")
            ->paginate(5);
        }
            //dd($lists);
        return view('livewire.incoming-trainings-show', ['trainings' => $lists]);
    }
}
