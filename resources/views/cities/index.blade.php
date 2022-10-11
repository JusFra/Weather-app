@extends('layouts.app')

@section('head')
    <!-- JQuery -->
    <link rel="stylesheet" type="text/css" href="{{ asset('jquery-ui.min.css') }}">
    
    <script type="text/javascript" src="{{ asset('jquery-3.6.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery-ui.min.js') }}"></script>
@endsection

    @section('content')
    @if (session('status'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif



    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin-top:40px">
                <h4>Search city</h4>

                <form method="POST" action="{{ route('store') }}">
                @csrf
                    <div class="mb-3">
                    <input type="text" id="city_name" name="city_name">

                    <!-- Select city id -->
                    <input type="text" id="city_id" name="city_id" hidden>

                    <button type="submit" class="btn btn-primary">Add city</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Script -->
    <script type="text/javascript">

        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        $(document).ready(function(){
            $('#city_name').autocomplete({
                source: function(request, response){
                    $.ajax({
                        url:"{{route('cities.getCities')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    $('#city_name').val(ui.item.label); // display the selected text
                    $('#city_id').val(ui.item.value); // save selected id to input
                    return false;
                }
            });
        });
    </script>

@endsection