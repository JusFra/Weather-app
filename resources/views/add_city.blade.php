<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add city') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Add city from the list.
                </div>
            </div>
        </div> 
    
        <br>
        <form method="POST" action="{{ route('city.store') }}">
            @csrf

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Miasto</label>
                            <select class="form-select" aria-label="Default select example" id="city_id" name="city_id">
                                {{-- @foreach ($cities as $city) --}}
                                    <option selected value="123">Kraków</option>
                                {{-- @endforeach --}}
                                
                                <option value="456">Rzeszów</option>
                                <option value="678">Poznań</option>
                              </select>
                        </div>  
                    </div>
                </div>
            </div>
            <br>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">        
                <button type="submit" class="btn btn-primary">Add city</button>
            </div>    
        </form>

    </div>

</x-app-layout>
