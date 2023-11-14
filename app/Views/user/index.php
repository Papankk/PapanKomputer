    <?= $this->extend('layout/template') ?>

    <?= $this->section('content') ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center fw-bold text-mid">
                    Mau Cari Part Komputer Apa <br> Hari Ini?
                </h1>
            </div>
            <div class="col-8 mt-3 mx-auto">
                <div class="input-group mb-3">
                    <form action="<?= base_url() ?>home/search" method="post" style="display: contents;">
                        <?= csrf_field() ?>
                        <input type="text" name="keyword" class="form-control rounded-pill" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Search">
                        <i class="bi bi-search"></i>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-custom1">
            <div class="row">
                <div class="col">

                    <!-- Kategori -->
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="fw-bold">Berdasarkan Kategori</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                foreach ($category as $c) :
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

                    <!-- Rekomendasi -->
                    <div class="card shadow mt-custom2">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold">Rekomendasi</h4>
                                <div class="ms-auto">
                                    <a href="">
                                        <h6>Selengkapnya</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ms-auto me-auto">
                                <?php
                                if (empty($is_recomend)) {
                                    echo "
                                        <h5 class='text-muted text-center'>
                                            Data tidak ditemukan.
                                        </h5>";
                                }

                                foreach ($is_recomend as $i) :
                                ?>
                                    <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                                        <div class="card shadow my-3">
                                            <img src="<?= base_url() ?>/img/<?= $i->gambar ?>" class="card-img-top p-3 mb-3" alt="" />
                                            <div class="card-body">
                                                <hr class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <p class="small my-auto"><a href="/kategori/<?= $i->slug_kategori ?>" class="text-muted"><?= $i->nama_kategori ?></a></p>
                                                    <a href="/brand/<?= $i->slug_brand ?>">
                                                        <img src="<?= base_url() ?>/img/brand/<?= $i->gambar_brand ?>" width="50px" height="50px" alt="">
                                                    </a>
                                                </div>
                                                <div class="d-flex justify-content-between mb-4 mt-2">
                                                    <div class="col">
                                                        <h5 class="mb-0"><?= $i->nama_barang ?></h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-success text-end mb-0 fw-semibold"><?= number_to_currency($i->harga, 'IDR') ?></h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-muted mb-0">Tersedia : <span class="fw-bold"><?= $i->stok ?></span></p>
                                                    <a class="text-end btn btn-success btn-sm" href="/produk/<?= $i->slug ?>">Beli Sekarang</a>
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

                    <!-- Terbaru -->
                    <div class="card shadow mt-custom2">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold">Terbaru</h4>
                                <div class="ms-auto">
                                    <a href="">
                                        <h6>Selengkapnya</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ms-auto me-auto">
                                <?php
                                if (empty($terbaru)) {
                                    echo "
                                        <h5 class='text-muted text-center'>
                                            Data tidak ditemukan.
                                        </h5>";
                                }

                                foreach ($terbaru as $t) :
                                ?>
                                    <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                                        <div class="card shadow my-3">
                                            <img src="<?= base_url() ?>/img/<?= $t->gambar ?>" class="card-img-top p-3 mb-3" alt="" />
                                            <div class="card-body">
                                                <hr class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <p class="small my-auto"><a href="/kategori/<?= $t->slug_kategori ?>" class="text-muted"><?= $t->nama_kategori ?></a></p>
                                                    <a href="/brand/<?= $t->slug_brand ?>">
                                                        <img src="<?= base_url() ?>/img/brand/<?= $t->gambar_brand ?>" width="50px" height="50px" alt="">
                                                    </a>
                                                </div>
                                                <div class="d-flex justify-content-between mb-4 mt-2">
                                                    <div class="col">
                                                        <h5 class="mb-0"><?= $t->nama_barang ?></h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-success text-end mb-0 fw-semibold"><?= number_to_currency($t->harga, 'IDR') ?></h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-muted mb-0">Tersedia : <span class="fw-bold"><?= $t->stok ?></span></p>
                                                    <a class="text-end btn btn-success btn-sm" href="/produk/<?= $t->slug ?>">Beli Sekarang</a>
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

                    <!-- Brand -->
                    <div class="card shadow mt-custom2">
                        <div class="card-header">
                            <h4 class="fw-bold">Berdasarkan Brand</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php
                                foreach ($brand as $b) :
                                ?>
                                    <div class="col-4 hover col-lg-1">
                                        <a class="link-category" href="/brand/<?= $b['slug_brand'] ?>">
                                            <img src="<?= base_url() ?>/img/brand/<?= $b['gambar_brand'] ?>" alt="<?= $b['nama_brand'] ?>" width="80px">
                                        </a>
                                    </div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Lainnya -->
                    <div class="row">
                        <div class="mt-5">
                            <h4 class="fw-bold">Lainnya : </h4>
                        </div><?php
                                if (empty($lainnya)) {
                                    echo "
                                        <h5 class='text-muted text-center'>
                                            Data tidak ditemukan.
                                        </h5>";
                                }

                                foreach ($lainnya as $l) :
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
                                                <h5 class="text-success text-end mb-0 fw-semibold"><?= number_to_currency($l->harga, 'IDR') ?></h5>
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