<?php

namespace App\Http\Livewire\College;

use App\Models\User;
use App\Models\College;
use Livewire\Component;
use Livewire\WithPagination;

class CollegeShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $toggle, $currentUrl, $college_name, $college_id;
    public $college = [];
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
     
    protected $listeners = [
        'toggle' => 'open',
        //'passUser' => 'pass',
        'refreshComponent' => '$refresh'
    ];

    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function store(){
        $validatedData = $this->validate([
            'college_name' => 'required'
        ]);

        $college = new College();
        $college->college_name = $validatedData['college_name'];
        $college->save();

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'You have Deleted the College Info');

    }
    public function get($id){
        $user = User::find($id);
        if ($user) {
            return $user->name;
        }else{
            return null;
        }
        
    }
    public function getId(int $id){
        $this->college_id = $id;
    }
    public function edit(int $id){
        $college = College::find($id);
        $this->college_name = $college->college_name;
        $this->college_id = $college->id;
    }
    public function update(){
        $validatedData = $this->validate([
            'college_name' => 'required'
        ]);

        $college = College::find($this->college_id);
        $college->college_name = $validatedData['college_name'];
        $college->save();

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'You have Updated the College Info');
    }
    public function delete(){
        
        College::find($this->college_id)->delete();
        $this->resetErrorBag();
        $this->resetInput();

        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'You have Deleted the College Info');
    }
    public function resetInput(){
        $this->college = [];
        $this->college_name = '';
        $this->college_id = '';
    }
    public function mount()
    {
        $this->currentUrl = url()->current();
    }
    public function render()
    {
        //$this->show();
        $college = College::all();
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        return view('livewire.college.college-show', ['colleges' => $college]);
    }
}
