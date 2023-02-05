<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRepRequest;
use Illuminate\Http\Request;
use App\Models\Represervation;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RepReservationResource;
use App\Models\MedicalRepRequests;

class ReservationMedicalRepController extends Controller
{
    public function createReservation(Request $request){
        $salePerson = Auth::guard('medicalRep-api')->user();
        // dd($salePerson);
        $reservation = new Represervation($request->all());
            $reservation->salePerson_id = $salePerson->id;
            $reservation->save();
            return $this->jsonResponse(true, $reservation, "this Reservation saved");

    }

    public function myReservation(){
        $salePerson = Auth::guard('medicalRep-api')->user();
        $reservations = $salePerson->repReservations;

        return RepReservationResource::collection($reservations);
    }
    public function myReservationReq(){
        $salePerson = Auth::guard('medicalRep-api')->user();
        $reservations = $salePerson->repReservationsReq;

        return RepReservationResource::collection($reservations);
    }

    public function createReservationReq(MedicalRepRequest $request){
        $salePerson = Auth::guard('medicalRep-api')->user();
        $repReq = new MedicalRepRequests($request->all());
            $repReq->medical_rep_id = $salePerson->id;
            $repReq->save();
            return $this->jsonResponse(true, $repReq, "Medical Reservations Req sent");
    }
}
