<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $currentUrl, $toggle;

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
    public function mount(){
        $this->currentUrl = url()->current();
        //dd($this->currentUrl);
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
