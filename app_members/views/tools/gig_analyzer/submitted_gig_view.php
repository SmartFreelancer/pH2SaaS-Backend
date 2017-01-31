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
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Overview</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig_analyzer/submit_gig"><i class="fa fa-lg fa-fw fa-magic"></i> <span class="menu-item-parent">Submit a Gig</span></a>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">My Submitted Gigs</span></a>
         </li>
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
            <li><a href="<?= base_url(); ?>tools/gig_analyzer">Gig Analyzer</a></li>
            <li><a href="<?= base_url(); ?>tools/gig_analyzer/submitted_gigs">My Submitted Gigs</a></li>
            <li>Viewing Gig</li>
        </ol>
    </div>

    <div id="content">

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="jarviswidget" id="ga-gig-view" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-newspaper-o"></i> </span>
                            <h2>My Submitted Gigs</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                                <?php
                                if ($gig_view_data->status == "0") { ?>
                                    <div class="page-msg text-center">
                                        <i class="fa fa-exclamation-triangle fa-5x text-primary"></i>
                                        <br>
                                        <h3>This gig is currently pending analysis</h3>
                                        <h5>Nothing to display at the moment!</h5>
                                    </div>
                                <?php } else if ($gig_view_data->status == "3"){ ?>
                                    <div class="page-msg text-center">
                                        <i class="fa fa-refresh fa-5x text-primary"></i>
                                        <br>
                                        <h3>Your gig was re-submitted and is currently pending analysis</h3>
                                        <h5>Nothing to display at the moment!</h5>
                                    </div>
                                <?php } else { ?>

                                    <div class="tabs-left">

                                        <ul class="nav nav-tabs tabs-left">
                                            <li class="active">
                                                <a href="#tab1" data-toggle="tab">
                                                <?php if (empty($gig_view_data->title_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Gig Title </a>
                                            </li>
                                            <li>
                                                <a href="#tab2" data-toggle="tab">
                                                <?php if (empty($gig_view_data->category_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Gig Category</a>
                                            </li>
                                            <li>
                                                <a href="#tab3" data-toggle="tab">
                                                <?php if (empty($gig_view_data->img_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Gig Image</a>
                                            </li>
                                            <li>
                                                <a href="#tab4" data-toggle="tab">
                                                <?php if (empty($gig_view_data->vid_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Gig Video</a>
                                            </li>
                                            <li>
                                                <a href="#tab5" data-toggle="tab">
                                                <?php if (empty($gig_view_data->desc_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Gig Description</a>
                                            </li>
                                            <li>
                                                <a href="#tab6" data-toggle="tab">
                                                <?php if (empty($gig_view_data->keywords_msg)) { ?>
                                                <i class="fa fa-check-square-o fa-lg text-success"></i>
                                                <?php } else { ?>
                                                <i class="fa fa-warning fa-lg text-danger"></i>
                                                <?php } ?>
                                                Keywords</a>
                                            </li>
                                            <li>
                                                <a href="#tab7" data-toggle="tab"><i class="fa fa-info-circle text-info fa-lg"></i> Additional Information</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">

                                            <div class="tab-pane active" id="tab1">
                                            <?php if (empty($gig_view_data->title_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>Your gig title is perfect and does not require any modifications.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>Your gig title require modification to improve your sales conversion.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->title_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab2">
                                            <?php if (empty($gig_view_data->category_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>Your gig is in a perfect category.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>The category your gig is in require modification to improve your sales conversion.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->category_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab3">
                                            <?php if (empty($gig_view_data->img_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>Your gig image is perfect and does not require any modifications.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>Your gig image require modification to improve your sales conversion.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->img_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab4">
                                            <?php if (empty($gig_view_data->vid_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>Your gig video is perfect and does not require any modifications.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>Your gig video require modification to improve your sales conversion.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->vid_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab5">
                                            <?php if (empty($gig_view_data->desc_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>Your gig description is perfect and does not require any modifications.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>Your gig description require modification to improve your sales conversion.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->desc_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab6">
                                            <?php if (empty($gig_view_data->keywords_msg)) { ?>
                                                <h3 class="text-success text-center">
                                                    <strong>The keywords you used are perfect for your gig.</strong>
                                                    <br><br>
                                                    <i class="fa fa-check-square-o fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-danger text-center"><strong>The keywords you used require improvement to increase your chance of ranking high.</strong></h3>
                                                <br>
                                                <p><strong>Please fix the following:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->keywords_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                            <div class="tab-pane" id="tab7">
                                            <?php if (empty($gig_view_data->additional_msg)) { ?>
                                                <h3 class="text-info text-center">
                                                    <strong>There is no additional information.</strong>
                                                    <br><br>
                                                    <i class="fa fa-info-circle fa-5x"></i>
                                                </h3>
                                            <?php } else { ?>
                                                <h3 class="text-info text-center"><strong>Additional information to improve your gig.</strong></h3>
                                                <br>
                                                <p><strong>Things you can do:</strong></p>
                                                <p>
                                                    <?= $gig_view_data->additional_msg; ?>
                                                </p>
                                            <?php    }?>
                                            </div>

                                        </div>

                                    </div>

                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </article>
                <article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="jarviswidget well" id="ga-gig-view-pre" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <div>
                            <div class="widget-body text-center">
                                <h3 style="margin: 0 0 10px;"><?= $gig_view_data->title; ?></h3>
                                <div class="ga-gig-view">
                                    <?= $gig_view_data->gig_img; ?>
                                </div>

                                <?php
                                if ($gig_view_data->status == "2") { ?>
                                <center id="resubmit-block">
                                    <hr>

                                    <h5>If you have made the necessary changes to your gig on fiverr you can re-submit it for revision.</h5>

                                    <div id="process-loader">
                                        <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                                    </div>
                                    <a href="#" id="resubmit-btn" class="btn btn-primary">Re-Submit for Revision</a>
                                </center>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </section>

    </div>

</div>

<script src="<?= base_url(); ?>assets/js/ajax.js"></script>
<script language='javascript' type="text/javascript">
    $("#resubmit-btn").click(function() {

        swal({
            title: "Re-submit This Gig?",
            text: "Please make sure you have made the necessary changes to your gig on fiverr before re-submitting it!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3276b1",
            confirmButtonText: "Yes - Re-submit",
            closeOnConfirm: false
        },
        function(){
            // send ajax data
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>tools/gig_analyzer/resubmit_gig',
                data: {"gig_id": <?= $gig_view_data->id; ?>}
            });

            //hide submit button
            $("#resubmit-block").fadeOut(700);

            // Show confirmation
            swal({
                title: "Submitted!",
                text: "Your gig was re-submitted successfully and is now pending revision.",
                type: "success",
                confirmButtonColor: "#3276b1",
                confirmButtonText: "Close"
            });
        });

    });
</script>