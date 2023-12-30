<!-- Modal -->
<div class="modal fade" id="modaltambahpelanggan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">FORM INPUT PELANGGAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?= form_open('pelanggan2/simpan', ['class' => 'formsimpan']) ?>
               

                <div class="form-group">
                    <label for="">INPUT NAMA PELANGGAN</label>
                    <input type="text" name="namapel" id="namapel" placeholder="INPUT NAMA PELANGGAN" class="form-control" autofocus>
                    <div class="invalid-feedback errorNama"></div>
                </div>

                <div class="form-group">
                    <label for="">INPUT HP/Telp.</label>
                    <input type="text" name="telp" id="telp" placeholder="INPUT TELP/HP PELANGGAN" class="form-control">
                    <div class="invalid-feedback errorTelp"></div>
                </div>
                <div class="form-group">
                    <label for="">ALAMAT</label>
                    <input type="text" name="alamatpel" id="alamatpel" placeholder="INPUT TELP/HP PELANGGAN" class="form-control">
                    <div class="invalid-feedback errorTelp"></div>
                </div>

                <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-block btn-primary" id="tombolsimpan">
                        SIMPAN
                    </button>

                </div>



                <?= form_close(); ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>

        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.formsimpan').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#tombolsimpan').prop('disble', true);
                    $('#tombolsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('#tombolsimpan').prop('disble', false);
                    $('#tombolsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        let err = response.error;
                        if (err.errNamaPelanggan) {
                            $('#namapel').addClass('is-invalid');
                            $('.errorNama').html(err.errNamaPelanggan);
                        }
                        if (err.errTelp) {
                            $('#telp').addClass('is-invalid');
                            $('.errorTelp').html(err.errTelp);
                        }
                    }
                    if (response.sukses) {
                        Swal.fire({
                            title: 'BERHASIL',
                            text: response.sukses,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'YA, AMBIL'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#nohp').val(response.nohp);
                                $('#namapelanggan').val(response.namapelanggan);
                                $('#idpelanggan').val(response.idpel);

                                let timerInterval
                                Swal.fire({
                                    icon: 'success',
                                    title: 'DATA PELANGGAN BERHASIL DITAMBAH',
                                    html: 'Otomatis Tertutup Dalam <b></b> milliseconds.',
                                    timer: 1000,
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
                                $('#modaltambahpelanggan').modal('hide');

                            } else {

                                $('#modaltambahpelanggan').modal('hide');
                                $('#modaldatapelanggan').modal('show');

                                let timerInterval
                                Swal.fire({
                                    icon: 'success',
                                    title: 'DATA PELANGGAN BERHASIL DITAMBAH',
                                    html: 'Otomatis Tertutup Dalam <b></b> milliseconds.',
                                    timer: 1000,
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

                                        lisDataPelanggan();

                                    }
                                })


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