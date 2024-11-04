<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Dibuat oleh <strong>Vincenzo</strong> <small>(SB ADMIN 2 TEMPLATE)</small></span>
        </div>
    </div>
</footer>

</div>

</div>



<a class="scroll-to-top rounded bg-primary" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Keluar" dibawah jika anda yakin untuk keluar dari sesi ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url() ?>login/logout">Keluar</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url() ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>js/demo/datatables-demo.js"></script>
<script src="<?= base_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>js/demo/chart-pie-demo.js"></script>

<script>
    $('input[type="number"]').on('change input keyup paste', function () {
        if (this.max) this.value = Math.min(parseInt(this.max), parseInt(this.value) || 0);
    });
</script>

</body>

</html>