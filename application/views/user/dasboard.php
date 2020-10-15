<div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="page-head-line">Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="notice-board">
            <div class="panel panel-default">
              <div class="panel-heading">
                Lastest Journal Submit
                <div class="pull-right">
                </div>
              </div>
              <div class="panel-body">
                <ul>
                  <?php 
                  $no=1;
                  foreach($jurnal as $row){?>
                  <li>
                    <?php echo $no.". ".$row->nama_jurnal;?> <br>
                    Aksi : <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#statusModal<?php echo $row->id_jurnal ?>" style="color:white;"> Cek Status</a>
                    <?php if($row->tipe=="Revisi"){?> 
                      <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#revisiModal<?php echo $row->id_jurnal ?>" style="color:white;">Cek Revisi Disini</a> 
                    <?php }else if(($row->tipe=="Selesai")||($row->tipe=="Ditolak")){?> 
                      | <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#selesaiModal<?php echo $row->id_jurnal ?>" style="color:white;"> Cek Pesan</a>
                    <?php }else if($row->tipe=="Dikembalikan"){?>
                      | <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tolakModal<?php echo $row->id_jurnal ?>" style="color:white;"> Cek Pesan</a>
                    <?php } ?>
                  </li>
                  <?php $no++; } ?>
                </ul>
              </div>
              <div class="panel-footer">
                <a href="<?php site_url('user') ?>" class="btn btn-default btn-block"><i class="glyphicon glyphicon-repeat"></i></a>
              </div>
            </div>
          </div>
          <hr>
        </div>
        <div class="col-md-6">
          <div class="Compose-Message">
            <div class="panel panel-primary">
              <div class="panel-heading">
                
              </div>
              <div class="panel-body">
                <div class="tab-content">
                  <div class="tab-pane fade active in" id="dashboard">
                  <center><label>Input New Submission</label></center>
                  <hr>
                    <form method="POST" action="<?php echo site_url('user/addJurnal')?>" enctype="multipart/form-data">
                      <label>Journal Name :</label> <input type="text" name="nama_jurnal" class="form-control" required>
                      <label>Bidang :</label>
                      <select name="bidang" class="form-control" required="">
                        <option value="" disabled selected hidden>Pilih...</option>
                        <option value="TEKNOLOGI PERANCANGAN DAN PENGEMBANGAN PRODUK">TEKNOLOGI PERANCANGAN DAN PENGEMBANGAN PRODUK</option>
                        <option value="TEKNOLOGI BAHAN DAN MATERIAL KOMPOSIT">TEKNOLOGI BAHAN DAN MATERIAL KOMPOSIT</option>
                        <option value="TEKNOLOGI KONVERSI ENERGI">TEKNOLOGI KONVERSI ENERGI</option>
                        <option value="TEKNOLOGI SISTEM KENDALI DAN PEMROSESAN SINYAL">TEKNOLOGI SISTEM KENDALI DAN PEMROSESAN SINYAL</option>
                        <option value="TEKNOLOGI MANUFAKTUR DAN METROLOGI">TEKNOLOGI MANUFAKTUR DAN METROLOGI</option>
                        <option value="Lainnya">Lainnya</option>
                      </select> 
                      <label>Upload Journal File :</label> <input type="file" class="dropify" data-height="75" name="file_jurnal" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf">
                      <!-- <label>Upload Payment Bill :</label> <input type="file" class="dropify" data-height="75" name="file_bayar" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf"> -->
                      <label>Note :</label> <textarea rows="3" class="form-control" name="note"></textarea>
                      <input type="checkbox" required> Saya menyetujui segala ketentuan yang berlaku
                      <hr>
                      <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-envelope"></span> Submit</button>
                    </form>
                    <br>
                    <div class="panel-footer text-muted">
                      <strong>Note :</strong> Please note that your journal file is correct
                    </div>
                  </div>
                  <div class="tab-pane fade" id="editprofile">
                    <center><label>Edit Profile</label></center>
                    <hr>
                    <form method="post" action="<?php echo site_url('user/editProfile/'.$akun['id_akun'])?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $akun['nama']?>" placeholder="Isikan Nama Lengkap" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $akun['tgl_lahir']?>" placeholder="Isikan Tanggal Lahir" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $akun['email']?>" placeholder="Isikan Email" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asal Institusi/Perguruan Tinggi</label>
                                <input type="text" class="form-control" name="asal_institusi" value="<?php echo $akun['asal_institusi']?>" placeholder="Isikan Nama Institusi"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telepon</label>
                                <input type="text" class="form-control" name="telp" value="<?php echo $akun['telp']?>" placeholder="Isikan Nomor Telepon"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Isikan Alamat" ><?php echo $akun['alamat']?></textarea>
                            </div>
                            <center>
                            <button type="submit" class="btn btn-primary">Submit</button> | 
                            <a class="btn btn-warning" href="" data-toggle="modal" data-target="#lupaModal"><i class="fa fa-key"></i> Ganti Password</a>
                            </center>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    $no=1; 
    foreach($jurnal as $row){ 
  ?>
  <div id="revisiModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Revisi</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('user/revisi/').$row->id_jurnal?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col col-lg-12">
                            <div class="form-group">
                              <center><h4><b>Tanggapan reviewer</b></h4></center>
                              <br>
                              <?php echo $row->jawaban?>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label>File Tanggapan Revisi : </label>
                              <?php if($row->file_jawaban!=NULL){ ?>
                              <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jawaban)?>"><i class="fa fa-file-pdf-o"></i></a>
                              <?php }else{ ?>
                              <span class="label label-danger">Tidak ada informasi berupa file</span>
                              <?php } ?>
                            </div>
                            <hr>
                            <div class="form-group">
                              <label>Upload Journal File :</label> 
                              <input type="file" class="dropify" data-height="75" name="file_revisi" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf">
                            </div>
                            <div class="form-group">
                            <label>Note :</label> <textarea rows="5" class="form-control" name="note"></textarea>
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

  <div id="selesaiModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Review</h3>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col col-lg-12">
                  <div class="form-group">
                    <center><h4><b>Tanggapan reviewer</b></h4></center>
                    <br>
                    <?php echo $row->jawaban?>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>File Tanggapan Revisi : </label>
                    <?php if($row->file_jawaban!=NULL){ ?>
                    <a class="btn btn-sm btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jawaban)?>"><i class="fa fa-file-pdf-o"></i></a>
                    <?php }else{ ?>
                    <span class="label label-danger">Tidak ada informasi berupa file</span>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>  
        </div>
    </div>
  </div>
  <div id="tolakModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Pesan</h3>
            </div>
            <div class="modal-body">
            <form method="post" action="<?php echo site_url('user/pengajuan_ulang/').$row->id_jurnal?>" enctype="multipart/form-data">
              <div class="row">
                <div class="col col-lg-12">
                  <div class="form-group">
                    <textarea class="form-control" rows=3 readonly><?php echo $row->jawaban?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Upload File Revisi:</label> 
                    <input type="file" class="dropify" data-height="75" name="file_revisi" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button class="btn btn-danger  pull-right" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </form>
            </div>  
        </div>
    </div>
  </div>
  <div id="statusModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Timeline</h3>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col col-lg-12">
                          <div id="stepper-example" class="bs-stepper">
                            <div class="bs-stepper-header">
                              <div class="step" data-target="#test-l-1">
                                <a href="#">
                                  <span class="bs-stepper-circle" style="background-color:green;"><i class="fa fa-check"></i></span>
                                  <span class="bs-stepper-label">Upload</span>
                                </a>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#test-l-2">
                                <a href="#">
                                <?php if($row->tipe=="Dikembalikan"){?>
                                  <span class="bs-stepper-circle" style="background-color:red;"><i class="fa fa-times"></i></span>
                                <?php }else if(($row->tipe=="Sedang diulas")||($row->tipe=="Revisi")||($row->tipe=="Ditolak")||($row->tipe=="Selesai")||($row->tipe=="Menunggu reviewer")||($row->tipe=="Keputusan Akhir")||($row->tipe=="Pengajuan akhir")){?>
                                  <span class="bs-stepper-circle" style="background-color:green;"><i class="fa fa-check"></i></span>
                                <?php }else{ ?>
                                  <span class="bs-stepper-circle">2</span>
                                <?php } ?>
                                  <span class="bs-stepper-label">Verifikasi Admin</span>
                                </a>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#test-l-3">
                                <a href="#">
                                <?php if($row->tipe=="Revisi"){?>
                                  <span class="bs-stepper-circle" style="background-color:orange;"><i class="fa fa-pause"></i></span>
                                <?php }else if(($row->tipe=="Ditolak")||($row->tipe=="Selesai"||($row->tipe=="Keputusan Akhir"))){?>
                                  <span class="bs-stepper-circle" style="background-color:green;"><i class="fa fa-check"></i></span>
                                  <?php }else{ ?>
                                  <span class="bs-stepper-circle">3</span>
                                <?php } ?>
                                <span class="bs-stepper-label">Diulas Reviewer</span>
                                </a>
                              </div>
                              <div class="line"></div>
                                <div class="step" data-target="#test-l-4">
                                  <a href="#">
                                  <?php if($row->tipe=="Selesai"){?>
                                    <span class="bs-stepper-circle" style="background-color:green;"><i class="fa fa-check"></i></span>
                                    <span class="bs-stepper-label">Disetujui</span>
                                  <?php }else if($row->tipe=="Ditolak"){?>
                                    <span class="bs-stepper-circle" style="background-color:red;"><i class="fa fa-times"></i></span>
                                    <span class="bs-stepper-label">Ditolak</span>
                                  <?php }else{ ?>
                                    <span class="bs-stepper-circle">4</span>
                                    <span class="bs-stepper-label">Final</span>
                                  <?php } ?>
                                  </a>
                                </div>
                            </div>
                            <?php if($row->tipe=="Selesai"){?>
                              <hr>
                            <form action="<?php echo site_url() ?>user/upload_bayar/<?= $row->id_jurnal ?>" method="POST" enctype="multipart/form-data">
                              <div class="form-grup">
                                  <label>Upload Bukti Pembayaran :</label> 
                                  <input type="file" class="dropify" data-height="75" name="file_bayar" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf" data-default-file="<?php echo site_url() ?>assets/upload/bayar/<?= $row->file_bayar ?>">
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button> 
                            </div>
                            </form>
                            <?php } ?>
                          </div>
                        </div>
                    </div>
            </div>  
        </div>
    </div>
  </div>
  <?php
    } 
  ?>

<div id="lupaModal" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Ganti Password</h3>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo site_url('user/gantipassUser/').$akun['id_akun']?>" enctype="multipart/form-data">
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