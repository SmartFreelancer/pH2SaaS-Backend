<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Tools
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>
            <li class="active">
                <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa-user-secret"></i> <span class="menu-item-parent">My Tools</span></a>
            </li>
            <!-- <li>
                <a href="#tab2" aria-controls="tab1" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Gig Tools</span></a>
            </li> -->
            <li>
                <a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa-gears"></i> <span class="menu-item-parent">Gig Software</span></a>
            </li>
            <li>
                <a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa fa-sitemap"></i> <span class="menu-item-parent">All Tools</a>
            </li>
            <li>
                <a href="mailto:<?= config_item('support_email'); ?>?subject=Private Support"><i class="fa fa-lg fa-fw fa-support"></i>Help &amp; Support</a>
            </li>
            <?php $this->load->view('quick_links'); ?>
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>


<div id="main" role="main">

    <!-- <div id="ribbon">
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li>Tools</li>
        </ol>
    </div> -->

    <div id="content">

    <div class="well">
            <h1>
                <span class="semi-bold">News</span>
                <i class="ultra-light">and</i>
                <span class="semi-bold">Announcements</span>
                <sup class="badge bg-color-orange">New!</sup>
                <br><br>
                <small class="txt-color-red">
                    <strong>More advanced tools and features coming soon!</strong>
                </small>
            </h1>
            <p>
                You can leave your feedback & suggestions about features that you would like to see us implement <a href="<?= base_url(); ?>community">Share Your Thoughts.</a>
            </p>
        </div>

        <div id="tool-list" role="tabpanel">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="tab1">

                    <div class="row">
                        <?php
                        foreach ($user_tools as $item) { ?>
                            <div class="col-xs-6 col-md-3">
                                <a class="thumbnail" href="<?= base_url(); ?><?= $item['url_segment']; ?>">
                                    <img alt="Tool" src="<?= base_url(); ?>assets/img/tools/<?= $item['image']; ?>">
                                    <div class="caption text-center">
                                        <h5><?= $item['name']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab2">
                    <div class="row">
                        <?php
                        foreach ($gig_tools as $item) { ?>
                            <div class="col-xs-6 col-md-3">
                                <a class="thumbnail" href="<?= base_url(); ?><?= $item['url_segment']; ?>">
                                    <img alt="Tool" src="<?= base_url(); ?>assets/img/tools/<?= $item['image']; ?>">
                                    <div class="caption text-center">
                                        <h5><?= $item['name']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab3">
                    <div class="row">
                        <?php
                        foreach ($gig_software as $item) { ?>
                            <div class="col-xs-6 col-md-3">
                                <a class="thumbnail" href="<?= base_url(); ?><?= $item['url_segment']; ?>">
                                    <img alt="Tool" src="<?= base_url(); ?>assets/img/tools/<?= $item['image']; ?>">
                                    <div class="caption text-center">
                                        <h5><?= $item['name']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab4">
                    <div class="row">
                        <?php
                        foreach ($all_tools as $item) { ?>
                            <div class="col-xs-6 col-md-3">
                                <a class="thumbnail" href="<?= base_url(); ?><?= $item['url_segment']; ?>">
                                    <img alt="Tool" src="<?= base_url(); ?>assets/img/tools/<?= $item['image']; ?>">
                                    <div class="caption text-center">
                                        <h5><?= $item['name']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>



    </div>

</div>
