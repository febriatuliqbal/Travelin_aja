<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CETAK STRUK BERANG KELUAR</title>
</head>

<body onload="window.print();">
    <table border="0" style="text-align: center; width: 100%;">
        <tr>
            <td colspan="3">
                <h2 style="height: 2px;">TRAVELIN AJA</h2>
                <small style="height: 2px;"> Jl. Dr. Wahidini No 17 Padang</small>
                <hr style="border: none;border-top: 2px solid #000;">


            </td>
        </tr>
        <tr style="text-align: left;">
            <td>FAKTUR</td>
            <td>:</td>
            <td><?= $faktur ?></td>
        </tr>
        <tr style="text-align: left;">
            <td>TANGGAL</td>
            <td>:</td>
            <td><?= date('d-m-Y', strtotime($tanggal)) ?></td>
        </tr>
        <tr style="text-align: left;">
            <td>PELANGGAN</td>
            <td>:</td>
            <td><?= $namapelanggan ?></td>
        </tr>

        <tr style="text-align: left;">
            <td>RUTE</td>
            <td>:</td>
            <td><?= $namapaket ?></td>
        </tr>


        <tr>
            <td colspan="3">
                <hr style="border: none;border-top: 2px dashed #000;">
            </td>
        </tr>

        <tr style="text-align: right;">
            <td></td>
            <td></td>
            <td>
                <b> Total Harga : Rp. <?= number_format($total, 0, ",", ".") ?></b>
            </td>
        </tr>
        <tr style="text-align: right;">
            <td></td>
            <td></td>
            <td>
                Jumlah Uang : Rp.<?= number_format($jumlahuang, 0, ",", ".") ?>
            </td>
        </tr>
        <tr style="text-align: right;">
            <td></td>
            <td></td>
            <td>
                Kembali : Rp.<?= number_format($sisauang, 0, ",", ".") ?>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr style="border: none;border-top: 2px dashed #000;">
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <h5>---TERIMA KASIH ATAS KUNJUNGAN ANDA---</h5>

            </td>
        </tr>

    </table>

</body>

</html>