<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{

    public $page = 'dashboard';
    public $string, $string2;
    
    //protected $queryString = ['page'];
    protected $listeners = [
        'MyProfile' => 'showUser',
        'home' => 'dashboard'
    ];

    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
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
     
    public function checkCoord(){
        if (auth()->user()->role_as == 1) {
            return true;
        } else {
            return false;
        }
        
    }
    public function idpSummary(){
        if ($this->checkCoord()) {
            $this->page = 'idpSummary';
        } else {
            session()->flash('message','You do not have the authority to access this page');
        }
        
    }
    public function attendanceSummary(){
        if ($this->checkCoord()) {
            $this->page = 'attendanceSummary';
        } else {
            session()->flash('message','You do not have the authority to access this page');
        }
        
       
    }
    public function trainingSummary(){
        if ($this->checkCoord()) {
            $this->page = 'trainingSummary';
        } else {
            session()->flash('message','You do not have the authority to access this page');
        }
        
       
    }
    public function certificateSummary(){
        if ($this->checkCoord()) {
            $this->page = 'certificateSummary';
        } else {
            session()->flash('message','You do not have the authority to access this page');
        }
        
       
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
    public function currentIDP(){
        $this->string2 = 'Current IDP';
        $this->idpsIndex();
        $this->emit('passIdp', $this->string2);
    }


    
    public function render()
    {
        $this->notification();
        return view('livewire.main');
    }
}
