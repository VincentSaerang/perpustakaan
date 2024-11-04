<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Categories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2 class="text-center fw-bold text-dark"><strong>Data Kategori</strong></h2>
        <p></p>
        <table class="table table-striped table-bordered text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Total Buku</th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach ($categories->result_array() as $cat) { ?>

                    <tr>
                        <td><?= $cat["KategoriID"] ?></td>
                        <td><?= $cat["NamaKategori"] ?></td>

                        <?php $totalBook = $this->db->get_where('buku', array('KategoriID' => $cat['KategoriID'])); ?>
                        <td><?= $totalBook->num_rows(); ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <small>Tanggal: <strong><?= date("d-m-Y") ?></strong> - Diprint oleh:
            <strong><?= $this->session->userdata('user_data')->NamaLengkap; ?></strong></small>
    </div>
</body>

</html>