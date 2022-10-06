@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Weather in my cities') }}</div>

                        <div class="card-body">        
                            @foreach ($cities as $city)
                                <div>
                                    Moje miasto
                                    {{ $city->city_id }}
                                </div>   
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div> 
        </div>
        
    </div>

@endsection
