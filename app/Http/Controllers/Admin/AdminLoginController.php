<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

class AdminLoginController extends Controller
{
    public function indexLogin(){
        return view('admin-auth.login');
    }

    public function adminLogout (){
        Auth::guard('admin')->logout();
        return redirect(route('login.index'));
    }

    public function loginAdmin(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
  
        $credentials = request(['email','password']);
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect(route('dashboard'));
        }
        return redirect()->back()->withInput($request->only('email'))->with('error', "The email or password is incorrect");
    }
}
