<!DOCTYPE html>
<html lang="en">
    @include('administrator.partials.head')

    <body>
        <div class="app">
            <div class="layout">
                {{-- Header Start --}}
                @include('administrator.partials.header')
                {{-- Header End --}}
                {{-- Side Nav Start --}}
                @include('administrator.partials.sidebar')
                {{-- Side Nav End --}}
                {{-- Page Container Start --}}
                <div class="page-container">
                    {{-- Content Wrapper Start --}}
                    <div class="main-content">
                        {{-- Breadcrumbs Start --}}
                        @include('administrator.partials.session')
                        {{-- Breadcrumbs End --}}
                        @yield('content') {{-- This yield for content --}}
                    </div>
                    {{-- Content Wrapper End --}}
                    {{-- Footer Start --}}
                    @include('administrator.partials.footer')
                    {{-- Footer End --}}
                </div>
                {{-- Page Container End --}}
                {{-- Search Start --}}
                @include('administrator.partials.search')
                {{-- Search End --}}
                {{-- Quick View Start --}}
                @include('administrator.partials.quickView')
                {{-- Quick View End --}}
            </div>
        </div>
        {{-- Core Vendor JS --}}
        <script src="{{ asset('administrator/assets/js/vendors.min.js') }}"></script>
        {{-- Page JS --}}
        <script>
            $(document).ready(function() {
                $('#notif').hide();
                $('#notif').fadeIn('slow');
                setTimeout(function() {
                    $('#notif').fadeOut('slow');
                }, 5000);
            });
        </script>
        @stack('scripts')
        {{-- Core JS --}}
        <script src="{{ asset('administrator/assets/js/app.min.js') }}"></script>
    </body>

</html>
