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
}
?>

<div class="container">
    <div class="row">
        <div class="col mt-5">
            <h3 class="fw-semibold my-3">
                Pesanan Saya
            </h3>
            <div class="card my-5">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="panel-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pembayaran" role="tab" aria-controls="pembayaran" aria-selected="true">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dikemas" role="tab" aria-controls="dikemas" aria-selected="false">Dikemas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dikirim" role="tab" aria-controls="dikirim" aria-selected="false">Dikirim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sampai" role="tab" aria-controls="sampai" aria-selected="false">Sudah sampai</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#diterima" role="tab" aria-controls="diterima" aria-selected="false">Diterima</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="pembayaran" role="tabpanel">
                            <table id="shoppingCart" class="table table-condensed table-responsive">
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
                                    if (empty($dibayar)) {
                                        echo "
                                                <tr>
                                                    <td colspan='7'>
                                                        <h5 class='text-muted text-center my-3'>
                                                            Belum ada pesanan!
                                                        </h5>
                                                    </td>
                                                </tr>";
                                    }
                                    foreach ($dibayar as $bayar) :
                                    ?>
                                        <tr>
                                            <td>#<?= $bayar->order_invoice ?></td>
                                            <td><?= number_to_currency($bayar->gross_amount, 'IDR') ?></td>
                                            <td>
                                                <span class="badge text-bg-warning">Menunggu konfirmasi</span>
                                                <span class="badge text-bg-success">Sudah dibayar</span>
                                            </td>
                                            <td>
                                                <a href="/invoice/<?= $bayar->order_invoice ?>" class="btn btn-sm btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class=" tab-pane" id="dikemas" role="tabpanel" aria-labelledby="history-tab">
                            <table id="shoppingCart" class="table table-condensed table-responsive">
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
                                    if (empty($dikemas)) {
                                        echo "
                                                <tr>
                                                    <td colspan='7'>
                                                        <h5 class='text-muted text-center my-3'>
                                                            Belum ada pesanan!
                                                        </h5>
                                                    </td>
                                                </tr>";
                                    }
                                    foreach ($dikemas as $kemas) :
                                    ?>
                                        <tr>
                                            <td>#<?= $kemas->order_invoice ?></td>
                                            <td><?= number_to_currency($kemas->gross_amount, 'IDR') ?></td>
                                            <td>
                                                <span class="badge text-bg-info">Dikemas</span>
                                            </td>
                                            <td>
                                                <a href="/invoice/<?= $kemas->order_invoice ?>" class="btn btn-sm btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="dikirim" role="tabpanel" aria-labelledby="deals-tab">
                            <table id="shoppingCart" class="table table-condensed table-responsive">
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
                                    if (empty($dikirim)) {
                                        echo "
                                                <tr>
                                                    <td colspan='7'>
                                                        <h5 class='text-muted text-center my-3'>
                                                            Belum ada pesanan!
                                                        </h5>
                                                    </td>
                                                </tr>";
                                    }
                                    foreach ($dikirim as $kirim) :
                                    ?>
                                        <tr>
                                            <td>#<?= $kirim->order_invoice ?></td>
                                            <td><?= number_to_currency($kirim->gross_amount, 'IDR') ?></td>
                                            <td>
                                                <span class="badge text-bg-info">Dikirim</span>
                                            </td>
                                            <td>
                                                <a href="/invoice/<?= $kirim->order_invoice ?>" class="btn btn-sm btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="sampai" role="tabpanel" aria-labelledby="deals-tab">
                            <table id="shoppingCart" class="table table-condensed table-responsive">
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
                                    if (empty($sampai)) {
                                        echo "
                                                <tr>
                                                    <td colspan='7'>
                                                        <h5 class='text-muted text-center my-3'>
                                                            Belum ada pesanan!
                                                        </h5>
                                                    </td>
                                                </tr>";
                                    }
                                    foreach ($sampai as $s) :
                                    ?>
                                        <tr>
                                            <td>#<?= $s->order_invoice ?></td>
                                            <td><?= number_to_currency($s->gross_amount, 'IDR') ?></td>
                                            <td>
                                                <span class="badge text-bg-success">Sudah sampai</span>
                                            </td>
                                            <td>
                                                <a href="/invoice/<?= $s->order_invoice ?>" class="btn btn-sm btn-primary">Detail</a>
                                                <a href="/invoice/update/<?= $s->id_payment ?>" class="btn btn-sm btn-success">Konfirmasi</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="diterima" role="tabpanel" aria-labelledby="deals-tab">
                            <table id="shoppingCart" class="table table-condensed table-responsive">
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
                                    if (empty($diterima)) {
                                        echo "
                                                <tr>
                                                    <td colspan='7'>
                                                        <h5 class='text-muted text-center my-3'>
                                                            Belum ada pesanan!
                                                        </h5>
                                                    </td>
                                                </tr>";
                                    }
                                    foreach ($diterima as $terima) :
                                    ?>
                                        <tr>
                                            <td>#<?= $terima->order_invoice ?></td>
                                            <td><?= number_to_currency($terima->gross_amount, 'IDR') ?></td>
                                            <td>
                                                <span class="badge text-bg-success">Diterima</span>
                                            </td>
                                            <td>
                                                <a href="/invoice/<?= $terima->order_invoice ?>" class="btn btn-sm btn-primary">Detail</a>
                                                <a href="/invoice/delete/<?= $terima->id_payment ?>" class="btn btn-sm btn-danger">Hapus</a>
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
            </div>
        </div>
    </div>
</div>

<script>
    $('#panel-tab a').on('click', function(e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>


<?= $this->endSection() ?>