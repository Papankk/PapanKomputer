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
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4"><?= lang('Auth.loginTitle') ?></h1>
                        <hr>

                        <?= view('Myth\Auth\Views\_message_block') ?>

                        <form method="POST" action="<?= url_to('login') ?>" autocomplete="off">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']) : ?>
                                <div class="mb-3">
                                    <label class="text-muted" for="email"><?= lang('Auth.email') ?></label>
                                    <input id="email" type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" value="" required placeholder="<?= lang('Auth.email') ?>" autofocus>
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>

                            <?php else : ?>
                                <div class="mb-3">
                                    <label class="text-muted" for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password"><?= lang('Auth.password') ?></label>
                                    <input id="password" type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="<?= lang('Auth.password') ?>" required>
                                </div>
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <?php if ($config->allowRemembering) : ?>
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                        <label for="remember" class="form-check-label"><?= lang('Auth.rememberMe') ?></label>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <?= lang('Auth.loginAction') ?>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            <p><a href="/register"><?= lang('Auth.needAnAccount') ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endSection() ?>