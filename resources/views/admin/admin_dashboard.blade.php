 @extends('layouts.admin_layout.admin_layout')
@section('content')
<?PHP
 use App\Admin\Product;
 use App\NewsletterSubscriber;
 $totatl_subscriber = NewsletterSubscriber::count();
 $prouduct = Product::count();
 $orders = Product::orders();
 $users = Product::users();
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3>{{$orders}}</h3>

                <p>Total Product</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('admin.view.orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
            <h3>{{$orders}}</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('admin.view.orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3>{{$users}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            <a href="{{route('admin.view.users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3>{{$totatl_subscriber}}</h3>

                <p>User Subscriber</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            <a href="{{route('admin.view.newsletter.subscribers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

                <!-- Main content -->
    <section class="content" style="margin-top: 100px;">

        <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Send Message To All Subscriber</h3>
                    </div>
                    <!-- /.card-header -->

                    @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- form start -->
                    <form role="form" method="POST" action="{{route('admin.message')}}" name="updatePasswordForm" id="updatePasswordForm" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" name="title" placeholder="Title" type="text" id="title">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control"></textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
      </div><!-- /.container-fluid -->
    </section>



</div>
<!-- /.content-wrapper -->

@endsection
