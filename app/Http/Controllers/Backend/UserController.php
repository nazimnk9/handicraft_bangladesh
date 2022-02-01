<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model\Company;
use App\Model\Logo;

class UserController extends Controller
{
    public function view(){
    	$data['allData'] = User::where('usertype','admin')->where('status','1')->get();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.view-user',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.add-user',$data);
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required|unique:users,email',
    		'password'=>'required'
    	]);
    	$data = new User();
    	$data->usertype = 'admin';
        $data->role = $request->role;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->password = bcrypt($request->password);
    	$data->save();
    	return redirect()->route('users.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = User::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.user.edit-user',$data);
    }

    public function update(Request $request,$id){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required|unique:users,email'
    	]);
    	$data = User::find($id);
    	$data->role = $request->role;
    	$data->name = $request->name;
    	$data->email = $request->email;
    	$data->save();
    	return redirect()->route('users.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$user = User::find($id);
    	if (file_exists('public/upload/user_images/'.$user->image) AND ! empty($user->image)) {
    		unlink('public/upload/user_images/'.$user->image);
    	}
    	$user->delete();
    	return redirect()->route('users.view')->with('success','Data Deleted Successfully.');
    }
}
