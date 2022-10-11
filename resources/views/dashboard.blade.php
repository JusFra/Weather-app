@extends('layouts.app')

@section('content')

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
              <a class="btn btn-secondary btn-lg" href="{{ route('add_city')}}">Add city</a>
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
          <div class="card bg-light border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-weather/ilu3.webp"
                    width="180px">
              <a class="link-secondary" href="{{ route('weather_plot', $w->id) }}" style="text-decoration:none"><h2 class="fs-4 fw-bold">{{ $w->name }}</h2></a>
              <p class="mb-0 text-muted mb-0">temperature: {{ $w->temp }}°C</p>
              <p class="mb-0 text-muted mb-0">humidity: {{ $w->humidity }}%</p>
            </div>
          </div>
        </div>
      @endforeach
          
    </div>
  </div>
</section>
  
@endsection
