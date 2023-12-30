<?= $this->extend('main/layout') ?>


<?= $this->section('judul') ?>
<b>MANAJAEMEN DATA JENIS CUCIAN</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-plus-square"></i> <b>TAMBAH JENIS CUCIAN</b>', [
  'class' => 'btn btn-success',
  'onclick' => "location.href=('" . site_url('Jeniscucian/tambah') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>

<!-- CARI DATA -->

<?= form_open('Jeniscucian/index') ?>
<div class="input-group">
  <input type="text" class="form-control form-control-lg" placeholder="CARI DATA JENIS CUCIAN" name="cari" autofocus>
  <div class="input-group-append">
    <button type="submit" class="btn btn-lg btn-primary" id="tombolcari" name="tombolcari">
      <i class="fa fa-search"></i>
    </button>
  </div>
</div>
<?= form_close() ?>

<br>
<!-- CARI DATA -->
Total Data : <span class="badge badge-success"> <h7><?= $totaldata ?></h7></span>
<br>

<?= session()->getFlashdata('sukses'); ?>
<?= session()->getFlashdata('erorupdate'); ?>
<div class="card">
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table class="table table-striped ">
      <thead>
        <tr>
          <th style="width: 5%"><b>NO</b></th>          
          <th><b>NAMA PAKET </b></th>
          <th><b>SATUAN </b></th>
          <th><b>HARGA </b></th>  
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
            <td><b><?= $row['namajeniscucian'] ?></b></td>
            <td><?= $row['namasatuan'] ?></td>           
            <td>Rp. <?= number_format($row['hargajc'], 0) ?></td>
         
            <td style="width:20%">
              <center>
                <button type="button" class="btn btn-info" title="EDIT DATA" onclick="edit('<?= $row['kdjeniscucian'] ?>')">
                  <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn  btn-danger" onclick="hapus('<?= $row['kdjeniscucian'] ?>')">
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

<div class="float-center">
  <?= $pager->links('barang', 'paging'); ?>
</div>

<script>
  function edit(id) {
    window.location = ('/Jeniscucian/edit/' + id);
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
          url: "/Jeniscucian/hapus",
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
    $('#master2').addClass('menu-is-opening menu-open');
    
    $('#jenis').addClass('nav-link active');
  });
</script>


<?= $this->endSection('isi') ?>