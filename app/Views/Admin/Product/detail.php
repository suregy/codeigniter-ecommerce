<?= form_open('Detprod/store', ['class' => 'fstore']); ?>
<?= csrf_field(); ?>
<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-default btnBack"> <i class="fas fa-chevron-circle-left"></i> Back </button>
    </div>
    <div class="card-body">

        <div class="row justify-content-md-center">
            <div class="col-md-6 border">
                <input type="hidden" name="refid" id="refid">
                <input type="hidden" name="detid" id="detid">
                <div class="form-group">
                    <label for="exampleInputEmail1">Input Size</label>
                    <input type="number" min="1" max="1000" value="1" class="form-control" name="size" id="size">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Input Color</label>
                    <input type="color" class="form-control" name="color" id="color">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Input Stok</label>
                    <input type="number" min="1" max="1000" value="1" class="form-control" name="stok" id="stok">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                    <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">reset</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detailprod">

                </div>

            </div>
        </div>

    </div>

</div>

<?= form_close(); ?>

<script>
function load(id) {
    $.ajax({
        url: 'Detprod/getOne',
        dataType: 'json',
        data: {
            'refid': id,
        },
        success: function(response) {
            $('.detailprod').html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        },
    });
}

function clear() {
    $('#color').val('#00000');
    $('#size').val('1');
    $('#stok').val('1');
    $('#detid').val('');
}
$(document).ready(function(e) {
    let refid = $('#refid').val();
    load(refid);

    $('.cancel').click(function(e) {
        clear();
    });

    $('.btnBack').click(function(e) {
        e.preventDefault();

        tampilData();
    });

    $('.fstore').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
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
                            load(refid);
                            clear();
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

});
</script>