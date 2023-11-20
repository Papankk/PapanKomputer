<!DOCTYPE html>
<html lang="en">

<?php
$itemModel = model('CartModel');
$itemModel->where('user', user_id());
$jumlah_cart = $itemModel->countAllResults();
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/home">
                <img src="/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body text-center">
                    <div class="navbar-collapse" id="navbarNavAltMarkup">
                        <div class="ms-auto navbar-nav">
                            <div class="dropdown">
                                <a class="nav-link hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="d-inline-flex align-items-center">
                                        <?php
                                        if (logged_in()) {
                                        ?>
                                            <img src="<?= base_url() ?>/img/default.jpg" class="rounded-circle me-2" alt="">
                                            <div class="mt-3 fw-semibold">
                                                <p class=""><?= user()->username ?></p>
                                            </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li>
                                        <a class="dropdown-item disabled" href="#" aria-disabled="true">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= base_url() ?>/img/<?= user()->profile_image ?>" alt="user" class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block mt-2"><?= user()->username ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                            if (in_groups('admin')) {
                                    ?>
                                        <li>
                                            <a class="dropdown-item" href="/admin">
                                                <i class="bi bi-speedometer2 me-2"></i>
                                                <span class="align-middle">Admin Dashboard</span>
                                            </a>
                                        </li>
                                    <?php
                                            }
                                    ?>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="profil/">
                                            <i class="bi bi-person me-2"></i>
                                            <span class="align-middle">Edit Profil</span>
                                        </a>
                                    </li>
                                    <style>
                                        .badge {
                                            left: 35px;
                                            font-size: 10px;
                                        }
                                    </style>
                                    <li class="position-relative">
                                        <a class="dropdown-item" href="<?= base_url('keranjang') ?>">
                                            <i class="bi bi-cart me-2"></i>
                                            <span class="align-middle">Keranjang</span>
                                            <?php
                                            if ($jumlah_cart > 0) :
                                            ?>
                                                <span class="position-absolute translate-middle badge rounded-pill bg-danger">
                                                    <?= $jumlah_cart ?>
                                                </span>
                                            <?php
                                            endif;
                                            ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="profil/">
                                            <i class="bi bi-truck me-2"></i>
                                            <span class="align-middle">Pesanan Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/logout">
                                            <i class="bi bi-power me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            <?php
                                        } else {
                            ?>
                                <a class="btn btn-primary shadow-sm mb-3" href="/login">Sign Up</a>
                            <?php
                                        }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <?php $this->renderSection('content') ?>

    <footer class="text-center text-lg-start text-secondary bg-body-tertiary">
        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-custom">
                <!-- Grid row -->
                <div class="row mt-5 pt-5">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">Papank Komputer</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            "Papank Komputer" adalah sebuah toko komputer yang menyediakan berbagai macam produk dan layanan terkait teknologi. Mereka mengkhususkan diri dalam penjualan dan perangkat keras komputer, termasuk laptop, desktop, komponen, dan aksesori terkait lainnya. Selain itu, Papank Komputer juga mungkin menawarkan jasa perbaikan dan upgrade komputer.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Bantuan</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-secondary">Cara Berbelanja</a>
                        </p>
                        <p>
                            <a href="#!" class="text-secondary">Cara Pembayaran</a>
                        </p>
                        <p>
                            <a href="#!" class="text-secondary">Status Pesanan</a>
                        </p>
                        <p>
                            <a href="#!" class="text-secondary">Layanan Pengiriman</a>
                        </p>
                        <p>
                            <a href="#!" class="text-secondary">Pengembalian Produk</a>
                        </p>
                        <p>
                            <a href="#!" class="text-secondary">Hubungi Kami</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Customer Care</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Klaim dan Garansi Produk, silakan hubungi :
                        </p>
                        <p>
                            <a href="" class="text-secondary">
                                <i class="bi bi-globe"></i> Papank Komputer Website
                            </a>
                        </p>
                        <p>
                            <i class="bi bi-calendar"></i> Layanan Senin - Sabtu, 10:00 - 18:00 WIB
                        </p>
                        <p>
                            <i class="bi bi-telephone"></i> 0341 9921238
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Tentang Kami</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="" class="text-secondary">
                                Kebijakan Privasi
                            </a>
                        </p>
                        <p>
                            <a href="" class="text-secondary">
                                Syarat & Ketentuan
                            </a>
                        </p>
                        <p>
                            <a href="" class="text-secondary">
                                Artikel
                            </a>
                        </p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3">
            © <?= date('Y') ?> Copyright:
            <a class="text-secondary" href="https://github.com/Papankk" target="_blank">Papank</a>
        </div>
        <!-- Copyright -->
    </footer>

</body>

</html>