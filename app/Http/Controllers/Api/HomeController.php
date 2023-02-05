<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HomeApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Diagnostic;
use App\Models\Medicine;
use App\Models\Reservation;
use App\Models\ReservationData;
use App\Models\Vaccination;
use App\Models\VaccinationReservation;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $res = [];
        $user = Auth::guard('api')->user();
        $childrenIds = Child::where('user_id',$user->id)->get()->pluck('id');
        if($request->child_id){
            $reserv = Reservation::whereIn('child_id',$childrenIds)->where('child_id',$request->child_id)->get();
        }else{
            $reserv = Reservation::whereIn('child_id',$childrenIds)->get();
        }
        foreach($reserv as $resr){
            $child = Child::find($resr['child_id']);
            $reservModel = Reservation::find($resr['id']);
            $push['reservation_id']=$resr['id'];
            $push['childImage']=$child->getFirstMediaUrl('image')==""?null:$child->getFirstMediaUrl('image');
            $push['child']=$child->name;
            // $push['diagonose']=$resr->diagnostics;
            // diagnostics
            $push['diagonose']=HomeApiResponse::diagn($resr);
            $push['status2']=$resr['status'];
            $push['date']=$resr['special_datetime']==null ? null : explode(' ',$resr['special_datetime'])[0];
            $push['height']=$resr->height;
            $push['weight']=$resr->weight;
            $push['temp']=$resr->temperature;
            $push['head']=$resr->head_size;
            $push['vacss']=$resr->vaccinations;

            $childrenIds = Child::where('user_id',$resr->user_id)->pluck('id');
            $resrIds= Reservation::whereIn('child_id',$childrenIds)->where(['is_follow_up'=>1])->pluck('id');
            $vaccIds = VaccinationReservation::whereIn('reservation_id',$resrIds)->pluck('vaccination_id');
            $push['vacsss']=Vaccination::whereIn('id',$vaccIds)->get();

            $push['doctorComment ']=$resr->doctor_comment;
            $push['comment']=$resr->doctor_notes;
            $push['type']=$resr->type;
            $push['images']=$reservModel->getMedia('image');
            // medicines
            $push['medisen']=HomeApiResponse::med($resr,$child);

            $push['thalyl']=HomeApiResponse::medTests($resr);
            $push['roshetas']=[]; // TODO;
            // $push['astshara']=null; // TODO;
            // astshara
            $push['astshara']=null;
            if($resr->is_follow_up){
                $push['astshara']=[
                    'id'=>$resr->id,
                    'userName'=>$user->name,
                    'child '=>$child->name,
                    'serviceId'=>$resr->id, //TODO,
                    'comment'=>$resr->doctor_notes,
                    'dComment'=>$resr->doctor_comment,
                    'al7ala'=>null, //TODO,
                    'status'=>$resr['status'],
                    'sloteId'=>$resr['slot_id'],
                    'height'=>$resr->height,
                    'weight'=>$resr->weight,
                    'temp'=>$resr->temperature,
                    'head'=>$resr->head_size,
                    'diags'=>HomeApiResponse::diagn($resr),
                    'roshetas'=>[], //TODO,
                    'day'=>explode(' ',$resr->special_datetime)[0]==null ? null : DateTime::createFromFormat('Y-m-d', explode(' ',$resr->special_datetime)[0])->format('D'),
                    'date'=>$resr['special_datetime']==null ? null : explode(' ',$resr['special_datetime'])[0],
                    'meds'=>HomeApiResponse::med($resr,$child),
                ];
            }
            $push['order']=null; // TODO;
            $push['kshf']=$resr->type=='examanation'? 1 : 0;
            $push['vaccin']=$resr->type=='vaccination'? 1 : 0;
            $push['survey']=null; // TODO;
            $push['astshara2']=null; // TODO;

            array_push($res,$push);
        }
        return $res;
    }
}
