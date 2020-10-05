<div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="page-head-line">Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="dashboard-div-wrapper bk-clr-one">
            <i class="fa fa-users dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
            </div>
            <h5>Pendaftar (<?php echo $jml_user['total'] ?>)</h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="dashboard-div-wrapper bk-clr-two">
            <i class="fa fa-upload dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"></div>
            </div>
            <h5>Upload Jurnal (<?php echo $jml_jurnal['total'] ?>)</h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="dashboard-div-wrapper bk-clr-three">
            <i class="fa fa-file dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
            </div>
            <h5>Revisi Jurnal Upload Jurnal (<?php echo $jml_jurnal_rev['total'] ?>)</h5>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
          <div class="dashboard-div-wrapper bk-clr-four">
            <i class="fa fa-check dashboard-div-icon"></i>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
            </div>
            <h5>Selesai Review (<?php echo $jml_jurnal_fin['total'] ?>)</h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="notice-board">
            <div class="panel panel-primary">
              <div class="panel-heading">
                List jurnal yang telah di upload
              </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th width="20%">Author</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                        foreach($jurnal as $row){ ?>
                          <tr>
                            <td align="center"><?php echo $no ?></td>
                            <td><?php echo $row->nama_jurnal ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td>
                              <a class="btn btn-warning" href="<?php echo site_url('admin/download_tf/'.$row->file_bayar)?>"><i class="fa fa-dollar"></i></a> | <a class="btn btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>"><i class="fa fa-file-pdf-o"></i></a> | <a class="btn btn-primary" href="" data-toggle="modal" data-target="#reviewerModal<?php echo $row->id_jurnal?>"><i class="fa fa-user-plus"></i></a>
                            </td>
                          </tr>
                        <?php $no++; } ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-md-6">
              <div class="notice-board">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Jurnal sedang diulas
                  </div>
                  <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th width="20%">Author</th>
                                    <th width="20%">Reviewer</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            foreach($jurnal_ulas as $row){ ?>
                              <tr>
                                <td align="center"><?php echo $no ?></td>
                                <td><?php echo $row->nama_jurnal ?></td>
                                <td><?php echo $row->nama ?></td>
                                <td>
                                  <?php $nama = $this->db->select('*')->from('tbl_akun')->where('id_akun', $row->id_reviewer)->get()->row();
                                    echo $nama->nama;
                                  ?>
                                </td>
                                <td>
                                  <a class="btn btn-sm btn-warning" href="<?php echo site_url('admin/download_tf/'.$row->file_bayar)?>"><i class="fa fa-dollar"></i></a> | <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                            </tbody>
                            </table>
                          </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="notice-board">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Jurnal telah diulas (Selesai)
                  </div>
                  <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th width="20%">Author</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            foreach($jurnal_fin as $row){ ?>
                              <tr>
                                <td align="center"><?php echo $no ?></td>
                                <td><?php echo $row->nama_jurnal ?></td>
                                <td><?php echo $row->nama ?></td>
                                <td>
                                <a class="btn btn-sm btn-warning" href="<?php echo site_url('admin/download_tf/'.$row->file_bayar)?>"><i class="fa fa-dollar"></i></a> | <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                            </tbody>
                            </table>
                          </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
                <div class="notice-board">
                    <div class="panel panel-success">
                    <div class="panel-heading">
                      <a class="btn btn-success" href="" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus-circle"></i> Tambah Akun</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            foreach($akun as $row){ ?>
                              <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $row->nama ?></td>
                                <td><?php echo $row->email ?></td>
                                <td><?php echo $row->telp ?></td>
                                <td>
                                <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#lupaModal<?php echo $row->id_akun?>"><i class="fa fa-key"></i></a> | <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#editModal<?php echo $row->id_akun?>"><i class="fa fa-edit"></i></a> | <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/deleteAkun/'.$row->id_akun)?>"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                            </tbody>
                            </table>
                        </div>  
                    </div>
                    </div>
                </div>
            </div>
           </div>
           <hr>
           <div class="row">
            <div class="col-md-12">
                <div class="notice-board">
                    <div class="panel panel-danger">
                    <div class="panel-heading">
                    <a class="btn btn-danger" href="<?php echo site_url('admin/register_reviewer') ?>"><i class="fa fa-plus-circle"></i> Tambah Reviewer</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;
                                foreach($reviewer as $row){ ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->nama ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->telp ?></td>
                                    <td>
                                      <a class="btn btn-sm btn-default" href="<?php echo site_url('admin/job/'.$row->id_akun)?>"><i class="fa fa-briefcase"></i></a> | <a class="btn btn-sm btn-warning" href="" data-toggle="modal" data-target="#lupa2Modal<?php echo $row->id_akun?>"><i class="fa fa-key"></i></a> | <a class="btn btn-sm btn-primary" href="" data-toggle="modal" data-target="#edit2Modal<?php echo $row->id_akun?>"><i class="fa fa-edit"></i></a> | <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/deleteAkun/'.$row->id_akun)?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $no++;} ?>
                                
                            </tbody>
                            </table>
                        </div>  
                    </div>
                    </div>
                </div>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Akun</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="post" action="<?php echo site_url('admin/addAkun')?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
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
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right" value="Tambah" name="submit">Tambah</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>

  <?php
    $no=1; 
    foreach($jurnal as $row){ 
  ?>
  <div id="reviewerModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Pilih Reviewer</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/mereview/').$row->id_jurnal?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                <select name="reviewer" class="form-control" required="">
                                    <option value="" disabled selected hidden>Pilih...</option>
                                    <?php foreach($reviewer as $r){ ?>
                                    <option value="<?php echo $r->id_akun ?>"><?php echo $r->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>

<?php
    $no=1; 
    foreach($akun as $row){ 
  ?>
  <div id="lupaModal<?php echo $row->id_akun?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Ganti Password</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/gantipassUser/').$row->id_akun?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password baru" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>
<?php
    $no=1; 
    foreach($akun as $row){ 
  ?>
  <div class="modal fade" id="editModal<?php echo $row->id_akun?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Akun</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="post" action="<?php echo site_url('admin/editAkun/'.$row->id_akun)?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Isikan Nama Lengkap" value="<?php echo $row->nama?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Isikan Tanggal Lahir" value="<?php echo $row->tgl_lahir?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Isikan Email" value="<?php echo $row->email?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asal Institusi/Perguruan Tinggi</label>
                                <input type="text" class="form-control" name="asal_institusi" placeholder="Isikan Nama Institusi" value="<?php echo $row->asal_institusi?>"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telepon</label>
                                <input type="text" class="form-control" name="telp" placeholder="Isikan Nomor Telepon" value="<?php echo $row->telp?>"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Isikan Alamat" ><?php echo $row->alamat?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right" value="Tambah" name="submit">Edit</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>

<?php
    $no=1; 
    foreach($reviewer as $row){ 
  ?>
  <div class="modal fade" id="edit2Modal<?php echo $row->id_akun?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Akun</h3>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="post" action="<?php echo site_url('admin/editAkun/'.$row->id_akun)?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Isikan Nama Lengkap" value="<?php echo $row->nama?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" placeholder="Isikan Tanggal Lahir" value="<?php echo $row->tgl_lahir?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Isikan Email" value="<?php echo $row->email?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asal Institusi/Perguruan Tinggi</label>
                                <input type="text" class="form-control" name="asal_institusi" placeholder="Isikan Nama Institusi" value="<?php echo $row->asal_institusi?>"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telepon</label>
                                <input type="text" class="form-control" name="telp" placeholder="Isikan Nomor Telepon" value="<?php echo $row->telp?>"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Isikan Alamat" ><?php echo $row->alamat?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right" value="Tambah" name="submit">Edit</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>
<?php
    $no=1; 
    foreach($reviewer as $row){ 
  ?>
  <div id="lupa2Modal<?php echo $row->id_akun?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Ganti Password</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('admin/gantipassUser/').$row->id_akun?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Masukkan Password baru" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>