@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Token: {{request()->user()->token ?? 'Already Generated!'}}
                    </p>
                    <form  action ="{{route('home')}}" method="POST">
                        @csrf 
                        <input type="text" name="secret" class="form-control" >
                        <input type="submit" value=" Generate Token" class="btn btn-outline-primary mt-1 ml-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
