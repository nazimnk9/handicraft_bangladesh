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
        Edit Profile
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
                    <h3>Edit Profile</h3>
                    <form action="{{route('customer.update.profile')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label for="name">Name</label>
                          <input type="text" name="name" value="{{$editData->name}}" class="form-control">
                          <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="email">Email</label>
                          <input type="email" name="email" value="{{$editData->email}}" class="form-control">
                          <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="mobile">Mobile No</label>
                          <input type="text" name="mobile" value="{{$editData->mobile}}" class="form-control">
                          <font style="color: red">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="address">Address</label>
                          <input type="text" name="address" value="{{$editData->address}}" class="form-control">
                          <font style="color: red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="gender">Gender</label>
                          <select name="gender" id="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" {{($editData->gender=="Male")?"selected":""}}>Male</option>
                            <option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="image">Image</label>
                          <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <div class="form-group col-md-2">
                          <img id="showImage" src="{{(!empty($editData->image))?url('public/upload/user_images/'.$editData->image):url('public/upload/no_image.png')}}" style="width: 150px; height: 160px; border: 1px solid #000;">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 30px; padding-left:30px;">
                          <input type="submit" value="Profile Update" class="btn btn-primary">
                        </div>
                      </div>
                    </form>
				</div>
			</div>
		</div>

@endsection
