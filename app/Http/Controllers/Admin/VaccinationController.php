<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameRequest;
use App\Http\Requests\VaccinationRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Vaccination;
use Illuminate\Support\Facades\DB;
class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Vaccination::latest()->get();
  
            return Datatables::of($data)

                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editVaccination"><i class="mdi mdi-square-edit-outline"></i></a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteVaccination"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                    ->addColumn('name',function($row){
                        
                        $name = $row->name;
                            return $name;
                        })
                    
                    ->rawColumns(['action','name'])
                    ->make(true);
        }
        
        return view('admin.medical.vaccination.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
       $vac =  Vaccination::updateOrCreate([
            'id' => $request->vaccination_id
        ],
        [
            'name' => ['en'=>$request->name_en,'ar'=>$request->name_ar],
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year
        ]
    );        
    
    $day=$request->day;
    $month = $request->month;
    $calmonth = $month * 30;
    $year = $request->year;
    $calyear = $year *365;
    $days = $day + $calmonth + $calyear;
       DB::table('vaccinations')->where('id', $vac->id)->update(
 
        ['days' => $days]
    );
       return response()->json(['success'=>'Vaccination saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vaccination = Vaccination::find($id);
        return response()->json($vaccination); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vaccination::find($id)->delete();
      
        return response()->json(['success'=>'Vaccination deleted successfully.']);
    }
}
