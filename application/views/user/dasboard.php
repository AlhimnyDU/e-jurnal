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
                  <li>
                    <a href="#"><span class="glyphicon glyphicon-align-left text-success"></span> <?= $jurnal['nama_jurnal'] ?> <span class="label label-warning">Just now</span></a>
                  </li>
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
            <div class="panel panel-success">
              <div class="panel-heading">
                Input New Submission
              </div>
              <form method="POST" action="<?php echo site_url('user/addJurnal')?>" enctype="multipart/form-data">
              <div class="panel-body">
                <label>Journal Name :</label> <input type="text" name="nama_jurnal" class="form-control"> 
                <label>Upload Journal File :</label> <input type="file" class="dropify" data-height="75" name="file_jurnal" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf">
                <label>Upload Payment Bill :</label> <input type="file" class="dropify" data-height="75" name="file_bayar" required="" data-max-file-size="2M" data-allowed-file-extensions="pdf">
                <label>Note :</label> <textarea rows="3" class="form-control" name="note"></textarea>
                <hr>
                <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-envelope"></span> Submit</button>
              </div>
              </form>
              <div class="panel-footer text-muted">
                <strong>Note :</strong> Please note that your journal file is correct
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>