<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
    public function update(Request $request, $id){
        $user = User::find($id);
        

        if($user->id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
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