<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
if (session()->getFlashdata('message')) {
?>
    <script>
        toastr.options = {
            "positionClass": "toast-top-center"
        }

        toastr.success("<?= session()->getFlashdata('message') ?>");
    </script>
<?php
} elseif (session()->getFlashdata('gagal')) {
?>
    <script>
        toastr.options = {
            "positionClass": "toast-top-center"
        }

        toastr.error("<?= session()->getFlashdata('gagal') ?>");
    </script>
<?php
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <!-- Product section-->
            <section class="py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6" id="container-img">
                            <div class="magnify-container">
                                <img class="card-img mb-5 mb-md-0" src="<?= base_url() ?>/img/<?= $item['gambar'] ?>" alt="..." id="magnify-image" />
                                <div class="magnify-overlay"></div>
                            </div>
                        </div>

                        <style>
                            .magnify-container {
                                position: relative;
                                overflow: hidden;
                            }

                            .magnify-overlay {
                                position: absolute;
                                width: 100%;
                                height: 100%;
                                top: 0;
                                left: 0;
                                background: url('<?= base_url() ?>/img/<?= $item['gambar'] ?>') no-repeat;
                                background-size: 300%;
                                /* Adjust the magnification level */
                                pointer-events: none;
                                opacity: 0;
                                transition: opacity 0.3s ease-in-out;
                            }

                            #magnify-image {
                                width: 100%;
                                max-width: 100%;
                                display: block;
                                cursor: zoom-in;
                            }
                        </style>

                        <script>
                            var magnifyContainer = document.querySelector('.magnify-container');
                            var magnifyOverlay = document.querySelector('.magnify-overlay');

                            magnifyContainer.addEventListener('mousemove', function(e) {
                                var rect = magnifyContainer.getBoundingClientRect();
                                var x = e.clientX - rect.left;
                                var y = e.clientY - rect.top;

                                var bgPosX = (x / rect.width) * 100;
                                var bgPosY = (y / rect.height) * 100;

                                magnifyOverlay.style.backgroundPosition = bgPosX + '% ' + bgPosY + '%';
                                magnifyOverlay.style.opacity = 1;
                            });

                            magnifyContainer.addEventListener('mouseout', function() {
                                magnifyOverlay.style.opacity = 0;
                            });
                        </script>

                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder"><?= $item['nama_barang'] ?></h1>
                            <div class="fs-5 mb-5 text-success">
                                <span class="fw-semibold"><?= number_to_currency($item['harga'], 'IDR') ?></span>
                            </div>
                            <p class="lead" style="text-align: justify;">
                                <?= $item['deskripsi'] ?><br><br>
                                <b>Stok : </b><?= $item['stok'] ?><br>
                                <b>Kategori : </b><a class="text-muted" href="/kategori/<?= $item['slug_kategori'] ?>"><?= $item['nama_kategori'] ?></a><br>
                                <b>Brand : </b><a href="/brand/<?= $item['slug_brand'] ?>"><img src="<?= base_url() ?>/img/brand/<?= $item['gambar_brand'] ?>" alt="gambar brand" width="80px"></a>
                            </p>
                            <form action="<?= base_url('cart/insert') ?>" method="post">
                                <?php
                                session()->setFlashdata('url', $item['slug']);
                                ?>
                                <input type="hidden" name="id_barang" value="<?= $item['id_barang'] ?>">
                                <input type="hidden" name="nama_barang" value="<?= $item['nama_barang'] ?>">
                                <input type="hidden" name="harga" value="<?= $item['harga'] ?>">
                                <input type="hidden" name="gambar" value="<?= $item['gambar'] ?>">
                                <input type="hidden" name="stok" value="<?= $item['stok'] ?>">
                                <div class="d-flex">
                                    <input class="form-control text-center me-3" id="inputQuantity" name="jml_barang" value="1" type="number" min="1" max="<?= $item['stok'] ?>" style="max-width: 4rem" <?= ($item['stok'] <= 0) ? 'readonly' : '' ?> />
                                    <button class="btn btn-<?= ($item['stok'] <= 0) ? 'danger' : 'success' ?> flex-shrink-0" type="submit" <?= ($item['stok'] <= 0) ? 'disabled' : '' ?>>
                                        <?php
                                        if ($item['stok'] <= 0) {
                                        ?><i class="bi bi-x-circle"></i>
                                            Stok habis!
                                        <?php
                                        } else {
                                        ?>
                                            <i class="bi-cart-fill me-1"></i>
                                            Tambahkan ke Keranjang
                                        <?php
                                        }
                                        ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Related items section-->
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <h2 class="fw-bolder mb-4">Produk Lainnya</h2>
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <?php
                        foreach ($lainnya as $l) :
                        ?>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <!-- Product image-->
                                    <img class="card-img-top p-3" src="<?= base_url() ?>/img/<?= $l->gambar ?>" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder"><?= $l->nama_barang ?></h5>
                                            <!-- Product price-->
                                            <p class="text-success fw-semibold"><?= number_to_currency($l->harga, 'IDR') ?></p>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-success mt-auto" href="/produk/<?= $l->slug ?>">Beli Sekarang</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?= $this->endSection() ?>