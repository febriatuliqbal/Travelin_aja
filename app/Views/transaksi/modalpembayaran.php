<!-- Modal -->
<div class="modal fade" id="modalpembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="staticBackdropLabel">PEMBAYARAN FAKTUR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?= form_open('transaksi/simpanPembayaran', ['class' => 'frmpembayaran']) ?>

            <div class="modal-body">
                <div class="form-group">
                    <label for="">NO FAKTUR</label>
                    <input type="text" name="nofaktur" id="nofaktur" class="form-control" placeholder=""
                        aria-describedby="helpId" value="<?= $faktur ?>" readonly>
                </div>

                <input type="text" name="tanggalfaktur" value="<?= $tgl ?>">
                <input type="text" name="idpelanggan" value="<?= $idpelanggan ?>">
                <input type="text" name="idpaket2" value="<?= $idpaket ?>">

                <div class="form-group">
                    <label for="">TOTAL HARGA</label>
                    <input type="text" name="totalbayar" id="totalbayar" class="form-control" placeholder=""
                        aria-describedby="helpId" value="<?= $totalharga ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">JUMLAH UANG</label>
                    <input type="text" name="jumalhuang" id="jumalhuang" class="form-control" placeholder=""
                        aria-describedby="helpId" autofocus>
                </div>
                <div class="form-group">
                    <label for="">SISA</label>
                    <input type="text" name="sisauang" id="sisauang" class="form-control" placeholder=""
                        aria-describedby="helpId" value="<?= $totalharga ?>" readonly>
                    <input type="hidden" name="hasil" id="hasil" class="form-control" placeholder=""
                        aria-describedby="helpId" value="<?= $totalharga ?>" readonly>

                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btnsimpan" id="simpanpem"
                        name="simpanpem">SIMPAN</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                </div>

            </div>

            <?= form_close() ?>

        </div>
    </div>
</div>

<!-- berguna untuk mengatur format angka di form -->
<script src="<?= base_url('dist/js/autoNumeric.js') ?>"></script>
<script>
$(document).ready(function() {


    $('#sisauang').val('0');
    $('#simpanpem').prop('disabled', true);


    $('#totalbayar').autoNumeric('init', {
        mDec: 0,
        aDec: ',',
        aSep: '.',

    });
    $('#jumalhuang').autoNumeric('init', {
        mDec: 0,
        aDec: ',',
        aSep: '.',

    });
    $('#sisauang').autoNumeric('init', {
        mDec: 0,
        aDec: ',',
        aSep: '.',

    });



    $('#jumalhuang').keyup(function(e) {

        let jumalhuang = $('#jumalhuang').autoNumeric('get');
        let totalbayar = $('#totalbayar').autoNumeric('get');

        let sisauang;

        if (parseInt(jumalhuang) < parseInt(totalbayar)) {
            sisauang = 0;
            $('#simpanpem').prop('disabled', true);
            $('#sisauang').autoNumeric('set', sisauang);

        } else if (jumalhuang == '') {
            sisauang = 0;
            $('#simpanpem').prop('disabled', true);
            $('#sisauang').autoNumeric('set', sisauang);

        } else {
            sisauang = parseInt(jumalhuang) - parseInt(totalbayar);
            $('#simpanpem').prop('disabled', false);
            $('#sisauang').autoNumeric('set', sisauang);
        }

    });

    $('.frmpembayaran').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnsimpan').prop('disabled', true);
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnsimpan').prop('disabled', false);
                $('.btnsimpan').html('Simpan');
            },
            success: function(response) {

                if (response.sukses) {

                    Swal.fire({
                        title: 'BERHASIL DI SIMPAN',
                        text: response.sukses + ",CETAK FAKTUR ?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'CETAK FAKTUR'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let windowCetak = window.open(response.cetakfaktur,
                                "CETAK FAKTUR BARANG KELUAR",
                                "width=400px,height=600px");
                            windowCetak.focus();

                            window.location.href = ('/transaksi/viewdata');
                        } else {
                            window.location.href = ('/transaksi/viewdata');
                        }
                    })
                }


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });


        return false;
    });

});
</script>