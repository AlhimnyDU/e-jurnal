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
                            <p>Doesn't have account ? Registration first with click button in below</p> 
                                <a href="<?php echo site_url()?>/login/register" class="btn btn-danger">Register</a></center>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">
                    <strong> Important to remember :</strong>
                        <br />
                        <ul>
                            <li>
                                Registration and submit paper ( until 17 November 2020 )
                            </li>
                            <li>
                                Review Paper by Reviewer ( 10 - 17 November 2020 )
                            </li>
                            <li>
                                Revision period ( 17 - 24 November 2020 )
                            </li>
                            <li>
                                Announcement ( 4 Desember 2020 )
                            </li>
                        </ul>
                       
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->