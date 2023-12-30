<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM TAMBAH PELANGGAN/USER
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('pelanggan/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('pelanggan/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="card-body">

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">USERNAME PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="usernamepelanggan" name="usernamepelanggan"
                placeholder="USERNAME PELANGGAN">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NAMA PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="namapelanggan" name="namapelanggan"
                placeholder="NAMA PELANGGAN">
        </div>
    </div>



    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">ALAMAT PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="ALAMAT PELANGGAN">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NOMOR HP PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="NO HP PELANGGAN">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">PASSWORD</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">KONFIRMASI PASSWORD</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="password2" name="password2"
                placeholder="KONFIRMASI PASSWORD">
        </div>
    </div>



    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-6">
            <input type="submit" value="Simpan" class="btn btn-success">
        </div>
    </div>

</div>




<?= form_close() ?>

<script>
$(document).ready(function() {
    $('#master').addClass('nav-link active');
    $('#konsumen').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
});
</script>

<?= $this->endSection('isi') ?>