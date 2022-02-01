<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shipping;
use App\Model\Payment;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Logo;
use App\Model\Company;

class OrderController extends Controller
{
    public function pendingList(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        $data['orders'] = Order::where('status','0')->get();
        return view('backend.order.pending-list',$data);
    }

    public function approvedList(){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        $data['orders'] = Order::where('status','1')->get();
        return view('backend.order.approved-list',$data);
    }

    public function details($id){
        $data['company'] = Company::first();
        $data['logo'] = Logo::first();
        $data['order'] = Order::find($id);
        return view('backend.order.order-details',$data);
    }

    public function approve(Request $request){
        $data['order'] = Order::find($request->id);
        $data['order']->status = '1';
        $data['order']->save();
        return redirect()->route('orders.approved.list')->with('success','Data Approved Successfully.');
    }
}
