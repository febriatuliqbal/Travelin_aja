<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>FORM TAMBAH TRAVEL
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('rute/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('Pihaktravel/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="card-body">



    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">USERNAME </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="username" name="username" placeholder="" autofocus>

        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">PASWORD</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="pass" name="pass">
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NAMA</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="nama" name="nama">
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">ALAMAT</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NO HP</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="nohp" name="nohp">
        </div>
    </div>





    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-6">
            <input type="submit" value="Simpan" class="btn btn-success">
        </div>
    </div>




    <?= form_close() ?>
</div>
<script>
$(document).ready(function() {
    $('#master').addClass('nav-link active');
    $('#pihaktravel').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
});
</script>



<?= $this->endSection('isi') ?>