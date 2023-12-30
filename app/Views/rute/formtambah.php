<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>FORM TAMBAH RUTE
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('rute/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('rute/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="card-body">



    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">RUTE </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="asal" name="asal" placeholder="" required>
            <small>Tulis dalam format "ASAL - TUJUAN" contoh : SOLOK - PADANG</small>
        </div>
    </div>




    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">HARGA</label>
        <div class="col-sm-6">
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
    </div>


    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">MOBIL</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="mobil" name="mobil" required>
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
    $('#satuan').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
});
</script>



<?= $this->endSection('isi') ?>