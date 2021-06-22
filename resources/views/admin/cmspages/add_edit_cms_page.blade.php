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
            <form  method="post" @if(empty($cmspage->id)) action="{{route('admin.add.edit.cms.page')}}" @else action="{{route('admin.add.edit.cms.page', $cmspage->id)}}" @endif>
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title"
                                @if(!empty($cmspage->title)) value ="{{$cmspage->title}}" @else value="{{old('title')}}" @endif
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter ...">
                                    @if(!empty($cmspage->description))
                                    {{$cmspage->description}}
                                    @else
                                    {{old('description')}}
                                    @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter ...">
                                    @if(!empty($cmspage->meta_description))
                                    {{$cmspage->meta_description}}
                                    @else
                                    {{old('meta_description')}}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url">URL</label>
                                <input type="text" class="form-control" name="url"
                                @if(!empty($cmspage->url)) value ="{{$cmspage->url}}" @else value="{{old('url')}}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="description">Meta Title</label>
                                <textarea class="form-control" name="meta_title" rows="3" placeholder="Enter ...">
                                    @if(!empty($cmspage->meta_title))
                                    {{$cmspage->meta_title}}
                                    @else
                                    {{old('meta_title')}}
                                    @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Meta Keywords</label>
                                <textarea class="form-control" name="meta_keywords" rows="3" placeholder="Enter ...">
                                    @if(!empty($cmspage->meta_keywords))
                                    {{$cmspage->meta_keywords}}
                                    @else
                                    {{old('meta_keywords')}}
                                    @endif
                                </textarea>
                            </div>
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
