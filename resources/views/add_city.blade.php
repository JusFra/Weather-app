@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin-top:40px">
                <h4>Search city</h4>
                <form method="GET" action="{{ route('add_city') }}">
                    @csrf

                    <div class="form-group">
                        <label for="">Enter keyword</label><br>
                        <input type="text" class="form-control" name="query" placeholder="Serach city">
                    </div>
                    <div class="form-group">
                        <br><button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <br><br><br><br>

                @if (isset($search_cities))

                    <form method="POST" action="{{ route('city.store') }}">
                        @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Miasto</label>
                                <select class="form-select" aria-label="Default select example" id="city_id" name="city_id">
                                    @if(count($search_cities) > 0)
                                        @foreach ($search_cities as $city)
                                            <option selected value={{ $city['id'] }}>{{ $city['name'] }}</option>
                                        @endforeach
                                        @else
                                            <option selected value="">No result found!</option>
                                        @endif
                                </select>
                            </div>  
                                
                        <br>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">        
                            <button type="submit" class="btn btn-primary">Add city</button>
                        </div>    
                    </form>

                @endif
            </div>
        </div>
    </div>
@endsection

