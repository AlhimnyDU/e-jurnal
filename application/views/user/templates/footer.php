        <footer>
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                © 2015 YourCompany | By : <a href="/" target="_blank">DesignBootstrap</a>
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
    </body>
  </html>