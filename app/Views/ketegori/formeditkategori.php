<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>FORM EDIT KATEGORI
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
form_open('kategori/updatedata', '', [
  'idkategori' => $id
])
?>

<div class="form-group">
  <label for="namakategori">Nama Kategori </label>
  <?= form_input('namakategori', $nama, [
    'class' => 'form-conrol',
    'id' => 'namakategori',
    'autofocus' => true
  ])
  ?>
</div>
<?= session()->getFlashdata('errornama'); ?>

<br>
<div class="form-group">

  <?=
  form_submit(
    '',
    'UPDATE',
    [
      'class' => 'btn btn-success',
      'onclick' => "location.href=('" . site_url('kategori/index') . "')"
    ]
  )
  ?>

</div>

<script>
  $(document).ready(function() {
    $('#master').addClass('nav-link active');
    $('#kategori').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
  });
</script>


<?= $this->endSection('isi') ?>