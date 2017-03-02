<!DOCTYPE html>
<html ng-app="usersApp">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('dashboard/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="{{ asset('dashboard/bootstrap/css/font-awesome.min.css') }}""> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dashboard/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Test</b>App</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#/" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/123.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Test app</p>
          <small>Welcome, Admin</small>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->

        <li ><a href="{{ url('/') }}"><i class="fa fa-link"></i> <span>Users Management</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h4>
        Users Management
      </h4>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
            <div  ng-controller="usersController">

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Age</th>
                  <th>Photo</th>
                  <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New User</button></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="user in users">
                <td>@{{user.id}}</td>
                <td>@{{user.name}}</td>
                <td>@{{user.address}}</td>
                <td>@{{user.age}}</td>
                <td ng-show="user.photo != null"><img src="@{{user.photo}}" 
                  alt="@{{user.name}} photo" class="img-circle" height="60" width="60"></td>
                <td ng-show="user.photo == null">No image found</td>  
                        <td>
                            <button class="btn btn-default btn-xs btn-detail glyphicon glyphicon-edit" ng-click="toggle('edit', user.id)"></button>
                            <button class="btn btn-danger btn-xs btn-delete glyphicon glyphicon-remove" ng-click="confirmDelete(user.id)"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">@{{form_title}}</h4>
                        </div>
                        <div class="modal-body">
                            <form name="userForm" class="form-horizontal" novalidate="" enctype="multipart/form-data">
                            <!-- <form action="{!! action('UsersController@store') !!}" method="POST" enctype="multipart/form-data"> -->

                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" value="@{{name}}" 
                                        ng-model="user.name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="userForm.name.$invalid && userForm.name.$touched">Invalid name</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="@{{address}}" 
                                        ng-model="user.address" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="userForm.address.$invalid && userForm.address.$touched">Invalid address</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Age</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" value="@{{age}}" 
                                        ng-model="user.age" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="userForm.age.$invalid && userForm.age.$touched">Invalid age</span>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="file" id="photo" name="photo">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="photo" name="photo" placeholder="Photo" value="@{{photo}}" 
                                        ng-model="user.photo" ng-required="false">
                                    <span class="help-inline" 
                                        ng-show="userForm.photo.$invalid && userForm.photo.$touched">Invalid photo</span>
                                    </div>
                                </div> -->

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="userForm.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
              <!-- /box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('dashboard/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('dashboard/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('dashboard/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
<script src ="{{ asset('app/app.js') }}"></script>
<!-- confirm js -->
<script src="{{ asset('dashboard/dist/js/jquery.confirm.min.js') }}"></script>
<script>
  $(".confirm").confirm();
</script>
<!-- page script -->
</body>
</html>