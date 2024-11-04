<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Kategori</h1>

        <?php if ($this->session->userdata('level') !== '0') { ?>
            <div>
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#catmodal"><i class="fas fa-plus fa-sm text-white-50"></i> Buat Kategori</a>

                <a href="<?= base_url('generate/category') ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Data</a>

                <a href="<?= base_url('generate/allcat') ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Semua Data</a>
            </div>
        <?php } ?>

    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_categorys; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-layer-group fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_books; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Total Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Total Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($categorys->result_array() as $cat) { ?>
                            <tr>
                                <td><?= $cat['KategoriID'] ?></td>
                                <td><a
                                        href="<?= base_url('category/detail') ?>/<?= $cat['KategoriID'] ?>"><strong><?= $cat['NamaKategori']; ?></strong></a>
                                </td>

                                <?php $totalBook = $this->db->get_where('buku', array('KategoriID' => $cat['KategoriID'])); ?>

                                <td><?= $totalBook->num_rows(); ?></td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-target="#editcat<?= $cat['KategoriID'] ?>"><i class="fas fa-edit"></i></button>
                                    <?php } ?>
                                    <a href="<?= base_url('category/detail') ?>/<?= $cat['KategoriID'] ?>"
                                        class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#delcat<?= $cat['KategoriID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="editcat<?= $cat['KategoriID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mengedit kategori</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>category/edit">
                                                <div class="modal-body">

                                                    <input type="hidden" name="catid" class="type"
                                                        value="<?= $cat['KategoriID'] ?>">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Nama:</label>
                                                        <input name="namecat" type="text" class="form-control"
                                                            value="<?= $cat['NamaKategori']; ?>">
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

                            <?php } ?>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="delcat<?= $cat['KategoriID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Kamu akan menghapus semua buku dari
                                                <strong><?= $cat['NamaKategori'] ?></strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Batak</button>
                                                <form method="post" action="<?= base_url() ?>/category/delete">
                                                    <input type="hidden" value="<?= $cat['KategoriID'] ?>" name="catid">
                                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                                </form>
                                            </div>
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

<?php if ($this->session->userdata('level') !== '0') { ?>
    <div class="modal fade" id="catmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat kategori baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url() ?>category/add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Nama:</label>
                            <input name="namecat" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>