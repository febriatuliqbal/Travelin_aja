<?= $this->extend('lamandepan/layout') ?>
<?= $this->section('isi') ?>

<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rute Travel</li>
                    </ol>
                </nav>
                <h5>Rute Travel</h5>
                <br>
                <h6>Silahkan Pilih Rute Travel Rute Travel</h6>
            </div>
        </div>

        <section class="search">






            <?= form_open('lamandepan/listrute') ?>


            <div class="input-group">
                <input type="text" class="form-control form-control-lg" placeholder="CARI RUTE/NAMA TRAVEL" name="cari"
                    value="<?= $cari; ?>" autofocus>
                <a href="" style="color: white;"> as </a>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" id="tombolcari" style="height: 49px; "
                        name="tombolcari">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?= form_close() ?>




        </section>
    </div>




</section>






<div class="container">
    <div class="row">

    </div>
    <div class="rows">
        <div class="cart-items">
            <div class="header">
                <div class="image">
                    <b>Gambar</b>
                </div>
                <div class="name">
                    <b>Rute</b>
                </div>
                <div class="price">
                    <b>Biaya</b>
                </div>


            </div>
            <div class="body">

                <?php foreach ($datarute as $row) :
                    $ratarata = 0;



                ?>

                <?php if ($row['jumlahulasan'] == 0) : $ratarata = 0; ?>
                <?php else : $ratarata = doubleval($row['totalpointulasan']) / doubleval($row['jumlahulasan']) ?>
                <?php endif; ?>

                <div class="item">
                    <div class="image">
                        <img src="<?= base_url() ?>/depan/dist/images/product/03.jpg">
                    </div>
                    <div class="name">
                        <div class="name-text">
                            <h3>
                                <?= $row['asal_tujuan'] ?>
                            </h3>
                            <?= $row['namapihaktravel'] ?>
                            <br>
                            ✓ <?= $row['mobil'] ?>

                        </div>

                        <div class="icon-area">
                            <i class="far fa-check-circle"></i>
                            <?= $row['jumlahpesanan'] ?>x
                            <span>Perjalanan</span>
                        </div>
                        <div class="button" onclick="edit('<?= $row['idrute'] ?>')">
                            <a class="btn bg-primary">Pesan</a>

                        </div>
                    </div>
                    <div class="price">
                        <del>Rp. 150.000</del>
                        <br><span>Rp.
                            <?= number_format($row['harga'], 0, ",", ".") ?></span>

                        <br>
                        <br>

                        <?= number_format($ratarata, 1, ",", ".") ?> ☆ dari <?= $row['jumlahulasan'] ?> Ulasan



                        <br>
                        <a style="color: orangered;" onclick="viewulasan('<?= $row['idrute'] ?>')">
                            > Lihat Ulasan
                        </a>

                    </div>






                </div>
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
    window.location = ('/lamandepan/pemesanan/' + id);
}

function viewulasan(id) {
    window.location = ('/lamandepan/viewulasan/' + id);
}

$(document).ready(function() {
    $('#rutetravel').addClass("active");
    $('#home').removeClass("active");
});
</script>

<?= $this->endsection('isi') ?>