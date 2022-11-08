<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;
    public $search, $name, $email, $teacher,$position,$yearinPosition,$yearJoined,$college_name,$supervisor,$User_id, $college_id,$supervisor_name,$signature,$password, $password_confirmation, $current_password,$photo;
    public $toggle, $currentUrl;

    public $state = null;
    public $next = null;

    public function updateButton(){
        $this->state = 'edit';
        $this->next = 0;
    }
    public function next(){
        ++$this->next;
    }
    public function back(){
        --$this->next;
    }

    public function clear(){
        $this->next = null;
        $this->state = null;
    }
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
    public function backButton(){
        return redirect('/profile');
    }
    
    public function checkCoord(){
        if(auth()->user()->role_as == 0)
        {
            return true;
        }
        else{ 
            return false;
        }
    }
    public function resetInput()
    {
        $this->college_id = '';
        $this->User_id = '';
        $this->name = '';
        $this->email = '';
        $this->teacher = '';
        $this->position = '';
        $this->yearinPosition = '';
        $this->yearJoined = '';
        $this->college = '';
        $this->supervisor = '';
        $this->supervisor_name = '';
        $this->college_name = '';
        $this->photo = '';
    }
    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'. $this->User_id,
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
        ];
    }
    protected $listeners = [
        'toggle' => 'open'
        //'passUser' => 'pass',
        //'refreshComponent' => '$refresh'
    ];
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
    }
    public function addSignature(){
        $validatedData = $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $user = User::find($this->User_id);
        if($validatedData['photo']){
            $filename = $this->User_id.'.signature';
            $validatedData['photo']->storeAs('public/users/'.$this->User_id, $filename);
            $user->signature = $filename;
            $user->save();
        }
        

    }
    public function editSignature(){
        $user = User::find($this->User_id);
        $user->signature = null;
        $user->save();

    }

    public function editUser(int $User_id)
    {
        $User = User::join('colleges', 'colleges.id', '=', 'users.college_id')
                    ->find($User_id);
        
        if($User){
            
            $this->User_id = $User_id;
            $this->name = $User->name;
            $this->email = $User->email;
            $this->teacher = $User->teacher;
            $this->position = $User->position;
            $this->yearinPosition = $User->yearinPosition;
            $this->yearJoined = $User->yearJoined;
            

            $this->updateButton();
            
            
            
        }else{
            session()->flash('message','No Results');
        }
    }
    public function updateUser()
    {
        $validatedData = $this->validate();
        $user = User::find($this->User_id);

            $user->name = $this->name;
            $user->email = $this->email;
            $user->teacher = $this->teacher;
            $user->position = $this->position;
            $user->yearinPosition = $this->yearinPosition;
            $user->yearJoined = $this->yearJoined;
            
            $user->save();
        return redirect()->to('/profile')->with('message','Profile Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function show(){
        $User = User::join('colleges', 'colleges.id', '=', 'users.college_id')
                    ->find(auth()->user()->id);
        
        if($User){
            
            $this->User_id = auth()->user()->id;
            $this->name = $User->name;
            $this->email = $User->email;
            $this->teacher = $User->teacher;
            $this->position = $User->position;
            $this->yearinPosition = $User->yearinPosition;
            $this->yearJoined = $User->yearJoined;
            $this->signature = $User->signature;

        }else{
            session()->flash('message','No Results');
        }
    }
    public function changePass(){
        $validatedData = $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed'
        ]);
        $user = User::find($this->User_id);
        $user->password = Hash::make($validatedData['password']);
        $user->save();
        session()->flash('message','Password Updated Successfully');

        if (auth()->user()->id == $this->User_id) {
            $this->show($this->User_id);
        }else{
            $this->backButton();
        }
        $this->closePass();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function closePass(){
        $this->password = null;
        $this->password_confirmation = null;
        $this->current_password = null;
        $this->resetErrorBag();
    }
    public function mount(){
        $this->show();
    }
    public function render()
    {
        
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        return view('livewire.profile');
    }
}