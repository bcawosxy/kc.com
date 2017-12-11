<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Magnet - Minimal Portfolio Template</title>

    <link rel="stylesheet" href="{{URL::asset('css/kc-metalwork/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/kc-metalwork/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/kc-metalwork/flexslider.css')}}" type="text/css" />
    <link rel="stylesheet" href=" {{URL::asset('css/kc-metalwork/style.css')}}" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700" rel="stylesheet">

</head>

<body>

<!-- PRE LOADER FIXED-->
<div id="MenuNavbar_fixed" class="navbar navbar-default navbar-static-top" role="navigation">
    @include('kc-metalwork.includes.navbarFixed')
</div>

<!-- PRE LOADER -->
<div  class="preloader">
    <div class="sk-spinner sk-spinner-wordpress">
        <span class="sk-inner-circle"></span>
    </div>
</div>

<!-- Navigation section  -->
<div id="MenuNavbar_default" class="navbar navbar-default navbar-static-top" role="navigation">
    @include('kc-metalwork.includes.navbarDefault')
</div>

<!-- Content -->
@yield('content')

<!-- Footer Section -->
<footer>
    @include('kc-metalwork.includes.footer')
</footer>

<!-- SCRIPTS -->
<script src="{{ URL::asset('js/kc-metalwork/jquery.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('js/kc-metalwork/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('js/kc-metalwork/custom.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('js/kc-metalwork/jquery.flexslider-min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            controlNav: "thumbnails"
        });
    });

    $( window ).scroll(function() {
        if($(window).scrollTop() > 138)  {
            $('#MenuNavbar_fixed').show();
        } else {
            $('#MenuNavbar_fixed').hide();
        }
    });
</script>
</body>
</html>