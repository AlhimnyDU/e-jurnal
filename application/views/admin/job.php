<!-- MENU SECTION END-->
<div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">List Jurnal Penugasan tiap Reviewer</h4>
                </div>

            </div>
            <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                           List jurnal yang diulas oleh <?php echo $reviewer['nama'] ?> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th width="20%">Author</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1;
                            foreach($jurnal as $row){ ?>
                            <tr>
                                <td align="center"><?php echo $no ?></td>
                                <td><?php echo $row->nama_jurnal ?></td>
                                <td><?php echo $row->nama ?></td>
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
    <!-- CONTENT-WRAPPER SECTION END-->