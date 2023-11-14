<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row w-100">
        <div class="col-lg-12 col-md-12 col-12">
            <h4 class="display-6 fw-semibold mt-5 mb-3 text-center">Keranjang Belanja</h4>
            <p class="mb-5 text-center">
                <b><?= $total_cart ?></b> produk di keranjang
            </p>
            <table id="shoppingCart" class="table table-condensed table-responsive">
                <thead>
                    <tr>
                        <th style="width:60%">Produk</th>
                        <th style="width:10%">Jumlah</th>
                        <th style="width:12%">Harga</th>
                        <th style="width:10%">Subtotal</th>
                        <th style="width:6%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_subtotal = 0;
                    if (empty($cart)) {
                        echo "
                        <tr>
                            <td colspan='5'>
                                <h5 class='text-muted text-center my-3'>
                                    Produk tidak ada.
                                </h5>
                            </td>
                        </tr>";
                    }
                    foreach ($cart as $c) :
                        $subtotal = $c->harga * $c->qty;
                        $total_subtotal += $subtotal;
                    ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-start">
                                        <img src="<?= base_url('img/' . $c->gambar) ?>" alt="" class="img-fluid d-none d-md-block rounded p-3">
                                    </div>
                                    <div class="col-md-9 text-start mt-sm-2">
                                        <h4><?= $c->nama_barang ?></h4>
                                        <p class="font-weight-light text-secondary"><?= $c->nama_kategori ?></p>
                                        <img src="<?= base_url() ?>/img/brand/<?= $c->gambar_brand ?>" alt="gambar brand" width="40px">
                                    </div>
                                </div>
                            </td>
                            <td data-th="Quantity">
                                <input type="number" class="form-control form-control-sm text-center" value="<?= $c->qty ?>" readonly>
                            </td>
                            <td data-th="Price" class="text-success"><?= number_to_currency($c->harga, 'IDR') ?></td>
                            <td class="text-success">
                                <?php
                                $subtotal = $c->harga * $c->qty
                                ?>
                                <?= number_to_currency($subtotal, 'IDR') ?>
                            </td>
                            <td class="actions" data-th="">
                                <div class="text-end">
                                    <button class="btn btn-danger btn-sm mb-2">
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="float-right text-end">
                <h4>Total:</h4>
                <h2 class="text-success"><?= number_to_currency($total_subtotal, 'IDR') ?></h2>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-flex align-items-center">
        <div class="col-sm-6 order-md-2 text-end">
            <a href="catalog.html" class="btn btn-primary mb-4 btn-md px-5">Checkout</a>
        </div>
        <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-start">
            <a href="<?= base_url('home') ?>" class="text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i> Lanjut Belanja
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>