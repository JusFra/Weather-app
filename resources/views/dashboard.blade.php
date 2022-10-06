@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <br>
            <a href="{{ route('add_city')}}"><button class="btn btn-primary">Add city</button></a>
            <br><br>
            <a href="{{ route('main_page')}}"><button class="btn btn-primary">My city</button></a>
        </div>
    </div>
</div>
@endsection
