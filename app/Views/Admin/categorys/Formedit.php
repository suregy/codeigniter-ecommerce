<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('category/updateData' , ['class' => 'formcategoryedit']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">

      <input type="hidden" name="id" id="id" value="<?= $id; ?>" >
        

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kategori 1</label>
        <div class="col-sm-3">
            <select class="custom-select mr-sm-2" name="c1" id="cmbcat1">
              <option selected>Pilih Kategori 1</option>
            </select>
            <div class="invalid-feedback cmb1"></div>
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
      </div>

      

      <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Kategori 3</label>
        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm" name="c3" id="c3" value="<?= $c3; ?>" placeholder="c3">
            <div class="invalid-feedback errc3"></div>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control form-control-sm" name="nmc3" id="nmc3" value="<?= $nmcat; ?>" placeholder="Nama kategori">
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

<script>
 $(document).ready(function(){
    //untuk change c1
    $('#cmbcat1').change(function(e){
        e.preventDefault();
        var c1 = $( "#cmbcat1 option:selected" ).val();
        var data = {'c1' : c1};
        $.ajax({
            url: "<?= base_url('category/getC2') ?>",
            data: data,
            dataType: "json",
            success: function(response){
              var data = response.c2;
              var option;
                option += '<option selected value="0">-- Pilih Category --</option>';
                $.each(data, function(i, item) {
                    option += '<option value="'+item.c2+'">'+item.namacategory+'</option>';
                });
                $('#cmbcat2').html(option);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    });


    //untuk fungsi update
    $('.formcategoryedit').submit(function(e){
        e.preventDefault();

        var c1 = $("#cmbcat1 option:selected").val();
        var c2 = $("#cmbcat2 option:selected").val();
        var c3 = $("#c3").val();
        var nmc3 = $("#nmc3").val();
        var id = $("#id").val();
        var data = {
          'c1' : c1,
          'c2' : c2,
          'c3' : c3,
          'nmc3' : nmc3,
          'id' : id,
        };

        $.ajax({
          type: "post",
          url: $(this).attr('action'),
          data: data,
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
                            $('#cmbcat1').addClass('is-invalid');
                            $('.cmb1').html(response.error.c1);
                        }else{
                            $('#cmbcat1').removeClass('is-invalid');
                            $('.cmb1').html('');
                        }
                        if(response.error.c2){
                            $('#cmbcat2').addClass('is-invalid');
                            $('.cmb2').html(response.error.c2);
                        }else{
                            $('#cmbcat2').removeClass('is-invalid');
                            $('.cmb2').html('');
                        }
                        if(response.error.c3){
                            $('#c3').addClass('is-invalid');
                            $('.errc3').html(response.error.c3);
                        }else{
                            $('#c3').removeClass('is-invalid');
                            $('.errc3').html('');
                        }
                        if(response.error.nmc3){
                            $('#nmc3').addClass('is-invalid');
                            $('.errnmc3').html(response.error.nmc3);
                        }else{
                            $('#nmc3').removeClass('is-invalid');
                            $('.errnmc3').html('');
                        }
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modalEdit').modal('hide');
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