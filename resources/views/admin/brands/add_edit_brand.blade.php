@extends('layouts.admin_layout.admin_layout')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catalogues</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catalogues</li>
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
                    <form role="form" method="POST"  @if(empty($brand->id)) action="{{route('admin.add.edit.brand')}}" @else action="{{route('admin.add.edit.brand', $brand->id)}}" @endif enctype="multipart/form-data">
                       @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input class="form-control" name="brand" placeholder="Enter Brand Name"
                                @if(!empty($brand->name)) value ="{{$brand->name}}" @else value="{{old('name')}}" @endif
                                required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{$button}}</button>
                        </div>
                    </form>
             </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

@endsection
