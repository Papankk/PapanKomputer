<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<div class="col-lg mb-4 order-0">
    <button type="button" class="mb-4 btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalInsert">
        <i class="tf-icons bx bx-plus"></i> Tambah Data
    </button>
    <?php if (session()->getFlashdata('message') || session()->has('errors')) :
    ?>
        <div class="alert <?= (session()->has('errors')) ? 'alert-danger' : 'alert-success' ?> alert-success alert-dismissible" role="alert">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1"><?= (session()->has('errors')) ? 'Error!' : 'Sukses!' ?></h6>
            <p class="mb-0">
                <?php
                if (session()->getFlashdata('message')) {
                    echo session()->getFlashdata('message');
                } else {
                    foreach (session('errors') as $error) :
                        echo esc($error) . "<br>";
                    endforeach;
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
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>Nama Produk</th>
                        <th style="width: 10px;">Stok</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Rekomendasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($item as $i) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $i->nama_barang ?></td>
                            <td><?= $i->stok ?></td>
                            <td class="text-success"><?= number_to_currency($i->harga, 'IDR') ?></td>
                            <td><img src="<?= base_url() ?>/img/<?= $i->gambar ?>" alt="" class="rounded" width="100px"></td>
                            <td><?php
                                if ($i->is_recomend == '1') {
                                    echo '<span class="badge bg-label-success">Direkomendasi</span>';
                                }
                                ?></td>
                            <td>
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modaldetail<?= $no ?>">Detail</a>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modaldelete<?= $no ?>">Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="modaldetail<?= $no ?>" tabindex="-1" aria-labelledby="modaldetail<?= $no ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaldetail<?= $no ?>Label">Detail <?= $i->nama_barang ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Nama Barang</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?= $i->nama_barang ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Deskripsi</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?= $i->deskripsi ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Harga</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8 text-success">
                                                <?= number_to_currency($i->harga, 'IDR') ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Stok</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?= $i->stok ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Kategori</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?= $i->nama_kategori ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Gambar</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <img src="<?= base_url() ?>/img/<?= $i->gambar ?>" width="400px" alt="">
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Brand</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?= $i->nama_brand ?>
                                            </div>
                                        </div>
                                        <div class="row mt-3 d-flex align-items-center">
                                            <div class="col-3">
                                                <h5 class="fw-semibold">Apakah di Rekomendasi?</h5>
                                            </div>
                                            <div class="col-1">
                                                :
                                            </div>
                                            <div class="col-8">
                                                <?php
                                                if ($i->is_recomend == '1') {
                                                    echo '<span class="badge bg-label-success">Direkomendasi</span>';
                                                } else {
                                                    echo '<span class="badge bg-label-danger">Tidak</span>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / Modal Detail -->

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" aria-labelledby="modaledit<?= $no ?>Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaledit<?= $no ?>Label">Edit <?= $i->nama_barang ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/admin/produk/update/<?= $i->id_barang ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="slug" value="<?= $i->slug ?>">
                                            <input type="hidden" name="gambar_lama" value="<?= $i->gambar ?>">
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" name="is_recomend" type="checkbox" value="1" role="switch" id="flexSwitchCheckDefault" <?= ($i->is_recomend == '1') ? 'checked' : '' ?>>
                                                <label class="form-label" for="flexSwitchCheckDefault">Produk Rekomendasi</label>
                                            </div>
                                            <label class="form-label">Nama Produk</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-package"></i></span>
                                                <input type="text" name="nama_barang" class="form-control" placeholder="Nama Produk" value="<?= old('nama_barang', $i->nama_barang) ?>" />
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label">Harga</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-dollar"></i></span>
                                                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="<?= old('harga', $i->harga) ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label">Stok</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-box"></i></span>
                                                        <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?= old('stok', $i->stok) ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="form-label">Deskripsi</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-comment"></i></span>
                                                <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" placeholder="Deskripsi"><?= old('deskripsi', $i->deskripsi) ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label">Kategori</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-category"></i></span>
                                                        <select name="kategori" id="kategori" class="form-select" value="<?= old('kategori', $i->kategori) ?>">
                                                            <?php
                                                            foreach ($category as $ik) :
                                                                $selected = ($ik['id_kategori'] == $i->id_kategori) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?= $ik['id_kategori'] ?>" <?= $selected ?>><?= $ik['nama_kategori'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label">Brand</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-store"></i></span>
                                                        <select name="brand" id="brand" class="form-select" value="<?= old('brand') ?>">
                                                            <?php
                                                            foreach ($brand as $b) :
                                                                $selected = ($b['id_brand'] == $i->id_brand) ? 'selected' : '';
                                                            ?>
                                                                <option value="<?= $b['id_brand'] ?>" <?= $selected ?>><?= $b['nama_brand'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="form-label">Gambar Produk</label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="gambar" class="form-control" />
                                            </div>
                                            <input type="hidden" name="username" id="username" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button name="submitedit" type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
        </div>
        <!-- / Modal Edit -->

        <!-- Modal Delete -->
        <div class="modal fade" id="modaldelete<?= $no ?>" tabindex="-1" aria-labelledby="modaldelete<?= $no ?>Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaldelete<?= $no ?>Label">Delete Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/admin/produk/<?= $i->id_barang ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <p>Yakin untuk menghapus <?= $i->nama_barang ?> ?</p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button name="submitdelete" type="submit" class="btn btn-danger">Confirm</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- / Modal Delete -->
    <?php
                    endforeach;
    ?>
    </tbody>
    </table>
    </div>
</div>
</div>

<!-- Modal Insert -->
<div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInsertLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/admin/produk/insert" enctype="multipart/form-data">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="is_recomend" type="checkbox" value="1" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-label" for="flexSwitchCheckDefault">Produk Rekomendasi</label>
                    </div>
                    <label class="form-label">Nama Produk</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-package"></i></span>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Nama Produk" value="<?= old('nama_barang') ?>" />
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Harga</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-dollar"></i></span>
                                <input type="text" name="harga" class="form-control" placeholder="Harga" value="<?= old('harga') ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Stok</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-box"></i></span>
                                <input type="text" name="stok" class="form-control" placeholder="Stok" value="<?= old('stok') ?>" />
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Deskripsi</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-comment"></i></span>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control" placeholder="Deskripsi" value="<?= old('deskripsi') ?>"><?= old('deskripsi') ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <label class="form-label">Kategori</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-category"></i></span>
                                <select name="kategori" id="kategori" class="form-select" value="<?= old('kategori') ?>">
                                    <?php
                                    foreach ($category as $ik) :
                                    ?>
                                        <option value="<?= $ik['id_kategori'] ?>"><?= $ik['nama_kategori'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">Brand</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-store"></i></span>
                                <select name="brand" id="brand" class="form-select" value="<?= old('brand') ?>">
                                    <?php
                                    foreach ($brand as $b) :
                                    ?>
                                        <option value="<?= $b['id_brand'] ?>"><?= $b['nama_brand'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Gambar Produk</label>
                    <div class="input-group mb-3">
                        <input type="file" name="gambar" class="form-control" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </form>
    </div>
</div>
<!-- / Modal Insert -->

<?= $this->endSection() ?>