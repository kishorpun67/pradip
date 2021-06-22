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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Section</h3>
            </div>
            <div class="card-body">
              <table id="sections" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse($results as $data)
                <tr>
                  <td>{{$data->id}}</td>
                  <td>{{$data->name}}</td>
                  <td>
                      @if($data->status==1)
                        <a  class="updateSectionStatus" id="section-{{$data->id}}" section_id="{{$data->id}}"  href="javascript:(0);">Active</a>
                      @else
                      <a class="updateSectionStatus" id="section-{{$data->id}}" section_id="{{$data->id}}" href="javascript:(0);">Inactive</a>
                      @endif
                  </td>
                </tr>
                @empty
                <p>No Data</p>
                @endforelse
                </tbody>
              
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


  <!-- /.content-wrapper -->

@endsection