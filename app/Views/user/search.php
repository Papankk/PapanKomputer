<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-8 mt-3 mx-auto">
            <div class="input-group mb-3">
                <form action="<?= base_url() ?>home/search" method="post" style="display: contents;">
                    <?= csrf_field() ?>
                    <input type="text" name="keyword" class="form-control rounded-pill" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Search">
                    <i class="bi bi-search"></i>
                </form>
            </div>
        </div>
        <div class="mt-5">
            <h4 class="fw-regular">Hasil pencarian <b>"<?= $keyword ?>" </b> : </h4>
        </div>
        <?php if (isset($message)) : ?>
            <div><?= $message; ?></div>
        <?php endif; ?>
        <?php

        if (!$results) {
        ?>
            <div class="text-center my-3">
                <h5 class="text-muted">
                    Data tidak ditemukan!
                </h5>
            </div>
        <?php
        }
        foreach ($results as $l) :
        ?>
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow my-3">
                    <img src="<?= base_url() ?>/img/<?= $l['gambar'] ?>" class="card-img-top p-3 mb-3" alt="" />
                    <div class="card-body">
                        <hr class="mb-3">
                        <div class="d-flex justify-content-between">
                            <p class="small my-auto"><a href="/kategori/<?= $l['slug_kategori'] ?>" class="text-muted"><?= $l['nama_kategori'] ?></a></p>
                            <a href="/brand/<?= $l['slug_brand'] ?>">
                                <img src="<?= base_url() ?>/img/brand/<?= $l['gambar_brand'] ?>" width="50px" height="50px" alt="">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between mb-4 mt-2">
                            <div class="col">
                                <h5 class="mb-0"><?= $l['nama_barang'] ?></h5>
                            </div>
                            <div class="col">
                                <h5 class="text-success text-end mb-0"><?= number_to_currency($l['harga'], 'IDR') ?></h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-muted mb-0">Tersedia : <span class="fw-bold"><?= $l['stok'] ?></span></p>
                            <a class="text-end btn btn-success btn-sm" href="/produk/<?= $l['slug'] ?>">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>

<?= $this->endSection() ?>