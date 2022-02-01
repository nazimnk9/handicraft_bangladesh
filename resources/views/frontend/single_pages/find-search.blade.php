@extends('frontend.layouts.master')
@section('content')
<!-- Banner Section -->
	<section class="banner_part">
		<img src="{{asset('public/upload/news_images/'.$news->image)}}" style="width: 100%">
	</section>

	<!-- About us Section -->
	<section class="about_us">
		<div class="container">
			<div class="row">
			<div class="col-md-4">
				<h3 style="padding-top: 15px;padding-bottom: 5px;border-bottom: 1px solid #000000; width: 70%;">News and Events</h3>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
				<img src="{{asset('public/upload/news_images/'.$news->image)}}" width="344px" height="250px" style="border: 1px solid #ddd;padding: 5px;background: #EFEE03;border-radius: 30px;float: left;margin-right: 10px;">
				<strong>Date: {{date('d-m-Y',strtotime($news->date))}}</strong><br><br>
				<strong>{{$news->short_title}}</strong><br><br>
				<p style="text-align: justify;">{{$news->long_title}}</p>
			</div>
			</div>
		</div>
	</section>

@endsection