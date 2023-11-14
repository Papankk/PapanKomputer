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
            <table id="myTable" class="table text-center">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th class="text-center">Nama Brand</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($brand as $b) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $b->nama_brand ?></td>
                            <td><img src="<?= base_url() ?>/img/brand/<?= $b->gambar_brand ?>" alt="" class="rounded" width="70px"></td>
                            <td>
                                <div class="d-grid gap-2 col-4 mx-auto">
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modaldelete<?= $no ?>">Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" aria-labelledby="modaledit<?= $no ?>Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaledit<?= $no ?>Label">Edit <?= $b->nama_brand ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/admin/brand/update/<?= $b->id_brand ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="slug_brand" value="<?= $b->slug_brand ?>">
                                            <input type="hidden" name="gambar_lama" value="<?= $b->gambar_brand ?>">
                                            <label class="form-label">Nama Brand</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-category"></i></span>
                                                <input type="text" name="nama_brand" class="form-control" placeholder="Nama Brand" value="<?= old('nama_brand', $b->nama_brand) ?>" />
                                            </div>
                                            <label class="form-label">Gambar Brand</label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="gambar_brand" class="form-control" />
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button name="submitedit" type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- / Modal Edit -->

                        <!-- Modal Delete -->
                        <div class="modal fade" id="modaldelete<?= $no ?>" tabindex="-1" aria-labelledby="modaldelete<?= $no ?>Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaldelete<?= $no ?>Label">Delete Brand</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/admin/brand/<?= $b->id_brand ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <p>Yakin untuk menghapus kategori <?= $b->nama_brand ?> ?</p>
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
                <form method="post" action="/admin/brand/insert" enctype="multipart/form-data">
                    <label class="form-label">Nama Brand</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-category"></i></span>
                        <input type="text" name="nama_brand" class="form-control" placeholder="Nama Brand" value="<?= old('nama_brand') ?>" />
                    </div>
                    <label class="form-label">Gambar Brand</label>
                    <div class="input-group mb-3">
                        <input type="file" name="gambar_brand" class="form-control" />
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