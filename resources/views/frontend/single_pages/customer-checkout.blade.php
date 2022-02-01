@extends('frontend.layouts.master')
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/frontend/images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Customer Billing Information
    </h2>
</section>

	<!-- About us Section -->
	<section class="about_us">
		<div class="container">
			<div class="row" style="padding: 20px 0px 20px 0px;">
				<div class="col-md-12">
                    <form action="{{route('customer.checkout.store')}}" method="post" enctype="multipart/form-data" id="checkoutForm">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                            <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                            <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="mobile">Mobile No</label>
                            <input type="text" name="mobile_no" class="form-control">
                            <font style="color: red">{{($errors->has('mobile_no'))?($errors->first('mobile_no')):''}}</font>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control">
                            <font style="color: red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                          </div>
                          <div class="form-group col-md-4" style="padding-top: 30px;">
                            <input type="submit" value="Submit" class="btn btn-primary">
                          </div>
                        </div>
                      </form>
				</div>
			</div>
		</div>
	</section>

    <script type="text/javascript">
        $(document).ready(function () {
          $('#checkoutForm').validate({
            rules: {
              name: {
                required: true,
              },
              mobile_no: {
                required: true,
              },
              address: {
                required: true,
              }
            },
            messages: {
              name: {
                required: "Please enter your full name",
              },
              mobile_no: {
                required: "Please enter your mobile number",
              },
              address: {
                required: "Please enter your address",
              }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
              $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
              $(element).removeClass('is-invalid');
            }
          });
        });
      </script>

@endsection
