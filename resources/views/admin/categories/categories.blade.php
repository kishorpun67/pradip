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
              <h3 class="card-title">Category</h3>
             <a href="{{route('admin.add.edit.category')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Category</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Parent Category</th>
                  <th>Image</th>
                  <th>Section</th>
                  <th>URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($results as $data)
               <?php $image_path = 'image/category_image/'.$data->category_image;?>
                @if(!isset($data->parentcategory->category_name))
                  <?php $parent_category = "Root"; ?>
                @else
                  <?php $parent_category = $data->parentcategory->category_name; ?>
                @endif
                <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->category_name}}</td>
                  <td>{{$parent_category}}</td>
                  <td>
                    @if(!empty($data->category_image) && file_exists($image_path))
                      <img src="{{asset('image/category_image/'.$data->category_image)}}" style=" width:80px;" alt="">
                    @else
                      <img src="{{asset('image/category_image/no_image.png')}}" style=" width:80px;" alt="">
                    @endif
                  </td>
                  <td>{{$data->section->name}}</td>
                  <td>{{$data->url}}</td>
                  <td>
                      @if($data->status==1)
                        <a  class="updateCategoryStatus" id="category-{{$data->id}}" category_id="{{$data->id}}"  href="javascript:(0);">Active</a>
                      @else
                      <a class="updateCategoryStatus" id="category-{{$data->id}}" category_id="{{$data->id}}" href="javascript:(0);">Inactive</a>
                      @endif
                  </td>

                   <td>

                    <a href="{{route('admin.add.edit.category', $data->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="category"  rel="{{$data->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                @empty
                <p>No Data</p>
                @endforelse

                <!-- <tr>
                  <td rowspan=8> -->
                  <!-- </td>
                </tr> -->
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
