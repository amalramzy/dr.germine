<?php

namespace App\Http\Controllers;

use App\Helpers\ResMesg;
use App\Models\AvailableFollowUp;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUp extends Controller
{
    public function myFollowups(){
        $user= Auth::user();
        $childrenIds = Child::where('user_id',$user->id)->pluck('id');
        return AvailableFollowUp::whereIn('child_id',$childrenIds)->get();
    }

    public function FollowupsForChild($childId){
        $child= Child::find($childId);
        $user= Auth::user();
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        }
        return AvailableFollowUp::where('child_id',$childId)->get();
    }
}
