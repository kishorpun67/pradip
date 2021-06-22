@extends('layouts.admin_layout.admin_layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Coupons</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cupons</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


        <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}}</h3>
                    </div>
                    <!-- /.card-header -->
                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- form start -->
                    <form role="form"
                      @if(empty($coupon->id)) action="{{route('admin.add.edit.coupon')}}"
                      @else
                        action="{{route('admin.add.edit.coupon',$coupon->id)}}"
                        @endif method="post"  name="add_coupons" id="add_coupons">
                      @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="coupons">Counpon Code</label>
                            <input class="form-control" name="coupon_code" id="coupon_code"
                            @if(!empty($coupon->coupon_code))
                            value="{{$coupon->coupon_code}}"
                            @else
                            value="{{old('coupon_code')}}"
                            @endif minlength="5" maxlength="15" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount"
                            @if(!empty($coupon->amount))
                            value="{{$coupon->amount}}"
                            @else
                            value="{{old('amount')}}"
                            @endif
                            class="form-control" id="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="amountType">Amount Type</label>
                            <select name="amount_type" id="amount_type" class="form-control select2">
                            <option value="percentage"
                            @if(!empty($coupon->amount_time) && $coupon->amount_time=="percentage")
                             selected
                            @endif
                            >Percentage</option>
                            <option value="fixed"
                            @if(!empty($coupon->amount_time) && $coupon->amount_time=="fixed")
                             selected
                            @endif
                            >Fixed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="expiryDate">Expiry Date</label>
                            <input type="date" id="expiry_date"
                            @if(!empty($coupon->expiry_date))
                            value="{{$coupon->expiry_date}}"
                            @else
                            value="{{old('expiry_date')}}"
                            @endif
                             name="expiry_date" class="form-control" required>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{$button}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
