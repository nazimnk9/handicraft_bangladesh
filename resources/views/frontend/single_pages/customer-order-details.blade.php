@extends('frontend.layouts.master')
@section('content')
<style>
    .prof li{
        background: #1781BF;
        padding: 7px;
        margin: 3px;
        border-radius: 15px;
    }
    .prof li a{
        font-size: 13px;
        color: #fff;
        padding-left: 15px;
    }
    .mytable tr td{
        padding: 10px;
    }
</style>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('../public/frontend/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Order Details
    </h2>
</section>

		<div class="container">
			<div class="row" style="padding: 15px 0px 15px 0px;">
				<div class="col-md-2">
                    <ul class="prof">
                        <li><a href="{{route('dashboard')}}">My Profile</a></li>
                        <li><a href="{{route('customer.password.change')}}">Password Change</a></li>
                        <li><a href="{{route('customer.order.list')}}">My Orders</a></li>
                    </ul>
				</div>
                <div class="col-md-10">
                    <table class="txt-center mytable" width="100%" border="1">
                        <tr>
                            <td  width="30%">
                                <img style="width: 100px; height:100px;" src="{{url('public/upload/logo_images/'.$logo->image)}}" alt="IMG-LOGO">
                            </td>
                            <td width="40%">
                                <h4><strong><span>{{$company->name}}</span><br></strong></h4>
                                <span><strong>Mobile no:</strong>{{$contact->mobile_no}}</span><br>
                                <span><strong>Email:</strong>{{$contact->email}}</span><br>
                                <span><strong>Address:</strong>{{$contact->address}}</span>
                            </td>
                            <td width="30%">
                                <strong>Order No: # {{$order->order_no}}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Billing Info:</strong></td>
                            <td colspan="2" style="text-align: left;">
                                <strong>Name: </strong>{{$order['shipping']['name']}} &nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>Mobile no: </strong>{{$order['shipping']['mobile_no']}} <br>
                                <strong>Email: </strong>{{$order['shipping']['email']}} &nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>Address: </strong>{{$order['shipping']['address']}} <br>
                                <strong>Payment: </strong>
                                {{$order['payment']['payment_method']}}
                                @if ($order['payment']['payment_method'] == 'Bkash')
                                (Transaction no : {{$order['payment']['transaction_no']}})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Order Details</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Product Name & Image</strong></td>
                            <td><strong>Color and Size</strong></td>
                            <td><strong>Quantity and Price</strong></td>
                        </tr>
                        @foreach ($order['order_details'] as $details)
                        <tr>
                            <td>
                                <img src="{{url('public/upload/product_images/'.$details['product']['image'])}}" style="width: 50px; height: 55px;"> &nbsp; {{$details['product']['name']}}
                            </td>
                            <td>
                                {{$details['color']['name']}} & {{$details['size']['name']}}
                            </td>
                            <td>
                                @php
                                $sub_total = $details->quantity*$details['product']['price'];
                                @endphp
                                {{$details->quantity}} x
                                {{$details['product']['price']}} = {{$sub_total}}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right;"><strong>Grand Total:</strong></td>
                            <td><strong>{{$order->order_total}}</strong></td>
                        </tr>
                    </table>
				</div>
			</div>
		</div>

@endsection
