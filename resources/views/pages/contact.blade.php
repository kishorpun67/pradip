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
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success_message') }}</strong>
                    </div>
                @endif
				@include('layouts.front_layout.front_sidebar')
				<div class="col-sm-9 padding-right">
			    	<div class="features_items"><!--features_items-->
						<h2 class="title text-center">
                            Contact Us
                        </h2>
                        <div class="contact-form">
	    				<div class="status alert alert-success" style="display: none"></div>
                            <form id="main-contact-form" class="contact-form row" name="contact-form" action="{{url('page/contact')}}" method="post">
                                @csrf
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Name">
									@error('name')
									<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>

                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
									@error('email')
									<div class="text-danger">{{ $message }}</div>
									@enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
									@error('subject')
									<div class="text-danger">{{ $message }}</div>
									@enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
									@error('message')
									<div class="text-danger">{{ $message }}</div>
									@enderror
                                </div>                        
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                                </div>
                            </form>
	    			    </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
@endsection