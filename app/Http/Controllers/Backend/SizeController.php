<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Size;
use App\Model\Company;
use App\Model\Logo;
use DB;
use Auth;
use App\Http\Requests\SizeRequest;


class SizeController extends Controller
{
    public function view(){
    	//$data['countAbout'] = About::count();
    	$data['allData'] = Size::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.size.view-size',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.size.add-size',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:sizes,name'
        ]);
    	$data = new Size();
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('sizes.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = Size::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.size.add-size',$data);
    }

    public function update(SizeRequest $request,$id){
    	$data = Size::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('sizes.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$size = Size::find($id);
    	$size->delete();
    	return redirect()->route('sizes.view')->with('success','Data Deleted Successfully.');
    }
}
