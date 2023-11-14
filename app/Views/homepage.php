<!DOCTYPE html>
<html class="bg-body-tertiary" lang="en">

<head>
    <link rel="stylesheet" href="/style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/img/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="navbar-collapse" id="navbarNavAltMarkup">
                        <div class="ms-auto navbar-nav">
                            <a class="mx-4 nav-link" href="#">Kontak Kami</a>
                            <a class="mx-4 nav-link" href="#">Cara Berbelanja</a>
                            <a class="mx-4 btn btn-primary shadow-sm" href="/login">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid bg-body-tertiary">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="d-flex flex-column">
                        <h1 class="fw-bold">Tempat Belanja Komponen <br> Komputer Nomor 1 di Indonesia!</h1>
                        <p class="fs-6">
                            Toko Komputer terlengkap, termudah, dan terpercaya! <br>
                            Daftar dan mulai berbelanja dengan puas!
                        </p>
                    </div>
                    <a class="btn btn-primary mt-5 shadow-sm" href="/home">Mulai Berbelanja</a>
                </div>
                <div style="margin-bottom: 19vh;" class="col-lg hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="/img/komputer.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>