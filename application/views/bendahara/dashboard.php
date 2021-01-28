<div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h6 class="page-head-line">Dashboard</h6>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="notice-board">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Tabel status pembayaran
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Bidang</th>
                                <th>Author</th>
                                <th>Telepon</th>
                                <th>Status Paper</th>
                                <th>Status Bayar</th>
                                <th width="10%">File</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                        foreach($jurnal as $row){ ?>
                          <tr>
                            <td align="center"><?php echo $no ?></td>
                            <td><?php echo $row->nama_jurnal ?></td>
                            <td><?php echo $row->bidang ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td><?php echo $row->telp ?></td>
                            <td>
                                <?php if($row->tipe=="Selesai"){ ?>
                                    Diterima
                                  <?php }else if($row->tipe=="Ditolak"){ ?>
                                    Ditolak
                                  <?php }else{ ?>
                                    Sedang proses
                                  <?php }?>
                            </td>
                            <td>
                                <?php if($row->file_bayar!=NULL){ ?>
                                    Sudah Bayar
                                <?php }else{?>
                                    Belum Bayar
                                <?php }?>
                            </td>
                            <td>
                            <?php $no=1;
                              if($row->file_bayar!=NULL){ ?>
                                <a class="btn btn-warning" href="<?php echo site_url('assets/upload/bayar/'.$row->file_bayar)?>"><i class="fa fa-dollar"></i></a>
                              <?php }?>
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
        <div class="col-md-12">
          <div class="notice-board">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Tabel status pembayaran Peserta Seminar
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable2">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Peserta</th>
                                <th>Telepon</th>
                                <th width="10%">File</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                        foreach($seminar as $row){ ?>
                          <tr>
                            <td align="center"><?php echo $no ?></td>
                            <td><?php echo $row->nama ?></td>
                            <td><?php echo $row->telp ?></td>
                            <td>
                              <a class="btn btn-warning" href="<?php echo site_url('assets/upload/bayar/'.$row->file_bayar)?>"><i class="fa fa-dollar"></i></a>
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