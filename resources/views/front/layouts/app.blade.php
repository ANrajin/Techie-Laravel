<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Stroyka</title>
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i"/>
    <!-- css -->
    <link rel="stylesheet" href="{{asset('FrontAssets/vendor/bootstrap-4.2.1/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('FrontAssets/vendor/owl-carousel-2.3.4/assets/owl.carousel.min.css')}}"/>
    <!-- font - fontawesome -->
    <link rel="stylesheet" href="{{asset('FrontAssets/vendor/fontawesome-5.6.1/css/all.min.css')}}" />
    <!-- font - stroyka -->
    <link rel="stylesheet" href="{{asset('FrontAssets/fonts/stroyka/stroyka.css')}}" />
    <link rel="stylesheet" href="{{asset('FrontAssets/css/style.css')}}" />
    <!-- js -->
    <script src="{{asset('FrontAssets/vendor/jquery-3.3.1/jquery.min.js')}}"></script>
  </head>
    <body>

        @include('front.components.header')

        <main>
            @yield('content')
        </main>

        @include('front.components.footer')

    <script src="{{asset('FrontAssets/vendor/bootstrap-4.2.1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('FrontAssets/vendor/owl-carousel-2.3.4/owl.carousel.min.js')}}"></script>
    <script src="{{asset('FrontAssets/vendor/nouislider-12.1.0/nouislider.min.js')}}"></script>
    <script src="{{asset('FrontAssets/js/number.js')}}"></script>
    <script src="{{asset('FrontAssets/js/main.js')}}"></script>
    <script src="{{asset('FrontAssets/js/cart.js')}}"></script>
    <script src="{{asset('FrontAssets/vendor/svg4everybody-2.1.9/svg4everybody.min.js')}}"></script>
    <script>
      svg4everybody();
    </script>
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-97489509-6"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "UA-97489509-6");
    </script>
  </body>
</html>