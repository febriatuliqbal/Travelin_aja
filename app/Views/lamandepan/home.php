<?= $this->extend('lamandepan/layout') ?>

<?= $this->section('isi') ?>

<!--Banner Area Start -->
<section class="banner-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="banner-area__content">
                    <p>
                    <h2>DAPATKAN CASHBACK POIN DI SETIAP PESANAN
                        <br> DI <i>TRAVEL.IN AJA</i>
                    </h2>
                    <p><i> Setiap Pesanan Akan Mendapatkan Cashback <b>10%</b>
                            Poin dapat ditukarkan menjadi potongan pemesanan travel</p>
                    </i> <a class="btn bg-primary" href="<?= base_url('lamandepan/listrute') ?>">PESAN SEKARANG</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="banner-area__img">
                    <img src="<?= base_url() ?>/depan/dist/images/banner.jpg" alt="banner-img" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="brand-area">
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/01.png" alt="Brand" class="img-fluid">
                    </div>
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/02.png" alt="Brand" class="img-fluid">
                    </div>
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/03.png" alt="Brand" class="img-fluid">
                    </div>
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/04.png" alt="Brand" class="img-fluid">
                    </div>
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/02.png" alt="Brand" class="img-fluid">
                    </div>
                    <div class="brand-area-image">
                        <img src="<?= base_url() ?>/depan/dist/images/brand/05.png" alt="Brand" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Banner Area End -->

<!-- Features Section Start -->
<section class="features">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h2>RUTE PERJALAN</h2>
                </div>
            </div>
        </div>
        <div class="features-wrapper">
            <div class="features-active">


                <?php foreach ($datarute as $row) : ?>

                <div class="product-item">
                    <div class="product-item-image">
                        <a onclick="edit('<?= $row['idrute'] ?>')"><img
                                src="<?= base_url() ?>/depan/dist/images/product/03.jpg" alt="Product Name"
                                class="img-fluid"></a>
                        <div class="cart-icon">
                            <a href="#"><i class="far fa-heart"></i></a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.75" height="16.75"
                                    viewBox="0 0 16.75 16.75">
                                    <g id="Your_Bag" data-name="Your Bag" transform="translate(0.75)">
                                        <g id="Icon" transform="translate(0 1)">
                                            <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="0.682" cy="0.714"
                                                rx="0.682" ry="0.714" transform="translate(4.773 13.571)" fill="none"
                                                stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5" />
                                            <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="0.682" cy="0.714"
                                                rx="0.682" ry="0.714" transform="translate(12.273 13.571)" fill="none"
                                                stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5" />
                                            <path id="Path_3" data-name="Path 3"
                                                d="M1,1H3.727l1.827,9.564a1.38,1.38,0,0,0,1.364,1.15h6.627a1.38,1.38,0,0,0,1.364-1.15L16,4.571H4.409"
                                                transform="translate(-1 -1)" fill="none" stroke="#1a2224"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                        </g>
                                    </g>
                                </svg>
                            </a>

                        </div>
                    </div>
                    <div class="product-item-info">
                        <span><?= $row['jumlahpesanan'] ?>X Perjalanan</b> </span>
                        <h3><?= $row['asal_tujuan'] ?></h3>
                        <span><?= $row['namapihaktravel'] ?> | <b>Rp.
                                <?= number_format($row['harga'], 0, ",", ".") ?></b> </span>
                    </div>
                </div>

                <?php endforeach; ?>


            </div>
            <div class="slider-arrows">
                <div class="prev-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                        <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7"
                            transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </div>
                <div class="next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                        <path id="Icon_feather-chevron-right" data-name="Icon feather-chevron-right"
                            d="M13.5,23l5.25-5.25.438-.437L20.5,16l-7-7" transform="translate(-12.086 -7.586)"
                            fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="features-morebutton text-center">
                    <a class="btn bt-glass" href="<?= base_url('lamandepan/listrute') ?>">LIHAT SEMUA RUTE</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Section End -->

