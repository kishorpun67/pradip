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
    @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('error_message') }}
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
          <h3 class="card-title">{{ $title}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
          </div>
        </div>
        <form
        @if(!empty($categorydata['id'])) action="{{route('admin.add.edit.category',$categorydata['id'])}}" @else action="{{route('admin.add.edit.category')}}" @endif
        method="post" enctype="multipart/form-data">
        @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name"
                  @if(!empty($categorydata['category_name']))
                  value= "{{$categorydata['category_name']}}"
                  @else value="{{old('category_name')}}"
                  @endif>
                </div>
                <div id="appendCategoriesLevel">
                  @include('admin.categories.append_categoreis_level')
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Section</label>
                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select</option>
                    @forelse($getSection as $section)
                    <option value="{{$section->id}}"
                      @if(!empty($categorydata['section_id']) && $categorydata['section_id']==$section->id)
                      selected
                      @endif
                      >{{$section->name}}
                    </option>
                      @empty
                      <p>No Data</p>
                    @endforelse
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Category Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="category_image" name="category_image">
                      <label class="custom-file-label" for="category_image">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                    </div>

                  </div>
                    @if(!empty($categorydata['category_image']))
                        <div >
                          <img style=" width:100px; margin-top:5px;" src="{{asset('image/category_image/'.$categorydata['category_image'])}}" alt="">
                          &nbsp;@if(!empty($categorydata['category_image']))
                            <a href="javascript:void(0)" record="category-image" rel="{{$categorydata['id']}}" class="delete_form">Delete Image</a>
                            @else
                            <p>No Image</p>
                          @endif
                        </div>
                      @else
                    @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label for="category_discoutn">Category Discount</label>
                  <input type="text" class="form-control" id="category_discout" name="category_discount" placeholder="Enter Category Discount"
                  @if(!empty($categorydata['category_discount']))
                  value= "{{$categorydata['category_discount']}}"
                  @else value="{{old('ccategory_discount')}}"
                  @endif>
                </div>
                <div class="form-group">
                  <label>Category Description</label>
                  <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter ...">
                    @if(!empty($categorydata['description']))
                    {{$categorydata['description']}}
                    @else
                    {{old('description')}}
                    @endif
                  </textarea>
                </div>
                <div class="form-group">
                  <label>Meta Description</label>
                  <textarea class="form-control" name="meta_description" rows="3" placeholder="Enter ...">
                    @if(!empty($categorydata['meta_description']))
                    {{$categorydata['meta_description']}}
                    @else
                    {{old('meta_description')}}
                    @endif
                  </textarea>
                </div>
              </div>
              <div class="col-12 col-sm-6" style="padding-right:20px;  ">
                <div class="form-group">
                    <label for="exampleInputEmail1">Category URL</label>
                    <input type="text" name="url" id="url" class="form-control" id="exampleInputEmail1" placeholder="Enter URL"
                    @if(!empty($categorydata['url']))
                     value= "{{$categorydata['url']}}"
                     @else value="{{old('url')}}"
                     @endif>
                </div>
                <div class="form-group">
                  <label>Meta Title</label>
                  <textarea class="form-control" rows="3" name="meta_title" id="meta_title" placeholder="Enter ...">
                      @if(!empty($categorydata['meta_title']))
                        {{$categorydata['meta_title']}}
                      @else
                        {{old('meta_title')}}
                      @endif
                    </textarea>
                </div>
                <div class="form-group">
                  <label>Meta Keywords</label>
                    <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter ...">
                      @if(!empty($categorydata['meta_keywords']))
                        {{$categorydata['meta_keywords']}}
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
      </div>
    </div>
  </section>
</div>
@endsection

