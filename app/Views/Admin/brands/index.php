<?= $this->extend('layoutbackend/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg">

        <p> <?= $judul; ?></p>

        <!-- tombol input edit delete -->
        <div class="mb-3">
            <button class="btn btn-primary btn-sm tambahData"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
            <button class="btn btn-success btn-sm btnEdit"> <i class="fas fa-edit"></i> Edit</button>
            <button class="btn btn-danger btn-sm btnDelete"> <i class="fas fa-trash"></i> Delete</button>
        </div>
       
        <div class="card viewcard">
            
        </div>
    </div>
</div>

<div class="tampilModal" style="display: none;"></div>

<!-- untuk javascript -->

<script type="text/javascript" src="<?= base_url('customjs/brands.js') ?>"></script>



<?= $this->endSection(); ?>