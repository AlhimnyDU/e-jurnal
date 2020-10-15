<div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4 class="page-head-line">Dashboard Reviewer</h4>
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
                                <th>Catatan</th>
                                <th width="20%">Author</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                        foreach($jurnal as $row){ ?>
                        <?php if(($row->tipe=="Sedang diulas")||($row->tipe=="Pengajuan akhir")||($row->tipe=="Menunggu reviewer")){ ?>
                          <tr>
                            <td align="center"><?php echo  $no ?></td>
                            <td><?php echo $row->nama_jurnal ?></td>
                            <td><?php echo $row->note ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td>
                              <a class="btn btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>"><i class="fa fa-file-pdf-o"></i></a> | <a class="btn btn-primary" href="" data-toggle="modal" data-target="#jawabanModal<?php echo $row->id_jurnal?>"><i class="fa fa-edit"></i></a>
                            </td>
                          </tr>
                        <?php $no++; }} ?>
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
                                <th width="15%">Aksi</th>
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
                              <a class="btn btn-danger" href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>"><i class="fa fa-file-pdf-o"></i></a>
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
    </div>
  </div>

  <?php
    foreach($jurnal as $row){
  ?>
  <div id="jawabanModal<?php echo $row->id_jurnal?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Mengulas Jurnal</h3>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo site_url('reviewer/jawaban/').$row->id_jurnal?>" enctype="multipart/form-data">
            <div class="row">
              <div class="col col-lg-12">
                <div class="form-group">
                <?php if($row->tipe!="Pengajuan akhir"){?>
                  <label>Persetujuan</label>
                  <select name="statusreviewer" class="form-control" required="">
                    <option value="" disabled selected hidden>Pilih...</option>
                    <option value="Revisi">Perlu Revisi</option>
                    <option value="Terima">Disetujui</option>
                    <option value="Tolak">Ditolak</option>
                    <!-- <option value="Tolak">Ditolak</option> -->
                  </select>
                <?php }else{ ?>
                    <label>Persetujuan</label>
                    <select name="statusreviewer" class="form-control" required="">
                      <option value="" disabled selected hidden>Pilih...</option>
                      <option value="Terima">Disetujui</option>
                      <option value="Tolak">Ditolak</option>
                      <!-- <option value="Tolak">Ditolak</option> -->
                    </select>
                <?php } ?>
                </div>
                <div class="form-group">
                  <label>Catatan hasil ulasan</label>
                  <textarea class="form-control ckeditor" name="jawaban" required></textarea>
                </div>
                <div class="form-group">
                  <label>Upload file</label> <small style="color:red;">*bila diperlukan</small>
                  <input type="file" class="dropify" data-height="75" name="file_jawaban" data-max-file-size="2M" data-allowed-file-extensions="pdf">
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