<!DOCTYPE html>
<html lang="en">
    @include('buyer.partials.head')

    <body class="header_sticky header-style-1 has-menu-extra">
        <!-- Preloader -->
        @if (request()->is('/'))
        <div id="loading-overlay">
            <div class="loader"></div>
        </div>
        @endif

        <!-- Boxed -->
        <div class="boxed">
            <!-- Header -->
            @include('buyer.partials.header')

            <!-- CONTENT -->
            @yield('content')

            <!-- Footer -->
            @include('buyer.partials.footer')

            <!-- Go Top -->
            <a class="go-top">
                <i class="fa fa-chevron-up"></i>
            </a>

        </div>
        @stack('scripts')
        <!-- Javascript -->
        <script src="{{ asset('buyer/assets/javascript/jquery.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/tether.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/bootstrap.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/bootstrap.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/parallax.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery-waypoints.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery-countTo.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery.countdown.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery.flexslider-min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/images-loaded.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery.isotope.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/magnific.popup.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery.hoverdir.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/equalize.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/jquery-ui.js') }}"></script>

        <script src="{{ asset('buyer/assets/javascript/jquery.cookie.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/main.js') }}"></script>

        <!-- Revolution Slider -->
        <script src="{{ asset('buyer/assets/rev-slider/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/javascript/rev-slider.js') }}"></script>
        
        <!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script src="{{ asset('buyer/assets/rev-slider/js/extensions/revolution.extension.video.min.js') }}"></script>
    </body>

</html>
