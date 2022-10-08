<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $trainingIndex = false;
    public $idpIndex = false;

    public function trainIndex(){
        $this->trainingIndex = true;
        $this->idpIndex = false;
    }
    public function idpsIndex(){
        $this->trainingIndex = false;
        $this->idpIndex = true;
    }
    public function render()
    {
        return view('livewire.main');
    }
}
