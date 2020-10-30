<!-- MENU SECTION END-->
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Account Registration</h4>

                </div>

            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                           Enter Detail of your Account 
                        </div>
                        <div class="panel-body">
                        <form method="post" action="<?php echo site_url('login/addAkun')?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" class="form-control" name="nama" placeholder="Enter your fullname" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of Birth</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Choose your Date of birth" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Isikan Email" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instantion or University</label>
                                <input type="text" class="form-control" name="asal_institusi" placeholder="Enter Instantion or University"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="text" class="form-control" name="telp" placeholder="Enter your phone number"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea class="form-control" name="alamat" placeholder="Enter your address" ></textarea>
                            </div>
                            <center><button type="submit" class="btn btn-primary">Submit</button></center>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->