<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kc-metalwork.com | Admin System</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ URL::asset('adminlte/bootstrap/css/bootstrap.min.css') }}" >
    <link rel="stylesheet" href="{{ URL::asset('adminlte/adminlte/css/_all-skins.min.css')}} ">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/adminlte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/icheck/all.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/font-awesome/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/editor.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/select.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/datatables/css/rowReorder.dataTables.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/icheck/minimal/minimal.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('js/admin/jquery-file-upload/css/jquery.fileupload.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('js/admin/sweet-alert2/css/sweet-alert2.min.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('js/admin/jquery-ui-1.12.1.custom/jquery-ui.min.css')}}">

    <link rel="stylesheet" href="{{ URL::asset('js/admin/croppie/croppie.min.css')}}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.includes.header')
        @include('admin.includes.navbar')

        @yield('content')

        <footer class="main-footer">
            <strong>Copyright &copy; 2017 <a href="{{url('')}}">  kc-metalwork</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>

@section('footer')
    <script src="{{ URL::asset('adminlte/js/jquery_2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/adminlte/js/demo.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('plugins/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/js/dataTables.select.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/js/dataTables.editor.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/js/dataTables.rowReorder.min.js')}}" type="text/javascript"></script>

    <script src="{{ URL::asset('adminlte/adminlte/js/app.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/jquery-file-upload/js/jquery.ui.widget.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/select2/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/sweet-alert2/js/sweet-alert2.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/highcharts/js/highcharts.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/highcharts/js/exporting.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('adminlte/plugins/highcharts/js/sand-signika.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/admin/croppie/croppie.min.js')}}" type="text/javascript"></script>

    @show
<script>
    function _swal(r) {
        switch (r.status) {
            case 0 : status = 'error'; break;
            case 2 : status = 'warning'; break;
            case 3 : status = 'info'; break;
            case 4 : status = 'question'; break;
            default : status = 'success'; break;
        }

        swal({
            'text' : r.message,
            'type' : status,
            'timer': 2000,
        }).then(
            function () { if(r.redirect) location.href = r.redirect; },
            function (dismiss) { if(r.redirect) location.href = r.redirect; }
        ).catch(swal.noop);
    }
</script>

</html>