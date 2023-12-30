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
                <h1>PEMESANAN BERHASIL</h1>
                <br>
                <a href="<?= base_url('lamandepan/pesanansaya') ?>">
                    <h6>Lihat Pesanan Saya</h6>
                </a>

            </div>
        </div>
    </div>
</section>




<!-- jQuery untuk perintah ajax dan json -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>


<script>
function edit(id) {
    window.location = ('/lamandepan/pemesanan/' + id);
}

$(document).ready(function() {
    $('#rutetravel').addClass("active");
    $('#home').removeClass("active");
});
</script>

<?= $this->endsection('isi') ?>