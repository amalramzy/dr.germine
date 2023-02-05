<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResMesg;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvalResrvReq;
use App\Models\Child;
use App\Models\EvalReservation;
use App\Models\Evaluation;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index(Request $request){
        if($request->reservation_id){
            $resrv=Reservation::findOrfail($request->reservation_id);
            return $this->jsonResponse(true,$resrv->evals,'');
        }
        return $this->jsonResponse(true,Evaluation::all(),'');
    }

    public function evaluate(EvalResrvReq $request){
        $resrvId = $request->reservation_id;
        $resrv=Reservation::findOrfail($resrvId);
        $child= Child::where('id',$resrv->child_id)->first();
        $user=Auth::user();
        if(!$child->isTheirParent($user)){
            return ResMesg::notUrChild();
        };
        foreach($request->evaluations as $eval){
            EvalReservation::create(['reservation_id'=>$resrvId,'evaluation_id'=>$eval['question_id'],'score'=>$eval['score']]);
        }
        $resrv->update(['evaluation_comment'=>$request->comment]);

        return $this->jsonResponse(true,$resrv->evals,'');
    }
}
