@component('mail::message')
<img src="{{asset('frontend/assets/images/menu/logo/logo.png')}}" alt="">
 Title :{{$subject}}

@foreach($introLines as $line)
  Message : {{$line}}
@endforeach
<br>
Thanks,<br>
@endcomponent
