<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\College;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class UserShow extends Component
{
    use WithPagination,WithFileUploads;

    protected $paginationTheme = 'bootstrap';


    public $search, $name, $email, $teacher,$position,$yearinPosition,$yearJoined,$college_name,$supervisor,$User_id, $college_id,$supervisor_name,$signature,$password, $password_confirmation, $current_password,$photo, $coordinator_name;
    public $colleges = [];
    public $state = null;
    public $next = null;
    public $table = null;
    protected $queryString = ['search'];
    public $toggle, $currentUrl;
    public function open(){
        if (!$this->toggle) {
            $this->toggle = 'toggled';
        }else{
            $this->toggle = null;
        }
    }
     
    protected $listeners = [
        'createUser' => 'createButton',
        'clearUser' => 'clear',
        'showUser' => 'show',
        'toggle' => 'open',
        //'passUser' => 'pass',
        'refreshComponent' => '$refresh'
    ];
    public function next(){
        ++$this->next;
    }
    public function back(){
        --$this->next;
    }
    public function createButton(){
            $this->getCollege();
            $this->state = 'create';
            $this->next = 0;
        }

    public function updateButton(){
        $this->getCollege();
        $this->state = 'edit';
        $this->next = 0;
    }
    public function clear(){
        $this->next = null;
        $this->state = null;
    }
    public function backButton(){

        if($this->checkCoord()){
            $this->resetInput();
            $this->clear();
            $this->emitTo('main', 'home');
        }else{
            $this->resetInput();
            $this->clear();
        }
    }
    
    public function notification(){
        if (session()->has('message')) {
            $this->dispatchBrowserEvent('show-notification');
        }
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

    public function saveUser()
    {   
        
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255','unique:users,email'],
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
            'college_id' => Rule::requiredIf(auth()->user()->role_as == 3)
        ]);

        $user = new User();
        if (!$this->checkOfficer()) {
            $this->college_id = auth()->user()->college_id;
        }else{
            $user->role_as = 1;
            $college = College::find($this->college_id);
            $college->coordinator = $user->id;
            $college->save();
        }
            $user->college_id = $this->college_id;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->teacher = $this->teacher;
            $user->position = $this->position;
            $user->yearinPosition = $this->yearinPosition;
            $user->yearJoined = $this->yearJoined;
            $user->save();

            if ($this->checkOfficer()) {
                $college = College::find($this->college_id);
                $college->coordinator = $user->id;
                $college->save();
            }
        session()->flash('message','User Added Successfully');
        $this->backButton();
        $this->dispatchBrowserEvent('close-modal');
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
        $this->show($this->User_id);

    }
    public function editSignature(){
        $user = User::find($this->User_id);
        $user->signature = null;
        $user->save();
        $this->show($this->User_id);

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

    public function editUser(int $User_id)
    {

        $User = User::join('colleges', 'colleges.id', '=', 'users.college_id')
                    ->find($User_id);
        
        if($User){
            if ($this->checkOfficer()) {
                $this->college_id = $User->college_id;
            }
            
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
        session()->flash('message','User Updated Successfully');
        if (auth()->user()->id == $this->User_id) {
            return redirect('/profile')->with('message', "Profile Updated Successfully");
        }else{
            $this->backButton();
        }
        $this->dispatchBrowserEvent('close-modal');
    }
    public function makeSup(){
        //dd($this->college_id.'.'.$this->User_id);
        $coll = College::find($this->college_id);
        if(!$coll->supervisor){
            $user = User::find($this->User_id);
            $user->role_as = 2;
            $coll->supervisor = $this->User_id;
            $coll->save();
            $user->save();
        }
        $this->dispatchBrowserEvent('close-modal');
    }
    public function makeNotSup(){
        $coll = College::find($this->college_id);
        if($coll->supervisor){
            $user = User::find($this->User_id);
            $user->role_as = 0;
            $coll->supervisor = null;
            $coll->save();
            $user->save();
        }
        $this->dispatchBrowserEvent('close-modal');
    }
    public function closePass(){
        $this->password = null;
        $this->password_confirmation = null;
        $this->current_password = null;
        $this->resetErrorBag();
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

    public function deleteUser(int $User_id)
    {
        $this->User_id = $User_id;
    }
    public function getIds(int $user_id,int $college_id)
    {
        $this->User_id = $user_id;
        $this->college_id = $college_id;
    }

    public function destroyUser()
    {
        $user = User::find($this->User_id);
        if ($user->user_status) {
            $user->user_status = 0;
            $user->save();
            session()->flash('message','User Disabled Successfully');
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $user->user_status = 1;
            $user->save();
            session()->flash('message','User Enabled Successfully');
            $this->dispatchBrowserEvent('close-modal');
        }
        

    }

    public function closeModal()
    {
        $this->resetInput();
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
        $this->colleges = [];
        $this->photo = '';
    }

    public function mount()
    {
        $this->currentUrl = url()->current();
        //dd($this->currentUrl);
    }
    public function getCollege(){
       $college = College::all();
       $arr = [];
        $college = $college->toArray();
       foreach ($college as $num => $item) {
            foreach ($item as $key => $value) {
                if ($key == 'id') {
                    $arr[$num][$key] = $value;
                }
                if ($key == 'college_name') {
                    $arr[$num][$key] = $value;
                }
    
                
            }
       }
       //dd($arr);
        $this->colleges = $arr;
    
    }
    public function checkOfficer(){
        if (auth()->user()->role_as == 3) {
            return true;
        }else {
            return false;
        }
    }
    public function render()
    {
        $this->notification();
        $this->dispatchBrowserEvent('toggle');
        if ($this->checkOfficer()) {
            $Users = User::select('users.id As user_id', 'name','email','teacher','position','yearinPosition','yearJoined','college_name','supervisor','users.updated_at','college_id', 'user_status')
                        ->join('colleges', 'colleges.id', '=', 'users.college_id')
                        ->where('role_as', 1)
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('users.updated_at','DESC')
                        ->paginate(3);
        } else {
            $Users = User::select('users.id As user_id', 'name','email','teacher','position','yearinPosition','yearJoined','college_name','supervisor','users.updated_at','college_id', 'user_status')
                        ->join('colleges', 'colleges.id', '=', 'users.college_id')
                        ->where('college_id',auth()->user()->college_id)
                        ->whereNot('users.id',auth()->user()->id)
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('users.updated_at','DESC')
                        ->paginate(3);
        }
        
        
        return view('livewire.user.User-show', ['users' => $Users]);
    }
}
