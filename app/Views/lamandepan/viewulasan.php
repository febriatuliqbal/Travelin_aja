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
                <h5><?= $asal_tujuan ?><small> | <?= $namapihaktravel ?></small></h5>

                <br>
                <h6>Ulasan Travel</h6>
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

                <div class="name">
                    <b>Ulasan</b>
                </div>


            </div>
            <div class="body">

                <?php foreach ($dataulasan as $row) : ?>
                <?php if ($row['idrute'] == $id) : ?>
                <div class="item">

                    <div class="name">
                        <div class="name-text">
                            <h5>
                                <?= $row['nama'] ?>
                            </h5>
                            <?php if ($row['nilai'] ==  5) : ?>
                            ☆☆☆☆☆
                            <?php elseif ($row['nilai'] ==  4) : ?>
                            ☆☆☆☆
                            <?php elseif ($row['nilai'] ==  3) : ?>
                            ☆☆☆
                            <?php elseif ($row['nilai'] ==  2) : ?>
                            ☆☆
                            <?php elseif ($row['nilai'] ==  1) : ?>
                            ☆
                            <?php endif; ?>

                            <br>
                            <?= $row['ulasan'] ?>


                        </div>


                    </div>






                </div>







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
function viewulasan(id) {
    window.location = ('/lamandepan/viewulasan/' + id);
}

$(document).ready(function() {
    $('#rutetravel').addClass("active");
    $('#home').removeClass("active");
});
</script>

<?= $this->endsection('isi') ?>