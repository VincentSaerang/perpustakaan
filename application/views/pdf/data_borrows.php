<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Peminjaman</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2 class="text-center fw-bold text-dark"><strong>Data Peminjaman</strong></h2>
        <p></p>
        <table class="table table-striped table-bordered text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach ($borrows->result_array() as $cat) {


                    $userdata = $this->db->get_where('user', array('UserID' => $cat['UserID']));
                    $bookdata = $this->db->get_where('buku', array('BukuID' => $cat['BukuID']));

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
                        <td><?= $cat['PeminjamanID'] ?></td>
                        <td><?= $userdata->NamaLengkap ?></td>
                        <td><?= $bookdata->Judul ?> (<?= $kategori->NamaKategori ?>)</td>
                        <td><?= $cat['TanggalPeminjaman'] ?></td>
                        <td><?= $cat['TanggalPengembalian'] ?></td>
                        <td><?= $cat['StatusPeminjaman'] == 2 ? '<span class="badge badge-pill badge-success">Dikembalikan</span>' : ($cat['StatusPeminjaman'] == 1 ? '<span class="badge badge-pill badge-warning text-dark">Belum Dikembalikan</span>' : '<span class="badge badge-pill badge-danger">Menunggu Diterima</span>') ?></td>
                        <td><?= $userdata->Level == 0 ? 'Peminjam' : ($cat['Level'] == 1 ? 'Admin' : 'Petugas') ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <small>Tanggal: <strong><?= date("d-m-Y") ?></strong> - Diprint oleh:
            <strong><?= $this->session->userdata('user_data')->NamaLengkap; ?></strong></small>
        <br>
        <small><i class="fa fa-info-circle text-danger mx-2"></i> Beberapa data tidak di tampilkan dikarenakan pengguna
            atau buku telah dihapus</small>
    </div>
</body>

</html>