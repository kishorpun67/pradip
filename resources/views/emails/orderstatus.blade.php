@component('mail::message')
# Hello : {{$greeting}}


@foreach($introLines as $line)
  {{$subject}} {{$line}}.
@endforeach
<br>
Thanks,<br>
@endcomponent
