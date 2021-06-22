@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order View</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order Date </th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Order Products</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th>Payment Method</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
               @forelse($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->created_at}}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->user_email}}</td>
                  <td>
                    @foreach($order->orders as $pro)
                        {{$pro->product_code}}
                    @endforeach
                  </td>
                  <td>{{$order->grand_total}}</td>
                  <td>{{$order->status}}</td>
                  <td>{{$order->payment_method}}</td>

                   <td>
                    <a href="{{route('admin.view.order', $order->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.view.order.invoice', $order->id)}}"><i class="fas fa-file-invoice" aria-hidden="true"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="order"  rel="{{$order->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



@endsection
@section('script')
<script>
  $(function () {
    $("#categories").DataTable();

  });
</script>
@endsection
