<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Gig Image Cre...
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>
            <li class="active">
                <a href="<?= base_url(); ?>gig_software/gig_image_creator"><i class="fa fa-lg fa-fw fa-image"></i> <span class="menu-item-parent">Info Graphics</span></a>
            </li>
            <!--<li>
                <a href="<?= base_url(); ?>gig_software/gig_image_creator_training"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">Tool Training</a>
            </li> -->
            <?php $this->load->view('quick_links'); ?>
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>

<div id="main" role="main">

    <div id="ribbon">
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= base_url(); ?>tools">Tools</a></li>
            <li>Gig Image Creator</li>
        </ol>
    </div>

    <div id="content">

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget" id="gic-tl" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-image"></i> </span>
                            <h2>Gig Image Creator</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                                <center>
                                    <iframe src="<?= base_url(); ?>gig_soft/infographics/app/installation/index.php" width="100%" height="810" frameborder="0"></iframe>
                                </center>

                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </section>

    </div>

</div>