<?php $this->extend('layout/auth_template') ?>

<?php $this->section('content') ?>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-4">
                    <img src="/img/logo.png" alt="logo" width="100">
                </div>
                <div class="mb-1">
                    <a href="/"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="card shadow-lg mb-3">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4"><?= lang('Auth.register') ?></h1>
                        <hr>

                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <form method="POST" action="<?= url_to('register') ?>" class="needs-validation" autocomplete="off">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="username"><?= lang('Auth.username') ?></label>
                                <input id="username" type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" value="<?= old('username') ?>" placeholder="<?= lang('Auth.username') ?>" required autofocus>
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email"><?= lang('Auth.email') ?></label>
                                <input id="email" type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= old('email') ?>" placeholder="<?= lang('Auth.email') ?>" required>
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password"><?= lang('Auth.password') ?></label>
                                <input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                <input id="pass_confirm" type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="align-items-center d-flex">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <?= lang('Auth.register') ?>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            <p><?= lang('Auth.alreadyRegistered') ?> <a href="/login"><?= lang('Auth.signIn') ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->endSection() ?>