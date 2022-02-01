<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\About;
use App\Model\Company;
use App\Model\Logo;

class AboutController extends Controller
{
    public function view(){
    	$data['countAbout'] = About::count();
    	$data['allData'] = About::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.about.view-about',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.about.add-about',$data);
    }

    public function store(Request $request){
    	$data = new About();
    	$data->description = $request->description;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('abouts.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = About::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.about.edit-about',$data);
    }

    public function update(Request $request,$id){
    	$data = About::find($id);
    	$data->description = $request->description;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('abouts.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$about = About::find($id);
    	$about->delete();
    	return redirect()->route('abouts.view')->with('success','Data Deleted Successfully.');
    }
}
