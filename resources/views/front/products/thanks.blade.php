@extends('layouts.front_layout.front_layout')
@section('content')
@include('layouts.front_layout.front1_header')

<section id="do_action">
	<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
		<div class="heading text-center">
			<h3>Your COD has been been placed.</h3>
			<p>Yor order number is {{Session::get('order_id')}}  and  total payable about is Rs.{{Session::get('grand_total')}}.00 </p>
		</div>
	</div>
</section>
@endsection
<?php
    Session::forget('grand_total');
    Session::forget('order_id');
 ?>
