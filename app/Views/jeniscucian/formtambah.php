<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM TAMBAH JENIS CUCIAN
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
  'class' => 'btn btn-warning',
  'onclick' => "location.href=('" . site_url('jeniscucian/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('Jeniscucian/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>

<div class="form-group row">
  <label for="text" class="col-sm-2 col-form-label">NAMA CUCIAN</label>
  <div class="col-sm-6">
    <input type="text" class="form-control" id="namabarang" name="namabarang" placeholder="NAMA CUCIAN">
  </div>
</div>


<div class="form-group row">
  <label for="text" class="col-sm-2 col-form-label">SATUAN</label>
  <div class="col-sm-6">
    <select name="satuan" id="satuan" class="form-control">
      <option value="">PILIH SATUAN</option>
      <?php foreach ($datasatuan as $sat) : ?>
        <option value="<?= $sat['kodesatuan'] ?>"><?= $sat['namasatuan'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="text" class="col-sm-2 col-form-label">HARGA CUCIAN</label>
  <div class="col-sm-6">
    <input type="number" class="form-control" id="hargabarang" name="hargabarang" placeholder="HARGA CUCIAN">
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
    $('#jenis').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
  });
</script>

<?= $this->endSection('isi') ?>