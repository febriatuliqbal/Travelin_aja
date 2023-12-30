<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>DATA TRANSAKSI LAUNDRY
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<button type="button" class="btn btn-success" onclick="location.href=('/transaksi/index')">
    <i class="fa fa-plus-square"></i> INPUT TRANSAKSI
</button>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

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
        <button type="button" class="btn btn-block btn-primary" id="tomboltampil">TAMPILKAN</button>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for=""></label>
    </div>

</div>

<?= form_open('transaksi/viewdata') ?>
<?= "<span class=\"badge badge-success\">Total Data : $totaldata</span> " ?>
<div class="input-group mb-3">
    <input type="text" class="form-control form-control-lg" placeholder="CARI BEDASARKAN NO FAKTUR" name="cari" value="<?= $cari ?>" autofocus>
    <div class="input-group-append">
        <button type="submit" class="btn btn-lg btn-outline-primary" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close() ?>


<div class="card">
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-sm table-bordered table-striped table-hover  ">
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
                        <center><b>JUMLAH ITEM</b></center>
                    </th>
                    <th>
                        <center><b>TOTAL HARGA</b></center>
                    </th>
                    <th>
                        <center><b>AKSI</b></center>
                    </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1 + (($nohalaman - 1) * 10);
                foreach ($tampildata as $row) :
                ?>

                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td>
                            <center><b><?= $row['faktur'] ?></b>
                        </td>
                        <td>
                            <center><?= date('d-m-y', strtotime($row['tgl'])); ?>
                        </td>
                        <td>
                            <center><b><?= $row['namapelanggan'] ?></b>
                        </td>
                        <td width="10%">
                            <?php
                            $db = \config\Database::connect();
                            $jumlahItem = $db->table('detailtransaksi')->where('detfaktur', $row['faktur'])->countAllResults();
                            ?>
                            <center>
                                <button type="button" class="btn  btn-sm btn-circle btn-outline-info" title="EDIT TRANSAKSI" onclick="detailitem('<?= sha1($row['faktur']) ?>')">
                                    <b><?= $jumlahItem; ?></b> &nbsp &nbsp<i class="fa fa-chevron-circle-down"></i>
                                </button>
                            </center>

                        </td>
                        <td>
                            <center>Rp. <?= number_format($row['total'], 0, ",", ".") ?>
                        </td>


                        <td style="width:15%">
                            <center>
                                <button type="button" class="btn  btn-sm  btn-outline-info" title="EDIT TRANSAKSI" onclick="edit('<?= sha1($row['faktur'])  ?>')">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn  btn-sm  btn-outline-danger" title="HAPUS TRANSAKSI" onclick="HapusTransaksi('<?= sha1($row['faktur']) ?>')">
                                    <i class="fa fa-trash-alt"></i>
                                </button>




                            </center>

                        </td>
                    </tr>



                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- /.card-body -->
</div>

<div class="viewmodal" style="display: none;"></div>

<div class="float-center">
    <?= $pager->links('transaksi', 'paging'); ?>
</div>

<script>
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

    function edit(faktur) {
        window.location.href = ('/transaksi/edit/') + faktur;
    }

    function detailitem(faktur) {
        $.ajax({
            type: "post",
            url: "/transaksi/DetailItem",
            data: {
                faktur: faktur
            },
            dataType: "json",
            success: function(response) {

                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modelitem').modal('show');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    title: 'DATA ITEM KOSONG',
                    text: 'Apakah anda ingin MENGHAPUS/MENGEDIT DATA TRANSAKSI ini ?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'YA HAPUS',
                    cancelButtonText: 'EDIT'

                }).then((result) => {
                    if (result.isConfirmed) {
                        HapusTransaksi(faktur);
                    }
                })
            }
        });
    }

    $(document).ready(function() {
        $('#transaksi').addClass('nav-item menu-is-opening menu-open');
        $('#transaksi2').addClass('nnav-link active');
        $('#datatransaksi').addClass('nav-link active');
    });

    $(document).ready(function() {
        listDataBarangKeluar();

        $('#tomboltampil').click(function(e) {
            e.preventDefault();
            listDataBarangKeluar();
        });
    });
</script>

<?= $this->endSection('isi') ?>