@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Service</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Service</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
      @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Billing Details</h3>
                </div>

                <div class="card-body">
                    <table id="categories" class="table table-hover">
                        <tbody>
                        <tr>
                            <td>Name </td>
                            <td>{{$userDetails->name}}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{$userDetails->address}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$userDetails->mobile}}</td>
                        </tr>
                        <td>City</td>
                            <td>{{$userDetails->city}}</td>
                        </tr>
                        <td>State</td>
                            <td>{{$userDetails->state}}</td>
                        </tr>
                        <td>Country</td>
                            <td>{{$userDetails->country}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Shipping Details</h3>
                </div>

                <div class="card-body">
                    <table id="categories" class="table table-hover">
                        <tbody>
                        <tr>
                            <td>Name </td>
                            <td>{{$orderDetails->name}}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{$orderDetails->address}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$orderDetails->mobile}}</td>
                        </tr>
                        <td>City</td>
                            <td>{{$orderDetails->city}}</td>
                        </tr>
                        <td>State</td>
                            <td>{{$orderDetails->stat}}</td>
                        </tr>
                        <td>Country</td>
                            <td>{{$orderDetails->country}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.update.order.status',$orderDetails->id)}}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" style="width:200px;">
                                    <label for="status">Select Status</label>
                                    <select name="order_status" id="order_status" class="form-control select2">
                                    <option value="New"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="New")
                                    selected
                                    @endif
                                    >New</option>
                                    <option value="Pending"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Pending")
                                    selected
                                    @endif
                                    >Pending</option>
                                    <option value="Cancelling"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Cancelling")
                                    selected
                                    @endif
                                    >Cancelling</option>
                                    <option value="Delivery"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Delivery")
                                    selected
                                    @endif
                                    >Delivery</option>
                                    <option value="Confirmed"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Confirmed")
                                    selected
                                    @endif
                                    >Confirmed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="categories" class="table table-bordered table-striped  text-center">
          <thead>
          <tr>
            <th>ID</th>
            <th>Porduct Name</th>
            <th>Color </th>
            <th>Size</th>
            <th>Code</th>
            <th>Quantity</th>
          </tr>
          </thead>
          <tbody>
         @forelse($orderDetails['orders'] as $cmspage)
          <tr>
            <td>{{$cmspage->id}}</td>
            <td>{{$cmspage->product_name}}</td>
            <td>{{$cmspage->product_color}}</td>
            <td>{{$cmspage->product_size}}</td>
            <td>{{$cmspage->product_code}}</td>
            <td>{{$cmspage->product_qty}}</td>
          </tr>
          @empty
          <p>No Data</p>
          @endforelse
          </tbody>
        </table>
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
