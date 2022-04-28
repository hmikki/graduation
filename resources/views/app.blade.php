<!DOCTYPE html>
<html lang="ar">
<head>
    <title>Unicode @yield('title')</title><!-- site title-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/all.min.css')}}"><!-- font awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/bootstrap.min.css')}}"><!-- bootstrap-->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/normlaize.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/style.css')}}"><!-- main style -->
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/responsive.css')}}"><!-- responsive style -->
</head>

<body>
<div class="wrapper">
    <div class="container-fluid">
        <header>
            <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('lib/img/logo.png')}}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('about')}}">About</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
    </div>
    <footer>
        <div class="bg-img-footer"><img src="{{asset('lib/img/footer.webp')}}" alt=""></div>
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <hr>
                    <div class="footer-content">
                        <div class="row responsive">
                            <div class="col-md-4 col-12"> <img src="{{asset('lib/img/footer_logo.webp')}}" alt=""> </div>
                            <div class="col-md-4 col-12">
                                <ul class="footer-list">
                                    <li><a href="#">support@unicodeofficial.com</a></li>
                                    <li>Riyadh, Saudi Arabia, 11253</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row responsive">
                            <div class="col-md-4"></div>
                            <div class="col-md-2 col-6"><a href="{{url('about')}}" class="footer-link">About Unicode</a></div>
                            <div class="col-md-2 col-6"><a href="{{url('privacy')}}" class="footer-link">Privacy Policy</a></div>
                            <div class="col-md-4 col-6"><a href="{{url('terms')}}" class="footer-link">Terms & Conditions</a></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row disp">
                        <div class="col-md-6 col-12 for-res"> &copy; 2021 Unicode.</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3 col-12">
                            <ul class="social">
                                <li><a href="{{url(''.(\App\Models\Setting::where('key','instagram')->first())->value)}}"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{url(''.(\App\Models\Setting::where('key','twitter')->first())->value)}}"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="{{url(''.(\App\Models\Setting::where('key','linkedin')->first())->value)}}"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{asset('lib/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('lib/js/bootstrap.min.js')}}"></script>
<script src="{{asset('lib/js/main.js')}}"></script>
</body>
</html>
