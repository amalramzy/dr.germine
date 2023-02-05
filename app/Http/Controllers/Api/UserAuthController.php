<?php

namespace App\Http\Controllers\Api;

use App\Helpers\RandomStr;
use App\Helpers\ResMesg;
use App\Helpers\SendMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\changePassReq;
use App\Http\Requests\sendResetEmailReq;
use App\Http\Requests\updateImageReq;
use App\Http\Requests\updatePasswordReq;
use App\Models\SalePerson;
use App\Http\Resources\PersonResource;
use App\Mail\ForgotPassword;
use App\Models\PasswordResetModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserAuthController extends Controller
{
    // 'father',
    // 'mother',
    // 'email',
    // 'area_id',
    // 'phone1',
    // 'phone2',
// 'password',
    public function changePassword(changePassReq $request)
    {
        $user = Auth::user();
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return ResMesg::passDoesntMatch();
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return ResMesg::passIsSame();
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return ResMesg::passIsSame();
        }

        //Change Password
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return ResMesg::passChanged();
    }
    public function createUser(CreateUserRequest $request){

        $user = new User([
            'father'=>$request->father,
            'mother'=>$request->mother,
            'area_id'=>$request->area_id,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'email'=>$request->email,
            'notification_token'=>$request->notification_token,
            'password'=>Hash::make($request->password),
        ]);
        $user->save();
        $token = $user->createToken('Laravel Password User Auth')->accessToken;
        $data = [
            'user' => User::find($user->id),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return $this->jsonResponse(true, $data, "Create User successfully");
    }

     public function login (LoginUserRequest $request) {
        $credentials = request(['phone1','password']);
        // if(!Auth::attempt($credentials)){
        //     return $this->jsonResponse(false, [], "Wrong Credentials");
        // }
        $user = User::where('phone1', $request->phone1)->first();
        if ($user) {
            $user->update([
                'notification_token'=>$request->notification_token,
            ]);
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password User Auth')->accessToken;
                $data = [
                    'User' => User::find($user->id),
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ];
                return $this->jsonResponse(true, $data, "User login successfully");
            }
        }
        $salePerson = SalePerson::where('phone', $request->phone1)->first();
        if($salePerson){
            $person = SalePerson::where('phone',$request->phone1)->first();
            $person->update([
                'notification_token'=>$request->notification_token,
            ]);
            if (Hash::check($request->password, $person->password)) {
                $token = $person->createToken('Laravel Password Sale Person')->accessToken;
                $data = [
                    'Person' => new PersonResource($person),
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ];
                return $this->jsonResponse(true, $data, "Sale Person login successfully");
            }
        }
        return ResMesg::WrongCardin();
    }

    public function getUser(){
        $user = Auth::guard('api')->user();
        // dd($user);
        return response()->json($user);
    }

    public function allUser(){
        $users = User::all();
        return UserResource::collection($users);

    }

    public function maleCount(){
        $users = User::where('gender','male')->count();
        return $users;
    }

    public function logout(Request $request){
        $user = Auth::guard('api')->user()->token();
        // dd($user);
        $user->revoke();
        return $this->jsonResponse(true, [], "User logged out");
    }

    public function updateProfile(Request $request){
        $user = Auth::guard('api')->user();
        // return $user;
        // dd($user);
        if(User::where('email',$request->email)->exists() && $user->email != $request->email){
            return ResMesg::emailExists();
        }
        $user->update($request->except('password'));
        if ($request->hasFile('image')){
            $user->clearMediaCollection('image');
            $user->addMedia($request->file('image'))->toMediaCollection('image');
        }
        $data = [
            'user' => User::find($user->id),
        ];
        return $this->jsonResponse(true, $data, "Profile Successfully Updated");
    }
    public function updateProfileImage(updateImageReq $request){
        $user = Auth::guard('api')->user();
        $user->clearMediaCollection('image');
        $user->addMedia($request->file('image'))->toMediaCollection('image');
        $data = [
            'image' => User::find($user->id)->image,
        ];
        return $this->jsonResponse(true, $data, "Profile Image Successfully Updated");
    }

    public function sendResetEmail(sendResetEmailReq $request)
    {
        SendMail::sendto($request->email);
        return ResMesg::emailSent();
    }

    public function updatePassword(updatePasswordReq $request)
    {
        // dd(PasswordResetModel::where(['email'=>$request->email])->orderBy('created_at', 'desc')->first()->token);
        $getToken = PasswordResetModel::where(['email'=>$request->email])->orderBy('created_at', 'desc')->first();
        $user=User::where('email',$request->email)->first();
        if(!Hash::check($request->token,$getToken->token)){
            // return redirect()->back();
            return response()->json(["message"=>"invalid token"]);
        }
        $createdAt = new Carbon($getToken->created_at);
        $twoHours = Carbon::now()->subHours(2);

        if ($createdAt->lt($twoHours)) {
            return response()->json(["message"=>"invalid token"]);
        }

        $user->update(['password'=>Hash::make($request->password)]);
        return redirect()->back();
    }
}
