<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Log In </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/jqvmap/jqvmap.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/dist/css/adminlte.min.css?v=3.2.0') ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('adminLTE/plugins/summernote/summernote-bs4.min.css')?>">
</head>
<body class="hold-transition login-page">
    
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Pengelolaan</b> Aset</a>
  </div>

  <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>


  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="login" action="<?= base_url('/login/auth') ?>" method="post">
        
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


    
<script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- jQuery UI 1.11.4 -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->

    <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script>
</body>
</html>
