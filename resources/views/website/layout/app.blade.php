<!doctype html>
<html lang="en">

	<!-- Google Web Fonts
	================================================== -->

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

	<!-- Basic Page Needs
	================================================== -->

	<title>{{ $settings->store_name ?? '' }} | @yield('title')</title>

	

<meta charset="utf-8">
	<meta name="author" content="Lokpriya Providentia International School">
	<meta name="keywords" content="Lokpriya Providentia International School">
	<meta name="description" content="Lokpriya Providentia International School">

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="shortcut icon" href="{{ $settings->favicon_image ?? ''}}">
	<!-- Vendor CSS
	============================================ -->
	
	<link rel="stylesheet" href="{{ asset('assets/website/font/demo-files/demo.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/plugins/revolution/css/settings.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/plugins/revolution/css/layers.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/plugins/revolution/css/navigation.css') }}">

	<!-- CSS theme files
	============================================ -->
	<link rel="stylesheet" href="{{ asset('assets/website/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/css/fontello.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/website/css/responsive.css') }}">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
   @stack('css')

   @stack('style')
  

</head>

<body>

  <div class="loader"></div>

  <!--cookie-->
  {{-- <div class="cookie">
          <div class="container">
            <div class="clearfix">
              <span>Please note this website requires cookies in order to function correctly, they do not store any specific information about you personally.</span>
              <div class="f-right"><a href="#" class="button button-type-3 button-orange">Accept Cookies</a><a href="#" class="button button-type-3 button-grey-light">Read More</a></div>
            </div>
          </div>
        </div>--}}

  <!-- - - - - - - - - - - - - - Wrapper - - - - - - - - - - - - - - - - -->

  <div id="wrapper" class="wrapper-container">

    <!-- - - - - - - - - - - - - Mobile Menu - - - - - - - - - - - - - - -->

    <nav id="mobile-advanced" class="mobile-advanced"></nav>

    <!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

    @include('website.layout.header')

    <!-- - - - - - - - - - - - - end Header - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->
   	@yield('content')
    

    <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

    @include('website.layout.footer')

    <div id="footer-scroll"></div>

    <!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->

  </div>

  <!-- - - - - - - - - - - - end Wrapper - - - - - - - - - - - - - - -->

  <!-- JS Libs & Plugins
  ============================================ -->
  <script src="{{ asset('assets/website/js/libs/jquery.modernizr.js') }}"></script>
  <script src="{{ asset('assets/website/js/libs/jquery-2.2.4.min.js') }}"></script>
  <script src="{{ asset('assets/website/js/libs/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/website/js/libs/retina.min.js') }}"></script>
  <script src="{{ asset('assets/website/plugins/jquery.scrollTo.min.js') }}"></script>
  <script src="{{ asset('assets/website/plugins/jquery.localScroll.min.js') }}"></script>
  <script src="{{ asset('assets/website/plugins/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/website/plugins/jquery.queryloader2.min.js') }}"></script>
  <script src="{{ asset('assets/website/plugins/revolution/js/jquery.themepunch.tools.min.js?ver=5.0') }}"></script>
  <script src="{{ asset('assets/website/plugins/revolution/js/jquery.themepunch.revolution.min.js?ver=5.0') }}"></script>
<!-- Live Slider script -->
 <script type="text/javascript" src="{{ asset('assets/website/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/website/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/website/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<!-- End slider script -->

  <!-- JS theme files
  ============================================ -->
  <script src="{{ asset('assets/website/js/plugins.js') }}"></script>
  <script src="{{ asset('assets/website/js/script.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  @stack('js')
  @stack('scripts')
  <script>

            @if(Session::has('success'))
               toastr.success("{{ Session::get('success') }}");
            @endif

            @if(Session::has('inqury_success'))
               toastr.success("{{ Session::get('inqury_success') }}");
            @endif
  </script>


  
</body>


</html>