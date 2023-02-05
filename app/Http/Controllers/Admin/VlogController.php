<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vlog;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\BlogRequest;

class VlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Vlog::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editVlog"><i class="mdi mdi-square-edit-outline"></i></a>';
                          
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteVlog"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                    ->addColumn('title',function($row){
                        
                        $title = $row->title;
                        $vlogShow = '<a href="'.route('vlog.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser">'.$title.'</a>';
                        return $vlogShow;
                        })
                    ->addColumn('content',function($row){
                        
                        $content = $row->content;
                            return $content;
                        })
                    ->rawColumns(['action','title','content'])
                    ->make(true);
        }
        
        return view('admin.vlog.index');
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
    public function store(BlogRequest $request)
    {
        $vlog = Vlog::updateOrCreate([
            'id' => $request->vlog_id
        ],
        [
            'title' => ['en'=>$request->title_en,'ar'=>$request->title_ar],
            'content' => ['en'=>$request->content_en,'ar'=>$request->content_ar],
        ],
      
    );        
    if($vlog){
        if ($request->hasFile('video')){
            $vlog->clearMediaCollection('video');
            $vlog->addMedia($request->file('video'))->toMediaCollection('video');
        } 
    }else{
        if ($request->file('video')){
            $vlog->addMedia($request->file('video'))->toMediaCollection('video');
           
        }
    }
           
       return response()->json(['success'=>'Vlog saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vlog = Vlog::find($id);
        return view('admin.vlog.show',compact(['vlog']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vlog = Vlog::find($id);
        return response()->json($vlog); 
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
        Vlog::find($id)->delete();
      
        return response()->json(['success'=>'Vlog deleted successfully.']);
    }
}
