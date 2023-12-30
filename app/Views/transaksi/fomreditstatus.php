<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
<b>EDIT TRANSAKSI TRAVEL
</b>
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fas fa-fast-backward"></i> <b>KEMBALI</b>', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('transaksi/viewdata') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>

<?= $this->section('isi') ?>


<div class="form-row">
    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-4">
        <label for="">NO FAKTUR</label>
        <input type="text" class="form-control" placeholder="NOMOR FAKTUR" name="faktur" id="faktur"
            value="<?= $nofaktur ?>" readonly>
    </div>
    <div class="form-group col-md-4">
        <label for="">TANGGAL </label>
        <div class="input-group date" id="reservationdate" data-target-input="nearest">
            <input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" name="tglfaktur"
                id="tglfaktur" value="<?= date($tanggal); ?>" readonly>
            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-2">
    </div>

    <div class="form-group col-md-4">
        <label for="">NAMA PELANGGAN</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="NAMA PELANGGAN" name="namapelanggan" id="namapelanggan"
                title="CARI PELANGGAN" value="<?= $namapel ?>" readonly>
            <div class="input-group-append">
                <input type="hidden" name="idpelanggan" id="idpelanggan" value="<?= $idpel ?>">

            </div>
        </div>
    </div>

    <div class="form-group col-md-4">

        <label for="">STATUS</label>
        <select name="status" id="status" class="form-control " style="background-color: green; color: white;">



            <option value="<?= $status ?>"><?= $status ?></option>
            <!-- <option value="LUNAS">LUNAS</b></option>
            <option value="LUNAS-SEDANG DIJEMPUT">LUNAS-SEDANG DIJEMPUT</b></option>
            <option value="LUNAS-SEDANG DIANTAR">LUNAS-SEDANG DIANTAR</b></option> -->
            <option value="Pesanan Dikirim">Pesanan Dikirim</b></option>
            <option value="Pesanan Diterima">Pesanan Diterima</b></option>

            <option value="Penumpang Dijemput">Penumpang Dijemput</b></option>
            <option value="Penumpang Diantar">Penumpang Diantar</b></option>
            <option value="Selesai">Selesai</b></option>





        </select>

    </div>

    <div class="form-group col-md-2">
    </div>
    <div class="form-group col-md-2">
    </div>

    <div class="form-group col-md-3">
        <label for=""> TOMBOL SELESAI </label>
        <p>
            <button type="button" class="btn  btn-info" id="tombolSelesaiTransaksi">
                <i class="fa fa-save"></i> Selesai Transaksi
            </button>
        </p>
    </div>

</div>




<!-- untuk caribarang tapi ini tersembnyi -->
<div class="modalcaribarang" style="display: none;"></div>


