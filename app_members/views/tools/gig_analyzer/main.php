<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Gig Analyzer
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig_analyzer"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Overview</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer/submit_gig"><i class="fa fa-lg fa-fw fa-magic"></i> <span class="menu-item-parent">Submit a Gig</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">My Submitted Gigs</span></a>
         </li>
         <!-- <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer/tool_training"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">Tool Training</a>
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
            <li>Gig Analyzer</li>
        </ol>
    </div>

    <div id="content" class="ga-gig-list">

        <div class="row">

            <div class="col-sm-6 col-md-3">
                <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="icon-stats">
                    <div class="well well-sm bg-color-purple txt-color-white text-center">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-shield fa-4x"></i>
                            </div>
                            <div class="col-xs-8 text-left">
                                <span class="count"><?= $total_gigs; ?></span>
                                <h5>Total Gigs</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="icon-stats">
                    <div class="well well-sm bg-color-orange txt-color-white text-center">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-clock-o fa-4x"></i>
                            </div>
                            <div class="col-xs-8 text-left">
                                <span class="count"><?= $pending_gigs; ?></span>
                                <h5>Pending Gigs</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="icon-stats">
                    <div class="well well-sm bg-color-red txt-color-white text-center">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-frown-o fa-4x"></i>
                            </div>
                            <div class="col-xs-8 text-left">
                                <span class="count"><?= $rejected_gigs; ?></span>
                                <h5>Rejected Gigs</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="icon-stats">
                    <div class="well well-sm bg-color-teal txt-color-white text-center">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <i class="fa fa-thumbs-o-up fa-4x"></i>
                            </div>
                            <div class="col-xs-8 text-left">
                                <span class="count"><?= $perfect_gigs; ?></span>
                                <h5>Approved Gigs</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <center style="border: 1px dashed #ccc; margin-bottom: 20px;">
            <h3>Get your Gigs analyzed by our team of experts. Click on the button below to submit your gig.</h3>
            <a class="btn btn-lg btn-success" href="<?= base_url(); ?>tools/gig_analyzer/submit_gig">Submit Your Gig</a>
            <br><br>
        </center>

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-7">
                    <div class="jarviswidget" id="wdj-ga-improvement" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-frown-o"></i> </span>
                            <h2>Rejected Gigs</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gig Image</th>
                                                <th>Title</th>
                                                <th>Analyze Since</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $rejected_gig_list; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="widget-footer">
                                    <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="btn btn-sm btn-primary">View More</a>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="jarviswidget" id="wdj-ga-pending" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-clock-o"></i> </span>
                            <h2>Pending Gigs</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gig Image</th>
                                                <th>Title</th>
                                                <th>Pending Since</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $pending_gig_list; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="widget-footer">
                                    <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="btn btn-sm btn-primary">View More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>

                <article class="col-xs-12 col-sm-12 col-md-5">
                    <div class="jarviswidget" id="wdj-ga-perfect" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-thumbs-o-up"></i> </span>
                            <h2>Approved Gigs</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Gig Image</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $perfect_gig_list; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="widget-footer">
                                    <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs" class="btn btn-sm btn-primary">View More</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </article>

            </div>
        </section>


    </div>

</div>