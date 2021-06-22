@extends('layouts.front_layout.front_layout')
@section('content')
@include('layouts.front_layout.front1_header')

        <!-- Begin Contact Main Page Area -->
        <div class="contact-main-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                        <div class="contact-page-side-content">
                            <h3 class="contact-page-title">Contact Us</h3>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-fax"></i> Address</h4>
                                <p>{{$contact->address}}</p>
                            </div>
                            <div class="single-contact-block">
                                <h4><i class="fa fa-phone"></i> Phone</h4>
                                <p>Mobile: {{$contact->mobile}}</p>
                                <p>Hotline: {{$contact->hotline}}</p>
                            </div>
                            <div class="single-contact-block last-child">
                                <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                <p>{{$contact->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                        <div class="contact-form-content">
                            <h3 class="contact-page-title">Tell Us Your Message</h3>
                            <div class="contact-form">
                                <form id="contact-form" action="{{url('contact')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your Name <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" >
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email <span class="required">*</span></label>
                                        <input type="email" name="email" id="email" >
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" id="subject">
                                        @error('subject')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-group-2">
                                        <label>Your Message</label>
                                        <textarea name="message" id="message"></textarea>
                                        @error('message')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" value="submit" id="submit" class="alsita-contact-form_btn" name="submit">send</button>
                                    </div>
                                </form>
                            </div>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Main Page Area End Here -->
@endsection
