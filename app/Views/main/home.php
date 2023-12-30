<?= $this->extend('main/layout') ?>


<?= $this->section('judul') ?>
<b>Home</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<img src="<?= base_url() ?>/dist/img/gambardepan.png" style="width: 100%;">


<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>













<script>
$(document).ready(function() {
    $('#home').addClass('nav-link active');
    $('#isi').hide;


});
</script>

<?= $this->endSection('isi') ?>