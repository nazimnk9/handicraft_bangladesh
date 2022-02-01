<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Contact;
use App\Model\Communicate;
use App\Model\Company;
use App\Model\Logo;

class ContactController extends Controller
{
    public function view(){
    	$data['countContact'] = Contact::count();
    	$data['allData'] = Contact::all();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.contact.view-contact',$data);
    }

    public function add(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.contact.add-contact',$data);
    }

    public function store(Request $request){
    	$data = new Contact();
    	$data->address = $request->address;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->facebook = $request->facebook;
    	$data->twitter = $request->twitter;
    	$data->youtube = $request->youtube;
    	$data->google_plus = $request->google_plus;
        $data->office_location = $request->office_location;
    	$data->created_by = Auth::user()->id;
    	$data->created_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('contacts.view')->with('success','Data Inserted Successfully.');
    }

    public function edit($id){
    	$data['editData'] = Contact::find($id);
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
    	return view('backend.contact.edit-contact',$data);
    }

    public function update(Request $request,$id){
    	$data = Contact::find($id);
    	$data->address = $request->address;
    	$data->mobile_no = $request->mobile_no;
    	$data->email = $request->email;
    	$data->facebook = $request->facebook;
    	$data->twitter = $request->twitter;
    	$data->youtube = $request->youtube;
    	$data->google_plus = $request->google_plus;
        $data->office_location = $request->office_location;
    	$data->updated_by = Auth::user()->id;
    	$data->updated_by_name = Auth::user()->name;
    	$data->save();
    	return redirect()->route('contacts.view')->with('success','Data Updated Successfully.');
    }

    public function delete($id){
    	$contact = Contact::find($id);
    	$contact->delete();
    	return redirect()->route('contacts.view')->with('success','Data Deleted Successfully.');
    }

    public function viewCommunicate(){
        $data['allData'] = Communicate::orderBy('id','desc')->get();
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        return view('backend.contact.view-communicate',$data);
    }

    public function deleteCommunicate($id){
        $communicate = Communicate::find($id);
        $communicate->delete();
        return redirect()->route('contacts.communicate')->with('success','Data Deleted Successfully.');
    }
}
