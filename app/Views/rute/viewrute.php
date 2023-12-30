<?= $this->extend('main/layout') ?>


<?= $this->section('judul') ?>
<b>DATA RUTE</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-plus-square"></i> <b>TAMBAH DATA</b>', [
    'class' => 'btn btn-success',
    'onclick' => "location.href=('" . site_url('rute/formtambah') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<?= session()->getFlashdata('sukses'); ?>

<?= form_open('rute/index') ?>

<div class="input-group">
    <input type="text" class="form-control form-control-m" placeholder="CARI DATA RUTE" name="cari"
        value="<?= $cari; ?>" autofocus>
    <div class="input-group-append">
        <button type="submit" class="btn btn-m btn-primary" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<br>
<?= form_close() ?>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table  table-sm table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width:5%;"><b>No</b></th>
                    <th>
                        <center><b>RUTE (ASAL - TUJUAN)</b></center>
                    </th>
                    <th>
                        <center><b>NAMA TRAVEL</b></center>
                    </th>
                    <th>
                        <center><b>HARGA</b></center>
                    </th>
                    <th>
                        <center><b>MOBIL</b></center>
                    </th>
                    <th style="width: 20%">
                        <center><b>AKSI</b></center>
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1 + (($nohalaman - 1) * 5);
                foreach ($tampildata as $row) :
                ?>


                <?php if (session()->iduser ==  $row['idtravel']) : ?>

                <tr>
                    <td><?= $nomor++ ?></td>
                    <td>
                        <center><?= $row['asal_tujuan'] ?></center>
                    </td>
                    <td>
                        <center><?= $row['namapihaktravel'] ?></center>
                    </td>
                    <td>
                        <center><?= $row['mobil'] ?></center>
                    </td>
                    <td>
                        <center> Rp. <?= number_format($row['harga'], 0) ?> </center>
                    </td>
                    <td style="width: 10%">
                        <center>
                            <button type="button" class="btn btn-sm btn-info" title="EDIT DATA"
                                onclick="edit('<?= $row['idrute'] ?>')">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button type="button" class="btn  btn-sm btn-danger"
                                onclick="hapus('<?= $row['idrute'] ?>')">
                                <i class="fa fa-trash-alt"></i>
                            </button>

                        </center>

                    </td>
                </tr>
                <?php endif ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="float-center">
    <?= $pager->links('rute', 'paging'); ?>
</div>

<script>
function edit(id) {
    window.location = ('/rute/formedit/' + id);
}

function hapus(id) {
    Swal.fire({
        title: 'Hapus Transaksi',
        text: "Yakin Menghapus Transaksi ini..?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/rute/hapus",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {

                    if (response.sukses) {

                        let timerInterval
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'ITEM BERHASIL DIHAPUS',
                            html: 'Otomatis Tertutup Dalam <b></b> milliseconds.',
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */

                            window.location.reload();
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')

                            }
                        })

                    }


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });




        }
    });
}
</script>

<script>
$(document).ready(function() {
    $('#master').addClass('nav-link active');
    $('#rute').addClass('nav-link active');
    $('#master2').addClass('menu-is-opening menu-open');
});
</script>





<?= $this->endSection('isi') ?>