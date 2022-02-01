<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Logo;
use App\Model\Company;

class LogoController extends Controller
{
   public function view(){
   	    $data['countLogo'] = Logo::count();
    	$data['allData'] = Logo::all();
        $data['company'] = Company::first();
    	return view('backend.logo.view-logo',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::all();
    	return view('backend.logo.add-logo',$data);
    }

    public function store(Request $request){
    	$data = new Logo();
    	if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/logo_images'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('logos.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['logo'] = Logo::find($id);
        $data['company'] = Company::first();
    	return view('backend.logo.edit-logo',$data);
    }

    public function update(Request $request,$id){
    	$data = Logo::find($id);
    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/logo_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/logo_images'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('logos.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$logo = Logo::find($id);
    	if (file_exists('public/upload/logo_images/'.$logo->image) AND ! empty($logo->image)) {
    		unlink('public/upload/logo_images/'.$logo->image);
    	}
    	$logo->delete();
    	return redirect()->route('logos.view')->with('success','Data Deleted Successfully.');
    }
}
