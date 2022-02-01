<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Company;
use App\Model\Logo;

class CompanyController extends Controller
{
    public function view(){
    	$data['countCompany'] = Company::count();
    	$data['allData'] = Company::all();
        $data['logo'] = Logo::first();
    	return view('backend.company.view-company',$data);
    }

    public function add(){
        $data['logo'] = Logo::first();
    	return view('backend.company.add-company',$data);
    }

    public function store(Request $request){
    	$data = new Company();
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('company.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['company'] = Company::find($id);
        $data['logo'] = Logo::first();
    	return view('backend.company.edit-company',$data);
    }

    public function update(Request $request,$id){
    	$data = Company::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('company.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$company = Company::find($id);
    	$company->delete();
    	return redirect()->route('company.view')->with('success','Data Deleted Successfully.');
    }
}
