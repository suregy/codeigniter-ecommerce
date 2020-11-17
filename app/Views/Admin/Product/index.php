<?= $this->extend('layoutbackend/template') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg">

        <p> <?= $judul; ?></p>

        <!-- tombol input edit delete -->
        <div class="mb-3">
            <button class="btn btn-primary btn-sm tambahData"> <i class="fas fa-plus-circle"></i> Tambah Data</button>
            <button class="btn btn-default btn-sm inputDetail"> <i class="fas fa-plus-circle"></i> Input Detail</button>
            <button class="btn btn-success btn-sm btnEdit"> <i class="fas fa-edit"></i> Edit</button>
            <button class="btn btn-danger btn-sm btnDelete"> <i class="fas fa-trash"></i> Delete</button>
        </div>


        <div class="mb-3 col-md-6">
            <select class="select" name="cmbc1" id="cmbc1">
                <option value="">-- Pilih Category 1 --</option>
                <?php foreach ($c1 as $c1) : ?>
                    <option value="<?= $c1['c1'] ?>"><?= $c1['namacategory'] ?></option>
                <?php endforeach; ?>
            </select>
            <select class="select" name="cmbc2" id="cmbc2">
                <option value="">-- Pilih Category 2 --</option>
            </select>
            <select class="select" name="cmbc3" id="cmbc3">
                <option value="">-- Pilih Category 3 --</option>
            </select>
        </div>
        <div class="card viewcard"></div>
    </div>
</div>

<div class="tampilModal" style="display: none;"></div>

<!-- untuk javascript -->

<script type="text/javascript" src="<?= base_url('customjs/product.js') ?>"></script>



<?= $this->endSection(); ?>