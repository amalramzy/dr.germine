<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Child;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class ChildButtonController extends Controller
{
    public function uploadeChildTest(Request $request,$id){
        $child = Child::findOrFail($id);
        if ($request->hasFile('child_tests')){
            $child->addMedia($request->file('child_tests'))->toMediaCollection('child_tests');
        }
        return redirect()->back();

    }



    public function deleteimg(Child $child,$img){
        Media::find($img)->delete();
        return redirect()->back();

    }

    public function editProfile(Request $request,$id){
        // dd($request);
        $child = Child::findOrFail($id);
        $child->update($request->all());

        if ($request->hasFile('image')){
            $child->clearMediaCollection('image');
            $child->addMedia($request->file('image'))->toMediaCollection('image');
        }
        return redirect()->back();

    }

}
