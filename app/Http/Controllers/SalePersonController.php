<?php

namespace App\Http\Controllers;

use App\Helpers\ResMesg;
use App\Http\Requests\CreateSalePersonReq;
use App\Models\SalePerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SalePersonController extends Controller
{
    public function createSalePerson(CreateSalePersonReq $request){

        $salePerson = new SalePerson([
            'name'=>$request->name,
            'company'=>$request->company,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'notification_token'=>$request->notification_token,
            'password'=>Hash::make($request->password),
        ]);
        $salePerson->save();
        $token = $salePerson->createToken('Laravel Password SalePerson Auth')->accessToken;
        $data = [
            'salePerson' => SalePerson::find($salePerson->id),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
        return $this->jsonResponse(true, $data, "Create User successfully");
    }

    public function updateProfile(Request $request){
        $salePerson = Auth::guard('medicalRep-api')->user();
        // return $user;
        // dd($user);
        if(SalePerson::where('email',$request->email)->exists() && $salePerson->email != $request->email){
            return ResMesg::emailExists();
        }
        $salePerson->update($request->except('password'));
        if ($request->hasFile('image')){
            $salePerson->clearMediaCollection('image');
            $salePerson->addMedia($request->file('image'))->toMediaCollection('image');
        }
        $data = [
            'salePerson' => SalePerson::find($salePerson->id),
        ];
        return $this->jsonResponse(true, $data, "Profile Successfully Updated");
    }
}
