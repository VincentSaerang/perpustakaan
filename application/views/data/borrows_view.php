<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Daftar Peminjaman</h1>

    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Peminjaman
                (<?= $this->session->userdata('user_data')->NamaLengkap; ?>)</li>
        </ol>
    </nav>

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

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Total Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Level Pengguna</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Buku</th>
                            <th>Total Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                            <th>Level Pengguna</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php

                        foreach ($borrows->result_array() as $cat) {

                            $userdata = $this->db->get_where('user', array('UserID' => $cat['UserID']))->row();
                            $bookdata = $this->db->get_where('buku', array('BukuID' => $cat['BukuID']))->row();
                            $kategori = $this->db->get_where('kategoribuku', array('KategoriID' => $bookdata->KategoriID))->row();
                            ?>
                            <tr>
                                <td><?= $userdata->NamaLengkap; ?></td>
                                <td><a href="<?= base_url('book/view/') ?><?= $cat["BukuID"]; ?>"><?= $bookdata->Judul ?>
                                        <strong>(<?= $kategori->NamaKategori ?>)</strong></a></td>
                                <td><?= $cat['Total']; ?></td>
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

                                <td><?= $userdata->Level == 0 ? 'Peminjam' : ($cat['Level'] == 1 ? 'Admin' : 'Petugas') ?>
                                </td>
                            </tr>
                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>