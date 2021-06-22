@extends('layouts.front_layout.front_layout')


@section('content')
    <section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						@foreach($banner as  $key=> $banners)
							<li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active"  @endif></li>
						@endforeach
						</ol>
						<div class="carousel-inner">
						@foreach($banner as  $key=> $banners)
							<div class="item @if($key==0) active @endif"> 
								<img src="{{asset('frontend/images/home/'.$banners->image)}}" alt="" />
							</div>
						@endforeach
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
			@include('layouts.front_layout.front_sidebar')
				<div class="col-sm-9 padding-right">
			    	<div class="features_items"><!--features_items-->
						<h2 class="title text-center">
                            {{$cmsPageDetalils->url}}
                        </h2>
                        <p>{{$cmsPageDetalils->description}}</p>
                    </div>
				</div>
			</div>
		</div>
	</section>
@endsection