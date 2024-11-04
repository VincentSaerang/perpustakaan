<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data buku dari <?= $category->row()->NamaKategori ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2 class="text-center fw-bold text-dark"><strong>Data buku dari <u><?= $category->row()->NamaKategori ?></u></strong></h2>
        <p class="text-center">total: <?= $books->num_rows(); ?></p>
        <p></p>
        <table class="table table-striped table-bordered text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach ($books->result_array() as $cat) { ?>

                    <tr>
                        <td>B<?= $cat["BukuID"] ?></td>
                        <td><?= $cat["Judul"] ?></td>
                        <td><?= $cat["Penulis"] ?></td>
                        <td><?= $cat["Penerbit"] ?></td>
                        <td><?= $cat["TahunTerbit"] ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <small>Tanggal: <strong><?= date("d-m-Y") ?></strong> - Diprint oleh:
            <strong><?= $this->session->userdata('user_data')->NamaLengkap; ?></strong></small>
    </div>
</body>

</html>