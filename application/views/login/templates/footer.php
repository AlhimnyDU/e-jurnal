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
    <?php if ($this->session->flashdata('sukses_registrasi')): ?>
    <script>
        swal({
            icon: 'success',
            title: 'Registrasi berhasil',
            text: "Cek inbox email, untuk aktivasi akun"
        });
    </script>
    <?php endif; ?>
    <?php if ($this->session->flashdata('gagal_login')): ?>
        <script>
            swal({
                icon: 'error',
                title: 'Gagal Login',
                text: "email atau password anda salah",
                buttons: false,
                timer: 1500
            });
        </script>
    <?php endif; ?>
</body>
</html>