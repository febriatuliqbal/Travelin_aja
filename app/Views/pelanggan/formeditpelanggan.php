<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM EDIT PELANGGAN
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
  'class' => 'btn btn-warning',
  'onclick' => "location.href=('" . site_url('pelanggan/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('pelanggan/updatedata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= session()->getFlashdata('erorupdate'); ?>

<div class="card-body">


    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">USERNAME PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="usenamepelanggan" name="usenamepelanggan"
                placeholder="USERNAME PELANGGAN" value="<?= $usenamepelanggan ?>" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NAMA PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="NAMA PELANGGAN"
                value="<?= $namapelanggan ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">ALAMAT PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="LAMAT PELANGGAN"
                value="<?= $alamat ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">NO HP PELANGGAN</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="nohp" name="nohp" placeholder="NO HP PELANGGAN"
                value="<?= $nohp ?>">
        </div>
    </div>


    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-6">
            <input type="submit" value="UPDATE" class="btn btn-success">
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