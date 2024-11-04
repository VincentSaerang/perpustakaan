<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Perpustakaan</title>
    <link href="<?= base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary bg-login">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh !important;">

            <div class="col-xl-5 col-lg-12 col-md">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat datang!</h1>
                                    </div>

                                    <?php
                                    if ($this->session->flashdata('error') != '') {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $this->session->flashdata('error');
                                        echo '</div>';
                                    }
                                    ?>

                                    <?php
                                    if ($this->session->flashdata('success_register') != '') {
                                        echo '<div class="alert alert-info" role="alert">';
                                        echo $this->session->flashdata('success_register');
                                        echo '</div>';
                                    }
                                    ?>
                                    <?php

                                    if ($this->session->flashdata('message') != '') {
                                        echo '<div class="alert alert-success" role="alert">';
                                        echo $this->session->flashdata('message');
                                        echo '</div>';
                                    }
                                    ?>
                                    <form class="user" action="login/auth" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email"
                                                name="username" aria-describedby="emailHelp" placeholder="Username"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Masuk
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register">Buat akun baru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>js/sb-admin-2.min.js"></script>

</body>

</html>