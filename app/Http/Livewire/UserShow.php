<?php

namespace App\Http\Livewire;

use App\Models\College;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class UserShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $name, $email, $teacher,$position,$yearinPosition,$yearJoined,$college_name,$supervisor,$User_id, $college_id;
    public $search = '';
    public $updateMode = false;

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
        ]);
        
        $user = new User();

            $user->college_id = $this->college_id;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->teacher = $this->teacher;
            $user->position = $this->position;
            $user->yearinPosition = $this->yearinPosition;
            $user->yearJoined = $this->yearJoined;
            /*
            if($this->supervisor == 1){
                $user->role_as = 2;
                $coll = College::find($this->college_id);
                $coll->supervisor = $this->name;
                $coll->save();
            }*/
        $user->save();
        session()->flash('message','User Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
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

        }else{
            return redirect()->to('/Users');
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
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteUser(int $User_id)
    {
        $this->User_id = $User_id;
    }

    public function destroyUser()
    {
        User::find($this->User_id)->delete();
        session()->flash('message','User Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
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
    }

    public function render()
    {
        $this->college_id = auth()->user()->college_id;
        $Users = User::select('users.id As user_id', 'name','email','teacher','position','yearinPosition','yearJoined','college_name','supervisor','users.updated_at')
                        ->join('colleges', 'colleges.id', '=', 'users.college_id')
                        ->where('college_id',auth()->user()->college_id)
                        ->where('name', 'like', '%'.$this->search.'%')
                        ->orderBy('users.updated_at','DESC')
                        ->paginate(10);
        return view('livewire.User-show', ['users' => $Users]);
    }
}
