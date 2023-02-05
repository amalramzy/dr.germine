<?php

namespace App\Http\Controllers\Admin;

use App\Events\ReservationFinished;
use App\Http\Controllers\Controller;
use App\Models\AvailableFollowUp;
use App\Models\Child;
use App\Models\Diagnostic;
use App\Models\Medicaltest;
use App\Models\Medicine;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ChildReservationController extends Controller
{
    //

    private function mapData($id)
    {
        return ['type' => "exist", "selected" => $id];
    }

    private function mapMedicines($medicines)
    {
        $data = [];
        foreach ($medicines as $medicine) {
            $data[] = [
                'type' => "exist",
                'notes' => $medicine->pivot->notes,
                'period' => $medicine->pivot->period,
                'selectedMed' => $medicine->id,
                'selectedDose' => $medicine->pivot->dose_id,
                'selectedAltMed' => $medicine->pivot->alt_medicine_id,
            ];
        }
        return $data;
    }

    public function getDetails(Child $child, Reservation $reservation = null)
    {
        $parent = $child->user;
        $data = [
            "child" => [
                'name' => $child->name,
                'child_id' => $child->id,
                'full_name' => $child->name . ' ' . $parent->father,
                'parent_name' => $parent->father,
                'parent_id' => $parent->id,
            ],
            "reservation" => $reservation,
            "details_card"=>$reservation ? [
                "age"=>$child->age,
                "reservation_id"=>$reservation->id,
                "type"=>$reservation->type,
                "patient_comment"=>$reservation->patient_comment,
                "secretarial_comment"=>$reservation->secretarial_comment,
                "images"=>[]
            ]: null,
            "diagnostic" => $reservation ? array_map(array($this, 'mapData'), $reservation->diagnostics()->pluck('diagnostics.id')->toArray()) : [],
            "medical_test" => $reservation ? array_map(array($this, 'mapData'), $reservation->medicalTests()->pluck('medicaltests.id')->toArray()) : [],
            "vaccination" => $reservation ? $reservation->actualVaccinations()->pluck('vaccinations.id')->toArray() : [],
            "medicines" => $reservation ? $this->mapMedicines($reservation->medicines) : [],
        ];


        return response()->json($data);
    }

    public function store(Request $request)
    {

        $reservation = $request->reservation_id ?
            Reservation::find($request->reservation_id) :
            new Reservation($request->only(['weight', 'height',
                'head_size', 'temperature', 'special_datetime', 'type', 'child_id','doctor_comment','doctor_notes','price']));


        if (!$request->reservation_id)
            $reservation->save();
        if ($request->reservation_id) {
            // handle basic data
            $reservation->update($request->only(['weight', 'height',
                'head_size', 'temperature', 'special_datetime', 'type','doctor_comment','doctor_notes','price']));
        }
        if ($request->hasFile('prespection_image')){
            //TODO Upload
        }

        //handle diagnoses
        if ($request->diagnostic) {
            $request->diagnostic = json_decode($request->diagnostic);
            $reservation->diagnostics()->detach();

            foreach ($request->diagnostic as $item) {
                if ($item->type== "exist")
                    $reservation->diagnostics()->attach($item->selected);
                else if ($item->type== "new") {
                    $dig = new Diagnostic(['name' =>  [
                        "en" => $item->val,
                        "ar" => $item->val
                    ]]);
                    $dig->save();
                    $reservation->diagnostics()->attach($dig->id);
                }
            }
        }
        //handle medical test
        if ($request->medical_test) {
            $request->medical_test = json_decode($request->medical_test);

            $reservation->medicalTests()->detach();

            foreach ($request->medical_test as $item) {
                if ($item->type== "exist")
                    $reservation->medicalTests()->attach($item->selected);
                else if ($item->type== "new") {
                    $newMT = new Medicaltest(['name' => [
                        "en" => $item->val,
                        "ar" => $item->val
                    ]]);
                    $newMT->save();
                    $reservation->medicalTests()->attach($newMT->id);
                }
            }
        }
        //handle vaccations
        if ($request->vaccination) {
            $request->vaccination = json_decode($request->vaccination);

            $reservation->actualVaccinations()->detach();

            $reservation->actualVaccinations()->attach($request->vaccination);
            $reservation->child->vaccinations()->attach($request->vaccination);
        }
        //handle medicines
        if ($request->medicines) {
            $request->medicines = json_decode($request->medicines);

            $reservation->medicines()->detach();

            foreach ($request->medicines as $item) {
                if ($item->type== "exist") {
                    $reservation->medicines()->attach([$item->selectedMed => [
                        'dose_id' => $item->selectedDose,
                        'period' => $item->period,
                        'notes' => $item->notes,
                        'alt_medicine_id' => $item->selectedAltMed

                    ]]);

                } else if ($item->type== "new") {
                    $med = new Medicine(['name' => [
                        "en" => $item->val,
                        "ar" => $item->val
                    ]]);
                    $med->save();
                    $reservation->medicines()->attach([$med->id => [
                        'dose_id' => $item->selectedDose,
                        'period' => $item->period,
                        'notes' => $item->notes,
                        'alt_medicine_id' => $item->selectedAltMed

                    ]]);
                }
            }
        }


        $reservation->status = 'finished';
        $reservation->finish_time = date('H:i:s');
        $reservation->save();

        // add available follow up
        $avFollowUp = new AvailableFollowUp([
            'child_id'=>$reservation->child_id,
            'reservation_id'=>$reservation->id,
            'available_for'=>7,  // TODO replace from setting value
            'available_to'=>Carbon::today()->addDays(7)->toDateString(), // TODO replace from setting value
        ]);
        $avFollowUp->save();

        event(new ReservationFinished());
    }

    // public function childReservationTable(Request $request,Child $child){
    //     if ($request->ajax()) {

    //         $data = $child->reservations->get();

    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 // ->addColumn('action', function($row){

    //                 //        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editChild"><i class="mdi mdi-square-edit-outline"></i></a>';

    //                 //        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteChild"><i class="mdi mdi-delete"></i></a>';
    //                 //     //    $btn = $btn.' <a href="'.route('children.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser"><i class="mdi mdi-eye-outline"></i></a>';

    //                 //        return $btn;
    //                 // })
    //                 // ->addColumn('name', function($row){
    //                 //     $name = $row->name;
    //                 //     $childShow = '<a href="'.route('children.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser">'.$name.'</a>';
    //                 //     return $childShow;
    //                 // })
    //                 // ->rawColumns(['action','name'])
    //                 ->make(true);
    //     }

    //     return view('admin.child.reservation');
    // }
}
