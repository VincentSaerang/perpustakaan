<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Pengguna</h1>

        <?php if ($this->session->userdata('level') !== '0') { ?>
            <div>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#addusermodal"><i class="fas fa-plus fa-sm text-white-50"></i> Buat Pengguna</a>

                <a href="<?= base_url('generate/users') ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Data</a>
            </div>
        <?php } ?>

    </div>

    <?php
    if ($this->session->flashdata('message') != '') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $this->session->flashdata('message');
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    ?>
    <?php
    if ($this->session->flashdata('error') != '') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $this->session->flashdata('error');
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    ?>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_users; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($users->result_array() as $cat) { ?>
                            <tr>
                                <td><?= $cat['UserID']; ?></td>
                                <td><?= $cat['Username']; ?></td>
                                <td><?= $cat['NamaLengkap']; ?></td>
                                <td><?= $cat['Email']; ?></td>
                                <td><?= $cat['Alamat']; ?></td>
                                <td><?= $cat['Level'] == 0 ? 'Peminjam' : ($cat['Level'] == 1 ? 'Admin' : 'Petugas') ?></td>
                                <td class="w-fit-content">
                                    <?php if ($cat["UserID"] !== $this->session->userdata('user_data')->UserID) { ?>
                                        <?php if ($this->session->userdata('level') !== '0') { ?>
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#edituser<?= $cat['UserID'] ?>"><i class="fas fa-edit"></i></button>
                                        <?php } ?>
                                        <?php if ($this->session->userdata('level') !== '0') { ?>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deluser<?= $cat['UserID'] ?>"><i class="fas fa-trash"></i></button>
                                        <?php } ?>

                                        <?php if ($cat['Level'] !== '0') { ?>
                                            <?php if ($this->session->userdata('level') == '1') { ?>
                                                <button class="btn btn-warning text-dark" data-toggle="modal"
                                                    data-target="#loguser<?= $cat['UserID'] ?>"><i class="fas fa-sign-in-alt"></i></button>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        Kamu sedang menggunakan akun ini
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="deluser<?= $cat['UserID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>/user/delete">
                                                <div class="modal-body">Kamu akan menghapus <strong><?= $cat['Username'] ?>
                                                        (<?= $cat['NamaLengkap'] ?>)</strong>
                                                    <br>
                                                    <hr>
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="mx-2" required> saya yakin ingin menghapus
                                                        akun ini
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <input type="hidden" value="<?= $cat['UserID'] ?>" name="userid">
                                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($this->session->userdata('level') == '1') { ?>
                                <div class="modal fade" id="edituser<?= $cat['UserID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Sedang mengedit
                                                    <strong><?= $cat["Username"] ?> (<?= $cat["NamaLengkap"] ?>)</strong>
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>user/edit">
                                                <div class="modal-body">

                                                    <input type="hidden" value="<?= $cat['UserID'] ?>" name="userid">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Username:</label>
                                                        <input name="username" type="text" class="form-control"
                                                            value="<?= $cat['Username'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email:</label>
                                                        <input name="email" type="email" class="form-control"
                                                            value="<?= $cat['Email'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Nama Lengkap:</label>
                                                        <input name="fullname" type="text" class="form-control"
                                                            value="<?= $cat['NamaLengkap'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Alamat:</label>
                                                        <input name="address" type="text" class="form-control"
                                                            value="<?= $cat['Alamat'] ?>" required>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Level:</label>
                                                        <select name="level" id="level" class="form-control">
                                                            <option value="0" <?= $cat["Level"] == 0 ? 'selected' : '' ?>>Peminjam
                                                            </option>
                                                            <option value="1" <?= $cat["Level"] == 1 ? 'selected' : '' ?>>Admin
                                                            </option>
                                                            <option value="2" <?= $cat["Level"] == 2 ? 'selected' : '' ?>>Petugas
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Password baru:</label>
                                                        <input name="password" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Konfirmasi password:</label>
                                                        <input name="rpassword" type="password" class="form-control">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="loguser<?= $cat['UserID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Masuk ke akun
                                                    <strong><?= $cat["Username"] ?> (<?= $cat["NamaLengkap"] ?>)</strong>
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>login/auth">
                                                <div class="modal-body">

                                                    <input type="hidden" value="<?= $cat['UserID'] ?>" name="userid">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Masukan Password:</label>
                                                        <input type="hidden" value="<?= $cat['Username'] ?>" name="username">
                                                        <input name="password" type="password" class="form-control" required>
                                                    </div>
                                                    

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Masuk</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>

<?php if ($this->session->userdata('level') == '1') { ?>
    <div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna Baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url() ?>user/add">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-form-label">Username:</label>
                            <input name="username" type="text" class="form-control" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-form-label">Password:</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Konfirmasi Password:</label>
                            <input name="rpassword" type="password" class="form-control" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-form-label">Email:</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nama lengkap:</label>
                            <input name="fullname" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat:</label>
                            <input name="address" type="text" class="form-control" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-form-label">Level:</label>
                            <select name="level" id="level" class="form-control">
                                <option value="0">Peminjam</option>
                                <option value="1">Admin</option>
                                <option value="2">Petugas</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>