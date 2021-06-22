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
                                <h4 class="small-title">MY ORDERS</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Ordered Products</th>
                                                <th>Payment Method</th>
                                                <th>Grand Total</th>
                                                <th>Created on</th>
                                                <th></th>
                                            </tr>
                                            @foreach($orderDetails as $order)
                                            <tr>
                                              <td>{{$order->id}}</td>
                                              <td>
                                                @foreach($order->orders as $orders)
                                                  {{$orders->product_code}} <br>
                                                @endforeach
                                              </td>
                                              <td>{{$order->payment_method}}</td>
                                              <td>{{$order->grand_total}}</td>
                                              <td>{{$order->created_at}}</td>
                                              @foreach($order->orders as $orders)
                                              <td><a href="{{route('order' ,$order->id)}}" class="hiraola-btn hiraola-btn_dark hiraola-btn_sm"><span>View</span></a>
                                              @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hiraola's Account Page Area End Here -->
        </main>
        <!-- Hiraola's Page Content Area End Here -->
@endsection
