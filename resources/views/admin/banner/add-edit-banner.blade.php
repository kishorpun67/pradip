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
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
            </div>
            <form  method="post" @if(empty($post->id)) action="{{route('admin.add.edit.post')}}" @else action="{{route('admin.add.edit.post', $post->id)}}" @endif enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="column">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_name">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title"
                                @if(!empty($post->title)) value ="{{$post->title}}" @else value="{{old('title')}}" @endif
                                 required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Banner Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" >
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                                @if(!empty($post['image']))
                                    <div >
                                    <img style=" width:100px; height:100px; margin-top:5px;" src="{{asset('frontend/assets/images/slider/'.$post->image)}}" alt="">
                                    &nbsp;@if(!empty($post->image))
                                        <a href="javascript:void(0)" record="post-image" rel="{{$post->id}}" class="delete_form">Delete Image</a>
                                        @else
                                        <p>No Image</p>
                                    @endif
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">URL</label>
                            <input type="text" name="description" @if(!empty($post->description)) value="{!!$post->description!!}" @else value="{{old('description')}}" @endif>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{$button}}</button>
                </div>
            </form>
    </section>
</div>

@endsection
@section('script')

@endsection
