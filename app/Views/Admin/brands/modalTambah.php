<!-- Modal add -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Brands</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('brands/store' , ['class' => 'formbrands']) ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        
        <table class="table">
            <thead>
                <tr><th>Nama Brands</th></tr>
            </thead>
            <tbody class="addBulk">
                <tr>
                    <td><input class="form-control" type="text" name="nama[]" id="nama"> <div class="invalid-feedback nama"></div></td>
                    <td>
                        <button type="button" class="btn btn-primary btnaddFrm"> <i class="fas fa-plus-circle"></i> </button>
                    </td>
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

$(document).ready(function(e){

    /** untuk bulk */
    $('.btnaddFrm').click(function(e){
        e.preventDefault();
        $('.addBulk').append(`
            <tr>
                <td><input class="form-control" type="text" name="nama[]" id="nama"> <div class="invalid-feedback nama"></div></td>
                <td>
                    <button type="button" class="btn btn-danger btnDel"> <i class="fas fa-trash"></i> </button>
                </td>
            </tr>
        `);
    });

    /** untuk handle simpan */
    $('.formbrands').submit(function(e){
        e.preventDefault();
        let namabrands = [];
        let bulk = $('.addBulk').children().length;
        $("input[name='nama[]']").each(function(){
            let value = $(this).val();
            if(value){
                namabrands.push(value);
            }
        });

        if(namabrands.length !== bulk){
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
                    $('#modalTambah').modal('hide');
                    tampilData();
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        }


    });

});

/**untuk hapus bulk */
$(document).on('click', '.btnDel', function(e){
    e.preventDefault();
    $(this).parents('tr').remove();
});

</script>