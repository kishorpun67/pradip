@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cms Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cms Pages</li>
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
              <h3 class="card-title">View CMS Page</h3>
             <a href="{{route('admin.add.edit.cms.page')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add CMS Page</a>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>URL </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @forelse($cmsPageDetalils as $cmspage)
                <tr>
                  <td>{{$cmspage->id}}</td>
                  <td>{{$cmspage->title}}</td>
                  <td>{{$cmspage->url}}</td>
                  <td>
                    @if($cmspage->status==1)
                      <a  class="updateCmsStatus" id="cms-{{$cmspage->id}}" cms_id="{{$cmspage->id}}"  href="javascript:(0);">Active</a>
                    @else
                      <a class="updateCmsStatus" id="cms-{{$cmspage->id}}" cms_id="{{$cmspage->id}}" href="javascript:(0);">Inactive</a>
                    @endif
                  </td>
                   <td>
                    <a href="" data-toggle="modal" data-target="#myModal{{$cmspage->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                    <a href="{{route('admin.add.edit.cms.page', $cmspage->id)}}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="cmspage"  rel="{{$cmspage->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                   <div class="modal fade" id="myModal{{$cmspage->id}}">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Title: {{$cmspage->title}}</p>
                            <p>URL: {{$cmspage->url}}</p>
                            <p>
                              @if($cmspage->status==1)
                               Status: Active
                              @else
                               Status: Inactive
                              @endif
                            </p>
                            <p>Created On: {{$cmspage->created_at}}</p>
                            <p>Description: {{$cmspage->description}}</p>
                          </div>
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </tr>
                @empty
                <p>No Data</p>
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
