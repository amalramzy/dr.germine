<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\DataTables\AdminsDataTable;

class AdminController extends Controller
{
    public function index(AdminsDataTable $dataTable)
    {
        return $dataTable->render('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin=new Admin($request->all());
        $admin->password= Hash::make($request->password);
        
        $admin->save();
        notify()->success('Admin has been Created Succesfuly');
        return redirect(route('admins.index'));
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
        $admin = Admin::findOrFail($id);
        return view('admin.edit',compact(['admin']));
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
        $admin = Admin::findOrFail($id);
        $admin->update($request->except('password'));
        if($request->password){
            $admin->password= Hash::make($request->password);
            $admin->save();
        }
        // notify()->success('Admin has been Updated Succesfuly');
        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        notify()->success('Admin has been Deleted Succesfuly');
        return redirect()->route('admins.index'); 
    }

    public function upload($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.upload',compact(['admin']));
    }

    public function UploadImage(Request $request,$id)
    {
        $admin = Admin::findOrFail($id);
          if ($request->hasFile('image')){
            $admin->clearMediaCollection('image');
            $admin->addMedia($request->file('image'))->toMediaCollection('image');
        }
        notify()->success('upload Image Succesfuly');
        return redirect(route('admins.index'));
    }


}
