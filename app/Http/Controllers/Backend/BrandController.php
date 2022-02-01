<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Model\Company;
use App\Model\Logo;
use DB;
use Auth;
use App\Http\Requests\BrandRequest;


class BrandController extends Controller
{
    public function view(){
    	//$data['countAbout'] = About::count();
    	$data['allData'] = Brand::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.brand.view-brand',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.brand.add-brand',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:brands,name'
        ]);
    	$data = new Brand();
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('brands.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = Brand::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.brand.add-brand',$data);
    }

    public function update(BrandRequest $request,$id){
    	$data = Brand::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('brands.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$brand = Brand::find($id);
    	$brand->delete();
    	return redirect()->route('brands.view')->with('success','Data Deleted Successfully.');
    }
}
