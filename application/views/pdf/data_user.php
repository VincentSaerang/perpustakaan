<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Pengguna</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <div>
        <h2 class="text-center fw-bold text-dark"><strong>Data Pengguna</strong></h2>
        <p></p>
        <table class="table table-striped table-bordered text-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach ($users->result_array() as $cat) { ?>

                    <tr>
                        <td><?= $cat["UserID"] ?></td>
                        <td><?= $cat["Username"] ?></td>
                        <td><?= $cat["NamaLengkap"] ?></td>
                        <td><?= $cat["Email"] ?></td>
                        <td><?= $cat["Alamat"] ?></td>
                        <td><?= $cat['Level'] == 0 ? 'Peminjam' : ($cat['Level'] == 1 ? 'Admin' : 'Petugas') ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <small>Tanggal: <strong><?= date("d-m-Y") ?></strong> - Diprint oleh:
            <strong><?= $this->session->userdata('user_data')->NamaLengkap; ?></strong></small>
    </div>
</body>

</html>