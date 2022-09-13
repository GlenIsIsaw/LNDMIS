<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
use App\Http\Requests\UserRequest;
=======
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
>>>>>>> 9af86ee7f00e5a4bfb36dae0c8a7a829a9f6cd7c
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
<<<<<<< HEAD
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
=======

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }

    public function edit($id){
        $users = User::find($id);
        return view('users.edit', ['users' => $users]);
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        

        if($user->id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
            'college' => 'required',
            'supervisor' => 'required'


        ]);


        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        $user->teacher = request('teacher');
        $user->position = request('position');
        $user->yearinPosition = request('yearinPosition');
        $user->yearJoined = request('yearJoined');
        $user->college = request('college');
        $user->supervisor = request('supervisor');

        
        $user->save();
        return back()->with('mssg', 'Updated') ;
>>>>>>> 9af86ee7f00e5a4bfb36dae0c8a7a829a9f6cd7c
    }
}
