<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark">Pengaturan</h1>
    </div>

    <div class="row ml-1">
        <div class="card shadow col-4">
            <div class="card-body">
                <form class="user" action="<?= base_url('dashboard/edit_settings') ?>" method="post">
                    <div class="row">
                        <div class="col">
                            <span><b>Denda</b></span>
                            <hr>
                            <div class="form-group">
                                <label class="col-form-label">Denda Biasa:</label>
                                <input type="text" class="form-control" id="email" name="username"
                                    value="<?= $settings->DendaBiasa ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Denda Rusak:</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    value="<?= $settings->DendaRusak ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Denda Hilang:</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    value="<?= $settings->DendaHilang ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary col">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
</div>