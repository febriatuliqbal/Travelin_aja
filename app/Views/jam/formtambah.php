<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>FORM TAMBAH JADWAL TRAVEL
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('jam/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<?= form_open_multipart('jam/simpandata') ?>
<?= session()->getFlashdata('error'); ?>
<?= session()->getFlashdata('sukses'); ?>
<div class="card-body">



    <div class="form-group row" hidden>
        <label for="text" class="col-sm-2 col-form-label">RUTE</label>
        <div class="col-sm-6">
            <select name="rute" id="rute" class="form-control select2 select2-danger select2-hidden-accessible"
                data-dropdown-css-class="select2-danger">
                <?php foreach ($datarute as $pak) : ?>
                <option value="<?= $pak['idrute'] ?>"><b><?= $pak['asal_tujuan'] ?></b></option>
                <?php endforeach; ?>
            </select require>

        </div>
    </div>

    <div class="form-group row" hidden>
        <label for="text" class="col-sm-2 col-form-label">TGL</label>
        <div class="col-sm-6">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" name="tgl"
                    id="tgl" value="<?= date('Y-m-d'); ?>">
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">JAM KEBERANGKATAN</label>
        <div class="col-sm-6">
            <input type="time" class="form-control" id="jam" name="jam" placeholder="" required>

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
    $('#jadwal').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
});
</script>



<?= $this->endSection('isi') ?>