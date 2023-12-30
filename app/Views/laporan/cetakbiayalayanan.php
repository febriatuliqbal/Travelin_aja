<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPORAN BIAYA LAYANAN</title>
</head>

<body onload="window.print();">
    <table style="width: 100%; border-collapse: collapse; text-align: center;" border="1">
        <tr>
            <td>
                <h1>TRAVELIN AJA</h1>
                <br>
                <h2><?= session()->namauser ?></h2>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <h3 style="height: 1px;"><u>LAPORAN BIAYA LAYANAN</u></h3>
                <p>
                <p>
                <h5>Periode : <?= $tglawal ?> s/d. <?= $tglakhir ?></h5>
            </td>
        </tr>

        <tr>
            <td>
                <p></p>
                <center>
                    <table border="1"
                        style="border-collapse: collapse; border: 1px solid #000; text-align: center; width: 80%;"
                        cellpadding="5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Faktur</th>
                                <th>Nama Pelanggan</th>
                                <th>Travel</th>
                                <th>Tanggal</th>
                                <th>Biaya Layanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            $totalseluruhharga = 0;
                            foreach ($datalaporan->getResultArray() as $row) :
                                $totalseluruhharga += $row['biayalayanan'];
                            ?>
                            <tr>
                                <td>
                                    <?= $nomor++; ?>
                                </td>
                                <td><?= $row['faktur'] ?></td>
                                <td><?= $row['namapelanggan'] ?></td>
                                <td><?= $row['namapihaktravel'] ?></td>
                                <td><?= $row['tgl'] ?></td>
                                <td style="text-align: center;">
                                    Rp.<?= number_format($row['biayalayanan'], 0, ",", ".") ?>
                                </td>
                            </tr>

                            <?php endforeach; ?>
                            <tr>
                                <td>

                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td style="text-align: center;">
                                    Rp.<?= number_format($totalseluruhharga, 0, ",", ".") ?>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </center>
                <p></p>
            </td>
        </tr>
    </table>

</body>

</html>