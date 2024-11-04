<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Rak: <strong><?= $rak->NamaRak ?></strong></h1>
        <div>
            <a href="<?= base_url('dashboard/rak') ?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
            <?php if ($this->session->userdata('level') !== '0') { ?>

                <a href="<?= base_url("generate/books/$category->KategoriID") ?>" target="_blank" class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i class="fas fa-print fa-sm text-dark-50"></i> Print Data</a>

                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addbookmodal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Buku</a>
            <?php } ?>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard/rak") ?>">Daftar Rak</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $rak->NamaRak ?></li>
        </ol>
    </nav>

    <?php

    if ($this->session->flashdata('message') != '') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $this->session->flashdata('message');
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Kategori</th>
                            <th>Judul Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ISBN</th>
                            <th>ID Kategori</th>
                            <th>Judul Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

                        foreach ($raks->result_array() as $cat) { ?>
                            <tr>
                                <td><?= $cat["BukuID"] ?></td>
                                <td><a href="<?= base_url("category/detail/") . $cat['KategoriID'] ?>"><?= $cat["KategoriID"] ?></a>
                                </td>
                                <td><?= $cat["Judul"] ?></td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#editbook<?= $cat['BukuID'] ?>"><i class="fas fa-edit"></i></button>
                                    <?php } ?>
                                    <a href="<?= base_url('book/view') ?>/<?= $cat['BukuID'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#delbook<?= $cat['BukuID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="editbook<?= $cat['BukuID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mengedit buku</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>book/edit">
                                                <div class="modal-body">
                                                    <input type="hidden" name="catid" value="<?= $cat["KategoriID"] ?>">
                                                    <div class="form-group">
                                                        <label class="col-form-label">ISBN:</label>
                                                        <input name="bookid" type="text" class="form-control" value="<?= $cat["BukuID"] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Judul:</label>
                                                        <input name="book" type="text" class="form-control" value="<?= $cat["Judul"] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Penulis:</label>
                                                        <input name="bookwriter" type="text" class="form-control" value="<?= $cat["Penulis"] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Penerbit:</label>
                                                        <input name="bookpublisher" type="text" class="form-control" value="<?= $cat["Penerbit"] ?>" required>
                                                    </div>
                                                    <?php
                                                    $currentDateTime = new DateTime('now');
                                                    $currentDate = $currentDateTime->format('Y');
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Tahun Terbit:</label>
                                                        <input name="bookyear" type="number" max="<?= $currentDate ?>" class="form-control" value='<?= $cat["TahunTerbit"] ?>' required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Stok:</label>
                                                        <input name="bookstok" type="number" class="form-control" value="<?= $cat["Stok"] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Rak:</label>
                                                        <select name="bookrak" id="bookrak" class="form-control">
                                                            <?php foreach ($allrak->result_array() as $ra) { ?>
                                                                <option value="<?= $ra['RakID'] ?>" <?= $ra["RakID"] == $cat['RakID'] ? 'selected' : '' ?>><?= $ra['NamaRak'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Kategori:</label>
                                                        <select name="bookcat" id="bookcat" class="form-control">
                                                            <?php foreach ($allcat->result_array() as $ra) { ?>
                                                                <option value="<?= $ra['KategoriID'] ?>" <?= $ra["KategoriID"] == $cat['KategoriID'] ? 'selected' : '' ?>><?= $ra['NamaKategori'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="delbook<?= $cat['BukuID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Kamu akan menghapus buku <strong><?= $cat['Judul'] ?></strong> dengan ISBN
                                                <strong><?= $cat["BukuID"] ?></strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                <form method="post" action="<?= base_url() ?>/rak/deletebook">
                                                    <input type="hidden" value="<?= $cat['RakID'] ?>" name="catid">
                                                    <input type="hidden" value="<?= $cat['BukuID'] ?>" name="bookid">
                                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
<div class="modal fade" id="addbookmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menambahkan buku baru di
                    <strong><?= $category->NamaKategori ?></strong>
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url() ?>book/add" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="catid" value="<?= $category->KategoriID ?>">
                    <div class="form-group">
                        <label class="col-form-label">ISBN:</label>
                        <input name="isbn" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Sampul:</label>
                        <input name="bookimg" type="file" accept="image/*" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Judul:</label>
                        <input name="book" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kelas:</label>
                        <input name="bookclass" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Penulis:</label>
                        <input name="bookwriter" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Penerbit:</label>
                        <input name="bookpublisher" type="text" class="form-control" required>
                    </div>
                    <?php
                    $currentDateTime = new DateTime('now');
                    $currentDate = $currentDateTime->format('Y');
                    ?>
                    <div class="form-group">
                        <label class="col-form-label">Tahun Terbit:</label>
                        <input name="bookyear" max="<?= $currentDate ?>" type="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kota:</label>
                        <input name="bookcity" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Stok:</label>
                        <input name="bookstok" type="number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Rak:</label>
                        <select name="bookrak" id="rak" class="form-control">
                            <?php foreach ($raks->result_array() as $ra) { ?>
                                <option value="<?= $ra['RakID'] ?>"><?= $ra['NamaRak'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>