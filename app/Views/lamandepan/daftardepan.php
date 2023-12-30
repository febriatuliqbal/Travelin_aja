<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Masuk</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- logo html -->
    <link rel="icon" href="/dist/img/logo.png">

</head>

<body class="hold-transition login-page" background="<?= base_url() ?>/dist/img/TRAVEL.jpg">

    <div class="login-box">
        <div class="login-logo">
            <a href=""><img src="<?= base_url() ?>/dist/img/travelinjalogo.png" height="100px"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card ">
            <div class="card-body login-card-body">
                <center>
                    <h2>DAFTAR</h2>
                </center>
                <p class="login-box-msg">SILAHKAN ISI DATA DATA DI BAWAH </p>

                <?= form_open('login/simpandaftar'); ?>
                <?= csrf_field(); ?>

                <div class="input-group mb-4">

                    <input type="text" name="usernamepelanggan" placeholder="MASUKAN USERNAME ANDA "
                        class="form-control  " autofocus required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>


                </div>

                <div class="input-group mb-4">

                    <input type="text" name="namapelanggan" placeholder="MASUKAN NAMA ANDA " class="form-control  "
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">

                        </div>
                    </div>


                </div>

                <div class="input-group mb-4">

                    <input type="text" name="nohp" placeholder="MASUKAN NO HP ANDA " class="form-control  " required>
                    <div class="input-group-append">
                        <div class="input-group-text">

                        </div>
                    </div>


                </div>

                <div class="input-group mb-4">

                    <input type="text" name="alamat" placeholder="MASUKAN ALAMAT ANDA " class="form-control  " required>
                    <div class="input-group-append">
                        <div class="input-group-text">

                        </div>
                    </div>


                </div>

                <div class="input-group mb-4">


                    <input type="password" name="password" placeholder="MASUKAN PASSWORD ANDA" class="form-control   "
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>


                </div>

                <div class="input-group mb-4">


                    <input type="password" name="password2" placeholder="KONFIRMASI PASSWORD ANDA"
                        class="form-control   " required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>


                </div>



                <div class="input-group mb-4">
                    <button type="submit" class="btn btn-block btn-info"><b>DAFTAR</b></button>
                </div>


                <p class="mb-0">
                    Sudah punya akun <b><a href="login" class="text-center">Masuk disini</a></b>
                </p>

                <p class="mb-0">
                    Login Sebagai <b><a href="index" class="text-center">Admin</a></b>
                </p>


                <?= form_close(); ?>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
</body>

</html>