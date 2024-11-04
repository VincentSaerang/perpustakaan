<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Rak</h1>

        <?php if ($this->session->userdata('level') !== '0') { ?>
            <div>
                <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#catmodal"><i class="fas fa-plus fa-sm text-white-50"></i> Buat Rak</a>

                <a href="<?= base_url('generate/rak') ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Data</a>

                <a href="<?= base_url('generate/allrak') ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Semua Data</a>
            </div>
        <?php } ?>

    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Daftar Rak</li>
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
                            <th>ID</th>
                            <th>Nama Rak</th>
                            <th>Total Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nama Rak</th>
                            <th>Total Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($rak->result_array() as $cat) { ?>
                            <tr>
                                <td><?= $cat['RakID'] ?></td>
                                <td><?= $cat['NamaRak'] ?></td>
                                <?php

                                $totalbuku = $this->db->get_where('buku', array('RakID' => $cat["RakID"]))->num_rows();
                                ?>
                                <td><?= $totalbuku ?></td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-target="#editcat<?= $cat['RakID'] ?>"><i class="fas fa-edit"></i></button>
                                        <a class="btn btn-primary" href="<?= base_url("rak/detail/") . $cat['RakID'] ?>"><i
                                                class="fas fa-eye"></i></a>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#delcat<?= $cat['RakID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>

                            <?php if ($this->session->userdata('level') !== '0') { ?>
                                <div class="modal fade" id="editcat<?= $cat['RakID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mengedit rak
                                                    <b><?= $cat['NamaRak'] ?></b></h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?= base_url() ?>rak/edit">
                                                <div class="modal-body">

                                                    <input type="hidden" name="rakid" class="type" value="<?= $cat['RakID'] ?>">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Nama:</label>
                                                        <input name="namerak" type="text" class="form-control"
                                                            value="<?= $cat['NamaRak']; ?>">
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
                                <div class="modal fade" id="delcat<?= $cat['RakID'] ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Kamu akan menghapus rak <strong><?= $cat['NamaRak'] ?></strong> tetapi semua buku masih akan tetap tersimpan
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Batak</button>
                                                <form method="post" action="<?= base_url() ?>/rak/delete">
                                                    <input type="hidden" value="<?= $cat['RakID'] ?>" name="rakid">
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
                    <h5 class="modal-title" id="exampleModalLabel">Buat Rak baru</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url() ?>rak/add">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Nama:</label>
                            <input name="namerak" type="text" class="form-control">
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