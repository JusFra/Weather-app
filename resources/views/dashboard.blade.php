@extends('layouts.app')


@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<header class="py-5">
  <div class="container px-lg-5">
      <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
          <div class="m-4 m-lg-5">
              <h1 class="display-5 fw-bold">Welcome!</h1>
              <p class="fs-4">Check the weather today!</p>
              <a class="btn btn-secondary btn-lg" href="{{ route('add_city')}}">{{ __('weather.button.add_city') }}</a>
          </div>
      </div>
  </div>
</header>

<!-- Page Content-->
<section class="pt-4">
  <div class="container px-lg-5">

    <!-- Page Features-->  
    <div class="row gx-lg-5">
      @foreach ($weather as $w)
        <div class="col-lg-6 col-xxl-4 mb-5">
          
          <a class="link-secondary" href="{{ route('weather_plot', $w->id) }}"><div class="card bg-primary bg-opacity-15 border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">    
              <img src='http://openweathermap.org/img/wn/{{ $w->icon }}@2x.png' width="180px" />
              <h2 class="fs-4 fw-bold">{{ $w->name }}</h2>
              <p class="mb-0 text-muted mb-0">{{ __('Temperature') }}: {{ $w->temp }}°C</p>
              <p class="mb-0 text-muted mb-0">{{ __('Humidity') }}: {{ $w->humidity }}%</p>
              
              <a href="{{ route('dashboard') }}"
                onclick="event.preventDefault();
                document.getElementById(
                'delete-form-{{$w->city_id}}').submit();"
              >{{ __('Delete') }}</a> | 
              
              <a href="{{ route('weather_plot', $w->id) }}">{{ __('Show more') }}</a>
              
              <form id="delete-form-{{$w->city_id}}" 
                + action="{{route('city_destroy', $w->city_id)}}"
                method="post">
                @csrf @method('DELETE')
              </form>

            </div>
          </div></a>
        </div>
      @endforeach
          
    </div>
  </div>
</section>
  
@endsection
