<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8">
                <h3 class="fw-bold mb-5">Checkout</h3>
                <!-- Checkout -->
                <div class="card shadow-0 border">
                    <div class="p-4">
                        <h5 class="card-title mb-4">Alamat Pengiriman</h5>
                        <form action="<?= base_url('insert-order') ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="gross" value="<?= $subtotal + $ongkir ?>">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <p class="mb-0">Nama Lengkap</p>
                                    <div class="form-outline">
                                        <input type="text" name="nama" id="typeText" placeholder="Nama Lengkap" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <p class="mb-0">Nomor Telepon</p>
                                    <div class="form-outline">
                                        <input type="text" id="typeText" placeholder="Nomor Telepon" name="no_telp" class="form-control" required />
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">Provinsi</p>
                                    <div class="form-outline">
                                        <select class="form-select" name="id_provinsi" id="id_provinsi" required>
                                            <option value="">--Pilih Provinsi--</option>
                                            <?php
                                            foreach ($provinsi as $p) :
                                            ?>
                                                <option value="<?= $p->id_provinsi ?>"><?= $p->nama_provinsi ?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">Kota/Kabupaten</p>
                                    <div class="form-outline">
                                        <select class="form-select" name="id_kabupaten" id="id_kabupaten" required>
                                            <option value="">--Pilih Kota/Kabupaten--</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 mb-3">
                                    <p class="mb-0">Kecamatan</p>
                                    <div class="form-outline">
                                        <select class="form-select" name="id_kecamatan" id="id_kecamatan" required>
                                            <option value="">--Pilih Kecamatan--</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <p class="mb-0">Alamat</p>
                                    <div class="form-outline">
                                        <textarea class="form-control" name="alamat" id="" rows="5" required></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-3">
                                    <p class="mb-0">Screenshot / Foto bukti pembayaran</p>
                                    <div class="form-outline">
                                        <input type="file" name="bukti_pembayaran" class="form-control" required />
                                    </div>
                                </div>

                            </div>

                            <div class="float-end">
                                <a class="btn btn-light border" href="/keranjang">Kembali ke Keranjang</a>
                                <button type="submit" class="btn btn-success shadow-0 border">Checkout</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Checkout -->
            </div>
            <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
                    <h6 class="text-dark my-4">Rincian</h6>

                    <?php
                    foreach ($cart as $c) :
                    ?>
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-3 position-relative">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-secondary">
                                    <?= $c->qty ?>
                                </span>
                                <img src="<?= base_url() ?>/img/<?= $c->gambar ?>" style="height: 96px; width: 96x;" class="img-sm rounded border p-1" />
                            </div>
                            <div class="">
                                <?= $c->nama_barang ?>
                                <div class="price text-muted">Total: <?= number_to_currency($c->price, 'IDR') ?></div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Subtotal:</p>
                        <p class="mb-2 text-success"><?= number_to_currency(intval($subtotal), 'IDR') ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Biaya lainnya:</p>
                        <p class="mb-2 text-success">+ <?= number_to_currency(intval($ongkir), 'IDR') ?></p>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Total bayar:</p>
                        <p class="mb-2 fw-bold text-success"><?= number_to_currency($subtotal + $ongkir, 'IDR') ?></p>
                    </div>
                    <div class="card p-3 mt-5">
                        <h4>Scan <img src="<?= base_url('img/bukti_pembayaran/qris.png') ?>" alt="" style="width: 50px;"></h4>
                        <img src="<?= base_url('img/bukti_pembayaran/QR Code.png') ?>" alt="" class="img-md rounded border p-1">
                        <hr>
                        <h4>BRI Virtual Account</h4>
                        <h6 class="mt-2">311860000001031</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {

        $("#id_provinsi").change(function(e) {
            var id_provinsi = $('#id_provinsi').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('item/kabupaten') ?>",
                data: {
                    id_provinsi: id_provinsi
                },
                success: function(response) {
                    $('#id_kabupaten').html(response);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        $("#id_kabupaten").change(function(e) {
            var id_kabupaten = $('#id_kabupaten').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('item/kecamatan') ?>",
                data: {
                    id_kabupaten: id_kabupaten
                },
                success: function(response) {
                    $('#id_kecamatan').html(response);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>