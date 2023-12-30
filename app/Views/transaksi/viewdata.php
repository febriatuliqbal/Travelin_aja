<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>DATA TRANSAKSI PEMESANAN TRAVEL
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-success" onclick="location.href=('/transaksi/index')">
    <i class="fa fa-plus-square"></i> INPUT TRANSAKSI
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<div class="row">
    <div class="col">
        <label for="">FILTER DATA</label>

    </div>
    <div class="col">
        <input type="date" id="tglawal" name="tglawal" class="form-control">
    </div>
    <div class="col">
        <input type="date" id="tglakhir" name="tglakhir" class="form-control">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-block btn-primary" id="tomboltampil">TAMPILKAN</button>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for=""></label>
    </div>

</div>



<table id="dataPelanggan" class="table table-sm table-bordered table-striped table-hover  ">
    <thead>
        <tr>
            <th style="width: 5%">
                <b>NO</b>
            </th>
            <th>
                <center><b>FAKTUR</b></center>
            </th>
            <th>
                <center><b>TANGGAL</b></center>
            </th>
            <th>
                <center><b>NAMA PELANGGAN</b></center>
            </th>
            <th>
                <center><b>RUTE</b></center>
            </th>
            <th>
                <center><b>PAKET</b></center>
            </th>
            <th>
                <center><b>TOTAL HARGA</b></center>
            </th>
            <th>
                <center><b>STATUS</b></center>
            </th>
            <th>
                <center><b>AKSI</b></center>
            </th>

        </tr>
    </thead>
    <tbody>

    </tbody>

</table>


<script>
function listDatatransaksi() {
    var table = $('#dataPelanggan').DataTable({
        destroy: true,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "/transaksi/listDatatransaksi",
            "type": "POST",
            "data": {
                tglawal: $('#tglawal').val(),
                tglakhir: $('#tglakhir').val(),

            }
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }, ],
    });

}

function cetak(faktur) {

    let windowCetak = window.open('/transaksi/cetakfaktur/' + faktur, "CETAK FAKTUR BARANG KELUAR",
        "width=400px,height=600px");
    windowCetak.focus();
}

function HapusTransaksi(faktur) {
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
                url: "/transaksi/hapusTransaksi",
                data: {
                    faktur: faktur
                },
                dataType: "json",
                success: function(response) {

                    if (response.sukses) {

                        window.location.reload();


                        let timerInterval
                        Swal.fire({
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

function edit(faktur) {
    window.location.href = ('/transaksi/edit/') + faktur;
}

function ubah(faktur) {
    window.location.href = ('/transaksi/editstatus/') + faktur;
}




$(document).ready(function() {

    listDatatransaksi();

    $('#transaksi').addClass('nav-item menu-is-opening menu-open');
    $('#transaksi2').addClass('nnav-link active');
    $('#datatransaksi').addClass('nav-link active');
    $('#transaksi').addClass('nav-link active');

    $('#tomboltampil').click(function(e) {
        e.preventDefault();
        listDatatransaksi();


    });
});
</script>

<?= $this->endSection('isi') ?>