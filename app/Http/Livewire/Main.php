<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $trainingIndex = true;
    public $idpIndex = false;
    public $string, $string2;

    public function approvedTraining(){
        $this->string = 'Approved Trainings';
        $this->emit('passTable', $this->string);
    }
    public function myTraining(){
        $this->string = 'My Trainings';
        $this->emit('passTable', $this->string);
    }
    public function submittedTraining(){
        $this->string = 'Submitted Trainings';
        $this->emit('passTable', $this->string);
    }
    public function approvedIDP(){
        $this->string2 = 'Approved IDPs';
        $this->emit('pass', $this->string2);
    }
    public function myIDP(){
        $this->string2 = 'My IDPs';
        $this->emit('pass', $this->string2);
    }
    public function submittedIDP(){
        $this->string2 = 'Submitted IDPs';
        $this->emit('pass', $this->string2);
    }
    public function trainIndex(){
        $this->emitTo('training-show','clear');
        $this->trainingIndex = true;
        $this->idpIndex = false;
    }
    public function idpsIndex(){
        $this->emitTo('idp-show','clear');
        $this->trainingIndex = false;
        $this->idpIndex = true;
    }
    public function render()
    {
        return view('livewire.main');
    }
}
