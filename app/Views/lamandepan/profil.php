<?= $this->extend('lamandepan/layout') ?>

<?= $this->section('isi') ?>

<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>


                <br>




                <h5>Profil</h5>

                <?= session()->getFlashdata('error'); ?>
                <?= session()->getFlashdata('sukses'); ?>
                <?= session()->getFlashdata('erorupdate'); ?>




            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-8 order-2 order-lg-1">


            <?= form_open_multipart('lamandepan/updateprofil') ?>



            <form action="#">


                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input id="usenamepelanggan" name="usenamepelanggan" value="<?= session()->iduser ?>"
                                type="text" class="form__input" placeholder="
                                            " hidden>

                            <input style="color: black;" id="usenamepelanggan2" name="usenamepelanggan2"
                                value="<?= session()->iduser ?>" type="text" class="form__input" placeholder="
                                            " disabled>


                            <label for="" class="form__label">username</label>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input value="<?= session()->namauser ?>" type="text" id="namapelanggan"
                                name="namapelanggan" class="form__input" placeholder="
                                            " autofocus>
                            <label for="" class="form__label">Nama</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="form__div">
                            <input value="<?= session()->hppelanggan ?>" type="text" id="nohp" name="nohp"
                                class="form__input" placeholder="
                                            ">
                            <label for="" class="form__label">Nomor Handphone</label>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="form__div">
                            <input value="<?= session()->alamatpelannggan ?>" type="text" id="alamat" name="alamat"
                                class="form__input" placeholder="
                                            ">
                            <label for="" class="form__label">Alamat </label>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-2 col-md-4 col-12 mt-30">

                        <button id="hai" style="height: 50px;" class="btn  bg-primary mt-0"
                            type="submit">Simpan</button>
                    </div>


                </div>
            </form>

            <?= form_close() ?>
        </div>
    </div>


</div>
<br> <br>
<!-- jQuery untuk perintah ajax dan json -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>


<script>
$(document).ready(function() {
    $('#rutetravel').removeClass("active");
    $('#home').removeClass("active");
    $('#profil').addClass("active");

});
</script>




<?= $this->endsection('isi') ?>