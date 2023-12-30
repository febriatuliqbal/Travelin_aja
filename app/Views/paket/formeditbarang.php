<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM EDIT PAKET
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
  'class' => 'btn btn-warning',
  'onclick' => "location.href=('" . site_url('Paket/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('Paket/updatedata', '', [
  'kodebarang' => $kode
]) ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<?= session()->getFlashdata('erorupdate'); ?>

<div class="card-body">

  <div class="form-group row">
    <label for="text" class="col-sm-2 col-form-label">NAMA BARANG</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="NAMA BARANG" value="<?= $namabarang ?>">
    </div>
  </div>


  <div class="form-group row">
    <label for="text" class="col-sm-2 col-form-label">HARGA BARANG</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" id="hargabarang" name="hargabarang" placeholder="HARGA BARANG" value="<?= $harga ?>">
    </div>
  </div>


  <div class="form-group row">
    <label for="text" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-6">
      <input type="submit" value="Simpan" class="btn btn-success">
    </div>
  </div>




  <?= form_close() ?>
  <script>
    $(document).ready(function() {
      $('#master').addClass('nav-link active');
      $('#paket').addClass('nav-link active');
      $('#master2').addClass('menu-is-opening menu-open');
    });
  </script>


  <?= $this->endSection('isi') ?>