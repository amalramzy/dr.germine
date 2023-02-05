<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DrodownsController extends Controller
{
    //
    public function vaccination()
    {
        $data = [];
        foreach (\App\Models\Vaccination::all() as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }
        return response()->json($data);
    }

    public function doses()
    {
        $data = [];
        foreach (\App\Models\Dose::all() as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }
        return response()->json($data);
    }

    public function medicines()
    {
        $data = [];

        foreach (\App\Models\Medicine::all() as $item) {
            $data[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }
        return response()->json($data);
    }

    public function diagnostic(){
        $data =[];

        foreach (\App\Models\Diagnostic::all() as $item){
            $data[]=[
                'id'=>$item->id,
                'name'=>$item->name
            ];
        }
        return response()->json($data);    }

    public function MedicalTest(){
        $data =[];

        foreach (\App\Models\Medicaltest::all() as $item){
            $data[]=[
                'id'=>$item->id,
                'name'=>$item->name
            ];
        }
        return response()->json($data);

    }

    public function generateModelDropdown($modelName){

    }
}
