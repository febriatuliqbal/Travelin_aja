<?= $this->extend('lamandepan/layout') ?>

<?= $this->section('isi') ?>

<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">Pesanan Saya</li>
                        <li class="breadcrumb-item active" aria-current="page">Ulasan</li>
                    </ol>
                </nav>


                <br>
                <h1><?= $asal_tujuan ?></h1>
                <h1 hidden><?= $idrute ?></h1>



                <h5>Kirim Ulasan Anda</h5>




            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-8 order-2 order-lg-1">
            <div class="row">
                <div class="col-12">
                    <div class="product-pricelist-selector-size">
                        <h6>Penilaian</h6>
                        <div class="sizes" id="sizes">
                            <li class="sizes-all" id="1" style="border-color: black; ">☆</li>
                            <li class="sizes-all" style="border-color: black; " id="2">☆</li>
                            <li class="sizes-all " style="border-color: black; " id="3">☆</li>
                            <li class="sizes-all" style="border-color: black; " id="4">☆</li>
                            <li class="sizes-all" style="border-color: black; " id="5">☆</li>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-12">
                    <div class="form__div mb-0">
                        <input value="5" id="nilai" name="nilai" type="text" class="form__input" style="height: 150;"
                            placeholder="" hidden>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form__div mb-0">
                        <input value="" id="ulasan" name="ulasan" type="text" class="form__input" style="height: 150;"
                            placeholder="
                                            ">
                        <label for="" class="form__label">Ulasan</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mt-30">

                    <button id="hai" class="btn  bg-primary mt-0" style="width: 100%;" type="submit">Kirim
                        Ulasan</button>
                </div>

            </div>



            </form>
        </div>
    </div>


</div>
<br> <br>
<!-- jQuery untuk perintah ajax dan json -->
<script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>


<script>
$('#1').click(function(e) {
    e.preventDefault();
    $('#1').addClass("active");
    $('#2').removeClass("active");
    $('#3').removeClass("active");
    $('#4').removeClass("active");
    $('#5').removeClass("active");
    $('#nilai').val("1");
});

$('#2').click(function(e) {
    e.preventDefault();
    $('#1').addClass("active");
    $('#2').addClass("active");
    $('#3').removeClass("active");
    $('#4').removeClass("active");
    $('#5').removeClass("active");
    $('#nilai').val("2");
});

$('#3').click(function(e) {
    e.preventDefault();
    $('#1').addClass("active");
    $('#2').addClass("active");
    $('#3').addClass("active");
    $('#4').removeClass("active");
    $('#5').removeClass("active");
    $('#nilai').val("3");
});
$('#4').click(function(e) {
    e.preventDefault();
    $('#1').addClass("active");
    $('#2').addClass("active");
    $('#3').addClass("active");
    $('#4').addClass("active");
    $('#5').removeClass("active");
    $('#nilai').val("4");
});

$('#5').click(function(e) {
    e.preventDefault();
    $('#1').addClass("active");
    $('#2').addClass("active");
    $('#3').addClass("active");
    $('#4').addClass("active");
    $('#5').addClass("active");
    $('#nilai').val("5");
});


$('#hai').click(function(e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: "/Lamandepan/simpanulasan",
        data: {
            ulasan: $('#ulasan').val(),
            nilai: $('#nilai').val(),
            idrute: <?= $idrute ?>,

        },
        dataType: "json",

        success: function(response) {

            window.location.href = ('/Lamandepan/viewulasan/<?= $idrute ?>');




        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });



});
</script>




<?= $this->endsection('isi') ?>