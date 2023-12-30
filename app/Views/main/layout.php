<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TravelIN Aja </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- notifikasi sukses keren sweeet alert -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.css">
    <script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- logo html -->
    <link rel="icon" href="/dist/img/logo2.png">


</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->


                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-info sidebar-no-expand">
            <!-- Brand Logo -->
            <a href="<?= base_url('main/index') ?>" class="brand-link">
                <center> <img src="<?= base_url() ?>/dist/img/travelinjalogo.png" style="height: 60px;"></center>


            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-3"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><b><?= session()->namauser ?></b>
                            <br><small><?= session()->iduser ?></small></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column  nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <!-- memanggil side bar di setiap view -->

                        <?php if (session()->idlevel == 1) : ?>

                        <li class="nav-item ">
                            <a href="<?= base_url('main/index') ?>" class="nav-link " id="home">
                                <i class="nav-icon fas fa-home  "></i>
                                <p>
                                    <b>HOME</b>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item " id="master2">
                            <a href="#" class="nav-link  " id="master">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <b>MASTER</b>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="<?= base_url('pelanggan/index'); ?>" class="nav-link" id="konsumen">
                                        <i class="fas fa-users nav-icon "></i>
                                        <p><b>PELANGGAN/USER</b></p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('Pihaktravel/index'); ?>" class="nav-link " id="pihaktravel">
                                        <i class="fas fa-weight nav-icon "></i>
                                        <p><b>TRAVEL</b></p>
                                    </a>
                                </li>



                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('Transaksi/viewdata'); ?>" class="nav-link " id="transaksi">
                                <i class="fas fa-shopping-cart nav-icon "></i>
                                <p><b>TRANSAKSI TRAVEL</b></p>
                            </a>
                        </li>


                        <li class="nav-item ">
                            <a href="<?= base_url('laporan/index'); ?>" class="nav-link" id="laporan">
                                <i class="fas fa-file nav-icon "></i>
                                <p><b>LAPORAN</b></p>
                            </a>
                        </li>

                        <?php endif ?>
                        <?php if (session()->idlevel == 2) : ?>


                        <li class="nav-item ">
                            <a href="<?= base_url('main/index') ?>" class="nav-link " id="home">
                                <i class="nav-icon fas fa-home  "></i>
                                <p>
                                    <b>HOME</b>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item " id="master2">
                            <a href="#" class="nav-link  " id="master">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <b>MASTER</b>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">






                                <li class="nav-item">
                                    <a href="<?= base_url('Rute/index'); ?>" class="nav-link " id="satuan">
                                        <i class="fas fa-weight nav-icon "></i>
                                        <p><b>RUTE TRAVEL</b></p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= base_url('Jam/index'); ?>" class="nav-link " id="jadwal">
                                        <i class="fas fa-weight nav-icon "></i>
                                        <p><b>JADWAL TRAVEL</b></p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('PIhaktravel/viewdata'); ?>" class="nav-link " id="pesanansaya">
                                <i class="fas fa-shopping-cart nav-icon "></i>
                                <p><b>PESANAN TRAVEL</b></p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('PIhaktravel/viewbiayalayanan'); ?>" class="nav-link "
                                id="biayalayanan">
                                <i class="fas fa-shopping-cart nav-icon "></i>
                                <p><b>BIAYA lAYANAN</b></p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('laporan/index'); ?>" class="nav-link" id="laporan">
                                <i class="fas fa-file nav-icon "></i>
                                <p><b>LAPORAN</b></p>
                            </a>
                        </li>



                        <?php endif ?>

                        <?php if (session()->idlevel == 3) : ?>
                        <li class="nav-item ">
                            <a href="<?= base_url('main/index') ?>" class="nav-link " id="home">
                                <i class="nav-icon fas fa-home  "></i>
                                <p>
                                    <b>HOME</b>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('laporan/index'); ?>" class="nav-link" id="laporan">
                                <i class="fas fa-file nav-icon "></i>
                                <p><b>LAPORAN</b></p>
                            </a>
                        </li>

                        <?php endif ?>

                        <li class="nav-item ">
                            <a href="<?= base_url('login/keluar') ?>" class="nav-link" id="home">
                                <i class="nav-icon fas fa-sign-out-alt  "></i>
                                <p>
                                    <b>LOGOUT</b>
                                </p>
                            </a>
                        </li>

                </nav>
                <!-- /.sidebar-menu -->

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?= $this->renderSection('judul') ?>
                            </h1>
                        </div>
                        <div class="col-sm-6">

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $this->renderSection('subjudul') ?>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="isinya">
                        <?= $this->renderSection('isi') ?>
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer">
          BAGIAN BAWAH TABEL
        </div> -->
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.1.0
            </div>
            <strong>Copyright &copy; Febriatul Iqbal - 1910005
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>

</html>