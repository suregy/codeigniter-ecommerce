<?= form_open('category/saveAll', ['class' => 'saveAll']); ?>
<?= csrf_field(); ?>
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-default btnBack"> <i class="fas fa-chevron-circle-left"></i> Back </button>
        <button type="submit" class="btn btn-danger btnSimpanBanyak"> <i class="fas fa-share-square"></i> Simpan
        </button>
    </div>
    <div class="card-body">
        <table class="table-sm table-bordered">
            <thead>
                <tr>
                    <th>Kategori 1</th>
                    <th>Kategori 2</th>
                    <th>Kategori 3</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>

            <tbody class="formBanyak">
                <tr>
                    <td> <input class="form-control" type="text" name="c1[]" id="c1">
                        <div class="invalid-feedback c1"></div>
                    </td>
                    <td> <input class="form-control" type="text" name="c2[]" id="c2">
                        <div class="invalid-feedback c2"></div>
                    </td>
                    <td> <input class="form-control" type="text" name="c3[]" id="c3">
                        <div class="invalid-feedback c3"></div>
                    </td>
                    <td> <input class="form-control" type="text" name="nmcat[]" id="nmcat">
                        <div class="invalid-feedback nmcat"></div>
                    </td>
                    <td>
                        <button class="btn btn-primary btnaddFrm"> <i class="fas fa-plus-circle"></i> </button>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
</div>
<?= form_close(); ?>

<script>
$(document).ready(function() {

    $('.saveAll').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnSimpanBanyak').attr('disabled', 'disabled');
                $('.btnSimpanBanyak').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnSimpanBanyak').removeAttr('disabled');
                $('.btnSimpanBanyak').html('Simpan');
            },
            success: function(response) {
                console.log(response.hasilc1);
                if (response.error) {
                    if (response.error.c1) {
                        $('#c1').addClass('is-invalid');
                        $('.c1').html(response.error.c1);
                    } else {
                        $('#c1').removeClass('is-invalid');
                        $('.c1').html('');
                    }
                    if (response.error.c2) {
                        $('#c2').addClass('is-invalid');
                        $('.c2').html(response.error.c2);
                    } else {
                        $('#c2').removeClass('is-invalid');
                        $('.c2').html('');
                    }
                    if (response.error.c3) {
                        $('#c3').addClass('is-invalid');
                        $('.c3').html(response.error.c3);
                    } else {
                        $('#c3').removeClass('is-invalid');
                        $('.c3').html('');
                    }
                    if (response.error.nmcat) {
                        $('#nmcat').addClass('is-invalid');
                        $('.nmcat').html(response.error.nmcat);
                    } else {
                        $('#nmc3').removeClass('is-invalid');
                        $('.nmcat').html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = ("<?= base_url('category') ?>");
                        }
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
        return false;
    });

    $('.btnaddFrm').click(function(e) {
        e.preventDefault();

        $('.formBanyak').append(`
            <tr>
                    <td> <input class="form-control" type="text" name="c1[]" id="c1"> <div class="invalid-feedback c1"></div> </td>
                    <td> <input class="form-control" type="text" name="c2[]" id="c2"> <div class="invalid-feedback c2"></div> </td>
                    <td> <input class="form-control" type="text" name="c3[]" id="c3"> <div class="invalid-feedback c3"></div> </td>
                    <td> <input class="form-control" type="text" name="nmcat[]" id="nmcat"> <div class="invalid-feedback nmcat"></div> </td>
                    <td>
                        <button class="btn btn-danger btndelFrm"> <i class="fas fa-trash"></i> </button>
                    </td>
                </tr>
            `);
    });

    $('.btnBack').click(function(e) {
        e.preventDefault();

        tampilData();
    });
});

// untuk hapus form append
$(document).on('click', '.btndelFrm', function(e) {
    e.preventDefault();
    $(this).parents('tr').remove();
});
</script>