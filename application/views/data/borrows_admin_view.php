<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Peminjaman</h1>

        <div>
            <?php if ($this->session->userdata('level') !== '0') { ?>
                <a href="<?= base_url("generate/borrow") ?>" target="_blank"
                    class="d-sm-inline-block btn btn-sm btn-warning text-dark shadow-sm"><i
                        class="fas fa-print fa-sm text-dark-50"></i> Print Data</a>
            <?php } ?>
        </div>
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
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_peminjaman; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-tag fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa fa-info-circle text-danger mx-2"></i> Beberapa data tidak di tampilkan dikarenakan pengguna
        atau buku telah dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
    </div> -->



    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="text-center font-weight-bold">Belum Diterima</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($borrows->result_array() as $cat) {

                            $userdata = $this->db->get_where('user', array('UserID' => $cat['UserID']));
                            $bookdata = $this->db->get_where('buku', array('BukuID' => $cat['BukuID']));

                            if ($cat['StatusPeminjaman'] !== '0') {
                                continue;
                            }

                            if ($userdata->num_rows() == 1) {
                                $userdata = $userdata->row();
                            } else {
                                continue;
                            }


                            if ($bookdata->num_rows() == 1) {
                                $bookdata = $bookdata->row();
                            } else {
                                continue;
                            }

                            $kategori = $this->db->get_where('kategoribuku', array('KategoriID' => $bookdata->KategoriID))->row();
                            ?>
                            <tr>
                                <td><?= $cat["PeminjamanID"] ?></td>
                                <td><?= $userdata->NamaLengkap; ?></td>
                                <td><a href="<?= base_url('book/view/') ?><?= $cat["BukuID"]; ?>"><?= $bookdata->Judul ?>
                                        <strong>(<?= $kategori->NamaKategori ?>)</strong></a></td>
                                <td><?= $cat['TanggalPeminjaman']; ?></td>
                                <td><?= $cat['TanggalPengembalian']; ?></td>
                                <td><?= $cat['StatusPeminjaman'] == 2 ? '<span class="badge badge-pill badge-success">Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 1 ? '<span class="badge badge-pill badge-warning text-dark">Belum Dikembalikan</span>' : '<span class="badge badge-pill badge-danger">Menunggu Diterima</span>') ?>
                                </td>

                                </td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <?php if ($cat['StatusPeminjaman'] == 0) { ?>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#approveborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-check"></i></button>
                                        <?php } ?>
                                        <?php if ($cat['StatusPeminjaman'] == 1) { ?>
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#returnborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-undo"></i></button>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deluser<?= $cat['UserID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>

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
                                                <div class="modal-body">Apakah kamu yakin ingin menghapus data peminjaman
                                                    tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> dipinjam oleh
                                                    <strong><?= $userdata->NamaLengkap ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>/dashboard/deleteborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($this->session->userdata('level') !== '0') { ?>
                                    <div class="modal fade" id="returnborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="<?= base_url() ?>dashboard/returnborrow">
                                                    <div class="modal-body">Peminjaman tentang:
                                                        <strong><?= $bookdata->Judul ?></strong>
                                                        pada tanggal <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                        dipinjam oleh <strong><?= $userdata->NamaLengkap ?></strong> statusnya
                                                        akan
                                                        menjadi <strong>Dikembalikan</strong>.
                                                        <hr>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" class="mx-2" required> konfirmasi
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Batal</button>
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <input type="text" value="<?= $cat['UserID'] ?>" name="userid">

                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Kamu akan menerima peminjaman dari
                                                    <strong><?= $userdata->NamaLengkap ?></strong> tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> pada tanggal
                                                    <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>dashboard/approveborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>


        </div>


    </div>

    <hr>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="text-center font-weight-bold">Denda</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable2" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($borrows->result_array() as $cat) {

                            $userdata = $this->db->get_where('user', array('UserID' => $cat['UserID']));
                            $bookdata = $this->db->get_where('buku', array('BukuID' => $cat['BukuID']));

                            if ($cat['StatusPeminjaman'] !== '5') {
                                if ($cat['StatusPeminjaman'] !== '4') {
                                    if ($cat['StatusPeminjaman'] !== '3') {
                                        continue;
                                    }
                                }
                            }

                            if ($userdata->num_rows() == 1) {
                                $userdata = $userdata->row();
                            } else {
                                continue;
                            }


                            if ($bookdata->num_rows() == 1) {
                                $bookdata = $bookdata->row();
                            } else {
                                continue;
                            }

                            $kategori = $this->db->get_where('kategoribuku', array('KategoriID' => $bookdata->KategoriID))->row();
                            ?>
                            <tr>
                                <td><?= $cat["PeminjamanID"] ?></td>
                                <td><?= $userdata->NamaLengkap; ?></td>
                                <td><a href="<?= base_url('book/view/') ?><?= $cat["BukuID"]; ?>"><?= $bookdata->Judul ?>
                                        <strong>(<?= $kategori->NamaKategori ?>)</strong></a></td>
                                <td><?= $cat['TanggalPeminjaman']; ?></td>
                                <td><?= $cat['TanggalPengembalian']; ?></td>
                                <?php if ($cat['StatusPeminjaman'] == 3) { ?>
                                    <td><span class="badge badge-pill badge-dark">Denda Biasa</span></td>
                                <?php } else if ($cat['StatusPeminjaman'] == 4) { ?>
                                    <td><span class="badge badge-pill badge-dark">Denda Rusak</span></td>
                                <?php } else if ($cat['StatusPeminjaman'] == 5) { ?>
                                    <td><span class="badge badge-pill badge-dark">Denda Hilang</span></td>
                                <?php } else { ?>
                                    <td><?= $cat['StatusPeminjaman'] == 2 ? '<span class="badge badge-pill badge-success">Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 1 ? '<span class="badge badge-pill badge-warning text-dark">Belum Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 0 ? '<span class="badge badge-pill badge-danger">Menunggu Diterima</span>' : '<span class="badge badge-pill badge-dark"></span>')) ?></td>
                                <?php } ?>

                                </td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <?php if ($cat['StatusPeminjaman'] == 0) { ?>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#approveborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-check"></i></button>
                                        <?php } ?>
                                        <?php if ($cat['StatusPeminjaman'] == 1) { ?>
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#returnborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-undo"></i></button>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deluser<?= $cat['UserID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>

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
                                                <div class="modal-body">Apakah kamu yakin ingin menghapus data peminjaman
                                                    tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> dipinjam oleh
                                                    <strong><?= $userdata->NamaLengkap ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>/dashboard/deleteborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($this->session->userdata('level') !== '0') { ?>
                                    <div class="modal fade" id="returnborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="<?= base_url() ?>dashboard/returnborrow">
                                                    <div class="modal-body">Peminjaman tentang:
                                                        <strong><?= $bookdata->Judul ?></strong>
                                                        pada tanggal <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                        dipinjam oleh <strong><?= $userdata->NamaLengkap ?></strong> statusnya
                                                        akan
                                                        menjadi <strong>Dikembalikan</strong>.
                                                        <hr>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" class="mx-2" required> konfirmasi
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Batal</button>
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <input type="hidden" value="<?= $cat['UserID'] ?>" name="userid">
                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Kamu akan menerima peminjaman dari
                                                    <strong><?= $userdata->NamaLengkap ?></strong> tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> pada tanggal
                                                    <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>dashboard/approveborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>


        </div>


    </div>

    <hr>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="text-center font-weight-bold">Belum Dikembalikan/Dikembalikan</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable3" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($borrows->result_array() as $cat) {

                            $userdata = $this->db->get_where('user', array('UserID' => $cat['UserID']));
                            $bookdata = $this->db->get_where('buku', array('BukuID' => $cat['BukuID']));

                            if ($cat['StatusPeminjaman'] == '0') {
                                continue;
                            }

                            if ($cat['StatusPeminjaman'] >= '3') {
                                continue;
                            }

                            

                            if ($userdata->num_rows() == 1) {
                                $userdata = $userdata->row();
                            } else {
                                continue;
                            }


                            if ($bookdata->num_rows() == 1) {
                                $bookdata = $bookdata->row();
                            } else {
                                continue;
                            }

                            $kategori = $this->db->get_where('kategoribuku', array('KategoriID' => $bookdata->KategoriID))->row();
                            ?>
                            <tr>
                                <td><?= $cat["PeminjamanID"] ?></td>
                                <td><?= $userdata->NamaLengkap; ?></td>
                                <td><a
                                        href="<?= base_url('book/view/') ?><?= $cat["BukuID"]; ?>"><?= $bookdata->Judul ?><strong>(<?= $kategori->NamaKategori ?>)</strong></a>
                                </td>
                                <td><?= $cat['TanggalPeminjaman']; ?></td>
                                <td><?= $cat['TanggalPengembalian']; ?></td>
                                <td><?= $cat['StatusPeminjaman'] == 2 ? '<span class="badge badge-pill badge-success">Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 1 ? '<span class="badge badge-pill badge-warning text-dark">Belum Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 0 ? '<span class="badge badge-pill badge-danger">Menunggu Diterima</span>' : '<span class="badge badge-pill badge-dark">Denda</span>')) ?>
                                </td>

                                </td>
                                <td class="w-fit-content">
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <?php if ($cat['StatusPeminjaman'] == 0) { ?>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#approveborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-check"></i></button>
                                        <?php } ?>
                                        <?php if ($cat['StatusPeminjaman'] == 1) { ?>
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#returnborrow<?= $cat['PeminjamanID'] ?>"><i
                                                    class="fas fa-undo"></i></button>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('level') !== '0') { ?>
                                        <button class="btn btn-danger" data-toggle="modal"
                                            data-target="#deluser<?= $cat['UserID'] ?>"><i class="fas fa-trash"></i></button>
                                    <?php } ?>
                                </td>

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
                                                <div class="modal-body">Apakah kamu yakin ingin menghapus data peminjaman
                                                    tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> dipinjam oleh
                                                    <strong><?= $userdata->NamaLengkap ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>/dashboard/deleteborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ($this->session->userdata('level') !== '0') { ?>
                                    <div class="modal fade" id="returnborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form method="post" action="<?= base_url() ?>dashboard/returnborrow">
                                                    <div class="modal-body">Peminjaman tentang:
                                                        <strong><?= $bookdata->Judul ?></strong>
                                                        pada tanggal <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                        dipinjam oleh <strong><?= $userdata->NamaLengkap ?></strong> statusnya
                                                        akan
                                                        menjadi <strong>Dikembalikan</strong>.
                                                        <hr>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" class="mx-2" required> konfirmasi
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Batal</button>
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <input type="hidden" value="<?= $cat['UserID'] ?>" name="userid">
                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveborrow<?= $cat['PeminjamanID'] ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Kamu akan menerima peminjaman dari
                                                    <strong><?= $userdata->NamaLengkap ?></strong> tentang:
                                                    <strong><?= $bookdata->Judul ?></strong> pada tanggal
                                                    <strong><?= $cat['TanggalPeminjaman'] ?></strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Batal</button>
                                                    <form method="post" action="<?= base_url() ?>dashboard/approveborrow">
                                                        <input type="hidden" value="<?= $cat['PeminjamanID'] ?>"
                                                            name="borrowid">
                                                        <button class="btn btn-success" type="submit">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
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