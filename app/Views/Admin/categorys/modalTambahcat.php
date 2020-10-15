<?php  ?>

<!-- Modal -->
<div class="modal fade" id="modalTambahCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('category/Simpanc1' , ['class' => 'formc1']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
      

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">C1</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="c1" id="c1" placeholder="Kode C1">
            <div class="invalid-feedback errC1"></div>
        </div>
      </div>
      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama Kategori</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm" name="nmc1" id="nmc1" placeholder="Nama kategori">
            <div class="invalid-feedback errnmC1"></div>
        </div>
      </div>
      

      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary btnSimpanc1">Simpan</button>
        <button type="button" class="btn btn-secondary tes" data-dismiss="modal">Close</button>
      </div>

      <?= form_close() ?>

    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
        $('.formc1').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(){
                    $('.btnSimpanc1').attr('disabled', 'disabled');
                    $('.btnSimpanc1').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('.btnSimpanc1').removeAttr('disabled');
                    $('.btnSimpanc1').html('Simpan');
                },
                success: function(response){
                    if(response.error){
                        if(response.error.c1){
                            
                            $('#c1').addClass('is-invalid');
                            $('.errC1').html(response.error.c1);
                        }else{
                            $('#c1').removeClass('is-invalid');
                            $('.errC1').html('');
                        }
                        if(response.error.nmc1){
                            $('#nmc1').addClass('is-invalid');
                            $('.errnmC1').html(response.error.nmc1);
                        }else{
                            $('#nmc1').removeClass('is-invalid');
                            $('.errnmC1').html('');
                        }
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modalTambahCat').modal('hide');
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