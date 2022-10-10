@extends('layouts.app')

@section('content')


@foreach ($weather as $w)
  <a href="{{ route('weather_plot', $w->id) }}">
    <div class="row d-flex justify-content-center align-items-center h-100" style="color: #282828;">
      <div class="col-md-9 col-lg-7 col-xl-5">

        <div class="card mb-4 gradient-custom" style="border-radius: 25px;">
          <div class="card-body p-4">

            <div id="demo1" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ul class="carousel-indicators mb-0">
                <li data-target="#demo1" data-slide-to="0" class="active"></li>
                <li data-target="#demo1" data-slide-to="1"></li>
                <li data-target="#demo1" data-slide-to="2"></li>
              </ul>
              <!-- Carousel inner -->
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="d-flex justify-content-between mb-4 pb-2">
                    <div>
                      <h4 class="display-5"><strong>{{ $w->name }}</strong></h4>
                    <p class="text-muted mb-0">temperature: {{ $w->temp }}°C</p>
                    <p class="text-muted mb-0">humidity: {{ $w->humidity }}%</p>
                    </div>
                    <div>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-weather/ilu3.webp"
                        width="180px">
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </a>
    @endforeach

  
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Weather in my cities') }}</div>

                        <div class="card-body">        
                            @foreach ($cities as $city)
                                <div>
                                    Moje miasto
                                    {{ $city->city_id }}
                                    @foreach ($name_of_cities as $name_of_city)
                                        @if ($city->city_id == $name_of_city->id)
                                            {{ $name_of_city->name }}
                                        @endif
                                    @endforeach
                                </div>   
                            @endforeach
                        </div>
                    </div>
                </div>

                
            </div> 
        </div>        
    </div> --}}

@endsection
