<table class="table table-striped table-bordered">
    <thead>
        <th style="width: 5%"><b>NO</b></th>
        <th>
            <center><b>KODE KONSUMEN</b>
        </th>
        <th>
            <center><b>NAMA KONSUMEN </b>
        </th>
        <th>
            <center><b>ALAMAT </b>
        </th>
        <th>
            <center><b>NO HP </b>
        </th>
       
        <th>
            <center><b>AKSI</b></center>
        </th>

    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($tampildata->getResultArray() as $row) :
        ?>

            <tr>
                <td><center><?= $nomor++ ?></td>
                <td><center><b><?= $row['kodepelanggan'] ?></b></td>
                <td><center><b><?= $row['namapelanggan'] ?></b></td>
                <td><center><?= $row['alamatpelannggan'] ?></td>
                <td><center><?= $row['hppelanggan'] ?></td>
                
                

                <td style="width:20%">
                    <center>
                        <button type="button" class="btn btn-info btn-sm" title="PILIH" onclick="pilih('<?= $row['kodepelanggan'] ?>')">
                            PILIH
                        </button>

                    </center>

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>

</table>

<script>
    function pilih(kode) {
        $('#kodebarang').val(kode);
        $('#modalcaribarang').on('hidden.bs.modal', function(event) {
           ambildatabarang();
        })

        $('#modalcaribarang').modal('hide');

    }
</script>