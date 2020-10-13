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
        $password = [
			'name' => 'password',
			'id' => 'password',
			'value' => old('password'),
            'class' => $validation->hasError('password') ? 'form-control is-invalid' : 'form-control',
            'type' => 'password',
            'placeholder' => 'input password',
            'autofocus' => 'autofocus'
		];   
    ?>
<section class="contact spad">
    <div class="container">
        <div class="row justify-content-md-center">
        <div class="col-lg-4 col-sm-4">
        <?= $pesan; ?>
        <div class="card">
            <div class="card-body login-card-body">
            <p class="login-box-msg text-center">Masuk ke aplikasi</p>
            <?= form_open('Auth/login') ?>
            <?= csrf_field(); ?>
            <div class="form-group">
                <?= form_label("email", "email") ?>
                <?= form_input($email) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </div>
            </div>
            <div class="form-group">
                <?= form_label("password", "password") ?>
                <?= form_password($password) ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('password') ?>
                </div>
            </div>
            <?= form_submit('submit', 'Login',['class'=>'btn btn-primary btn-block']) ?>
            <?= form_close() ?>

            <!-- untuk link register  -->
            <p class="mt-3 text-center">Belum punya akun ? <a class="text-danger" href="<?= base_url('/register') ?>">Register</a></p>
            <!-- end link register -->
            </div>
            <!-- /.login-card-body -->
        </div> 
        </div>
        </div>
        
    </div>
    </section>
<?= $this->endSection(); ?>