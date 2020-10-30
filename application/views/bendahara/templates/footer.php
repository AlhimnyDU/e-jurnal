<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SEMNAS RATMI
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
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            });
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