<script>
function buatnofaktur() {

    $.ajax({
        type: "post",
        url: "/transaksi/buatnofaktur_jikatgldiubah",
        data: {
            tanggal: $('#tglfaktur').val()
        },
        dataType: "json",

        success: function(response) {
            $('#faktur').val(response.nofaktur),
                dataTemp();

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });

}

function ambilhargapaket() {

    let paket = $('#paketku').val();

    if (paket == '0') {

        $('#hargatambahan').val("+ Rp. 0");


    } else {

        $.ajax({
            type: "post",
            url: "/transaksi/ambilhargapaket",
            data: {
                kdpaket: $('#paketku').val()
            },
            dataType: "json",

            success: function(response) {
                let data = response.sukses;
                $('#hargatambahan').val("+ Rp. " + data.hargapaket);
                $('#hargapaket').val(data.hargapaket);


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });

    }

}

function ambilhargajenispakaian() {

    $.ajax({
        type: "post",
        url: "/transaksi/ambilhargajenispakaian",
        data: {
            jeniscucian: $('#jeniscucian').val()
        },
        dataType: "json",

        success: function(response) {
            let data = response.sukses;
            $('#hargacucian').val("Rp. " + data.harga);
            $('#realhargacucian').val(data.harga);



        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });

}

function dataTemp() {
    let faktur = $('#faktur').val();
    $.ajax({
        type: "post",
        url: "/transaksi/datadetailstatus",
        data: {
            faktur: faktur
        },
        dataType: "json",
        beforeSend: function() {
            $('#tampildatatemp').html("<i class='fa fa-spin fa-spinner'></i> &nbsp&nbsp  Mohon Tunggu");
        },
        success: function(response) {
            if (response.data) {

                //MENAMPILKAN PAKET SESUAI DATA SEBELUMNYA

                $('#paketku').val(response.paket);
                $('#paket2').val(response.paket);

                let paket = $('#paketku').val();


                if (paket == '0') {

                    $('#viewpakettampil').hide();
                    $('#viewpaket').show();


                } else {
                    $('#viewpakettampil').show();
                    $('#viewpaket').hide();

                }

                ambilhargapaket();



                //MENAMPILKAN DATA TEMP

                $('#tampildatatemp').html(response.data);

            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });
}



function kosong() {
    $('#kodebarang').val('');
    $('#hargajual').val('');
    $('#namabarang').val('');
    $('#hergabeli').val('');
    $('#berat').val('');
    $('#kodebarang').focus();
}

function kosong2() {
    $('#hargajual').val('');
    $('#namabarang').val('');
    $('#hergabeli').val('');
    $('#berat').val('');
    $('#kodebarang').focus();
}

function ambildatabarang() {
    let kodebarang = $('#kodebarang').val();

    $.ajax({
        type: "post",
        url: "/transaksi/ambilDataBarang",
        data: {
            kodebarang: kodebarang
        },
        dataType: "json",
        success: function(response) {
            if (response.sukses) {
                let data = response.sukses;

                $('#hergabeli').focus();
                // TAMPILAN LOADING
                let timerInterval
                Swal.fire({
                    icon: 'success',
                    title: 'SEDANG MEMERIKASA KODE BARANG',
                    html: 'Otomatis Tertutup Dalam <b></b> milliseconds.',
                    timer: 500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })

                // MENMPILKAN DATA
                $('#namabarang').val(data.namabarang);
                $('#hargajual').val(data.hargajual);
                $('#hergabeli').val('');
                $('#jumlah').val('');


            }

            if (response.error) {

                // TAMPILAN LOADING
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'KODE BARANG SALAH',
                    text: response.error,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                kosong2();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });
}



$(document).ready(function() {



    $('#transaksi').addClass('nav-link active');




});

$('#tombolreload').click(function(e) {
    e.preventDefault();
    $('#iddetail').val('');
    $(this).hide();
    $('#tombiledititem').hide();
    $('#tombolreload').hide();
    $('#tomboltambahtem').fadeIn();
    kosong();

})


$('#jeniscucian').change(function(e) {

    ambilhargajenispakaian();

});

$('#paketku').change(function(e) {
    e.preventDefault();
    ambilhargapaket();

});





// nofaktur berubah jika tgl di ubah
$('#tglfaktur').change(function(e) {
    buatnofaktur();
    dataTemp();
});

$('#tombolCariPelanggan').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "/pelanggan2/modalDataPelanggan",

        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.viewmodal').html(response.data).show();
                $('#modaldatapelanggan').modal('show');
            }
        }
    });

});



$('#tomboltambahtem').click(function(e) {

    // menvariabelkan

    e.preventDefault();
    let faktur = $('#faktur').val();
    let paket = $('#paketku').val();
    let jeniscucian = $('#jeniscucian').val();
    let berat = $('#berat').val();
    let realhargacucian = $('#realhargacucian').val();
    let hargapaket = $('#hargapaket').val();


    // validasi
    if (faktur.length == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'FAKTUR TIDAK BOLEH KOSONG',

        })
    } else if (paket == '0') {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'PAKET TIDAK BOLEH KOSONG',

        })
    } else if (paket.length == 0) {

        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'KODE BARANG BELUM TERISI',

        })


    } else if (berat == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'JUMLAH BELI BELUM TERISI',

        })

    } else {

        // simpan

        $.ajax({
            type: "post",
            url: "/transaksi/simpandetail",
            data: {
                faktur: faktur,
                jeniscucian: jeniscucian,
                berat: berat,
                paket: paket,
                realhargacucian: realhargacucian,
                hargapaket: hargapaket,

            },
            dataType: "json",
            success: function(response) {
                if (response.sukses);
                dataTemp();
                kosong();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

});

$('#tombiledititem').click(function(e) {

    // menvariabelkan

    e.preventDefault();
    let id = $('#iddetail').val();
    let faktur = $('#faktur').val();
    let paket = $('#paket').val();
    let jeniscucian = $('#jeniscucian').val();
    let berat = $('#berat').val();
    let realhargacucian = $('#realhargacucian').val();
    let hargapaket = $('#hargapaket').val();


    // validasi
    if (faktur.length == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'FAKTUR TIDAK BOLEH KOSONG',

        })
    } else if (paket == '0') {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'PAKET TIDAK BOLEH KOSONG',

        })
    } else if (berat == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oppss....',
            text: 'JUMLAH BELI BELUM TERISI',

        })

    } else {

        // simpan

        $.ajax({
            type: "post",
            url: "/transaksi/updatedetail",
            data: {
                id: id,
                faktur: faktur,
                jeniscucian: jeniscucian,
                berat: berat,
                paket: paket,
                realhargacucian: realhargacucian,
                hargapaket: hargapaket,

            },
            dataType: "json",
            success: function(response) {
                if (response.sukses);
                dataTemp();
                kosong();

                $('#iddetail').val('');
                $(this).hide();
                $('#tombiledititem').hide();
                $('#tombolreload').hide();
                $('#tomboltambahtem').fadeIn();
                kosong();

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

});

$('#tomboltambahpelanggan').click(function(e) {
    e.preventDefault();
    $.ajax({

        url: "/pelanggan2/formtambah",

        dataType: "json",
        success: function(response) {
            if (response.data) {
                $('.modalpelanggan').html(response.data).show();
                $('#modaltambahpelanggan').modal('show');

            }

        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + thrownError);
        }
    });

});



// aksi keyprees kode barang
$('#kodebarang').keydown(function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        ambildatabarang();

    }
});


