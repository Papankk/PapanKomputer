<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h4 class="fw-bold">Berdasarkan Kategori</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    foreach ($categoryall as $c) :
                                    ?>
                                        <div class="col-4 hover col-lg-2">
                                            <a class="link-category" href="/kategori/<?= $c['slug_kategori'] ?>">
                                                <div class="bg-category p-3 text-center btn-category ms-auto me-auto">
                                                    <i class="bi bi-<?= $c['icon'] ?> icon-category"></i>
                                                </div>
                                                <h5 class="text-center fw-semibold"><?= $c['nama_kategori'] ?></h5>
                                            </a>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-5">
                        <h4 class="fw-regular">Kategori <b>"<?= $category['nama_kategori'] ?>" </b> : </h4>
                    </div>
                    <?php
                    if (empty($categoryresult)) {
                        echo "
                                        <h5 class='text-muted text-center my-3'>
                                            Data tidak ditemukan.
                                        </h5>";
                    }

                    foreach ($categoryresult as $l) :
                    ?>
                        <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                            <div class="card shadow my-3">
                                <img src="<?= base_url() ?>/img/<?= $l->gambar ?>" class="card-img-top p-3 mb-3" alt="" />
                                <div class="card-body">
                                    <hr class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <p class="small my-auto"><a href="/kategori/<?= $l->slug_kategori ?>" class="text-muted"><?= $l->nama_kategori ?></a></p>
                                        <a href="/brand/<?= $l->slug_brand ?>">
                                            <img src="<?= base_url() ?>/img/brand/<?= $l->gambar_brand ?>" width="50px" height="50px" alt="">
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4 mt-2">
                                        <div class="col">
                                            <h5 class="mb-0"><?= $l->nama_barang ?></h5>
                                        </div>
                                        <div class="col">
                                            <h5 class="text-success text-end mb-0"><?= number_to_currency($l->harga, 'IDR') ?></h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-muted mb-0">Tersedia : <span class="fw-bold"><?= $l->stok ?></span></p>
                                        <a class="text-end btn btn-success btn-sm" href="/produk/<?= $l->slug ?>">Beli Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>