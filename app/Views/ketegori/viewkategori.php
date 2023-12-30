<?= $this->extend('main/layout') ?>



<?= $this->section('judul') ?>
<b>MANAJAEMEN DATA KATEGORI</b>

<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-plus-square"></i> <b>TAMBAH DATA</b>', [
  'class' => 'btn btn-success',
  'onclick' => "location.href=('" . site_url('kategori/formtambah') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<?= session()->getFlashdata('sukses'); ?>

<?= form_open('kategori/index') ?>

<div class="input-group">
    <input type="text" class="form-control form-control-lg" placeholder="CARI DATA KATEGORI" name="cari"
        value="<?= $cari; ?>" autofocus>
    <div class="input-group-append">
        <button type="submit" class="btn btn-lg btn-primary" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<br>
<?= form_close() ?>

<div class="card">
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%"><b>No</b></th>
                    <th><b>NAMA KATEGORI</b></th>
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

                <tr>
                    <td><?= $nomor++ ?></td>
                    <td><?= $row['katnama1910005'] ?></td>
                    <td style="width: 10%">
                        <center>
                            <button type="button" class="btn btn-info" title="EDIT DATA"
                                onclick="edit('<?= $row['katid1910005'] ?>')">
                                <i class="fa fa-edit"></i>
                            </button>

                            <form method="POST" action="/kategori/hapus/<?= $row['katid1910005'] ?>"
                                Style="display:inline" onsubmit="return hapus()">
                                <input type="hidden" value="DELETE" name="_method">
                                <button type="submit" class="btn btn-danger" title="HAPUS DATA">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>

                        </center>

                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<div class="float-center">
    <?= $pager->links('kategori', 'paging'); ?>
</div>

<script>
function edit(id) {
    window.location = ('/kategori/formedit/' + id);
}

function hapus(id) {
    pesan = confirm('YAKIN DATA ANDA MAU DI HAPUS ?..');
    if (pesan) {
        return true;
    } else {
        return false;
    }
}


function hapus(id) {
    Swal.fire({
        title: 'Hapus Item',
        text: "Yakin Menghapus Item ini..?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/barangmasuk/hapus",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {

                    if (response.sukses) {

                        dataTemp();

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
    })
}
</script>






<?= $this->endSection('isi') ?>