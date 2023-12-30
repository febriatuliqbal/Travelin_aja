<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>CETAK LAPORAN
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

SILAHKAN PILIH LAPORAN YANG INGIN DI CETAK

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>
<div class="row">
    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>LAPORAN <p>TRANSAKSI</h3>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('/laporan/cetakbarangmasuk'); ?>" class="small-box-footer">
                LAPORAN TRANSAKSI <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <?php if (session()->idlevel == 2) : ?>

    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>LAPORAN <p>BIAYA LAYANAN</h3>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('/laporan/cetakbiayalayanan'); ?>" class="small-box-footer">
                LAPORAN BIAYA LAYANAN OLEH TRAVEL<i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <?php endif ?>

    <?php if (session()->idlevel == 1) : ?>

    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>LAPORAN <p>BIAYA LAYANAN PER TRAVEL</h3>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('/laporan/cetakbiayalayananolehadmin'); ?>" class="small-box-footer">
                LAPORAN BIAYA LAYANAN OLEH ADMIN <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>LAPORAN <p>BIAYA LAYANAN SEMUA TRAVEL</h3>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('/laporan/cetakbiayalayananolehadminall'); ?>" class="small-box-footer">
                LAPORAN BIAYA LAYANAN OLEH ADMIN <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <?php endif ?>



</div>
<script>
$(document).ready(function() {

    $('#laporan').addClass('nav-link active');
});
</script>

<?= $this->endSection('isi') ?>