<!-- About Area Start -->
<section class="about-area">
    <div class="container">
        <div class="about-area-content">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div class="about-area-content-img">
                        <img src="<?= base_url() ?>/depan/dist/images/feature/medicine.jpg" alt="img" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-area-content-text">
                        <h3>KENAPA HARUS TRAVEL.IN AJA</h3>
                        <p>
                            Banyak Keuntungan yang akan anda dapatkan dengan travelin aja sebagai berikut
                        </p>
                        <div class="icon-area-content">
                            <div class="icon-area">
                                <i class="far fa-check-circle"></i>
                                <span>PEMBAYARAN AMAN</span>
                            </div>
                            <div class="icon-area">
                                <i class="far fa-check-circle"></i>
                                <span>LAYANAN CUSTEMER SERVICES 24 JAM</span>
                            </div>
                            <div class="icon-area">
                                <i class="far fa-check-circle"></i>
                                <span>TEPAT WAKTU</span>
                            </div>
                            <div class="icon-area">
                                <i class="far fa-check-circle"></i>
                                <span>MEMILIKI MOBIL YANG NYAMAN </span>
                            </div>
                        </div>

                        <a class="btn bg-primary" href="<?= base_url('lamandepan/listrute') ?>">PESAN SEKARANG</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Area End -->



<!-- Categorys Section Start -->
<section class="categorys">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h2>Our Team</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/iqbal.jpg" alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>FEBRIATUL IQBAL <br> 1910005</h6>
                            <span>PROGRAMMER</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/marion.jpg"
                                alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>MARION PUTRA <br> 1910012</h6>
                            <span>PROGRAMMER</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/rahmi.jpg" alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>RAHMI HAYATI <br> 1910034</h6>
                            <span>Projek Manager & System Analyst</span>
                        </a>
                    </div>
                </div>
            </div>



            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/nouser.png"
                                alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>WINA YOLANDA <br> 1910040</h6>
                            <span>Projek Manager & System Analyst</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/nouser.png"
                                alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>LAURA SIDRATIL AINI <br> 1910010</h6>
                            <span>Projek Manager & System Analyst</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="productcategory text-center">
                    <div class="productcategory-img">
                        <a href="#"><img src="<?= base_url() ?>/depan/dist/images/categorys/nouser.png"
                                alt="images"></a>
                    </div>
                    <div class="productcategory-text">
                        <a href="#">
                            <h6>NURTIANI NDURU <br> 1910024</h6>
                            <span>Projek Manager & System Analyst</span>
                        </a>
                    </div>
                </div>
            </div>



        </div>
</section>
<!-- Categorys Section End -->

<!-- Features Section Start -->
<section class="customersreview">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h2>ULASAN PELANGGAN</h2>
                </div>
            </div>
        </div>
        <div class="customersreview-wrapper">
            <div class="customersreview-active">
                <div class="customersreview-item">
                    <p>Mobilnya nyaman, enak tidur saat perjalanan</p>
                    <div class="name">
                        <h6>Riski</h6>
                    </div>
                </div>
                <div class="customersreview-item">
                    <p>Sopirnya ramah dan bawa mobilnya ga ugal ugalan</p>
                    <div class="name">
                        <h6>Dian</h6>
                    </div>
                </div>
                <div class="customersreview-item">
                    <p>Tepat waktu, jadi ga takut terlambat</p>
                    <div class="name">
                        <h6>iqbal</h6>
                    </div>
                </div>
                <div class="customersreview-item">
                    <p>Mobilnya nyaman, enak tidur saat perjalanan</p>
                    <div class="name">
                        <h6>Riski</h6>
                    </div>
                </div>

            </div>
            <div class="slider-arrows">
                <div class="prev-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                        <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7"
                            transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </div>
                <div class="next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                        <path id="Icon_feather-chevron-right" data-name="Icon feather-chevron-right"
                            d="M13.5,23l5.25-5.25.438-.437L20.5,16l-7-7" transform="translate(-12.086 -7.586)"
                            fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function edit(id) {
    window.location = ('/lamandepan/pemesanan/' + id);
}
</script>
<!-- Features Section End -->
<?= $this->endsection('isi') ?>