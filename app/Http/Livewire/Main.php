<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{

    public $page = 'reports';
    public $string, $string2;
    
    //protected $queryString = ['page'];
    protected $listeners = [
        'MyProfile' => 'showUser',
        'home' => 'dashboard'
    ];
    public function dashboard(){
        $this->page = 'dashboard';

    }
    public function trainIndex(){
        $this->emitTo('training-show','clearTraining');
        $this->page = 'training';
    }
    public function createTraining(){
        $this->trainIndex();
        $this->emitTo('training-show','createTraining');
    }
    public function idpsIndex(){
        $this->emitTo('idp-show','clearIDP');
        $this->page = 'idp';
    }
    public function createIdp(){
        $this->idpsIndex();
        $this->emitTo('idp-show','createIDP');
    }
    public function userIndex(){
        $this->emitTo('user-show','clearUser');
            $this->page = 'user';
    }

    public function createUser(){
        $this->userIndex();
        $this->emitTo('user-show','createUser');
    }
    public function showUser(){
        $this->userIndex();
        $this->emit('showUser',auth()->user()->id);
    }
    public function reports(){
        $this->page = 'reports';
    }

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


    
    public function render()
    {
        return view('livewire.main');
    }
}
