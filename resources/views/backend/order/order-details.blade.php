@extends('backend.layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Approved Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>Order Details Info
                    <a class="btn btn-success float-right btn-sm" href="{{route('orders.approved.list')}}"><i class="fa fa-list"></i> Orders Approved List</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table class="txt-center mytable" width="100%" border="1">
                    <tr>
                        <td width="30%"><strong>Billing Info:</strong></td>
                        <td width="70%" colspan="2" style="text-align: left;">
                            <strong>Name: </strong>{{$order['shipping']['name']}} &nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Mobile no: </strong>{{$order['shipping']['mobile_no']}} <br>
                            <strong>Email: </strong>{{$order['shipping']['email']}} &nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Address: </strong>{{$order['shipping']['address']}} <br>
                            <strong>Payment: </strong>
                            {{$order['payment']['payment_method']}}
                            @if ($order['payment']['payment_method'] == 'Bkash')
                            (Transaction no : {{$order['payment']['transaction_no']}})
                            @endif &nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Order No: # {{$order->order_no}}</strong>
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
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
