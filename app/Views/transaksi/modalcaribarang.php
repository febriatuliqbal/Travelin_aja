<!-- Modal -->
<div class="modal fade" id="modalcaribarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title" id="staticBackdropLabel"><b>SILAHKAN CARI KODE/NAMA KONSUMEN</b> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <!-- kolomcari -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="SILAHKAN CARI DATA KONSUMEN BERDASARKAN KODA/NAMA" id="cari" name="cari">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="btncari"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div class="row viewdetaildata"></div>

                <!-- kalau mau langsung cari, copi saja coding dataidatabarang.php ke bagian sini -->
             
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function cariDataBarang() {
        let cari = $('#cari').val();
        $.ajax({
            type: "post",
            url: "/transaksi/detailCariBarang",
            data: {
                cari: cari
            },
            dataType: "json",
            success: function(response) {
                $('.viewdetaildata').html(response.data);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        $('#btncari').click(function(e) {
            e.preventDefault();
            cariDataBarang();

        });

        $('#cari').keydown(function(e) {
            if (e.keyCode == '13') {
                e.preventDefault();
                cariDataBarang();

            }
        });
    });
</script>