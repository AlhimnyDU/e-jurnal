<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                © SEMINAR NASIONAL REKAYASA DAN APLIKASI TEKNIK MESIN DI INDUSTRI
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable();
        } );
    </script>
    <?php if ($this->session->flashdata('sukses_login')): ?>
    <script>
        swal({
            icon: 'success',
            title: 'Login Berhasil',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    <?php endif; ?>
    <?php if ($this->session->flashdata('sukses_add')): ?>
    <script>
        swal({
            icon: 'success',
            title: 'Tambah Berhasil',
            buttons: false,
            timer: 1500
        });
    </script>
    <?php endif; ?>
    <?php if ($this->session->flashdata('sukses_update')): ?>
    <script>
        swal({
            icon: 'success',
            title: 'Update Berhasil',
            buttons: false,
            timer: 1500
        });
    </script>
    <?php endif; ?>
</body>
</html>