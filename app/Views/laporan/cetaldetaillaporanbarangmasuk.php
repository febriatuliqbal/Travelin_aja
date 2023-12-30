<!DOCTYPE html>
<html lang="en">
<link rel="icon" href="<?= base_url() ?>/dist/img/aplikasigudang.png">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN DETAIL TRANSAKSI</title>
</head>

<body onload="window.print();">
    <table style="width: 100%; border-collapse: collapse; text-align: center;" border="1">
        <tr>
            <td>
                <h1>APLIKASi TRAVEL</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h3 style="height: 1px;"><u>LAPORAN DETAIL TRANSAKSI</u></h3>
                <p>
                <p>
                    <i>
                        <h5>Periode : <?= $tglawal ?> s/d. <?= $tglakhir ?></h5>
                    </i>
            </td>
        </tr>

        <tr>
            <td>
                <p></p>
                <center>
                    <table border="1"
                        style="border-collapse: collapse; border: 0px solid #000; text-align: center; width: 80%;"
                        cellpadding="5">
                        <thead>
                            <tr style="background: yellow;">
                                <th>NO</th>
                                <th>NO FAKTUR</th>
                                <th>NAMA PELANGGAN</th>
                                <th>PAKET</th>
                                <th>TANGGAL</th>
                                <th colspan="">TOTAL HARGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            $totalseluruhharga = 0;
                            foreach ($datalaporan->getResultArray() as $row) :
                                $totalseluruhharga += $row['total'];
                            ?>
                            <tr style="background: #E7E7E6;">
                                <td>
                                    <?= $nomor++; ?>
                                </td>
                                <td> <b><?= $row['faktur'] ?></b></td>
                                <td> <b><?= $row['namapelanggan'] ?></b></td>
                                <td> <b><?= $row['namapaket'] ?></b></td>
                                <td><?= $row['tgl'] ?></td>
                                <td style="text-align: center;"> Rp.<?= number_format($row['total'], 0, ",", ".") ?>
                                </td>
                            </tr>

                            <thead>
                                <th>DETAIL BARANG</th>
                                <th>JENIS CUCIAN</th>
                                <th colspan="2">HARGA+PAKET</th>
                                <th>JUMLAH</th>
                                <th>TOTAL</th>
                            </thead>

                            <?php

                                foreach ($datadetail->getResultArray() as $rew) :
                                ?>

                            <?php if ($row['faktur'] == $rew['detfaktur']) : ?>
                            <tr>
                                <td> - </td>
                                <td><?= $rew['namajeniscucian'] ?> </td>
                                <td colspan="2">Rp.
                                    <?= number_format($rew['det_harga'] + $rew['detharga_tambahan'], 0, ",", ".") ?>
                                </td>
                                <td><?= $rew['detberat_jumlah'] ?> </td>
                                <td colspan="2">Rp.<?= number_format($rew['dettotalharga'], 0, ",", ".") ?> </td>
                            </tr>
                            <?php else : ?>

                            <?php endif; ?>
                            <?php endforeach; ?>

        </tr>

        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #DCEBF8;">
                <th colspan="4">
                    TOTAL SELURUH HARGA
                </th>
                <th colspan="2">
                    Rp.<?= number_format($totalseluruhharga, 0, ",", ".") ?>
                </th>
            </tr>
        </tfoot>
    </table>
    </center>
    <p></p>
    </td>
    </tr>
    </table>

</body>

<script>
$(document).ready(function() {
    $('#faktur').val('tayo');

});
</script>

</html>