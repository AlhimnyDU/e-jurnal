<!--page title section-->
<section class="inner_cover parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url() ?>assets/homepage/assets/img/bg/inner_cover.png">
    <div class="overlay_dark"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="inner_cover_content">
                    <h3>
                        Arsip
                    </h3>
                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Home</a>  |  </li>
                <li><a href="#"><span>Arsip</span></a>   </li>

            </ul>
        </div>
    </div>
</section>
<!--page title section end-->

<!--about section -->
<section class="pt100 pb100">
    <div class="container">
        <div class="section_title">
            <h3 class="title">
                Arsip
            </h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul</th>
                                <th>Bidang</th>
                                <th>Author</th>
                                <th>Aksi</th>
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
                            <td>
                                <a href="<?php echo site_url('admin/download_jurnal/'.$row->file_jurnal)?>" class="btn btn-primary btn-rounded">Download</a>
                            </td>
                          </tr>
                        <?php $no++; } ?>
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</section>