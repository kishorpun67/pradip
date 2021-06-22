@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Contact</h3>
                </div>

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
                <form role="form" method="POST" action="{{route('admin.contact',$contact->id)}}">
                  @csrf
                    <div class="card-body">
                        <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Address"
                        @if(!empty($contact->address))
                            value="{{$contact->address}}"
                            @else
                            {{old('address')}}
                        @endif
                        >
                        </div>
                        <div class="form-group">
                        <label for="category_name">Mobile</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile"
                        @if(!empty($contact->mobile))
                            value="{{$contact->mobile}}"
                            @else
                            {{old('number')}}
                        @endif
                        >
                        </div>
                        <div class="form-group">
                            <label for="category_name">Hotline</label>
                            <input type="number" class="form-control" name="hotline" id="hotline" placeholder="Hotline"
                            @if(!empty($contact->hotline))
                                value="{{$contact->hotline}}"
                                @else
                                {{old('hotline')}}
                            @endif
                            >
                        </div>
                        <div class="form-group">
                            <label for="category_name">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email"
                            @if(!empty($contact->email))
                                value="{{$contact->email}}"
                                @else
                                {{old('email')}}
                            @endif
                            >
                        </div>
                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
