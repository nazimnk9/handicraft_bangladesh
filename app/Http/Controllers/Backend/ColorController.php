<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Color;
use App\Model\Company;
use App\Model\Logo;
use DB;
use Auth;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
{
    public function view(){
    	//$data['countAbout'] = About::count();
    	$data['allData'] = Color::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.color.view-color',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.color.add-color',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:colors,name'
        ]);
    	$data = new Color();
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('colors.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = Color::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.color.add-color',$data);
    }

    public function update(ColorRequest $request,$id){
    	$data = Color::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('colors.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$color = Color::find($id);
    	$color->delete();
    	return redirect()->route('colors.view')->with('success','Data Deleted Successfully.');
    }
}
