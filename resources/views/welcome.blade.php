<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <!-- Scripts -->
        @vite(['resources/css/styles.css'])


    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <li class="nav-item"><a href="{{ url('/dashboard') }}" class="nav-link">{{ __('Home') }}</a></li>
                                @else
                                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a></li>

                                    @if (Route::has('register'))
                                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a></li>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header - set the background image for the header in the line below-->
        <header class="py-5 bg-image-full" style="background-image: url({{ url('images/umbrela.jpg') }})">
            <div class="text-center my-5">
                <h1 class="text-white fs-3 fw-bolder"></h1><br><br><br>
            </div>
        </header>
        <!-- Content section-->
        <section class="py-5">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h1>Weather forecast just for You</h1><br>
                        <p class="lead">Check the weather forecast for the city of your choice.</p><br>
                        <p class="mb-0">Create a list of cities you are watching and have the weather forecast always with you.</p><br>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; {{ config('app.name', 'Laravel') }} 2022</p></div>
        </footer>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
