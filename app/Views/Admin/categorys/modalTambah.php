<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('category/save' , ['class' => 'formcategory']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">


                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kategori 1</label>
                    <div class="col-sm-3">
                        <select class="custom-select mr-sm-2" name="c1" id="cmbcat1">
                            <option selected>Pilih Kategori 1</option>
                        </select>
                        <div class="invalid-feedback cmb1"></div>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default addCat1">Tambah Kategori 1</button>
                    </div>
                </div>

                <!-- form togle cat 2 -->
                <div class="form-group row fcat2" style="display: none;">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tambah Kategori
                        2</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm-1" name="c2" id="c2"
                            placeholder="Kode c2">
                        <div class="invalid-feedback errc2"></div>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm-1" name="nmc2" id="nmc2"
                            placeholder="Nama kategori 2">
                        <div class="invalid-feedback errnmc2"></div>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-default saveC2">simpan c2</button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kategori 2</label>
                    <div class="col-sm-3">
                        <select class="custom-select mr-sm-2" name="c2" id="cmbcat2">
                            <option selected>Pilih Kategori 2</option>
                        </select>
                        <div class="invalid-feedback cmb2"></div>
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default addCat2">Tambah Kategori 2</button>
                    </div>
                </div>



                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kategori 3</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" name="c3" id="c3" placeholder="c3">
                        <div class="invalid-feedback errc3"></div>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" name="nmc3" id="nmc3"
                            placeholder="Nama kategori">
                        <div class="invalid-feedback errnmc3"></div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                <button type="button" class="btn btn-secondary tes" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>

        </div>
    </div>
</div>

<div class="tampilModalcat" style="display: none;"></div>

<script>
$(document).ready(function() {


    // untuk modal cat 1
    $('.addCat1').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('category/Formtambahcat') ?>",
            dataType: "json",
            success: function(response) {
                $('.tampilModalcat').html(response.data)
            .show(); //show digunakan karena display none

                //tampilkan modal dr file lain
                $('#modalTambahCat').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        })
    });

    //untuk toggle cat 2 
    $('.addCat2').click(function(e) {
        e.preventDefault();
        $('.fcat2').toggle();
        return false;
    });

    //untuk simpan form c2
    $('.saveC2').click(function(e) {
        e.preventDefault();
        var c2 = $("#c2").val();
        var nmc2 = $("#nmc2").val();
        var cmbc1 = $("#cmbcat1 option:selected").val();
        var data = {
            'c1': cmbc1,
            'c2': c2,
            'nmc2': nmc2,
        };
        $.ajax({
            url: "<?= base_url('category/Simpanc2') ?>",
            data: data,
            dataType: "json",
            beforeSend: function() {
                $('.saveC2').attr('disabled', 'disabled');
                $('.saveC2').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.saveC2').removeAttr('disabled');
                $('.saveC2').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.c1) {
                        $('#cmbcat1').addClass('is-invalid');
                        $('.cmb1').html(response.error.c1);
                    } else {
                        $('#cmbcat1').removeClass('is-invalid');
                        $('.cmb1').html('');
                    }
                    if (response.error.c2) {
                        $('#c2').addClass('is-invalid');
                        $('.errc2').html(response.error.c2);
                    } else {
                        $('#c2').removeClass('is-invalid');
                        $('.errc2').html('');
                    }
                    if (response.error.nmc2) {
                        $('#nmc2').addClass('is-invalid');
                        $('.errnmc2').html(response.error.nmc2);
                    } else {
                        $('#nmc2').removeClass('is-invalid');
                        $('.errnmc2').html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    });
                    $('.fcat2').toggle();
                    $("#c2").val('');
                    $("#nmc2").val('');
                    tampilData();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
        return false;
    });

    //untuk change c1
    $('#cmbcat1').change(function(e) {
        e.preventDefault();
        var c1 = $("#cmbcat1 option:selected").val();
        var data = {
            'c1': c1
        };
        $.ajax({
            url: "<?= base_url('category/getC2') ?>",
            data: data,
            dataType: "json",
            success: function(response) {
                var data = response.c2;
                var option;
                option += '<option selected value="0">-- Pilih Category --</option>';
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

    $('.formcategory').submit(function(e) {
        e.preventDefault();
        var c1 = $("#cmbcat1 option:selected").val();
        var c2 = $("#cmbcat2 option:selected").val();
        var c3 = $("#c3").val();
        var nmc3 = $("#nmc3").val();
        var data = {
            'c1': c1,
            'c2': c2,
            'c3': c3,
            'nmc3': nmc3,
        };
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: data,
            dataType: "json",
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
                    if (response.error.c1) {
                        $('#cmbcat1').addClass('is-invalid');
                        $('.cmb1').html(response.error.c1);
                    } else {
                        $('#cmbcat1').removeClass('is-invalid');
                        $('.cmb1').html('');
                    }
                    if (response.error.c2) {
                        $('#cmbcat2').addClass('is-invalid');
                        $('.cmb2').html(response.error.c2);
                    } else {
                        $('#cmbcat2').removeClass('is-invalid');
                        $('.cmb2').html('');
                    }
                    if (response.error.c3) {
                        $('#c3').addClass('is-invalid');
                        $('.errc3').html(response.error.c3);
                    } else {
                        $('#c3').removeClass('is-invalid');
                        $('.errc3').html('');
                    }
                    if (response.error.nmc3) {
                        $('#nmc3').addClass('is-invalid');
                        $('.errnmc3').html(response.error.nmc3);
                    } else {
                        $('#nmc3').removeClass('is-invalid');
                        $('.errnmc3').html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    });
                    $('#modalTambah').modal('hide');
                    tampilData();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
        return false;
    });
});
</script>