<?= $this->extend('lamandepan/layout') ?>

<?= $this->section('isi') ?>

<section class="breadcrumb-area mt-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item " aria-current="page">Rute Travel</li>
                        <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                    </ol>
                </nav>


                <br>
                <h1><?= $asal_tujuan ?></h1>



                <h5>Formulir Pemesanan</h5>




            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-8 order-2 order-lg-1">

            <br>

            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input id="faktur" name="faktur" value="<?= $nofaktur ?>" type="text" class="form__input"
                                placeholder="
                                            " disabled>
                            <label for="" class="form__label">Kode Transaksi</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input id="tglfaktur" name="tglfaktur" value="<?= date('Y-m-d'); ?>" type="date"
                                data-target="#reservationdate" class="form__input " placeholder="
                                            ">


                            <label for="" class="form__label">Tanggal</label>


                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input id="idpel" value="<?= session()->iduser ?>" type="text" class="form__input"
                                placeholder="
                                            " disabled>
                            <label for="" class="form__label">username</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form__div">
                            <input value="<?= session()->namauser ?>" type="text" class="form__input" placeholder="
                                            " disabled>
                            <label for="" class="form__label">Nama</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="form__div">
                            <input value="<?= session()->hppelanggan ?>" type="text" class="form__input" placeholder="
                                            " disabled>
                            <label for="" class="form__label">Nomor Handphone</label>
                        </div>
                    </div>

                </div>




                <div class="row">
                    <div class="col-12">
                        <div class="form__div mb-0">
                            <input value="<?= session()->alamatpelannggan ?>" type="text" class="form__input"
                                placeholder="
                                            " disabled>
                            <label for="" class="form__label">Alamat</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-4 col-12 mt-30">
                        <select id="jam">
                            <option value="0">PILIH JAM KEBERANGKATAN</b></option>
                            <?php foreach ($datajam as $pak) : ?>
                            <option id="jam2" value="<?= $pak['namajam'] ?>"><b><?= $pak['namajam'] ?></b>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                </div>


                <div class="row">

                    <div class="col-lg-9 col-md-4 col-12 mt-30">
                        <div class="form__div">
                            <input id="total" value="<?= $harga ?>" type="text" class="form__input"
                                placeholder="                                            " disabled>
                            <label for="" class="form__label">Biaya</label>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-12 mt-30">

                        <button id="hai" style="height: 50px;" class="btn  bg-primary mt-0" type="submit">PESAN</button>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between bottom flex-wrap">
                            <a href="<?= base_url('lamandepan/listrute') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-left">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                                Pilih Rute</a>

                        </div>
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
$(document).ready(function() {
    $('#rutetravel').removeClass("active");
    $('#home').removeClass("active");

});


$('#tglfaktur').change(function(e) {
    e.preventDefault();

    buatnofaktur();

});

function buatnofaktur() {

    $.ajax({
        type: "post",
        url: "/Lamandepan/buatnofaktur_jikatgldiubah",
        data: {
            tanggal: $('#tglfaktur').val()
        },
        dataType: "json",

        success: function(response) {
            $('#faktur').val(response.nofaktur);
            $('#rute').removeProp(disabled);


        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });

}
$('#jam').click(function(e) {
    e.preventDefault();
    alert('hai');

});

$('#hai').click(function(e) {
    e.preventDefault();

    let faktur = $('#jam').val();
    alert(faktur);

});



$('#hai2').click(function(e) {
    e.preventDefault();

    $.ajax({
        type: "post",
        url: "/Lamandepan/simpanpembayaran",
        data: {
            faktur: $('#faktur').val(),
            idpel: $('#idpel').val(),
            tglfaktur: $('#tglfaktur').val(),
            idrute: <?= $idrute ?>,
            total: $('#total').val(),

        },
        dataType: "json",

        success: function(response) {

            window.location.href = ('/Lamandepan/konfirmasi');




        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });



});
</script>




<?= $this->endsection('isi') ?>