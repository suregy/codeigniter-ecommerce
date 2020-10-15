<?= $this->extend('layoutbackend/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg">

        <!-- tombol input edit delete -->
        <div class="mb-3">
                <button class="btn btn-primary btn-sm tambahData"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
        </div>

        <!-- <select name="kategori" id="kategori" class="form-control">
                            <option value="0">-PILIH-</option>
                            <?php //foreach($data as $row):?>
                                <option value="<?php //echo $row['c1'];?>"><?php //echo $row['namacategory']?></option>
                            <?php //endforeach;?>
                        </select> -->
       

        <div class="card">
            <div class="card-header">
                <?= $judul; ?>
            </div>

            <div class="card-body tabledata"></div>
        </div>
    </div>
</div>

<div class="tampilModal" style="display: none;"></div>

<script>

    var data;

    function tampilData(){
        $.ajax({
            url: "<?= base_url('category/tampildata') ?>",
            dataType: "json",
            success: function(response){
                $('.tabledata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        })
    }

  $(document).ready(function(){

    tampilData();
    
    // tombol tambah di klik
    $('.tambahData').click(function(e){
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('category/Formtambah') ?>",
            dataType: "json",
            success: function(response){
                $('.tampilModal').html(response.data).show(); //show digunakan karena display none

                //tampilkan modal dr file lain
                $('#modalTambah').modal('show');

                // untuk ngirim data c1 ke form
                var data = response.c1;
                var option;
                option += '<option selected value="0">-- Pilih Category --</option>';
                $.each(data, function(i, item) {
                    option += '<option value="'+item.c1+'">'+item.namacategory+'</option>';
                });
                $('#cmbcat1').html(option);
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        })
    });


  });
</script>

<?= $this->endSection(); ?>