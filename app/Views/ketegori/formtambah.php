<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM TAMBAH KATEGORI
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
  'class' => 'btn btn-warning',
  'onclick' => "location.href=('" . site_url('kategori/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<?=
form_open('kategori/simpandata')
?>
<div class="form-group">
  <label for="namakategori">Nama Kategori </label>
  <?= form_input('namakategori', '', [
    'class' => 'form-control',
    'id' => 'namakategori',
    'autofocus' => true,
    'placeholder' => 'Isi Nama Kategori'
  ])
  ?>
</div>
<?= session()->getFlashdata('errornama'); ?>

<br>
<div class="form-group">

  <?=
  form_submit(
    '',
    'SIMPAN',
    [
      'class' => 'btn btn-success',
      'onclick' => "location.href=('" . site_url('kategori/index') . "')"
    ]
  )
  ?>

</div>




<?= $this->endSection('isi') ?>