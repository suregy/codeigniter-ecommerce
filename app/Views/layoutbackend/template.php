<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('admin/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/dist/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('customcss/mycss.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= base_url('admin/plugins/sweetalert2/sweetalert2.min.css') ?>">
    <script src="<?= base_url('admin/plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

    <!-- jQuery -->
    <script src="<?= base_url('admin/plugins/jquery/jquery.min.js') ?>"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('layoutbackend/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('layoutbackend/sidenav') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
            <!-- render section -->



            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark"> -->
        <!-- Control sidebar content goes here -->
        <!-- <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div> -->
        <!-- </aside> -->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="<?= base_url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('admin/dist/js/adminlte.min.js') ?>"></script>

    <script src=<?= base_url('admin/plugins/datatables/jquery.dataTables.js') ?> "></script>
<script src=<?= base_url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?> "></script>

    <!-- untuk general js -->
    <script type="text/javascript" src="<?= base_url('customjs/myjs.js') ?>"></script>

</body>

</html>