

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
            <input type="text" class="form-control form-control-sm" name="cat1" id="cat1" placeholder="kategori 1">
            <div class="invalid-feedback erorC1"></div>
        </div>
      </div>

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Kategori</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="namacategory" id="namacategory" placeholder="Nama kategori">
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

<script>
     $(document).ready(function(){
        $('.formcategory').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnSimpan').attr('disabled', 'disabled');
                    $('.btnSimpan').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('.btnSimpan').removeAttr('disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response){
                    if(response.error){
                        if(response.error.c1){
                            $('#cat1').addClass('is-invalid');
                            $('.erorC1').html(response.error.c1);
                        }else{
                            $('#cat1').removeClass('is-invalid');
                            $('.erorC1').html('');
                        }
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modalTambah').modal('hide');
                        tampilData();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
            return false;
        });
     });
</script>