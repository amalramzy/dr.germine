<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResMesg;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateImageReq;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 'name',
// 'birthdate',
// 'gender',
// 'hospital',
class UserChildController extends Controller
{
    // public function addChild(Request $request){

    // }
    public function addChild(Request $request)
    {
        $user = Auth::guard('api')->user();
        //$child->save;
        $child = new Child($request->all());
        $child->user_id = $user->id;
        $child->save();
        if($child->save()){
            if ($request->hasFile('image')){
                $child->clearMediaCollection('image');
                $child->addMedia($request->file('image'))->toMediaCollection('image');

                }
        }
            return $this->jsonResponse(true,$child,"this Child saved");
    }

    public function editChild(Request $request,$childId){
            $user = Auth::guard('api')->user();
            $child= Child::findOrFail($childId);
            if(!$child->isTheirParent($user)){
                return ResMesg::notUrChild();
            }

            $child->fill($request->all())->save();
            $child->save();
            if($child->save()){
                if ($request->has('image')){
                    $child->clearMediaCollection('image');
                    $child->addMedia($request->file('image'))->toMediaCollection('image');

                }
                return $this->jsonResponse(true,$child,"this Child updated");
            }
    }

    public function updateProfileImage(updateImageReq $request,$childId){
        $user = Auth::guard('api')->user();
        $child= Child::findOrFail($childId);
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        }
        $child->clearMediaCollection('image');
        $child->addMedia($request->file('image'))->toMediaCollection('image');
        $data = [
            'image' => Child::find($childId)->image,
        ];
        return $this->jsonResponse(true, $data, "Profile Image Successfully Updated");
    }

    public function deleteChild()
    {

        $user = Auth::guard('api')->user();
        //  dd($user);
     $child = Child::where('user_id',$user->id)->first();
        // dd($child);
          if($child)  {
              $child->delete();
              return $this->jsonResponse(true,[],"this Child Deleted");

          }

    }

    public function childCount(){
        $childMale = Child::where('gender','male')->count();
        $childFemale = Child::where('gender','female')->count();
        $data = array($childMale,$childFemale);

      return $data;
    }
}

