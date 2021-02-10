<!--page title section-->
<section class="inner_cover parallax-window" data-parallax="scroll" data-image-src="<?php echo base_url() ?>assets/homepage/assets/img/bg/bg.png">
    <div class="overlay_dark"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="inner_cover_content">
                    <h3>
                        Archieve
                    </h3>
                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <ul>
                <li><a href="#">Home</a> | </li>
                <li><a href="#"><span>Archieve</span></a> </li>

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
                Archieve
            </h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <tr>
                                <th style="text-align:center;" width="5%">No</th>
                                <th style="text-align:center;">Title</th>
                                <th style="text-align:center;">Category</th>
                                <th style="text-align:center;">Author</th>
                                <th style="text-align:center;">URL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jurnal as $row) { ?>
                                <tr>
                                    <td align="center"><?php echo $no ?></td>
                                    <td><?php echo $row->judul ?></td>
                                    <td><?php echo $row->bidang ?></td>
                                    <td><?php echo $row->penulis ?></td>
                                    <td><?php echo $row->link ?></td>
                                    <td align="center">
                                        <a href="<?php echo site_url('home/download_jurnal/' . $row->file) ?>"><i class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>