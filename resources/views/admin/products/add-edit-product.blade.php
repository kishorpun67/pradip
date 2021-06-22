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
            <form  @if(empty($products)) action="{{route('admin.add.edit.product')}}" @else action="{{route('admin.add.edit.product', $products->id)}}" @endif method="post" enctype="multipart/form-data">
            @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category_id" id="category_id"  class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        @forelse($getSection as $section)
                                            <optgroup label="{{ $section->name}}"></optgroup>
                                            @foreach($section['categories'] as $category)
                                                <option value="{{$category->id}}"
                                                    @if(!empty(@old('category_id')) && $category->id==@old('category_id'))
                                                    selected=""
                                                    @elseif(!empty($products->category_id) && $products->category_id==$category['id'])
                                                     selected=""
                                                    @endif
                                                    >&nbsp;&raquo;&nbsp; {{$category->category_name}}</option>
                                                @foreach($category['subcategories'] as $subCategory)
                                                    <option value="{{$subCategory->id}}"
                                                    @if(!empty(@old('category_id')) && $subCategory->id==@old('category_id'))
                                                    selected=""
                                                    @elseif(!empty($products->category_id) && $products->category_id==$subCategory['id'])
                                                     selected=""
                                                    @endif
                                                    >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp; {{$subCategory->category_name}}</option>
                                                @endforeach
                                            @endforeach
                                        @empty
                                        @endforelse
                                </select>
                                @error('category_id')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Select Brand</label>
                                <select name="brand_name" id="brand_name" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        @forelse($brands as $brand)
                                            <option value="{{$brand->name}}" @if(!empty($products->brand_name) && $products->brand_name==$brand->name) selected="" @endif>&nbsp;&raquo;&nbsp; {{$brand->name}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter Product Name"
                                @if(!empty($products->product_name))
                                value= "{{$products->product_name}}"
                                @else value="{{old('product_name')}}"
                                @endif
                                >
                                @if(!empty($products->id))
                                 <input type="hidden" class="form-control" name="product_id" id="product_id" value= "{{$products->id}}">
                                @endif
                                @error('product_name')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_discoutn">Product Price</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Price Rs."
                                @if(!empty($products->product_price))
                                value= "{{$products->product_price}}"
                                @else value="{{old('product_price')}}"
                                @endif>
                                @error('product_price')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Discount (%)</label>
                                <input type="text" name="product_discount" id="productd_discount" class="form-control"  placeholder="Enter Product Discount"
                                @if(!empty($products->product_discount))
                                value= "{{$products->product_discount}}"
                                @else value="{{old('product_discount')}}"
                                @endif>
                            </div>
                            <div class="form-group">
                                <label for="category_discoutn">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Price Code"
                                @if(!empty($products->product_code))
                                value= "{{$products->product_code}}"
                                @else value="{{old('product_code')}}"
                                @endif>
                                @error('product_code')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Weight</label>
                                <input type="text" name="product_weight" id="product_weight" class="form-control"  placeholder="Enter Product Weight"
                                @if(!empty($products->product_weight))
                                value= "{{$products->product_weight}}"
                                @else value="{{old('product_weight')}}"
                                @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Color</label>
                                <input type="text" name="product_color" id="product_color" class="form-control"  placeholder="Enter Product Color"
                                @if(!empty($products->product_color))
                                value= "{{$products->product_color}}"
                                @else value="{{old('product_color')}}"
                                @endif>
                                @error('product_color')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Color</label>
                                <input type="text" name="product_color1" id="product_color1" class="form-control"  placeholder="Enter Product Color"
                                @if(!empty($products->product_color1))
                                value= "{{$products->product_color1}}"
                                @else value="{{old('product_color1')}}"
                                @endif>
                                @error('product_color')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Color</label>
                                <input type="text" name="product_color2" id="product_color2" class="form-control"  placeholder="Enter Product Color"
                                @if(!empty($products->product_color2))
                                value= "{{$products->product_color2}}"
                                @else value="{{old('product_color2')}}"
                                @endif>
                                @error('product_color')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Color</label>
                                <input type="text" name="product_color3" id="product_color3" class="form-control"  placeholder="Enter Product Color"
                                @if(!empty($products->product_color3))
                                value= "{{$products->product_color3}}"
                                @else value="{{old('product_color3')}}"
                                @endif>
                                @error('product_color')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Prouduct Color</label>
                                <input type="text" name="product_color4" id="product_color4" class="form-control"  placeholder="Enter Product Color"
                                @if(!empty($products->product_color4))
                                value= "{{$products->product_color4}}"
                                @else value="{{old('product_color4')}}"
                                @endif>
                                @error('product_color')
                                <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Product Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="product_image" name="product_image">
                                        <label class="custom-file-label" for="product_image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                                Recommanded Image Size:Width:1040px, Height:1200px
                                @if(!empty($products->product_image))
                                    <div >
                                        <img style=" width:100px; margin-top:5px;" src="{{asset('image/product_image/small/'.$products->product_image)}}" alt="">
                                        &nbsp;@if(!empty($products->product_image))
                                            <a href="javascript:void(0)" record="product-image" rel="{{$products->id}}" class="delete_form">Delete Image</a>
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
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Select Fabric</label>
                                <select name="fabric" id="fabric" class="form-control select2" style="width: 100%;">
                                        <option selected="selected" >Select</option>
                                        @forelse($fabric as $fab)
                                            <option value="{{$fab}}" @if(!empty($products->fabric) && $products->fabric==$fab ) selected="" @endif>&nbsp;&raquo;&nbsp; {{$fab}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Seleeve</label>
                                    <select name="sleeve" id="sleeve" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Select</option>
                                            @forelse($sleeve as $sel)
                                                <option value="{{$sel}}"  @if(!empty($products->sleeve) && $products->sleeve==$sel ) selected="" @endif>&nbsp;&raquo;&nbsp; {{$sel}}</option>
                                            @empty
                                            @endforelse
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                            <label>Select Pattern</label>
                                <select name="pattern" id="pattern" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        @forelse($pattern as $patterns)
                                            <option value="{{$patterns}}" @if(!empty($products->pattern) && $products->pattern==$patterns ) selected="" @endif>&nbsp;&raquo;&nbsp; {{$patterns}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                            <label>Select Ocassion</label>
                                <select name="occassion" id="occassion" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        @forelse($occassion as $occassions)
                                            <option value="{{$occassions}}" @if(!empty($products->ocassion) && $products->ocassion==$occassions ) selected="" @endif>&nbsp;&raquo;&nbsp; {{$occassions}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter ...">
                                @if(!empty($products->description))
                                {{$products->description}}
                                @else
                                {{old('description')}}
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Enter ..." >
                                @if(!empty($products->meta_description))
                                {{$products->meta_description}}
                                @else
                                {{old('meta_description')}}
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Wash Care</label>
                                <textarea class="form-control" rows="3" name="wash_care" id="wash_care" placeholder="Enter ..." >
                                @if(!empty($products->wash_care))
                                {{$products->wash_care}}
                                @else
                                {{old('wash_care')}}
                                @endif
                                </textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">

                            <div class="form-group">
                            <label>Select Fit</label>
                                <select name="fit" id="fit" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select</option>
                                        @forelse($fit as $fits)
                                            <option value="{{$fits}}" @if(!empty($products->fit) && $products->fit==$fits ) selected="" @endif>&nbsp;&raquo;&nbsp; {{$fits}}</option>
                                        @empty
                                        @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Meta Title</label>
                                <textarea class="form-control" rows="3" name="meta_title" id="meta_title" placeholder="Enter ...">
                                @if(!empty($products->meta_title))
                                {{$products->meta_title}}
                                @else
                                {{old('meta_title')}}
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <textarea class="form-control" rows="3" name="meta_keywords" id="meta_keywords" placeholder="Enter ..." >
                                @if(!empty($products->meta_keywords))
                                {{$products->meta_keywords}}
                                @else
                                {{old('meta_keywords')}}
                                @endif
                                </textarea>
                            </div>
                            <div class="form-group">
                            <label for="category_discoutn">Is Feature</label><br>
                                <input type="checkbox" id="is_feature"  name="is_feature" value="Yes"
                                @if(!empty($products->is_feature) && $products->is_feature =="Yes")
                                checked=""
                                @endif>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{$button}}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
