<!DOCTYPE html>
<html lang="en">
<head>
    <title>EvaluadorPD</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/style.css">


</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    EvaluadorPD
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>



    <div class="site-blocks-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">

                <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">

                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8 text-center">
                            <h1>EvaluadorPD <span class="typed-words"></span></h1>
                            <p class="lead mb-5">Ana Perez Albarrán</p>
                            <div><a data-fancybox data-ratio="2" href="https://github.com" class="btn btn-primary btn-md">Github</a></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="p-3 box-with-humber">
                        <div class="number-behind">01.</div>
                        <h2 class="text-primary">Título 1</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Característica 1</li>
                            <li>Característica 2</li>
                            <li>Característica 3</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="p-3 box-with-humber">
                        <div class="number-behind">02.</div>
                        <h2 class="text-primary">Título 2</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Característica 1</li>
                            <li>Característica 2</li>
                            <li>Característica 3</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="p-3 box-with-humber">
                        <div class="number-behind">03.</div>
                        <h2 class="text-primary">Título 3</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et praesentium eos nulla qui commodi consectetur beatae fugiat. Veniam iste rerum perferendis.</p>
                        <ul class="list-unstyled ul-check primary">
                            <li>Característica 1</li>
                            <li>Característica 2</li>
                            <li>Característica 3</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-4">
            </div> <!-- .site-wrap -->

            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/jquery-migrate-3.0.1.min.js"></script>
            <script src="js/jquery-ui.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/jquery.stellar.min.js"></script>
            <script src="js/jquery.countdown.min.js"></script>
            <script src="js/bootstrap-datepicker.min.js"></script>
            <script src="js/jquery.easing.1.3.js"></script>
            <script src="js/aos.js"></script>
            <script src="js/jquery.fancybox.min.js"></script>
            <script src="js/jquery.sticky.js"></script>

            <script src="js/typed.js"></script>
            <script>
                var typed = new Typed('.typed-words', {
                    strings: ["TFG"," Ingeniería de la Salud"],
                    typeSpeed: 80,
                    backSpeed: 80,
                    backDelay: 2000,
                    startDelay: 1000,
                    loop: true,
                    showCursor: true
                });
            </script>

            <script src="js/main.js"></script>



</body>
</html>