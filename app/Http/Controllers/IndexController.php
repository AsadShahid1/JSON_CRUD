<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    // form view 
    public function index(){
        return view('form');
    }

    // Form value Store function
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'max:255'],
            'address' => 'required|string|max:255',
            'image' => 'required|file|max:500|image|mimes:jpg,png,gif,ico',
            'password' => ['required', 'confirmed',Rules\Password::defaults()],
        ]);
        $file = $request->file('image');

        if ($request->hasFile('image')) {
            $filename = 'image-' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/', $filename);
        } else {
            return redirect()->back();
        }
        $data = json_encode([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $filename,
            'password' => Hash::make($request->password)
        ]);
        
       $UserCreate =  User::create(['data' => $data]);
       if ($UserCreate) {
        return redirect()->route('show')->with('success', 'User Created Successfully');
       }else{
           return redirect()->back()->with('error','Error Found');
       }
        
    }

    // show all users
    public function show(){
        $users = User::all();
        return view('show',['users' => $users ]);
    }

    // edit user details
    public function edit(User $user){
        return view('edit_form',['data'=>$user]);
    }
    // Update user details
    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'lowercase', 'max:255'],
            'address' => 'required|string|max:255',
            'image' => 'required|file|max:500|image|mimes:jpg,png,gif,ico',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }
            $file = $request->file('image');

            $filename = 'image-' . time() . rand(99, 199) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/', $filename);
        } else {
            return redirect()->back()->with('error','Image Not Found');
        }
        $data = json_encode([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'image' => $filename,
            'password' => $user->password
        ]);
        
       $UserCreate =  $user->update(['data' => $data]);
       if ($UserCreate) {
        return redirect()->route('show')->with('success', 'User Updated Successfully');
       }else{
           return redirect()->back()->with('error','Error Found');
       }
        return redirect()->route('show');
    }
}
