<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationRequest;
use App\Http\Requests\NameRequest;
use Illuminate\Http\Request;
use App\Models\Evaluation;
use Yajra\DataTables\Facades\DataTables;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Evaluation::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editEvaluation"><i class="mdi mdi-square-edit-outline"></i></a>';
                          
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteEvaluation"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                    ->addColumn('question',function($row){
                        
                        $question = $row->question;
                            return $question;
                        })
                    
                    ->rawColumns(['action','question'])
                    ->make(true);
        }
        
        return view('admin.evaluation.index');
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
    public function store(EvaluationRequest $request)
    {
        Evaluation::updateOrCreate([
            'id' => $request->evaluation_id
        ],
        [
            'question' => ['en'=>$request->question_en,'ar'=>$request->question_ar]
        ]
    );        

       return response()->json(['success'=>'Evaluation saved successfully.']);
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
        $evaluation = Evaluation::find($id);
        return response()->json($evaluation); 
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
        Evaluation::find($id)->delete();
      
        return response()->json(['success'=>'Evaluation deleted successfully.']);
    }
}
