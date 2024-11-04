<div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion shadow-lg mt-4 ml-sm-4"
        style="border-radius:15px 15px 0 0;" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
            <div class="sidebar-brand-icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Perpus</div>
        </a>


        <hr class="sidebar-divider">
        <div class="sidebar-heading text-light">
            Dashboard
        </div>
        <li class="nav-item <?= $act_1 ? "active border-left-light" : "" ?>">
            <a class="nav-link " href="<?= base_url() ?>dashboard">
                <i class="fas fa-fw fa-home"></i>
                <span>Beranda</span></a>
        </li>
        <li class="nav-item <?= $act_6 ? "active border-left-light" : "" ?>">
            <a class="nav-link" href="<?= base_url() ?>dashboard/rak">
                <i class="fas fa-fw fa-warehouse"></i>
                <span>Rak</span></a>
        </li>
        <li class="nav-item <?= $act_2 ? "active border-left-light" : "" ?>">
            <a class="nav-link" href="<?= base_url() ?>dashboard/category">
                <i class="fas fa-fw fa-book"></i>
                <span>Daftar Kategori</span></a>
        </li>
        <?php if ($this->session->userdata('level') == '1') { ?>
            <li class="nav-item <?= $act_3 ? "active border-left-light" : "" ?>">
                <a class="nav-link" href="<?= base_url() ?>dashboard/users">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Daftar Pengguna</span></a>
            </li>
        <?php } ?>
        <li class="nav-item <?= $act_4 ? "active border-left-light" : "" ?>">
            <a class="nav-link" href="<?= base_url() ?>dashboard/borrowing">
                <i class="fas fa-fw fa-list"></i>
                <span>Peminjaman</span></a>
        </li>
        <?php if ($this->session->userdata('level') == '1') { ?>
            <li class="nav-item <?= $act_5 ? "active border-left-light" : "" ?>">
                <a class="nav-link" href="<?= base_url() ?>dashboard/settings">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan</span></a>
            </li>
        <?php } ?>
        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Pakai latar gambar \/ -->
        <!-- <div id="content" class="bg-image"> -->
        <div id="content">

            <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow-lg m-4"
                style="border-radius:20px;">

                <button id="sidebarToggleTop" class="btn btn-link d-md-none text-light bg-primary rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="mr-2 d-lg-inline text-light font-weight-bold"><?= $this->session->userdata('user_data')->NamaLengkap; ?></span>
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-light"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url() ?>login/logout" data-toggle="modal"
                                data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>