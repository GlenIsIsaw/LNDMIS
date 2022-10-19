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
        $this->trainIndex();
        $this->emit('passTraining', $this->string);
    }
    public function myTraining(){
        $this->string = 'My Trainings';
        $this->trainIndex();
        $this->emit('passTraining', $this->string);
    }
    public function submittedTraining(){
        $this->string = 'Submitted Trainings';
        $this->trainIndex();
        $this->emit('passTraining', $this->string);
    }

    public function approvedIDP(){
        $this->string2 = 'Approved IDPs';
        $this->idpsIndex();
        $this->emit('passIdp', $this->string2);
    }
    public function myIDP(){
        $this->string2 = 'My IDPs';
        $this->idpsIndex();
        $this->emit('passIdp', $this->string2);
    }
    public function submittedIDP(){
        $this->string2 = 'Submitted IDPs';
        $this->idpsIndex();
        $this->emit('passIdp', $this->string2);
    }


    public function trainIndex(){
        $this->emitTo('training-show','clearTraining');
        $this->trainingIndex = true;
        $this->idpIndex = false;
    }
    public function createTraining(){
        $this->trainIndex();
        $this->emitTo('training-show','createTraining');
    }
    public function idpsIndex(){
        $this->emitTo('idp-show','clearIDP');
        $this->trainingIndex = false;
        $this->idpIndex = true;
    }
    public function createIdp(){
        $this->idpsIndex();
        $this->emitTo('idp-show','createIDP');
    }
    public function render()
    {
        return view('livewire.main');
    }
}
