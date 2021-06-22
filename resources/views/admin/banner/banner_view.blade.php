@extends('layouts.admin_layout.admin_layout')
@section('content')
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
              <li class="breadcrumb-item active">Banner</li>
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
              <h3 class="card-title">Banner</h3>
             <!-- <a href="{{route('admin.add.edit.post')}}" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success">Add Banner</a>-->
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>ID</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>URL</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($results as $post)
                <tr class="text-center">
                  <td>{{$post->id}}</td>
                  <td>{{$post->title}}</td>
                  <td><img src="{{asset('frontend/assets/images/slider/'.$post->image)}}" style=" width:200px; heigt:100px;" alt="name"></td>
                  <td>{!!$post->description!!}</td>
                  <!--<td>
                      @if($post->status==1)
                        <a  class="updatePostStatus" id="post-{{$post->id}}" post_id="{{$post->id}}"  href="javascript:(0);">Active</a>
                      @else
                      <a class="updatePostStatus" id="post-{{$post->id}}" post_id="{{$post->id}}" href="javascript:(0);">Inactive</a>
                      @endif
                  </td>-->
                   <td>
                    <a href="{{route('admin.add.edit.post', $post->id)}}" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;</a>
                    <a href="javascript:" class="delete_form" record="post" rel="{{$post->id}}" style="display:inline;">
                      <i class="fa fa-trash fa-" aria-hidden="true" ></i>
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
