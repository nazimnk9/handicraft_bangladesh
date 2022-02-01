<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Slider;
use App\Model\Company;
use App\Model\Logo;

class SliderController extends Controller
{
    public function view(){
    	$data['allData'] = Slider::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.slider.view-slider',$data);
    }

    public function add(){
         $data['company'] = Company::first();
         $data['logo'] = Logo::first();
    	return view('backend.slider.add-slider',$data);
    }

    public function store(Request $request){
    	$data = new Slider();
    	if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/slider_images'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->short_title = $request->short_title;
    	$data->long_title = $request->long_title;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('sliders.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	 $data['editData'] = Slider::find($id);
         $data['company'] = Company::first();
         $data['logo'] = Logo::first();
    	return view('backend.slider.edit-slider',$data);
    }

    public function update(Request $request,$id){
    	$data = Slider::find($id);
    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/slider_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/slider_images'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->short_title = $request->short_title;
    	$data->long_title = $request->long_title;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('sliders.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$slider = Slider::find($id);
    	if (file_exists('public/upload/slider_images/'.$slider->image) AND ! empty($slider->image)) {
    		unlink('public/upload/slider_images/'.$slider->image);
    	}
    	$slider->delete();
    	return redirect()->route('sliders.view')->with('success','Data Deleted Successfully.');
    }
}
