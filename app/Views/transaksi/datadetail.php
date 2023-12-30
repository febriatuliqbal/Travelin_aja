<table class="table table-sm ">
    <tr>
        <td width="60%"></td>

        <th>TOTAL</th>
        <td>
            <center>
                <b>
                    <h4>
                        Rp. <?= number_format($total, 0, ",", "."); ?>
                </b>
                <input type="hidden" id="totalharga" value="<?= $total ?>">
        </td>
        </center>
    </tr>
</table>


<table class="table table-striped table-sm table-striped table-hover">
    <thead>
        <tr>
            <th>
                <center>NO</center>
            </th>
            <th>
                <center>JENIS CUCIAN</center>
            </th>
            <th>
                <center>HRAGA+PAKET</center>
            </th>
            <th>
                <center>BERAT/JUMLAH</center>
            </th>
            <th>
                <center>TOTAL HARGA</center>
            </th>
            <th>
                <center>AKSI</center>
            </th>


        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach ($datatemp->getResultArray() as $row) :
        ?>
            <tr>
                <td>
                    <center>
                        <?= $nomor++; ?>
                </td>
                </center>
                <td>
                    <center><b><?= $row['namajeniscucian']; ?> </b>
                </td>
                <td>
                    <center><b><?= $row['det_harga'] + $row['detharga_tambahan']; ?> </b>
                </td>
                <td>
                    <center><?= $row['detberat_jumlah']; ?>
                </td>
                <td style="text-align: right;">
                    <center>
                        Rp.<?= number_format($row['dettotalharga'], 0, ",", "."); ?>
                    </center>
                </td>

                <td>
                    <center>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusitem('<?= $row['iddetail'] ?>')">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info" onclick="edititem('<?= $row['iddetail'] ?>')">
                            <i class="fa fa-edit"></i>
                        </button>


                    </center>
                </td>
            </tr>
        <?php endforeach; ?>


    </tbody>
</table>


<script>
    function edititem(id) {

        $('#iddetail').val(id);

        $.ajax({
            type: "post",
            url: "/transaksi/editItem",
            data: {
                iddetail: $('#iddetail').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {


                    let data = response.sukses;
                    $('#berat').val(data.berat);
                    $('#jeniscucian').val(data.jeniscucian);
                    $('#hargacucian').val(data.det_harga);
                    $('#realhargacucian').val(data.det_harga);

                    $('#tombiledititem').fadeIn();
                    $('#tombolreload').fadeIn();
                    $('#tomboltambahtem').fadeOut();


                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });

    }

    function hapusitem(id) {
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
                    url: "/transaksi/hapusdatadetail",
                    data: {
                        id: id,
                        faktur: $('#faktur').val(),
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