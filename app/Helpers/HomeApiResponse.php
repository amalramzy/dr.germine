<?php
namespace App\Helpers;

use App\Models\Medicine;
use App\Models\Reservation;

class HomeApiResponse
{
    public static function diagn($resr) {
        $res=[];
        foreach($resr->diagnostics as $diagn){
            $pushMedicine=[
                'id'=>$diagn->id,
                'serviceId '=>$resr->id, // TODO,
                'astsharaId'=>HomeApiResponse::astsharaId($resr),
                'diagonoses'=>$diagn->name,
                'photo '=>$diagn->getFirstMediaUrl('image')==""?null:$diagn->getFirstMediaUrl('image'),
                'createdAt'=>$diagn->created_at,
                'updatedAt'=>$diagn->updated_at
            ];
            array_push($res,$pushMedicine);
        }
        return $res;
    }
    public static function med($resr,$child){
        $res=[];
        foreach($resr->medicines as $medicine){
            $medForReserv = Reservation::find($resr->id)->medicines->where('id',$medicine->id)->first();
            $pushMedicine=[
                'id'=>$medicine->id,
                'medicenName'=>$medicine->name,
                'serviceId '=>$resr->id, // TODO,
                'astsharaId'=>HomeApiResponse::astsharaId($resr),
                'childId'=>$child->id,
                'sdate'=>"", // TODO,
                'edate'=>"", // TODO,
                'days'=>$medForReserv->period,
                'dose'=>$medForReserv->dose,
                'med2'=>Medicine::find($medForReserv->alt_medicine_id),
                'nots'=>$medForReserv->notes,
            ];
            array_push($res,$pushMedicine);
        }
        return $res;
    }
    public static function medTests($resr){
        $res=[];
        foreach($resr->medicalTests as $med){
            $pushMedTest=[
                'id'=>$med->id,
                'name'=>$med->name,
                'swar'=>HomeApiResponse::swar($med)
            ];
            array_push($res,$pushMedTest);
        }
        return $res;
    }

    public static function swar($model){
        $res=[];
        foreach($model->getMedia('image') as $img){
            $pushImg=[
                'id'=>$img->id,
                'sora'=>$img->getUrl()
            ];
            array_push($res,$pushImg);
        }
        return $res;
    }
    public static function astsharaId($resr){
        return $resr->is_follow_up ? $resr->id : null;
    }
}
