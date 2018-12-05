<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MP Performance | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/dataTables.bootstrap.min.css">
  <!-- Waves -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/waves.css">
  <!-- Animate -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .signature-pad {
      position: absolute;
      background-color: white;
      border: 1px solid #ccd2d8;
    }
    .swal2-popup {
      font-size: 1.6rem !important;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url("index.php"); ?>" class="logo">
    <!-- <a href="<?php echo base_url("index.php/notifications/sendFCM"); ?>" class="logo"> -->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MP</b>Performance</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span id="notif_count" class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li id="list_header" class="header"></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul id="notif_list" class="menu">
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-list text-yellow"></i> New tasks to evaluate
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-list text-green"></i> New tasks to verify
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-red"></i> Evaluation from evaluator
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-red"></i> Remarks from verificator
                    </a>
                  </li> -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('name') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('name') ?> - <?php echo $this->session->userdata('unit') ?>
                  <small><?php echo $this->session->userdata('ac_type') ?> - <?php echo $this->session->userdata('resp') ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('index.php/dashboard/edit_signature'); ?>" class="btn btn-default btn-flat">Edit Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('index.php/login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
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
          <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name') ?> - <?php echo $this->session->userdata('unit') ?> <br>
          </p>
          <a href="#"><?php echo $this->session->userdata('ac_type') ?> - <?php echo $this->session->userdata('resp') ?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> -->
        <li class="active"><a href="<?php echo base_url('index.php'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php 
          if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2)
          {
        ?>
          <li><a href="<?php echo base_url('index.php/assignment'); ?>"><i class="fa fa-user"></i> <span>Assign Task</span></a></li>
          <li><a href="<?php echo base_url('index.php/crud_user'); ?>"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <?php  
          }
        ?>
        <?php 
          if($this->session->userdata('role') == 3 || $this->session->userdata('role') == 4)
          {
        ?>
        <li><a href="<?php echo base_url('index.php/user'); ?>"><i class="fa fa-list"></i> <span>MP Tasks</span></a></li>
        <?php  
          }
        ?>
        <li><a href="<?php echo base_url('index.php/summary'); ?>"><i class="fa fa-file"></i> <span>Summary</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- <div class="content-wrapper">
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Well done!</h4>
      <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
      <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </div>
  </div> -->
  <?php $this->load->view($container) ?>
  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://gmf-aeroasia.co.id">PT GMF AeroAsia Tbk</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-functions.js"></script>

    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase.js"></script>
    <script>
        var config = {
            apiKey: "AIzaSyB8avx1GZWHo1QdXlBrs-PQ5cYtpYaneRg",
            authDomain: "mpperformance-3931b.firebaseapp.com",  
            databaseURL: "https://mpperformance-3931b.firebaseio.com",
            projectId: "mpperformance-3931b",
            storageBucket: "mpperformance-3931b.appspot.com",
            messagingSenderId: "282707331130"
          };
          firebase.initializeApp(config);
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                //alert("Notification permission granted.");

                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token_post) {
                var id_user_post = <?php echo $this->session->userdata('id_user'); ?>;
                //alert(id_user_post + " + " + token_post);
                $.ajax({
                  url: '<?php echo base_url("index.php/notifications/notifications_token"); ?>',
                  type: 'POST',
                  data: { id_user: id_user_post,
                          token: token_post},
                  success:function(data){  
                           //alert("MANTAP BETUL");
                      }
                });
            })
            .catch(function (err) {
                $.notify("Unable to get permission to notify.", "error");
            });

        messaging.onMessage(function(payload) {
            console.log("Message received. ", payload['notification']['body']); 
            $.notify(payload['notification']['body'], "info");
            var id = <?php echo $this->session->userdata('id_user'); ?>;
            $.ajax({
                    url: '<?php echo base_url("index.php/notifications/get_notifications"); ?>',
                    type: 'POST',
                    data: { id_user: id},
                    success:function(data){  
                             var list = JSON.parse(data);
                             $( "#notif_list" ).empty();
                             if(list.length > 0)
                             {
                                $("#notif_count").text(list.length);
                             }
                             $("#list_header").text("You have "+ list.length +" notifications");
                             for( var i = 0; i < list.length; i++ )
                             { 
                                 var temp = list[i];
                                 $( "#notif_list" ).append('<li><a onClick="readNotif('+temp.id_notif_his+');" href="<?php echo base_url(); ?>/'+ temp.src_notif +'"><i class="fa fa-list text-blue"></i>'+ temp.notif_message +'</a></li>');
                             } 
                        }  
                  });
            //di halaman evaluator
            //$.notify("You've got remarks from verificator", "warn");
            //di halaman verificator
            //$.notify("The remarks has been evaluated by ...", "success");
            //di halaman verificator/evaluator
            //$.notify("You have new tasks to evaluate", "info");
        });
    </script>
<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?=base_url()?>assets/js/raphael.min.js"></script>
<script src="<?=base_url()?>assets/js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>assets/js/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url()?>assets/js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>assets/js/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>assets/js/moment.min.js"></script>
<script src="<?=base_url()?>assets/js/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.min.js"></script>
<!-- date-range-picker -->
<script src="<?=base_url()?>assets/js/moment.min.js"></script>
<script src="<?=base_url()?>assets/js/daterangepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>assets/js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>assets/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap Notify -->
<script src="<?=base_url()?>assets/js/bootstrap-notify.js"></script>
<!-- Notification -->
<script src="<?=base_url()?>assets/js/notify.js"></script>
<!-- Waves -->
<script src="<?=base_url()?>assets/js/waves.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Date Range Picker -->
<script>
  $(function() {
    $('#reservation').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

  });
</script>

<script>
$(document).ready(function() {
  //console.log('asdadasdd');
  var id = <?php echo $this->session->userdata('id_user'); ?>;
  $.ajax({
          url: '<?php echo base_url("index.php/notifications/get_notifications"); ?>',
          type: 'POST',
          data: { id_user: id},
          success:function(data){  
                   var list = JSON.parse(data);
                   if(list.length > 0)
                   {
                      $("#notif_count").text(list.length);
                   }
                   $("#list_header").text("You have "+ list.length +" notifications");
                   for( var i = 0; i < list.length; i++ )
                   { 
                       var temp = list[i];
                       $( "#notif_list" ).append('<li><a onClick="readNotif('+temp.id_notif_his+');" href="<?php echo base_url(); ?>/'+ temp.src_notif +'"><i class="fa fa-list text-blue"></i>'+ temp.notif_message +'</a></li>');
                   } 
              }  
        });
});
</script>
<script>
  function readNotif($id){
    var id = $id;
      $.ajax({
          url: '<?php echo base_url("index.php/notifications/read_notif"); ?>',
          type: 'POST',
          data: { id_notif_his : id},
          success:function(data){
              }  
        });
  }

  //Active Tree
  var url = window.location;
  // for sidebar menu but not for treeview submenu
  $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
  }).parent().siblings().removeClass('active').end().addClass('active');
  // for treeview which is like a submenu
  $('ul.treeview-menu a').filter(function() {
      return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active').end().addClass('active');
</script>
<script>
  $(function () {
    // $('#example1').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })  
  })
</script>
<script>
  $(function () {
    // $('#example1').DataTable()
    $('#summary_table').DataTable({
      'scrollX'     : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })  
  })
</script>
</body>
</html>
