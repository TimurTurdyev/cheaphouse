<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('/') }}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('apple-touch-icon-114x114.png') }}">

    {!! SEO::generate(app()->isProduction()) !!}

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i|Poppins:300,400,500,600,700"
          rel="stylesheet">
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet" media="screen">
    @if ( App::environment('local') )
        @vite( ['resources/js/app.js'] )
    @endif
</head>
<body>

<div class="animsition">
    <div class="wrapper boxed">
        <!-- Content CLick Capture-->
        <div class="click-capture"></div>
        <!-- Sidebar Menu-->
        <div class="menu">
            <span class="close-menu icon-cross2 right-boxed"></span>
            <ul class="menu-list right-boxed">
                <li class="active">
                    <a href="{{ route('home') }}">Главная</a>
                </li>
                <li>
                    <a href="{{ route('project.index') }}">Наши работы</a>
                </li>
                <li>
                    <a href="{{ route('post.index') }}">Статьи</a>
                </li>
                <li><a href="/">О нас</a></li>
                <li><a href="/">Контакты</a></li>
            </ul>
            <div class="menu-footer right-boxed">
                <div class="social-list">
                    <a href="/" class="icon ion-social-twitter"></a>
                    <a href="/" class="icon ion-social-facebook"></a>
                    <a href="/" class="icon ion-social-googleplus"></a>
                    <a href="/" class="icon ion-social-linkedin"></a>
                    <a href="/" class="icon ion-social-dribbble-outline"></a>
                </div>
                <div class="copy">© {{ config('app.cooperate') }}. All Rights Reseverd</div>
            </div>
        </div>
        <!-- Navbar -->
        <header class="navbar boxed js-navbar">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"
                    aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="brand" href="/">
                <img alt="" src="{{ asset('theme/images/brand.png') }}">
                <div class="brand-info">
                    <div class="brand-name">{{ $globalSetting->get('logoTitle', config('app.name_logo')) }}</div>
                    <div class="brand-text">{{ $globalSetting->get('logoSubTitle', config('app.name_logo_desc')) }}</div>
                </div>
            </a>

            <div class="social-list hidden-xs">
                <a href="/" class="icon ion-social-twitter"></a>
                <a href="/" class="icon ion-social-facebook"></a>
                <a href="/" class="icon ion-social-googleplus"></a>
                <a href="/" class="icon ion-social-linkedin"></a>
                <a href="/" class="icon ion-social-dribbble-outline"></a>
            </div>

            <div class="navbar-spacer hidden-sm hidden-xs"></div>

            <address class="navbar-address hidden-sm hidden-xs">
                ЗВОНИТЕ: <span class="text-dark"><a href=""
                                                    class="text-dark">{{ $globalSetting->get('phone', config('app.phone')) }}</a></span>
            </address>
        </header>

        {{ $slot }}
        <!-- Footer -->
        <footer id="footer" class="footer section">
            <div class="footer-flex">
                <div class="flex-item">
                    <a class="brand pull-left" href="/">
                        <img alt="" src="{{ asset('theme/images/brand.png') }}">
                        <div class="brand-info">
                            <div class="brand-name">{{ config('app.name_logo') }}</div>
                            <div class="brand-text">{{ config('app.name_logo_desc') }}</div>
                        </div>
                    </a>
                </div>
                <div class="flex-item">
                    <div class="inline-block">© {{ config('app.cooperate') }}<br>All Rights Resevered</div>
                </div>
                <div class="flex-item">
                    <ul>
                        <li><a href="/">Site Map</a></li>
                        <li><a href="/">Term & Conditions</a></li>
                        <li><a href="/">Privacy Policy</a></li>
                        <li><a href="/">Help</a></li>
                        <li><a href="/">Affiliatep</a></li>
                    </ul>
                </div>
                <div class="flex-item">
                    <ul>
                        <li><a href="/">Our Location</a></li>
                        <li><a href="/">Career</a></li>
                        <li><a href="/">About</a></li>
                        <li><a href="/">Contact</a></li>
                    </ul>
                </div>
                <div class="flex-item">
                    <div class="social-list">
                        <a href="/" class="icon ion-social-twitter"></a>
                        <a href="/" class="icon ion-social-facebook"></a>
                        <a href="/" class="icon ion-social-googleplus"></a>
                        <a href="/" class="icon ion-social-linkedin"></a>
                        <a href="/" class="icon ion-social-dribbble-outline"></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- jQuery -->

<script src="{{ asset('theme/js/jquery.min.js') }}"></script>
<script src="{{ asset('theme/js/animsition.min.js') }}"></script>
<script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/js/smoothscroll.js') }}"></script>
<script src="{{ asset('theme/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('theme/js/wow.min.js') }}"></script>
<script src="{{ asset('theme/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('theme/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('theme/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('theme/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('theme/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins.js') }}"></script>
<script src="{{ asset('theme/js/sly.min.js') }}"></script>


<!-- Slider revolution -->
<script src="{{ asset('theme/js/rev-slider/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/jquery.themepunch.revolution.min.js') }}"></script>

<!-- Slider revolution 5x Extensions   -->
<script src="{{ asset('theme/js/rev-slider/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider/revolution.extension.video.min.js') }}"></script>


<!-- Scripts -->
<script src="{{ asset('theme/js/scripts.js') }}"></script>
<script src="{{ asset('theme/js/rev-slider-init.js') }}"></script>
@if( app()->isProduction() )
{!! $globalSetting->get('$globalSetting') !!}
@endif
</body>
</html>
