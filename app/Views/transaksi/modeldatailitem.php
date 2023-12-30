<!-- Modal -->
<div class="modal fade" id="modelitem" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header ">
        <h5 class="modal-title" id="staticBackdropLabel"><b>DETAIL ITEM</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body p-0">
          <table class="table table-striped ">
            <thead>
              <tr>
                <th style="width: 5%"><b>NO</b></th>
                <th><center><b>JENIS CUCIAN</b></th>
                <th><center><b>HARGA</b></th>
                <th><center><b>JUMLAH</b></th>
                <th><center><b>SUB. TOTAL </b></th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor = 1;
              foreach ($tampildatadetail->getResultArray() as $row) :
              ?>

                <tr>
                  <td>
                    <center>
                      <?= $nomor++; ?>
                  </td>
                  </center>
                  <td>
                    <center><b><?= $row['namajeniscucian']; ?></b>
                  </td>
                  <td>
                    <center><b><?= $row['hargajc']; ?></b>
                  </td>
                  <td>
                    <center><?= $row['detberat_jumlah']; ?>
                  </td>
                  <td style="text-align: right;">
                    <center>
                      Rp.<?= number_format($row['dettotalharga'], 0, ",", "."); ?>
                    </center>
                  </td>

                  <!-- <td>
                    <center>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusitem('<?= $row['iddetail'] ?>')">
                        <i class="fa fa-trash-alt"></i>
                      </button>


                    </center>
                  </td> -->
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info" title="EDIT TRANSAKSI" onclick="edit('<?= sha1($row['detfaktur'])  ?>')">
          <i class="fa fa-edit"> </i>EDIT
        </button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times-circle"> </i>TUTUP</button>

      </div>
    </div>
  </div>
</div>