<?php
 $current_month = date('M');
 $last_month = date('M',strtotime("-1 month"));
 $last_to_last_month = date('M',strtotime("-2 month"));

 $dataPoints = array(
     array("y" => $last_to_last_month_users, "label" => $last_to_last_month ),
     array("y" => $last_month_users, "label" => $last_month),
     array("y" => $current_month_users, "label" => $current_month),

 );
 ?>
@extends('layouts.admin_layout.admin_layout')
@section('content')
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "User Reporting"
	},
	axisY: {
		title: "Number of Users"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Charts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li> 
              <li class="breadcrumb-item active">Charts</li>
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
              <h3 class="card-title">User Chart</h3>
            </div>
            <div class="card-body">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection


