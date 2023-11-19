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
            <table id="myTable" class="table">
                <thead>
                    <tr>
                        <th style="width: 10px;">#</th>
                        <th>User</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $u) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    <div class="avatar me-3">
                                        <img src="<?= base_url() ?>/img/<?= $u->profile_image ?>" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?= $u->email ?></h6>
                                        <span>
                                            <?= $u->username ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($u->group_id == 1) {
                                    echo '<span class="badge bg-label-primary">User</span>';
                                } else {
                                    echo '<span class="badge bg-label-danger">Admin</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="d-grid gap-2 col-4 mx-auto">
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit<?= $no ?>">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modaldelete<?= $no ?>">Delete</a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modaledit<?= $no ?>" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaleditLabel">Edit <?= $u->username ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?= base_url("admin/user/update/$u->id") ?>">
                                            <label class="form-label">Role</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-lock-alt"></i></span>
                                                <select name="role" id="role" class="form-select">
                                                    <option value="1" <?= ($u->group_id == '1') ? 'selected' : ''; ?>>User</option>
                                                    <option value="2" <?= ($u->group_id == '2') ? 'selected' : ''; ?>>Admin</option>
                                                </select>
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
                        <div class="modal fade" id="modaldelete<?= $no ?>" tabindex="-1" aria-labelledby="modaldeleteLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaldeleteLabel">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?= base_url("admin/user/$u->id") ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <p>Yakin untuk menghapus User : <?= $u->username ?> ?</p>
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

<?= $this->endSection() ?>