<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Logo;
use DB;
use Auth;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function view(){
    	//$data['countAbout'] = About::count();
    	$data['allData'] = Category::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.category.view-category',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.category.add-category',$data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:categories,name'
        ]);
    	$data = new Category();
    	$data->name = $request->name;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('categories.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = Category::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.category.add-category',$data);
    }

    public function update(CategoryRequest $request,$id){
    	$data = Category::find($id);
    	$data->name = $request->name;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('categories.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$category = Category::find($id);
    	$category->delete();
    	return redirect()->route('categories.view')->with('success','Data Deleted Successfully.');
    }
}
