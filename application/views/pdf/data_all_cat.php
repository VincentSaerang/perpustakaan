<!DOCTYPE html>
<html lang="en">

<head>
    <title>Semua Data Categories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2 class="text-center fw-bold text-dark"><strong>Semua Data Kategori</strong></h2>


        <div class="d-flex">
            <?php

            foreach ($categories->result_array() as $cat) {
                
                $books = $this->db->get_where('buku', array('KategoriID' => $cat['KategoriID']));
                ?>

                <div>
                    <h4 class="text-dark"><?= $cat['NamaKategori'] ?> (<?= $books->num_rows(); ?> buku)</h4>
                    <p>ID: <strong>KAT<?= $cat['KategoriID'] ?></strong></p>

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
                </div>
                <hr>
            <?php } ?>
        </div>
        <small>Tanggal: <strong><?= date("d-m-Y") ?></strong> - Diprint oleh:
            <strong><?= $this->session->userdata('user_data')->NamaLengkap; ?></strong></small>
    </div>
</body>

</html>