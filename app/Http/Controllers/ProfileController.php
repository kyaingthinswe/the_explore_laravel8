<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function edit(){
        return view('profile.edit');
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'profile' => 'nullable|file|mimes:jpeg,png|max:5000',
        ]);
        $user = User::find(auth()->id());
        $user->name = $request->name;
        if ($request->hasFile('profile')){
            $dir = 'storage/profile/';
            $newName = "profile_".uniqid().".".$request->file('profile')->extension();
            $request->file('profile')->storeAs("public/profile/",$newName);
            $user->profile = $dir.$newName;
        }
        $user->update();
        return redirect()->back();

    }
    public function changePassword(){
        return view('profile.change-password');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ]);
        if (!Hash::check($request->old_password,auth()->user()->password)){
            return redirect()->back()->withErrors(["old_password"=>"Password don't match!"]);
        }
        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->update();
        auth()->logout();
        return redirect()->route('login');
    }
}
