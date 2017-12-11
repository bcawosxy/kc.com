<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pindelta.com | Admin System</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="adminlte/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="adminlte/adminlte/css/_all-skins.min.css">
        <link rel="stylesheet" href="adminlte/adminlte/css/AdminLTE.min.css">
        <link rel="stylesheet" href="adminlte/plugins/icheck/all.css">
        <link rel="stylesheet" href="adminlte/plugins/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="adminlte/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div style="width:100%" class="login-logo">
                <a href="javascript:void(0)">Kc-metalwork.<b>Admin</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your work!</p>
                <form role="form" method="POST" action="{{ url('login') }}">
                    {{ csrf_field() }}
                    @if ($errors->has('msg'))
                        <span class="help-block">
                            <div class="alert alert-danger">{{$errors->first('msg')}}</div>
                        </span>
                    @endif
                    <div class="form-group has-feedback">
                        <input type="text" name="account" class="form-control" id="account" value="admin" placeholder="Account" required autofocus>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" id="password" name="password" value="123456" placeholder="Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="">
                            <button type="submit" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>

    <script src="adminlte/js/jquery_2.1.4.min.js" type="text/javascript"></script>
    <script src="adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="adminlte/adminlte/js/app.min.js" type="text/javascript"></script>
    <script src="adminlte/adminlte/js/demo.js" type="text/javascript"></script>
    <script src="adminlte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</html>