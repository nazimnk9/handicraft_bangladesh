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
</style>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/frontend/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Password Change
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
                    <h3>Password Change</h3>
                    <form method="post" action="{{route('customer.password.update')}}" id="myForm">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control">
                            <font style="color: red">{{($errors->has('current_password'))?($errors->first('current_password')):''}}</font>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control">
                            <font style="color: red">{{($errors->has('new_password'))?($errors->first('new_password')):''}}</font>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="again_new_password">Again New Password</label>
                            <input type="password" name="again_new_password" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <input type="submit" value="Password Update" class="btn btn-primary">
                          </div>
                        </div>
                      </form>
				</div>
			</div>
		</div>

@endsection
