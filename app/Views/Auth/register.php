
<?= $this->extend('layoutfontend/template') ?>

<?= $this->section('content') ?>
    <?php
        $email = [
			'name' => 'email',
			'id' => 'email',
            'class' => $validation->hasError('email') ? 'form-control is-invalid' : 'form-control',
            'type' => 'email',
            'value' => old('email'),
            'placeholder' => 'input email',
            'autofocus' => 'autofocus'
		];
        $namadepan = [
			'name' => 'namadepan',
			'id' => 'namadepan',
			'value' => null,
            'class' => $validation->hasError('namadepan') ? 'form-control is-invalid' : 'form-control',
            'type' => 'text',
            'value' => old('namadepan'),
            'placeholder' => 'input Nama Depan',
            'autofocus' => 'autofocus'
		];
        $namabelakang = [
			'name' => 'namabelakang',
			'id' => 'namabelakang',
			'value' => old('namabelakang'),
            'class' => 'form-control',
            'type' => 'text',
            'placeholder' => 'input Nama Belakang',
            'autofocus' => 'autofocus'
		];
        $notelpon = [
			'name' => 'notelpon',
			'id' => 'notelpon',
			'value' => old('notelpon'),
            'class' => $validation->hasError('notelpon') ? 'form-control is-invalid' : 'form-control',
            'type' => 'text',
            'placeholder' => 'nomor telpon',
            'autofocus' => 'autofocus'
		];
        $tgllahir = [
			'name' => 'tgllahir',
			'id' => 'tgllahir',
			'value' => old('tgllahir'),
            'class' => $validation->hasError('tgllahir') ? 'form-control date is-invalid' : 'form-control date',
            'type' => 'text',
            'placeholder' => 'YYYY - MM - DD',
            'autofocus' => 'autofocus'
		];
        $password = [
			'name' => 'password',
			'id' => 'password',
			'value' => old('password'),
            'class' => $validation->hasError('password') ? 'form-control is-invalid' : 'form-control',
            'type' => 'password',
            'placeholder' => 'input password',
            'autofocus' => 'autofocus'
		];
        $repassword = [
			'name' => 'repassword',
			'id' => 'repassword',
			'value' => old('repassword'),
            'class' => $validation->hasError('repassword') ? 'form-control is-invalid' : 'form-control',
            'type' => 'password',
            'placeholder' => 'ulangi password',
            'autofocus' => 'autofocus'
        ];

        
    ?>
<section class="contact spad">
    <div class="container">
        <div class="row justify-content-md-center">
        <div class="col-lg-4 col-sm-4">
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg text-center">Register untuk promo yang hebat</p>

            <!-- untuk list error -->
            <?php # if($validation->getErrors() != null) : ?>
                <!-- <div class="alert alert-danger" role="alert"> -->
                    <?php #echo  $validation->listErrors(); ?>
                <!-- </div> -->
            <?php #endif; ?>
            <!-- untuk list error -->

            <?= form_open('Auth/register') ?>
            <?= csrf_field(); ?>
            <div class="form-group">
                <?= form_label("email", "email") ?>
                <?= form_input($email) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("Nama Depan", "Nama Depan") ?>
                <?= form_input($namadepan) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('namadepan') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("Nama Belakang", "Nama Belakang") ?>
                <?= form_input($namabelakang) ?>
            </div>
            <div class="form-group">
                <?= form_label("notelpon", "Nomor Telpon") ?>
                <?= form_input($notelpon) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('notelpon') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("tanggal lahir", "Nomor Telpon") ?>
                <?= form_input($tgllahir) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('tgllahir') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("password", "password") ?>
                <?= form_password($password) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('password') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("Repassword", "Repassword") ?>
                <?= form_input($repassword) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('repassword') ?>
                </div>
            </div>
            <?= form_submit('submit', 'Submit',['class'=>'btn btn-primary btn-block']) ?>
            <?= form_close() ?>
            </div>
            <!-- /.login-card-body -->
        </div> 
        </div>
        </div>
        
    </div>
    
</section>

<?= $this->endSection(); ?>
