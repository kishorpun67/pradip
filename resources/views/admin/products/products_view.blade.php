@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catelogues</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catelogues</li>
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
              <h3 class="card-title">Product</h3>
              <a href="{{route('admin.add.edit.product')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Product</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Product</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($results as $product)
                <?php $image_path = 'image/product_image/small/'.$product->product_image;?>
                <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->category->category_name}}</td>
                  <td>
                  @if(!empty($product->product_image) && file_exists($image_path))
                  <img src="{{asset('image/product_image/small/'.$product->product_image)}}" style=" width:80px;" alt="">
                  @else
                  <img src="{{asset('image/product_image/small/no_image.png')}}" style=" width:80px;" alt="">
                  @endif
                  </td>
                  <td>Rs.{{$product->product_price}}.00</td>
                  <td>{{$product->section->name}}</td>
                  <td>
                      @if($product->status==1)
                        <a  class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"  href="javascript:(0);">Active</a>
                      @else
                      <a class="updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}" href="javascript:(0);">Inactive</a>
                      @endif
                  </td>
                   <td>
                   <a href="" data-toggle="modal" data-target="#myModal{{$product->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.attribte', $product->id)}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.images', $product->id)}}"><img src="{{asset('frontend/fonts/add_image_icon1.jpg')}}" alt="" style="width:30px"></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.edit.product', $product->id)}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="product" rel="{{$product->id}}" style="display:inline;">
                    <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                    <div class="modal fade" id="myModal{{$product->id}}">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Product Discount: {{$product->product_discount}}</p>
                            <p>Product Code: {{$product->product_code}}</p>
                            <p>Product Color: {{$product->product_color}}</p>
                            <p>Weight: {{$product->product_weight}}</p>
                            <p>Wash Care: {{$product->wash_care}}</p>
                            <p>Pattern: {{$product->pattern}}</p>
                            <p>Sleeve: {{$product->sleeve}}</p>
                            <p>Fit: {{$product->fit}}</p>
                            <p>Occassion: {{$product->ocassion}}</p>
                            <p>Fabric: {{$product->fabric}}</p>
                            <p>Feature: {{$product->is_feature}}</p>
                            <p>Brand Name: {{$product->brand_name}}</p>
                            <p>
                              @if($product->status==1)
                               Status: Active
                              @else
                               Status: Inactive
                              @endif
                            </p>
                            <p>Created On: {{$product->created_at}}</p>
                            <p>Description: {{$product->description}}</p>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                  </div>
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
