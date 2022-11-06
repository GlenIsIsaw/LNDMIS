<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Menu extends Component
{
    public $toggle, $currentUrl;
    
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
    public function render()
    {
        return view('livewire.menu');
    }
}
