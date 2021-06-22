@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catalogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catalogues</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Add Product Attributes</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
            </div>
            <form method="post" action="{{route('admin.add.images', $productDetails->id)}}"  enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_name">Product Name:</label>&nbsp;{{$productDetails->product_name}}
                      </div>
                      <div class="form-group">
                        <label for="product_color">Product Color:</label>&nbsp;{{$productDetails->product_color}}
                      </div>
                      <div class="form-group">
                        <label for="product_code">Prouduct Code:</label>&nbsp;{{$productDetails->product_code}}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <img style=" width:100px; margin-top:5px;" src="{{asset('image/product_image/small/'.$productDetails->product_image)}}" alt="">
                        <label for=""></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                        <input type="hidden" id="product_id" name="product_id" value="{{$productDetails->id}}" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
        <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Product Images</h3>
            </div>
            <div class="card-body">
            <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image ID</th>
                  <th>Product ID</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($productDetails['images'] as $attribute)
                    <tr class="text-center">
                      <td>{{$attribute->id}}</td>
                      <td>{{$attribute->product_id}}</td>
                      <td><img src="{{asset('image/product_image/small/'.$attribute->image)}}" style=" width:80px;" alt=""></td>
                      <td>
                        @if($attribute->status==1)
                        <a  class="updateProductImageStatus" id="productImage-{{$attribute->id}}" productImg_id="{{$attribute->id}}"  href="javascript:(0);">Active&nbsp;&nbsp;</a>
                        @else
                        <a class="updateProductImageStatus" id="productImage-{{$attribute->id}}" productImg_id="{{$attribute->id}}" href="javascript:(0);">Inactive&nbsp;&nbsp;</a>
                        @endif
                        <a href="javascript:" class="delete_form" record="image" rel="{{$attribute->id}}" style="display:inline;">
                        <i class="fa fa-trash" aria-hidden="true" ></i></a>
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
