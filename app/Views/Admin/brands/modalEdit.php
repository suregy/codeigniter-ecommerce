<!-- Modal add -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Brands</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('brands/update' , ['class' => 'formbrands']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        
        <table class="table">
            <thead>
                <tr><th>Nama Brands</th></tr>
            </thead>
            <tbody class="addBulk">
            <input type="hidden" name="id" value="<?= $id; ?>">
                <tr>
                    <td><input class="form-control" type="text" name="nama" id="nama" value ="<?= $namabrands; ?>" ></td>
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

    $('.formbrands').submit(function(e){
        e.preventDefault();
        let nama = $("input[name='nama']").val();
        if(nama === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'nama tidak boleh kosong',
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
                        title: 'Updated',
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
    });

});
</script>