<?= form_open_multipart('banners/update', ['class' => 'fUpdate']); ?>
<?= csrf_field(); ?>
<div class="card">
    <div class="card-header"> 
        <button type="button" class="btn btn-default btnBack"> <i class="fas fa-chevron-circle-left"></i>  Back </button>
    </div>
    <div class="card-body">

        <input type="hidden" name="id" id="id" value="<?= $id ?>">
        <input type="hidden" name="imageold" id="imageold" value="<?= $image ?>">

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Judul</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" name="judul" id="errjudul" value="<?= $banner; ?>" placeholder="input judul">
                <div class="invalid-feedback errjudul"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Url</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" name="url" id="judul" value="<?= $url; ?>" placeholder="input url">
                <div class="invalid-feedback errURl"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Status</label>
            <div class="col-sm-6">
                <Select name="status" class="form-control form-control-sm" id="errStatus">
                    <option value="1" <?= $status == '1'  ? 'selected="selected"' : ''; ?>   >Aktif</option>
                    <option value="0" <?= $status == '0'  ? 'selected="selected"' : ''; ?>  >Tidak Aktif</option>
                </Select>
                <div class="invalid-feedback errStatus"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Tanggal create</label>
            <div class="col-sm-6">
                <input type="date" class="form-control form-control-sm" name="date" value="<?= $date_create ?>" id="date" placeholder="YYYY-MM-dd">
                <div class="invalid-feedback errURl"></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">File</label>
            <div class="col-sm-6">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="photo" id="errFile" onchange="imgPrev()">
                <label class="custom-file-label" for="validatedCustomFile"><?= $image; ?></label>
                <div class="invalid-feedback errFile"></div>
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Gambar</label>
            <div class="col-sm-6">
                <div class="">
                    <img src="<?= base_url('/images/banners/'.$image) ?>" alt="atas" class="img-prev">
                </div>
            </div>
        </div>

        <div class="card-footer"> 
            <button type="submit" class="btn btn-danger btnSimpan"> <i class="fas fa-chevron-circle-left"></i>  Simpan </button>
        </div>

    </div>
</div>
<?= form_close(); ?>

<script>
$(document).ready(function(){
    $('.fUpdate').submit(function(e){
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('file', $('input[type=file]')[0].files[0]);

        $.ajax({
            type: 'post', 
            url: $(this).attr('action'), 
            dataType: 'json', 
            cache: false,
			contentType: false,
			processData: false,
			async: false, 
            data: formData, 
            beforeSend: function(){
                $('.btnSimpan').attr('disabled', 'disabled');
                $('.btnSimpan').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function(){
                $('.btnSimpan').removeAttr('disabled');
                $('.btnSimpan').html('Simpan');
            },
            success: function(response) { 
                if(response.error){
                    if(response.error.judul){
                        $('#errjudul').addClass('is-invalid');
                        $('.errjudul').html(response.error.judul);
                    }else{
                        $('#errjudul').removeClass('is-invalid');
                        $('.errjudul').html('');
                    }
                    if(response.error.status){
                        $('#errStatus').addClass('is-invalid');
                        $('.errStatus').html(response.error.status);
                    }else{
                        $('#errStatus').removeClass('is-invalid');
                        $('.errStatus').html('');
                    }
                    if(response.error.file){
                        $('#errFile').addClass('is-invalid');
                        $('.errFile').html(response.error.file);
                    }else{
                        $('#errFile').removeClass('is-invalid');
                        $('.errFile').html('');
                    }
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = ("<?= base_url('banners') ?>");
                        }
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });

    });

    $('.btnBack').click(function(e){
            e.preventDefault();

            tampilData();
    });

});
</script>