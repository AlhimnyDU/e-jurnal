<div class="copyright_footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SEMNAS RATMI
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</div>
<!--footer end -->
<!-- jquery -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/jquery.min.js"></script> 
<!-- bootstrap -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/popper.js"></script>
<script src="<?php echo base_url() ?>assets/homepage/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/homepage/assets/js/waypoints.min.js"></script>
<!--slick carousel -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/owl.carousel.min.js"></script>
<!--parallax -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/parallax.min.js"></script>
<!--Counter up -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/jquery.counterup.min.js"></script>
<!--Counter down -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/jquery.countdown.min.js"></script>
<!-- WOW JS -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/wow.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/homepage/assets/js/main.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
        $(document).ready( function () {
            $('.datatable').DataTable();
        } );
    </script>
   <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Nov 5, 2020 23:59:59").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("days").innerHTML = String(days).padStart(2, '0');
            document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
            document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
            document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("day").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
            }
        }, 1000);
    </script>
</body>
</html>