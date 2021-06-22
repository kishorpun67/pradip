@extends('layouts.front_layout.front_layout')
@section('content')
@include('layouts.front_layout.front1_header')

     <!-- Begin Hiraola's Page Content Area -->

     <main class="page-content">
        <!-- Begin Hiraola's Account Page Area -->
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="myaccount-orders">
                            <h4 class="small-title">MY ORDERS DETAILS</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr style="text-align:center;">
                                          <th>Product Code</th>
                                          <th>Product Name</th>
                                          <th>Product Size</th>
                                          <th>Product Color</th>
                                          <th>Product Price</th>
                                          <th>Product Quantity</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($orderDetails->orders as $order)
                                        <tr>
                                            <td>{{$order->product_code}}</td>
                                            <td>{{$order->product_name}}</td>
                                            <td>{{$order->product_size}}</td>
                                            <td>{{$order->product_color}}</td>
                                            <td>Rs.{{$order->product_price}}.00</td>
                                            <td>{{$order->product_qty}}</td>
                                        </tr>
                                      @endforeach
                                    </table>
                                </table>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Account Page Area End Here -->
    </main>
    <!-- Hirao
@endsection
