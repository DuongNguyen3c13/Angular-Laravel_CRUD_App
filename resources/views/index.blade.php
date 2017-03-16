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
          <img src="{{ asset('image/123.jpg') }}" class="img-circle" alt="User Image">
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
            <table class="table"  style="word-break: keep-all;">
                <thead>
                <tr>
                <th>ID
                    <a href="#"  ng-click="orderBy('id')">&#x25B2;</a>
                    <a href="#"  ng-click="orderBy('-id')">&#x25BC;</a> 
                </th>
                <th>Name 
                    <a href="#"  ng-click="orderBy('name')">&#x25B2;</a>
                    <a href="#"  ng-click="orderBy('-name')">&#x25BC;</a>
                </th>
                <th>Address 
                    <a href="#"  ng-click="orderBy('address')">&#x25B2;</a>
                    <a href="#"  ng-click="orderBy('-address')">&#x25BC;</a>
                    </a>
                </th>
                <th>Age 
                    <a href="#"  ng-click="orderBy('age')">&#x25B2;</a>
                    <a href="#"  ng-click="orderBy('-age')">&#x25BC;</a>
                </th>
                <th>Photo</th>
                <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New User</button></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="user in users | orderBy:field">
                <td>@{{user.id}}</td>
                <td>@{{user.name}}</td>
                <td>@{{user.address}}</td>
                <td>@{{user.age}}</td>
                <td ng-show="user.photo !== null"><img src="@{{user.photo}}" 
                  alt="@{{user.name}} photo" class="img-circle" height="60" width="60"></td>
                <td ng-show="user.photo === null">No image found</td>  
                <td>
                    <button class="btn btn-default btn-xs btn-detail glyphicon glyphicon-edit" ng-click="toggle('edit', user.id)"></button>
                    <button class="btn btn-danger btn-xs btn-delete glyphicon glyphicon-remove" ng-click="confirmDelete(user.id)"></button>
                </td>
                </tr>
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="saveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="saveModalLabel">@{{form_title}}</h4>
                        </div>
                        <div class="modal-body">
                            <form name="userForm" class="form-horizontal" novalidate="">
                                <div class="form-group error">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Name" ng-focus="userForm.name.$setUntouched()" 
                                        ng-model="user.name" ng-required="true" ng-maxlength="100" ng-pattern="/^[a-zA-Z\s]*$/">
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.name.$error.required && userForm.name.$touched">
                                            Name field is required
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red" 
                                            ng-show="userForm.name.$error.maxlength && userForm.name.$touched">
                                            Name must not be longer than 100 characters
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.name.$error.pattern && userForm.name.$touched">
                                            Name field must contain alphabectic characters only
                                            <br>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" ng-focus="userForm.address.$setUntouched()"
                                        ng-model="user.address" ng-required="true" ng-maxlength="300" 
                                        ng-pattern="/^[a-zA-Z0-9,. \t\r\n\-]+$/">
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.address.$error.required && userForm.address.$touched">
                                            Address field is required
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red" 
                                            ng-show="userForm.address.$error.maxlength && userForm.address.$touched">
                                            Address must not be longer than 300 characters
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.address.$error.pattern && userForm.address.$touched">
                                            Name field must contain alphabectic characters, number, coma and dot only
                                            <br>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Age</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" ng-focus="userForm.age.$setUntouched()" ng-model="user.age" ng-required="true" ng-maxlength="2" ng-pattern="/^[1-9]\d*$/">
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.age.$error.required && userForm.age.$touched">Age field is required
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.age.$error.maxlength && userForm.age.$touched">
                                            Age field must not be longer than 2 characters
                                            <br>
                                        </span>
                                        <span class="help-inline" style="color:red"
                                            ng-show="userForm.age.$error.pattern && userForm.age.$touched">
                                            Age field must contain positive number only
                                            <br>
                                        </span>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Photo</label>
                                    <div class="col-sm-9">
                                    
                                        <input type="file" id="photo"
                                        onchange="angular.element(this).scope().uploadImage(this)">
                                        <input type="text" style="display:none" class="form-control" name="photo" ng-model="user.photo" name="photo">
                                        <span class="help-inline" ng-show="user.photo != null">
                                            Current photo: <img src="@{{user.photo}}" alt="@{{user.name}} photo" class="img-circle" height="60" width="60">
                                        </span>
                                        <div id="photo-format-error"></div>
                                        <div id="photo-size-error"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" ng-click="close()">Cancel</button>
                            <button type="button" class="btn btn-primary" id="btn-save" name="submit" onclick="this.disabled=true"  ng-click="save(modalstate, id)" ng-disabled="userForm.$invalid">Save changes</button>
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
<script src="{{ asset('app/app.js') }}"></script>
<!-- confirm js -->
<script src="{{ asset('dashboard/dist/js/jquery.confirm.min.js') }}"></script>
<!-- page script -->
</body>
</html>