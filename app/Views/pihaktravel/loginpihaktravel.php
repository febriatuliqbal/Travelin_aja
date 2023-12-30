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
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">HAI <b>TRAVEL</b> SILAHKAN MASUKAN USER DAN PASWORD </p>

                <?= form_open('login/cekusertravel'); ?>
                <?= csrf_field(); ?>

                <div class="input-group mb-3">
                    <?php

                    // if (session()->getFlashdata('errIdUser')) {
                    //     $isInvaliduser = 'is-invalid';
                    // } else {
                    //     $isInvaliduser = '';
                    // }

                    //bisa pakai salah satu atas atau bawah fungsi sama

                    $isInvaliduser = (session()->getFlashdata('errIdUser')) ? 'is-invalid' : '';
                    ?>

                    <input type="text" name="iduser" placeholder="MASUKAN ID USER ANDA "
                        class="form-control  <?= $isInvaliduser ?> " autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <?php

                    if (session()->getFlashdata('errIdUser')) {
                        echo ' <div id="validationServer03Feedback" class="invalid-feedback">
                            ' . session()->getFlashdata('errIdUser') . '
                        </div>';
                    } else {
                        $isInvaliduser = '';
                    }

                    ?>

                </div>

                <div class="input-group mb-3">
                    <?php

                    // if (session()->getFlashdata('errIdUser')) {
                    //     $isInvalidpass = 'is-invalid';
                    // } else {
                    //     $isInvalidpass = '';
                    // }

                    //bisa pakai salah satu atas atau bawah fungsi sama

                    $isInvalidpass = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';
                    ?>

                    <input type="password" name="pass" placeholder="MASUKAN PASSWORD ANDA"
                        class="form-control  <?= $isInvalidpass ?> " autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <?php

                    if (session()->getFlashdata('errPassword')) {
                        echo ' <div id="validationServer03Feedback" class="invalid-feedback">
                            ' . session()->getFlashdata('errPassword') . '
                        </div>';
                    } else {
                        $isInvalidpass = '';
                    }

                    ?>

                </div>



                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-block btn-info"><b>MASUK</b></button>
                </div>


                <p class="mb-0">
                    Belum punya akun <b><a href="<?= base_url('login/daftratravel') ?>" class="text-center">Daftar
                            disini</a></b>
                </p>

                <p class="mb-0">
                    Login Sebagai <b><a href="<?= base_url('login/index') ?>" class="text-center">Admin</a></b>
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