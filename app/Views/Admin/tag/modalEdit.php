!-- Modal add -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Tags</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('tag/update' , ['class' => 'formedit']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">

      <input type="hidden" name="id" id="id" value="<?= $id; ?>">
        
        <table class="table">
            <thead>
                <tr><th>Nama Tags</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td><input class="form-control" type="text" name="nama" id="nama" value="<?= $nama; ?>"> <div class="invalid-feedback nama"></div></td>
                </tr>
            </tbody>
        </table>
      

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
    $('.formedit').submit(function(e){
        e.preventDefault();

        let nama = $("input[name=nama]").val();

        if(nama === '') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'isi kolom nama',
            });
        }else{
            $.ajax({
                type: 'post', 
                url: $(this).attr('action'), 
                dataType: 'json', 
                data: $(this).serialize(), 
                beforeSend: function(){
                    $('.btnSimpan').attr('disabled', 'disabled');
                    $('.btnSimpan').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                complete: function(){
                    $('.btnSimpan').removeAttr('disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) { 
                   
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        $('#modalEdit').modal('hide');
                        tampilData();
                    
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        }
        
        return false;
    });
});
</script>