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
                        <div class="row">
                            <div class="col-sm-8 mb-3">
                                <p class="mb-0">Alamat rumah</p>
                                <div class="form-outline">
                                    <input type="text" id="typeText" placeholder="Type here" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <p class="mb-0">City</p>
                                <select class="form-select">
                                    <option value="1">New York</option>
                                    <option value="2">Moscow</option>
                                    <option value="3">Samarqand</option>
                                </select>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <p class="mb-0">House</p>
                                <div class="form-outline">
                                    <input type="text" id="typeText" placeholder="Type here" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-4 col-6 mb-3">
                                <p class="mb-0">Postal code</p>
                                <div class="form-outline">
                                    <input type="text" id="typeText" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-4 col-6 mb-3">
                                <p class="mb-0">Zip</p>
                                <div class="form-outline">
                                    <input type="text" id="typeText" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                            <label class="form-check-label" for="flexCheckDefault1">Kirim notifikasi email ?</label>
                        </div>

                        <div class="float-end">
                            <button class="btn btn-light border">Kembali ke Keranjang</button>
                            <button class="btn btn-success shadow-0 border">Checkout</button>
                        </div>
                    </div>
                </div>
                <!-- Checkout -->
            </div>
            <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
                    <h6 class="mb-3">Rincian</h6>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Total price:</p>
                        <p class="mb-2">$195.90</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Discount:</p>
                        <p class="mb-2 text-danger">- $60.00</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Shipping cost:</p>
                        <p class="mb-2">+ $14.00</p>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <p class="mb-2">Total price:</p>
                        <p class="mb-2 fw-bold">$149.90</p>
                    </div>

                    <div class="input-group mt-3 mb-4">
                        <input type="text" class="form-control border" name="" placeholder="Promo code" />
                        <button class="btn btn-light text-primary border">Apply</button>
                    </div>

                    <hr />
                    <h6 class="text-dark my-4">Keranjang</h6>

                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-secondary">
                                1
                            </span>
                            <img src="<?= base_url() ?>/img/inteli5.jpg" style="height: 96px; width: 96x;" class="img-sm rounded border" />
                        </div>
                        <div class="">
                            <a href="#" class="nav-link">
                                Gaming Headset with Mic <br />
                                Darkblue color
                            </a>
                            <div class="price text-muted">Total: $295.99</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <div class="me-3 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                                1
                            </span>
                            <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/5.webp" style="height: 96px; width: 96x;" class="img-sm rounded border" />
                        </div>
                        <div class="">
                            <a href="#" class="nav-link">
                                Apple Watch Series 4 Space <br />
                                Large size
                            </a>
                            <div class="price text-muted">Total: $217.99</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3 position-relative">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                                3
                            </span>
                            <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/1.webp" style="height: 96px; width: 96x;" class="img-sm rounded border" />
                        </div>
                        <div class="">
                            <a href="#" class="nav-link">GoPro HERO6 4K Action Camera - Black</a>
                            <div class="price text-muted">Total: $910.00</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>