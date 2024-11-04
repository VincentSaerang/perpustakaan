<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Selamat Datang, <?= $this->session->userdata('user_data')->NamaLengkap ?>!</h1>
    </div>

    <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_categorys; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-layer-group fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('dashboard/category'); ?>" class="card-footer d-flex justify-content-between btn">
                    Lihat <span>></span>
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Buku</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_books; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-book fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('dashboard/category'); ?>" class="card-footer d-flex justify-content-between btn">
                    Lihat <span>></span>
                </a>
            </div>
        </div>

        <?php if ($this->session->userdata("level") !== '0') { ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_users; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('dashboard/users'); ?>" class="card-footer d-flex justify-content-between btn">
                    Lihat <span>></span>
                </a>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($this->session->userdata("level") !== '0') { ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_peminjaman; ?></div>
                        </div>
                        <div class="col-auto bg-gray-100 p-3 rounded-circle">
                            <i class="fas fa-tag fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('dashboard/borrowing'); ?>"
                    class="card-footer d-flex justify-content-between btn">
                    Lihat <span>></span>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
    

</div>
</div>