<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Support Tickets</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">


  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <script>
      window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
      ]); ?>
    
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> 
  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SP</b>T</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Support</b>Ticket</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
     

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user.png" class="user-image" alt="User Image">
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/dist/img/user.png" class="img-circle" alt="User Image">
                <p href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->name }} 
                </p>
               
              </li>
        
             
              <li class="user-footer">
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
               </div>
              </li>
            </ul>
          </li>
        
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        
          <div>
             <span ><b>{{Auth::user()->name}}  </b><i class="fa fa-circle fa-1 text-success" ></i>Online</span>
          </div>  
          @if (Auth::user()->rol==1)
            <p>Rol: Admin</p>
          @elseif (Auth::user()->rol==2)
            <p>Rol: Agent</p>
          @else
            <p>Rol: User</p>
          @endif          
        </div>
      </div>
  
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
           <li class="treeview"><a href="{{ url('/') }}">
             <i class="fa fa-home"></i> <span>Home</span>  
           </a></li>
        @if (Auth::user()->rol==1)
          <li class="treeview">
            <a href="{{ url('admin/tickets') }}">
              <i class="fa fa-ticket"></i> <span>Tickets</span>  
            </a>
          </li>
          <li class="treeview">
            <a href="{{ url('admin/create') }}">
              <i class="fa fa-user-plus"></i> <span>Create User</span>  
            </a>
          </li>
          <li class="treeview">
            <a href="{{ url('admin/category') }}">
              <i class="fa fa-th-large"></i> <span>Category</span>  
            </a>
          </li>
        @elseif(Auth::user()->rol==2)
         <li class="treeview">
            <a href="{{ url('agent/tickets') }}">
              <i class="fa fa-ticket"></i> <span>Assigned tickets</span>  
            </a>
          </li>         
        @else
          <li class="treeview">
            <a href="{{ url('my_tickets') }}">
              <i class="fa fa-ticket"></i> <span>My Tickets</span>  
            </a>
          </li>
          <li class="treeview">
            <a href="{{ url('new_ticket') }}">
            <i class="fa fa-pencil"></i> <span>Open Ticket</span>  
            </a>
          </li>
        @endif      
      </ul>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
  
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
       @yield('content')
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->


<script type="text/javascript" src="/vendor/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/vendor/moment/min/moment.min.js"></script>

<script type="text/javascript" src="/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/vendor/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- TEXT EDITOR -->
     <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format:'YYYY-MM-DD HH:mm:ss'

                });
            });
        </script>
<!-- <script>
  $(function () {
    CKEDITOR.replace('editor1');
    $(".textarea").wysihtml5();
  });
</script> -->
</body>
</html>
