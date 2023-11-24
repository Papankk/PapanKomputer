<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<div class="col-lg mb-4 order-0">
    <?php if (session()->getFlashdata('message') || session()->has('errors')) :
    ?>
        <div class="alert <?= (session()->has('errors')) ? 'alert-danger' : 'alert-success' ?> alert-success alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1"><?= (session()->has('errors')) ? 'Error!' : 'Sukses!' ?></h6>
            <p class="mb-0">
                <?php
                if (session()->getFlashdata('message')) {
                    echo session()->getFlashdata('message');
                } else {
                    echo session()->getFlashdata('errors');
                }
                ?>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {

                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                        $(this).remove();
                    });
                }, <?= (session()->has('errors')) ? 5000 : 3000 ?>);

            });
        </script>
    <?php endif;
    ?>
    <div class="card">
        <div class="p-3 table-responsive">
            <h4 class="fw-semibold">Belum dibayar</h4>
            <hr>
            <table class="table display">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dibayar as $bayar) :
                        $no++
                    ?>
                        <tr>
                            <td>#<?= $bayar->order_invoice ?></td>
                            <td><?= number_to_currency($bayar->gross_amount, 'IDR') ?></td>
                            <td>
                                <span class="badge bg-label-warning">Menunggu konfirmasi</span>
                                <span class="badge bg-label-success">Sudah dibayar</span>
                            </td>
                            <td>
                                <a href="/admin/transaksi/update/<?= $bayar->id_payment ?>" class="btn btn-sm btn-success">Konfirmasi</a>
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modaldelete<?= $no ?>">Bukti Pembayaran</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modaldelete<?= $no ?>" tabindex="-1" aria-labelledby="modaldeleteLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaldeleteLabel">Bukti Pembayaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="<?= base_url('img/bukti_pembayaran/' . $bayar->gambar) ?>" alt="" width="500px" class="mx-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <div class="p-3 table-responsive">
            <h4 class="fw-semibold">Dikemas</h4>
            <hr>
            <table class="table display">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dikemas as $kemas) :
                    ?>
                        <tr>
                            <td>#<?= $kemas->order_invoice ?></td>
                            <td><?= number_to_currency($kemas->gross_amount, 'IDR') ?></td>
                            <td>
                                <span class="badge bg-label-primary">Dikemas</span>
                            </td>
                            <td>
                                <a href="/admin/transaksi/update/<?= $kemas->id_payment ?>" class="btn btn-sm btn-success">Konfirmasi</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <div class="p-3 table-responsive">
            <h4 class="fw-semibold">Dikirim</h4>
            <hr>
            <table class="table display">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dikirim as $kirim) :
                    ?>
                        <tr>
                            <td>#<?= $kirim->order_invoice ?></td>
                            <td><?= number_to_currency($kirim->gross_amount, 'IDR') ?></td>
                            <td>
                                <span class="badge bg-label-info">Dikirim</span>
                            </td>
                            <td>
                                <a href="/admin/transaksi/update/<?= $kirim->id_payment ?>" class="btn btn-sm btn-success">Konfirmasi</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <div class="p-3 table-responsive">
            <h4 class="fw-semibold">Sampai tujuan</h4>
            <hr>
            <table class="table display">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($sampai as $s) :
                    ?>
                        <tr>
                            <td>#<?= $s->order_invoice ?></td>
                            <td><?= number_to_currency($s->gross_amount, 'IDR') ?></td>
                            <td>
                                <span class="badge bg-label-secondary">Sampai tujuan</span>
                            </td>
                            <td>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <div class="p-3 table-responsive">
            <h4 class="fw-semibold">Diterima</h4>
            <hr>
            <table class="table display">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($diterima as $terima) :
                    ?>
                        <tr>
                            <td>#<?= $terima->order_invoice ?></td>
                            <td><?= number_to_currency($terima->gross_amount, 'IDR') ?></td>
                            <td>
                                <span class="badge bg-label-secondary">Sampai tujuan</span>
                            </td>
                            <td>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>