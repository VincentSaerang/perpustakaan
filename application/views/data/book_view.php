<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Kategori: <strong><?= $category->NamaKategori ?></strong></h1>
        <a href="<?= base_url("category/detail/$category->KategoriID") ?>"
            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url("dashboard/category") ?>">Daftar Kategori</a></li>
            <li class="breadcrumb-item"><a
                    href="<?= base_url("category/detail/$category->KategoriID") ?>"><?= $category->NamaKategori ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= $book->Judul ?></li>
        </ol>
    </nav>

    <?php

    if ($this->session->flashdata('message') != '') {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $this->session->flashdata('message');
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    ?>

    <div class="card shadow mb-4" id="printArea">
        <div class="card-body">
            <div class="row mw-100">
                <div class="d-flex mw-100 mw-sm-auto mx-auto mx-sm-0 mr-sm-3">
                    <img class="img-thumbnail mx-auto mr-sm-3" style="max-width: 200px !important; max-height: 200px !important;" src="<?= $book->Foto ?>" alt="SAMPUL">
                </div>
                <div class="text-center text-sm-left mx-auto mx-sm-0">
                    <h3 class="text-dark">Buku : <strong><?= $book->Judul ?></strong></h3>
                    <p>ISBN: <strong><?= $book->BukuID ?></strong></p>
                    <p>Rak: <strong><a
                                href="<?= base_url('rak/detail/') . $rak->RakID ?>"><?= $rak->NamaRak ?></a></strong>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penulis</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->Penulis; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penerbit
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->Penerbit; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tahun Terbit
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->TahunTerbit; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Stok
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->Stok; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kota
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->Kota; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelas
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $book->Kelas; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <h6 class="text-dark"><strong>Aksi</strong></h6>
            <div class="row">
                <?php if ($this->session->userdata('level') !== '0') { ?>
                    <div class="col-xl-1 bg-dark m-2 rounded p-0">
                        <button class="btn btn-primary w-100" data-toggle="modal" data-target="#editbook"><i
                                class="fas fa-edit"></i> Edit</button>
                    </div>
                    <div class="col-xl-1 bg-dark m-2 rounded p-0">
                        <button class="btn btn-warning text-dark w-100" onclick="printDiv('printArea')"><i
                                class="fas fa-print"></i> Print</button>
                    </div>
                <?php } ?>
                <?php if ($this->session->userdata('level') !== '0') { ?>
                    <div class="col-xl-1 bg-dark m-2 rounded p-0">
                        <button class="btn btn-danger w-100" data-toggle="modal" data-target="#delbook"><i
                                class="fas fa-trash"></i> Hapus</button>
                    </div>
                <?php } ?>
                <?php if ($this->session->userdata('level') == '0') { ?>
                    <div class="col-xl-1 bg-dark m-2 rounded p-0">
                        <button class="btn btn-success w-100" data-toggle="modal" data-target="#borrowbook"><i
                                class="fas fa-tag"></i> Pinjam</button>
                    </div>
                <?php } ?>
            </div>

            <hr>
            <h6 class="text-dark"><strong>Ulasan</strong></h6>
            <div>
                <div>
                    <div>
                        <div class="py-2">
                            <?php
                            if ($this->session->flashdata('messagerev') != '') {
                                echo '<div class="alert alert-success" role="alert">';
                                echo $this->session->flashdata('messagerev');
                                echo '</div>';
                            }
                            ?>
                            <form action="<?= base_url('review/add'); ?>" method="post">
                                <div class="form-group">
                                    <input type="hidden" name="userid"
                                        value="<?= $this->session->userdata('user_data')->UserID ?>">
                                    <input type="hidden" name="bookid" value="<?= $book->BukuID ?>">
                                    <input type="text" class="form-control form-control-user" id="review" name="ulasan"
                                        placeholder="Berikan ulasan anda tentang buku ini." required>
                                </div>

                                <?php
                                $star = 0;
                                ?>
                                <input type="hidden" id="rating" name="rating" value="<?= $star ?>">
                                <input type="hidden" id="catid" name="catid" value="<?= $category->KategoriID ?>">

                                <div class="form-group">
                                    <span class="p-2"><span id="starnum"><?= $star ?></span>/5</span>
                                    <?php
                                    for ($x = 1; $x <= 5; $x) {
                                        if ($x > $star) { ?>
                                            <button onclick="starAdd('<?= $x ?>')" type="button"
                                                style="background:transparent;border:none;">
                                                <i class="fa fa-star star" id="star-<?= $x ?>"></i>
                                            </button>
                                            <?php
                                            $x = $x + 1;
                                        } else { ?>
                                            <button onclick="starAdd('<?= $x ?>')" type="button"
                                                style="background:transparent;border:none;">
                                                <i class="fa fa-star text-warning" id="star-<?= $x ?>"></i>
                                            </button>
                                            <?php $x = $x + 1;
                                        }
                                    } ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Kirim
                                </button>
                            </form>
                            <hr>

                            <?php
                            if ($reviews->num_rows() > 0) { ?>

                                <?php foreach ($reviews->result_array() as $rev) { ?>
                                    <div class="column border border-primary rounded p-2 shadow my-5">
                                        <div class="d-flex">
                                            <h5 class="col-xl text-dark"><strong><?= $rev['Username'] ?></strong>
                                                (<?= $rev['UserLevel'] == 0 ? 'Peminjam' : ($rev['UserLevel'] == 1 ? 'Admin' : 'Petugas') ?>)
                                            </h5>
                                        </div>
                                        <p class="col-xl"><?= $rev['Ulasan'] ?></p>
                                        <span class="col-xl">
                                            <span class="p-2"><?= $rev['Rating'] ?>/5</span>
                                            <?php
                                            for ($x = 1; $x <= 5; $x) {
                                                if ($x > $rev["Rating"]) { ?>
                                                    <i class="fa fa-star star""></i>
                                                        <?php
                                                        $x = $x + 1;
                                                } else { ?>
                                                            <i class=" fa fa-star text-warning""></i>
                                                    <?php $x = $x + 1;
                                                }
                                            } ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>

</div>

</div>


<?php if ($this->session->userdata('level') !== '0') { ?>
    <div class="modal fade" id="editbook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mengedit buku</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="<?= base_url() ?>book/edit">
                    <div class="modal-body">
                        <input type="hidden" name="catid" value="<?= $book->KategoriID ?> ?>">
                        <div class="form-group">
                            <label class="col-form-label">ISBN:</label>
                            <input name="bookid" type="text" class="form-control" value="<?= $book->BukuID ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Judul:</label>
                            <input name="book" type="text" class="form-control" value="<?= $book->Judul ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Penulis:</label>
                            <input name="bookwriter" type="text" class="form-control" value="<?= $book->Penulis ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Penerbit:</label>
                            <input name="bookpublisher" type="text" class="form-control" value="<?= $book->Penerbit ?>"
                                required>
                        </div>
                        <?php
                        $currentDateTime = new DateTime('now');
                        $currentDate = $currentDateTime->format('Y');
                        ?>
                        <div class="form-group">
                            <label class="col-form-label">Tahun Terbit:</label>
                            <input name="bookyear" type="number" max="<?= $currentDate ?>" class="form-control"
                                value='<?= $book->TahunTerbit ?>' required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Stok:</label>
                            <input name="bookstok" type="number" class="form-control" value="<?= $book->Stok ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Rak:</label>
                            <select name="bookrak" id="bookrak" class="form-control">
                                <?php foreach ($raks->result_array() as $ra) { ?>
                                    <option value="<?= $ra['RakID'] ?>" <?= $ra["RakID"] == $cat['RakID'] ? 'selected' : '' ?>>
                                        <?= $ra['NamaRak'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Kategori:</label>
                            <select name="bookcat" id="bookcat" class="form-control">
                                <?php foreach ($categorys->result_array() as $ra) { ?>
                                    <option value="<?= $ra['KategoriID'] ?>" <?= $ra["KategoriID"] == $cat['KategoriID'] ? 'selected' : '' ?>><?= $ra['NamaKategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($this->session->userdata('level') == '0') { ?>
    <div class="modal fade" id="borrowbook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form method="post" action="<?= base_url() ?>book/borrow/<?= $book->BukuID ?>">
                    <div class="modal-body">
                        <span>Kamu akan meminjam <strong><?= $book->Judul ?></strong> dari
                            <strong><?= $category->NamaKategori ?></strong>
                            <br>
                            Stok: <strong><?= $book->Stok ?></strong></span>
                        <hr>
                        <input type="hidden" name="catid" value="<?= $cat['KategoriID'] ?>">
                        <input type="hidden" name="bookid" value="<?= $cat['BukuID'] ?>">
                        <div class="form-group">
                            <!-- <label class="col-form-label">Total Pinjaman:</label> -->
                            <input name="takeborrow" type="hidden" value="1" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($this->session->userdata('level') !== '0') { ?>
    <div class="modal fade" id="delbook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah kamu yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Kamu akan menghapus <strong><?= $book->Judul ?></strong> dari
                    <strong><?= $category->NamaKategori ?></strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form method="post" action="<?= base_url() ?>book/delete">
                        <input type="hidden" value="<?= $book->KategoriID ?>" name="catid">
                        <input type="hidden" value="<?= $book->BukuID ?>" name="bookid">
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function starAdd(id) {
        for (let i = 1; i <= 5; i++) {
            console.log('num ' + i);
            $("#star-" + i).removeClass('text-warning');
            if (i <= id) {
                $("#starnum").empty();
                $("#starnum").html(id);
                $("#star-" + i).addClass('text-warning');
            }
        }

        $("#rating").val(id);
    }

    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>