<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Model\Company;
use App\Model\Logo;


class ProfileController extends Controller
{
    public function view(){
    	$id = Auth::user()->id;
    	$data['user'] = User::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.view-profile',$data);
    }

    public function edit(){
    	$id = Auth::user()->id;
    	$data['editData'] = User::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.edit-profile',$data);
    }

    public function update(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required',
    		'mobile'=>'required',
    		'address'=>'required'
    	]);
    	$data = User::find(Auth::user()->id);
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->mobile = $request->mobile;
    	$data->address = $request->address;
    	$data->gender = $request->gender;
    	if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/user_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/user_images'),$filename);
    		$data['image'] = $filename;
    	}
    	$data->save();
    	return redirect()->route('profiles.view')->with('success','Profile Updated Successfully.');
    }

    public function passwordView(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.edit-password',$data);
    }

    public function passwordUpdate(Request $request){
    	if (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_password])) {
    		$user = User::find(Auth::user()->id);
    		$user->password = bcrypt($request->new_password);
    		$user->save();
    		return redirect()->route('profiles.view')->with('success','Password changed Successfully.');
    	}else{
    		return redirect()->back()->with('error','Sorry! your current password does not match.');
    	}
    }
}
