<body>

<div class="full-page">
    <div id="main" role="main">
        <div id="content">

            <section id="widget-grid" class="">
                <div class="jarviswidget" id="apc-ga-rs-mod" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-rocket"></i> </span>
                        <h2>Gig Moderation</h2>
                        <div class="widget-toolbar" role="menu">
                            <button id="mod-close-btn" class="btn btn-danger" href="javascript:void(0);">Close Moderation</button>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">

                            <div class="row">
                                <div class="col-md-6" style="padding-right: 0;">

                                    <div style="height: 84vh; border-right: 1px solid #c2c2c2;">
                                        <iframe src="<?= base_url(); ?>admin/gig-analyzer/gig-frame/<?= $gig_data->id; ?>" width="100%" height="100%" style="border:none"></iframe>
                                    </div>

                                </div>
                                <div class="col-md-3" style="padding-left: 0; padding-right: 0px; border-right: 1px solid #ddd;">

                                    <div id="accordion-1" class="panel-group smart-accordion-default">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="" href="#collapse_rs_1" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="true">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Gig Title Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_1" class="panel-collapse collapse in" aria-expanded="true" style="">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->title_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_2" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Gig Category Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->category_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_3" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Gig Image Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->img_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_4" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Gig Video Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->vid_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_5" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Gig Description Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->desc_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_6" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Keywords Message (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->keywords_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" href="#collapse_rs_7" data-parent="#accordion-1" data-toggle="collapse" aria-expanded="false">
                                                        <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                        <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                        Additional Info (before)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_rs_7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                <div class="panel-body no-padding mod-textarea">
                                                    <textarea rows="5" readonly><?= $gig_data->additional_msg; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-3" style="padding-left: 0;">

                                    <form id="process-form">
                                        <input type="hidden" value="<?= $gig_data->id; ?>" name="gig_id">
                                        <input type="hidden" value="2" name="mod_status">
                                        <input type="hidden" value="2" name="status">
                                        <div id="accordion-2" class="panel-group smart-accordion-default">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="" href="#collapse1" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="true">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                                Gig Title
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse in" aria-expanded="true" style="">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_title_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse2" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Gig Category
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_category_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse3" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Gig Image
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_img_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse4" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Gig Video
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_video_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse5" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Gig Description
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_desc_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse6" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Keywords
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_keywords_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="collapsed" href="#collapse7" data-parent="#accordion-2" data-toggle="collapse" aria-expanded="false">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                                                            Additional Info
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body no-padding mod-textarea">
                                                        <textarea rows="5" name="gig_addinfo_msg"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>

                                    <div class="padding-10">
                                        <strong>Gig Keyword:</strong> <?= $gig_data->keyword; ?>
                                    </div>

                                </div>
                            </div>

                            <div class="widget-footer">
                                <div class="row">

                                    <div class="col-md-6 text-left">
                                        <button id="mod-perfect-btn" class="btn btn-sm btn-success"><i class="fa fa-check-square-o"></i> Just Perfect</button>
                                        <button id="mod-skip-btn" class="btn btn-sm btn-warning"><i class="fa fa-exchange"></i> Skip Gig</button>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <button id="mod-submit-btn" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Submit Modification</button>
                                     <span id="process-loader">
                                 <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                              </span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('textarea').focus(function(){
            $('.mod-textarea').addClass('active');
        });

        $("textarea").focusout(function() {
            $('.mod-textarea').removeClass('active');
        })

      var next_gig_id = <?= $next_gig; ?>;

        // submit moderation
      $('#mod-submit-btn').click(function() {
          var dataString = $("#process-form").serialize();
          $.ajax({
             url : '<?= base_url(); ?>admin/gig-analyzer/mod_submit',
             type: "POST",
             data : dataString,
             beforeSend: function(){
                $('#process-loader').show();
             },
             success:function() {
                    swal({
                        title: "Gig Moderated Successfully!",
                        text: "Please Wait 2 Seconds... The next gig will be loaded shortly.",
                        timer: 2000,
                        type: "success",
                        showConfirmButton: false
                    });
                    window.location.href = "<?= base_url(); ?>admin/gig-analyzer/resubmit_mod/"+next_gig_id+"";
             },
             complete: function(){
                 $('#process-loader').hide();
             }
          });
       });

        // Just perfect gig
        $('#mod-perfect-btn').click(function() {
            swal({
                title: "Are you sure?",
                text: "Do you want to mark this gig as perfect without recommending any additional notes?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Yes - Its Perfect",
                closeOnConfirm: false
            },
            function(){
                swal({
                    title: "Gig Mark as Perfect!",
                    text: "Please Wait... The next gig will be loaded shortly.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                })

                // send ajax request
                $.ajax({
                 url : '<?= base_url(); ?>admin/gig-analyzer/mod_submit',
                 type: "POST",
                 data : {
                        mod_status: 2,
                     status: 1,
                     gig_id: <?= $gig_data->id; ?>
                 },
                 success:function() {
                     window.location.href = "<?= base_url(); ?>admin/gig-analyzer/resubmit_mod/"+next_gig_id+"";
                    }
             });
            });

        });

        // skip gig
        $('#mod-skip-btn').click(function() {
            swal({
                title: "Skip This Gig?",
                text: "Are you sure you want to skip this gig without moderating it?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Yes - Skip It",
                closeOnConfirm: false
            },
            function(){
                swal({
                    title: "Gig Skipped!",
                    text: "Please Wait... The next gig will be loaded shortly.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                })
                window.location.href = "<?= base_url(); ?>admin/gig-analyzer/resubmit_mod/"+next_gig_id+"";
            });
        });

        // close gig
        $('#mod-close-btn').click(function() {
            swal({
                title: "End Moderation?",
                text: "Are you sure you want to end moderation? the current gig your working on now will not be moderated.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#337ab7",
                confirmButtonText: "Yes - End It",
                closeOnConfirm: false
            },
            function(){
                swal({
                    title: "Moderation Ended!",
                    text: "Please Wait... You will be taken to the Admin Cpanel.",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                })
                window.location.href = "<?= base_url(); ?>admin/gig-analyzer/resubmitted_gigs";
            });
        });

    })
</script>