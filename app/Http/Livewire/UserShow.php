<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $email, $teacher,$position,$yearinPosition,$yearJoined,$college,$supervisor,$User_id;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
            'college' => 'required',
            'supervisor' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveUser()
    {
        $validatedData = $this->validate();

        User::create($validatedData);
        session()->flash('message','User Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editUser(int $User_id)
    {
        $User = User::find($User_id);
        if($User){

            $this->User_id = $User->id;
            $this->name = $User->name;
            $this->email = $User->email;
            $this->teacher = $User->teacher;
            $this->position = $User->position;
            $this->yearinPostion = $User->yearinPosition;
            $this->yearJoined = $User->yearJoined;
            $this->college = $User->college;
            $this->supervisor = $User->supervisor;
        }else{
            return redirect()->to('/Users');
        }
    }

    public function updateUser()
    {
        $validatedData = $this->validate();

        User::where('id',$this->User_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'teacher' => $validatedData['teacher'],
            'position' => $validatedData['position'],
            'yearinPosition' => $validatedData['yearinPosition'],
            'yearJoined' => $validatedData['yearJoined'],
            'college' => $validatedData['college'],
            'supervisor' => $validatedData['supervisor']
        ]);
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
        $this->User_id = '';
        $this->name = '';
        $this->email = '';
        $this->teacher = '';
        $this->position = '';
        $this->yearinPostion = '';
        $this->yearJoined = '';
        $this->college = '';
        $this->supervisor = '';
    }

    public function render()
    {
        $Users = User::where('name', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(10);
        return view('livewire.User-show', ['users' => $Users]);
    }
}
