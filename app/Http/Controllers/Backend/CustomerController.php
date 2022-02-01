<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Company;
use App\Model\Logo;
use App\User;

class CustomerController extends Controller
{
    public function view(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        $data['allData'] = User::where('usertype','customer')->where('status','1')->get();
        return view('backend.customer.view-customer',$data);
    }

    public function draftView(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        $data['allData'] = User::where('usertype','customer')->where('status','0')->get();
        return view('backend.customer.draft-customer',$data);
    }

    public function delete(Request $request){
        $customer = User::find($request->id);
        if (file_exists('public/upload/user_images/'.$customer->image) AND ! empty($customer->image)) {
    		unlink('public/upload/user_images/'.$customer->image);
    	}
        $customer->delete();
        return redirect()->route('customers.draft.view')->with('success','Data Deleted Successfully.');
    }
}
