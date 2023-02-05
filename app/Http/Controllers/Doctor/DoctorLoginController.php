<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorLoginController extends Controller
{
    public function indexLogin(){
        return view('doctor-auth.login');
    }

    public function doctorLogout (){
        Auth::guard('doctor')->logout();
        return redirect(route('logindoctor.index'));
    }

    public function loginDoctor(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
  
        $credentials = request(['email','password']);
        if(Auth::guard('doctor')->attempt($credentials)){
            return redirect(route('dashboard'));
        }
        return redirect()->back()->withInput($request->only('email'))->with('error', "The email or password is incorrect");
    }
}
