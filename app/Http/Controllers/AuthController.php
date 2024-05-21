<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //direct loginPage

    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    //password change

    public function password() {
        return view('admin.adminDetail.password');
    }

    public function changePassword(Request $request) {

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        $request->validate([
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ]);

        if(Hash::check($request->oldPassword,$dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ] ;
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#login');
        }
        return back()->with(['notMatchPassword' => 'notMatch']);
    }

    //dashboard
    public function dashboard() {

        if(Auth::user()->role == 'admin') {
            return Redirect()->route('category#list');
        }

        if(Auth::user()->role == 'user') {
            return Redirect()->route('user#home');
        }
    }
}
