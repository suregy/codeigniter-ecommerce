<?= $this->extend('layoutbackend/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg">

        <!-- tombol input edit delete -->
        <div class="mb-3">
                <button class="btn btn-primary btn-sm tambahData"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
        </div>

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
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        })
    });


  });
</script>

<?= $this->endSection(); ?>