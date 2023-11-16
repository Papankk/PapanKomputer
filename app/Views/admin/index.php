<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>


<div class="col-lg-4 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Data Produk</h5>
                    <p class="mb-4">
                        Jumlah produk yang terdaftar :
                        <br><span style="font-size: 60px;"><?= $itemCount ?></span>
                    </p>
                    <a href="/admin/produk" class="btn btn-sm btn-outline-primary">Manage <i class="tf-icons bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Data User</h5>
                    <p class="mb-4">
                        Jumlah user yang terdaftar :
                        <br><span style="font-size: 60px;"><?= $userCount ?></span>
                    </p>
                    <a href="/admin/kategori" class="btn btn-sm btn-outline-primary">Manage <i class="tf-icons bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Data Brand</h5>
                    <p class="mb-4">
                        Jumlah brand yang terdaftar :
                        <br><span style="font-size: 60px;"><?= $brandCount ?></span>
                    </p>
                    <a href="/admin/brand" class="btn btn-sm btn-outline-primary">Manage <i class="tf-icons bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Data Kategori</h5>
                    <p class="mb-4">
                        Jumlah kategori yang terdaftar :
                        <br><span style="font-size: 60px;"><?= $categoryCount ?></span>
                    </p>
                    <a href="/admin/kategori" class="btn btn-sm btn-outline-primary">Manage <i class="tf-icons bx bx-right-arrow-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>