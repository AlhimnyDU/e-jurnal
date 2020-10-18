<!-- MENU SECTION END-->
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Log In</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="<?php echo site_url('login/login_akun')?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Isikan Email" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                            <span></span>
                        </div>
                        <div class="form-grup">
                            <center><button type="submit" class="btn btn-primary">Log In</button> <hr> 
                            <p>Tidak memiliki akun ? Silahkan registrasi dengan klik tombol dibawah ini, batas waktu pendaftaran : <span class="label label-success"><?php echo date('d F Y',strtotime($registrasi->batas_waktu)) ?></span></p> 
                            <?php if(date('Y-m-d H:i:s') < $registrasi->batas_waktu){ ?>
                                <a href="<?php echo site_url()?>/login/register" class="btn btn-danger">Register</a></center>
                            <?php }else{ ?>
                                <label class="label label-default">Registrasi telah ditutup, tunggu seminar RATMI selanjutnya</label>
                            <?php } ?>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        Kepada pemakalah yang belum memiliki akun, silahkan untuk melakukan registrasi terlebih dahulu
                        <br />
                         <strong> Ketentuan yang berlaku :</strong>
                        <ul>
                            <li>
                                Point Ini disesuaikan dengan konten
                            </li>
                            <li>
                                Point Ini disesuaikan dengan konten
                            </li>
                            <li>
                                Point Ini disesuaikan dengan konten
                            </li>
                            <li>
                                Point Ini disesuaikan dengan konten
                            </li>
                        </ul>
                       
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->