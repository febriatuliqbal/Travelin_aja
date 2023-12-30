<?= $this->extend('lamandepan/layout') ?>
<?= $this->section('isi') ?>

<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
                    </ol>
                </nav>
                <h5>Pesanan Saya</h5>
                <br>
                <h7>Daftar pesanan saya</h7>

            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="row">

    </div>
    <div class="rows">
        <div class="cart-items">
            <div class="header">
                <!-- <div class="image">
                    <b>Gambar</b>
                </div>
                <div class="name">
                    <b>Keterangan Pesanan</b>
                </div>
                <div class="price">
                    <b>Biaya</b>
                </div> -->


            </div>
            <div class="body">

                <?php foreach ($datapesanan as $row) : ?>

                <?php if ($row['idpelanggan'] == session()->iduser) : ?>

                <div class="item">
                    <div class="image">
                        <img src="<?= base_url() ?>/depan/dist/images/product/03.jpg">
                    </div>
                    <div class="name">
                        <div class="name-text">
                            <h2>
                                <?= $row['asal_tujuan'] ?>
                            </h2>
                            <h5>
                                <?= $row['namapihaktravel'] ?> <small>| HP : <a
                                        href="https://api.whatsapp.com/send/?phone=<?= $row['telppihaktravel'] ?>&text&type=phone_number&app_absent=0"><?= $row['telppihaktravel'] ?></a>
                                </small>
                            </h5>
                            <h5>


                                <p><?= $row['tgl'] ?> | JAM : <?= $row['jam'] ?>
                            </h5>
                            <h5>
                                <br> <?= $row['faktur'] ?>
                            </h5>

                            <h6>
                                <br> <?= $row['status'] ?>
                            </h6>
                        </div>

                    </div>
                    <div class="price">
                        <del>Rp. 150.000</del>
                        <br><span>Rp.
                            <?= number_format($row['total'], 0, ",", ".") ?></span>
                        <br><br><br>



                        <?php if ($row['status'] == 'Pesanan Dikirim') : ?>

                        <button type="button" class="btn  btn-info" style="background-color: orangered;"
                            title="EDIT DATA" onclick="edit('<?= $row['faktur'] ?>')">
                            Batalkan
                        </button>

                        <?php elseif ($row['status'] == 'Pesanan Selesai') : ?>

                        <a style="color: orangered;" onclick="krimulasan('<?= $row['idrute'] ?>')">
                            > Kirim Ulasan
                        </a>



                        <?php else : ?>

                        <button type="button" class="btn  btn-info" style="background-color: orangered;"
                            title="EDIT DATA" onclick="edit('<?= $row['faktur'] ?>')" disabled>
                            Batalkan
                        </button>

                        <?php endif; ?>



                    </div>
                </div>

                <?php else : ?>

                <?php endif; ?>

                <?php endforeach; ?>


            </div>
        </div>
    </div>
    <div class="row">

        <br>
    </div>
</div>

<!-- jQuery untuk perintah ajax dan json -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>


<script>
function edit(id) {
    window.location = ('/lamandepan/batalkan/' + id);
}

function krimulasan(id) {
    window.location = ('/lamandepan/krimulasan/' + id);
}

$(document).ready(function() {
    $('#kontak').addClass("active");
    $('#home').removeClass("active");
});
</script>

<?= $this->endsection('isi') ?>