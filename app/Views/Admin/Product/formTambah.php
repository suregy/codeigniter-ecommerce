<?= form_open_multipart('products/store', ['class' => 'fstore']); ?>
<?= csrf_field(); ?>
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-default btnBack"> <i class="fas fa-chevron-circle-left"></i> Back </button>
    </div>
    <div class="card-body">

        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Category 1</label>
                    <select class="form-control form-control-sm" name="cmbcat1" id="cmbcat1">
                        <option>Small select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Category 2</label>
                    <select class="form-control form-control-sm" name="cmbcat2" id="cmbcat2">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Category 3</label>
                    <select class="form-control form-control-sm" name="cmbcat3" id="cmbcat3">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Brands</label>
                    <select class="form-control form-control-sm" name="cmbbrands" id="cmbbrands">
                        <option>Pilih</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Deskripsi</label>
                    <textarea type="email" class="form-control" name="desc" id="desc"></textarea>
                </div>
                <div class="form-group number_only">
                    <label for="exampleInputEmail1">Harga Beli</label>
                    <input type="text" class="form-control" onkeydown="return numberOnly(event)" name="hrgbeli" id="hrgbeli">
                    <p id="rp">Rp.</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga Jual</label>
                    <input type="text" class="form-control" onkeydown="return numberOnly(event)" name="hrgjual" id="hrgjual">
                    <p id="rpj">Rp.</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Tags</label>
                    <div id="tags"></div>
                </div>
                <div class="form-group">
                    <label for="example">Pilih Gambar</label>
                    <input type="file" class="input-file" name="fileMulti[]" id="fileMulti" onchange="prevMulti();" multiple />
                    <label class="my-label" for="fileMulti"><i class="fas fa-image"></i></label>
                </div>
                <div class="d-flex">
                    <div id="preview" class="d-flex mb-5">
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>

</div>

<?= form_close(); ?>

<script>
    $(document).ready(function() {
        $('#cmbcat1').change(function(e) {
            e.preventDefault();
            var c1 = $("#cmbcat1 option:selected").val();
            $.ajax({
                type: 'post',
                url: "products/getC2",
                dataType: 'json',
                data: {
                    'c1': c1
                },
                success: function(response) {
                    var data = response.c2;
                    var option;
                    option += '<option selected value="0">-- Pilih Category 2 --</option>';
                    $.each(data, function(i, item) {
                        option += '<option value="' + item.c2 + '">' + item
                            .namacategory + '</option>';
                    });
                    $('#cmbcat2').html(option);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
        $('#cmbcat2').change(function(e) {
            e.preventDefault();
            var c1 = $("#cmbcat1 option:selected").val();
            var c2 = $("#cmbcat2 option:selected").val();
            $.ajax({
                type: 'post',
                url: "products/getC3",
                dataType: 'json',
                data: {
                    'c1': c1,
                    'c2': c2
                },
                success: function(response) {
                    var data = response.c3;
                    var option;
                    option += '<option selected value="0">-- Pilih Category 3 --</option>';
                    $.each(data, function(i, item) {
                        option += '<option value="' + item.c3 + '">' + item
                            .namacategory + '</option>';
                    });
                    $('#cmbcat3').html(option);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });

        $('#hrgbeli').keyup(function(e) {
            let rp = $('#rp');
            let hrg = $(this).val();
            let p = convertRupiah(hrg, 'Rp. ');
            rp.text(p);
        });

        $('#hrgjual').keyup(function(e) {
            let rpj = $('#rpj');
            let hrg = $(this).val();
            let p = convertRupiah(hrg, 'Rp. ');
            rpj.text(p);
        });

        $('.btnBack').click(function(e) {
            e.preventDefault();
            tampilData();
        });
        $('.cancel').click(function(e) {
            e.preventDefault();
            tampilData();
        });


        $('.fstore').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                data: new FormData(this),
                beforeSend: function() {
                    $('.btnSimpan').attr('disabled', 'disabled');
                    $('.btnSimpan').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = ("<?= base_url('products') ?>");
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });

    });


    function numberOnly(evt) {
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>