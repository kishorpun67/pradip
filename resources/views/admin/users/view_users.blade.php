@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
              <h3 class="card-title">View User</h3>
            </div>
            <div class="card-body">
              <table id="categories" class="table table-bordered table-striped  text-center">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Mobile</th>
                    <th>Eamil</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($usersDetails as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->city}}</td>
                        <td>{{$user->state}}</td>
                        <td>{{$user->country}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->status==1)
                                <a  class="updateUserStatus" id="user-{{$user->id}}" user_id="{{$user->id}}"  href="javascript:(0);">Active</a>
                            @else
                            <a class="updateUserStatus" id="user-{{$user->id}}" user_id="{{$user->id}}" href="javascript:(0);">Inactive</a>
                            @endif
                        </td>
                        <td>
                          <a href="javascript:" class="delete_form" record="user"  rel="{{$user->id}}" style="display:inline;">
                            <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                          </a>
                        </td>
                    </tr>
                    @endforeach
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