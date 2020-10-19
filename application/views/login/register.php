<!-- MENU SECTION END-->
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Registrasi Akun</h4>

                </div>

            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                           Daftarkan data diri 
                        </div>
                        <div class="panel-body">
                        <form method="post" action="<?php echo site_url('login/addAkun')?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Isikan Nama Lengkap" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Isikan Tanggal Lahir" />
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
                                <label for="exampleInputEmail1">Asal Institusi/Perguruan Tinggi</label>
                                <input type="text" class="form-control" name="asal_institusi" placeholder="Isikan Nama Institusi"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telepon</label>
                                <input type="text" class="form-control" name="telp" placeholder="Isikan Nomor Telepon"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Isikan Alamat" ></textarea>
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