<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header">
                    Pesanan <strong>#<?= $invoice['order_invoice'] ?></strong>
                    <?php
                    if ($invoice['status'] == 0) {
                    ?>
                        <div class="float-end">
                            <span class="badge text-bg-warning">Menunggu konfirmasi</span>
                            <span class="badge text-bg-success">Sudah dibayar</span>
                        </div>
                    <?php
                    } elseif ($invoice['status'] == 1) {
                    ?>
                        <div class="float-end">
                            <span class="badge text-bg-primary">Pesanan dikemas</span>
                        </div>
                    <?php
                    } elseif ($invoice['status'] == 2) {
                    ?>
                        <div class="float-end">
                            <span class="badge text-bg-secondary">Pesanan dikirim</span>
                        </div>
                    <?php
                    } elseif ($invoice['status'] == 3) {
                    ?>
                        <div class="float-end">
                            <span class="badge text-bg-info">Pesanan sampai di tujuan</span>
                        </div>
                    <?php
                    } elseif ($invoice['status'] == 4) {
                    ?>
                        <div class="float-end">
                            <span class="badge text-bg-success">Pesanan diterima</span>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="mb-3">Dari:</h6>
                            <div><strong>Papank Komputer</strong></div>
                            <div>Indonesia, Jawa Timur, Kota Malang, Klojen</div>
                            <div>Jl. Jend. Basuki Rahmad 24A</div>
                            <div>Email: papankomputer@gmail.com</div>
                            <div>Nomor Telepon: +628970537844</div>
                        </div>

                        <div class="col-sm-6">
                            <h6 class="mb-3">Kepada:</h6>
                            <div><strong><?= $invoice['nama'] ?></strong></div>
                            <div><?= $invoice['nama_provinsi'] ?>, <?= $invoice['nama_kabupaten'] ?>, <?= $invoice['nama_kecamatan'] ?></div>
                            <div><?= $invoice['alamat'] ?></div>
                            <div>Email: <?= user()->email ?></div>
                            <div>Nomor Telepon: <?= $invoice['no_telp'] ?></div>
                        </div>

                    </div>

                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">#</th>
                                    <th style="width:60%">Produk</th>
                                    <th style="width:10%">Jumlah</th>
                                    <th style="width:12%">Harga</th>
                                    <th style="width:10%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($cart as $c) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td class="left"><?= $c->nama_barang ?></td>
                                        <td class="center"><?= $c->qty ?></td>
                                        <td class="right"><?= number_to_currency($c->harga, 'IDR') ?></td>
                                        <td class="right"><?= number_to_currency($c->price, 'IDR') ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5 ms-auto">
                            <table class="table table-clear mb-3">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right"><?= number_to_currency($subtotal, 'IDR') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Biaya lainnya</strong></td>
                                        <td class="right"><?= number_to_currency($ongkir, 'IDR') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total Bayar</strong></td>
                                        <td class="right"><strong><?= number_to_currency($ongkir + $subtotal, 'IDR') ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>