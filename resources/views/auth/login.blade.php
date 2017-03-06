<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Support Ticket</title>

    <!-- Custom CSS -->
    <!--   <link href="/css/sb-admin-2.css" rel="stylesheet">
     -->
    <link href="/css/index.css" rel="stylesheet">
    
    <script language="JavaScript" type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>

    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    
    </script>

</head>


<body class="hola">
   
  
<div class="container">    
        
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
     
        <div class="panel panel-default " id="gg">
            <div class="panel-body" >
                <div class="panel-heading">
                    <div class="row">
                        <a href="#" class="active" id="login-form-link">Login</a>
                    </div>
                    <hr>
                </div>
                <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input placeholder="E-mail" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">  
                        <div class="col-md-8 col-md-offset-2">
                         <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="btn btn-lg btn-block">
                                Login
                            </button>
                        </div>
                        <div class="col-md-8 col-md-offset-3">
                            <a class="forgot-password" href="{{ url('/password/reset') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
                           

            </div>                     
        </div>  
    </div>
</div>


    <!-- Scripts -->
    <!-- <script src="/js/app.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>

    <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

  
</body>
</html>