//simpan ke datatemp





function cekfaktur() {
    $('#kodebarang').focus();
    // TAMPILAN LOADING
    let timerInterval
    Swal.fire({
        icon: 'info',
        title: 'SEDANG MEMERIKASA NOMOR FAKTUR',
        html: 'Otomatis Tertutup Dalam <b></b> milliseconds.',
        timer: 500,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    })
    // MENMPILKAN DATA
    dataTemp();


    // if(!dataTemp()){
    //     Swal.fire({
    //     icon: 'success',
    //     title: 'ADA',
    //     text: 'SUDAH ADA NOMOR FAKTUR',

    // })        
    // }
}

//ketika enter di nomor faktur
$('#faktur').keydown(function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();

        let faktur = $('#faktur').val();

        $.ajax({
            type: "post",
            url: "/transaksi/validasi_faktur_transaksi",
            data: {
                faktur: faktur
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    let data = response.sukses;

                    $('#kodebarang').focus();
                    // TAMPILAN LOADING
                    cekfaktur();

                }

                if (response.error) {

                    // TAMPILAN LOADING
                    let timerInterval
                    Swal.fire({
                        icon: 'error',
                        title: 'GANTI NOMOR FAKTUR ANDA',
                        text: response.error,

                    })
                    dataTemp();


                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });


    }
});


$('#tombolSelesaiTransaksi').click(function(e) {
    e.preventDefault();
    let faktur = $('#faktur').val();
    let status = $('#status').val();


    Swal.fire({
        title: 'Transaksi Selesai?',
        text: "Yakin Transaksi ini disimpan?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya Simpan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "/transaksi/selesaieditTransaksistatus",
                data: {
                    faktur: $('#faktur').val(),
                    status: $('#status').val(),

                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oppss....',
                            text: response.error,

                        })
                    }

                    if (response.sukses) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil...',
                            text: response.sukses,

                        })

                        window.location.href = ('/transaksi/viewdata');

                    }


                    //KODING KETIKA LANGSUNG KITA SIMPAN
                    // if (response.sukses) {
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Berhasil..',
                    //         text: response.sukses,

                    //     }).then((result) => {
                    //         if (result.isConfirmed) {

                    //         }
                    //     })

                    //     kosongkanpelanggan();
                    //     window.location.reload();
                    // }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    })


});
</script>

<?= $this->endSection('isi') ?>