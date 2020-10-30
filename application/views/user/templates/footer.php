        <footer>
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SEMNAS RATMI
                </div>
            </div>
            </div>
        </footer>
        <script src="<?php echo base_url() ?>assets/js/jquery-1.11.1.js"></script>
        <!-- jQuery -->
        <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <script>
            $( document ).ready(function() {
                $('.dropify').dropify({
                messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
                }
                });
            });
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
        <?php if ($this->session->flashdata('sukses_add')): ?>
        <script>
            swal({
                icon: 'success',
                title: 'Jurnal berhasil Diupload',
                buttons: false,
                timer: 1500
            });
        </script>
        <?php endif; ?>
        <?php if ($this->session->flashdata('sukses_bayar')): ?>
        <script>
            swal({
                icon: 'success',
                title: 'Bukti Pembayaran berhasil di Upload',
                buttons: false,
                timer: 1500
            });
        </script>
        <?php endif; ?>
    </body>
  </html>