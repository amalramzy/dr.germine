<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
Use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Blog::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit editBlog"><i class="mdi mdi-square-edit-outline"></i></a>';
                          
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="delete deleteBlog"><i class="mdi mdi-delete"></i></a>';
                                
                           return $btn;
                    })
                    ->addColumn('title',function($row){
                        
                        $title = $row->title;
                        $blogShow = '<a href="'.route('blog.show',[$row->id]).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="show showUser">'.$title.'</a>';
                        return $blogShow;
                        })
                    ->addColumn('content',function($row){
                        
                        $content = $row->content;
                            return $content;
                        })
                    ->rawColumns(['action','title','content'])
                    ->make(true);
        }
        
        return view('admin.blog.index');
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
        $blog = Blog::updateOrCreate([
            'id' => $request->blog_id
        ],
        [
            'title' => ['en'=>$request->title_en,'ar'=>$request->title_ar],
            'content' => ['en'=>$request->content_en,'ar'=>$request->content_ar],
        ],
      
    );        
    if($blog){
        if ($request->hasFile('image')){
            $blog->clearMediaCollection('image');
            $blog->addMedia($request->file('image'))->toMediaCollection('image');
        } 
    }else{
        if ($request->file('image')){
            $blog->addMedia($request->file('image'))->toMediaCollection('image');
           
        }
    }
           
       return response()->json(['success'=>'Blog saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.show',compact(['blog'])); 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return response()->json($blog); 
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
        Blog::find($id)->delete();
      
        return response()->json(['success'=>'Blog deleted successfully.']);
    }
}
