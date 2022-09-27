<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

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
    public function update($id,Request $request){
        $user = User::find($id);
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['string', 'min:8', 'confirmed'],
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
            'college' => 'required',
            'supervisor' => 'required'
        ]);
        $formFields['password'] = Hash::make($formFields['password']);

        $user->update($formFields);
        return response()->json('User updated!');
    }
    public function index()
    {
        $users = User::all()->toArray();
        $new = array_reverse($users);
        
        return response()->json($new);      
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required','string', 'min:8', 'confirmed'],
            'teacher' => 'required',
            'position' => 'required',
            'yearinPosition' => 'required',
            'yearJoined' => 'required',
            'college' => 'required',
            'supervisor' => 'required'
        ]);
        
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'teacher' => $request->input('teacher'),
            'position' => $request->input('position'),
            'yearinPosition' => $request->input('yearinPosition'),
            'yearJoined' => $request->input('yearJoined'),
            'college' => $request->input('college'),
            'supervisor' => $request->input('supervisor'),
            'password' => Hash::make($request->input('password')),

                
        ]);
        $user->save();
        return response()->json('User created!');
    }
    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('User deleted!');
    }
}