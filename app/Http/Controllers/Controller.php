<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectToLogin()
    {

        return redirect()->route('login');
    }
    public function changePasswordView()
    {
        return view('auth.change-password');
    }
    public function changePassword()
    {

        $current = Input::get('current_password');
        $new = Input::get('new_password');
        $newRepeat = Input::get('new_password_repeat');
        if (!($new === $newRepeat))
        {
            return redirect()->back()->with(['error'=>'The Passwords do Not Match']);
        }
       if ( Auth::attempt(['username'=>Auth::user()->username,'password'=>$current]))
        {
            $user = Auth::user();
            $user->password = bcrypt($new);
            $user->save();
            return redirect()->back()->with(['success'=>'Password Changed Successfully']);
        }
        else{
            return redirect()->back()->with(['error'=>'Current Password is wrong']);
        }
    }
}
