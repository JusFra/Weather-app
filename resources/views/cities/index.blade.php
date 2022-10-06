@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="margin-top:40px">
                <h4>Search city</h4>

                <form method="POST" action="{{ route('city.store') }}">
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