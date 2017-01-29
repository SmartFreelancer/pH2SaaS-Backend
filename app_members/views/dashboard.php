<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Dashboard
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>
            <li>
                <a href="<?= base_url(); ?>account"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Manage Account</span></a>
            </li>
            <li>
                <a href="<?= base_url(); ?>tools"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Tools</span></a>
            </li>
            <li>
                <a href="<?= base_url(); ?>academy"><i class="fa fa-lg fa-fw fa-university"></i> <span class="menu-item-parent">Academy</span></a>
            </li>
            <li>
                <a href="<?= base_url(); ?>community"><i class="fa fa-lg fa-fw fa-comments-o"></i> <span class="menu-item-parent">Community</span></a>
            </li><!--
            <li>
                <a href="<?= base_url(); ?>support"><i class="fa fa-lg fa-fw fa fa-support"></i> <span class="menu-item-parent">Help & Support</a>
            </li> -->
            <?php $this->load->view('quick_links'); ?>
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>

<div id="main" role="main">

    <div id="content">

        <!-- <div class="well">
            <h1>
                <span class="semi-bold">News</span>
                <i class="ultra-light">and</i>
                <span class="semi-bold">Announcements</span>
                <sup class="badge bg-color-orange">New!</sup>
                <br><br>
                <small class="txt-color-red">
                    <strong>Booster Launch Date.</strong>
                </small>
            </h1>
            <p>
                Boosterr is launching on <strong>April 6, 2015</strong> by all means. If you sell services on Fiverr, you have come to the right place. Here, you will find all the cool tools that you need to track and optimize your gigs for maximum visibility, which in turn will help to increase your sales.
            </p>
        </div> --> <br>

        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="jarviswidget jarviswidget-color-blue" id="db-new-tools" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-wrench"></i> </span>
                            <h2>New Tools</h2>
                        </header>
                        <div>
                            <div id="intro-gigs" class="widget-body">

                                <div class="row">
                                    <?php
                                    foreach ($new_tools as $item) { ?>
                                        <div class="col-xs-6 col-sm-4 col-md-4">
                                            <a class="thumbnail" href="<?= base_url(); ?><?= $item['url_segment']; ?>">
                                                <img alt="Tool" src="<?= base_url(); ?>assets/img/tools/<?= $item['image']; ?>">
                                                <div class="caption text-center">
                                                    <h5><?= $item['name']; ?></h5>
                                                </div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="widget-footer">
                                    <a href="<?= base_url(); ?>tools" class="btn btn-primary btn-sm">View All</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>
                <article class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="jarviswidget jarviswidget-color-teal" id="db-latest-course" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-university"></i> </span>
                            <h2>Latest Courses</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                                <div id="course-intro" class="row">
                                    <?php foreach ($course_list as $item) { ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?= base_url(); ?>academy/course/<?= $item['course_id']; ?>">
                                                        <img class="media-object" src="<?= base_url(); ?>uploads/academy/course-img/<?= $item['img_name']; ?>" alt="course" width="60px">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a href="<?= base_url(); ?>academy/course/<?= $item['course_id']; ?>"><h5 class="media-heading"><?= $item['name']; ?></h5></a>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="widget-footer">
                                    <a href="<?= base_url(); ?>academy" class="btn btn-primary btn-sm">View All</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </article>
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-purple" id="db-community" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-comments-o"></i> </span>
                            <h2>Word From The Community</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                                <div class="row">
                                    <div class="col-md-4">

                                        <h5 class="text-center margin-top-0"><i class="fa fa-comment-o text-muted"></i> Latest Question</h5>
                                        <hr class="dashed">
                                        <?php if (empty($latest_posts)) { ?>
                                            <p class="text-center">No latest posts at the moment.</p>
                                        <?php } else { ?>
                                            <ul class="no-padding list-unstyled">
                                                <?php foreach ($latest_posts as $item) { ?>
                                                    <li style="margin-bottom: 15px">
                                                        <img class="img-circle" src="<?= base_url(); ?>uploads/avatar/<?= $item['author_avatar']; ?>" width="30px" height="30px">
                                                        <a href="<?= base_url(); ?>community/question/<?= $item['question_id']; ?>"><?= character_limiter($item['title'], 30); ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </div>
                                    <div class="col-md-4">

                                        <h5 class="text-center margin-top-0"><i class="fa fa-star-o text-muted"></i> Most Popular Question</h5>
                                        <hr class="dashed">
                                        <?php if (empty($popular_questions)) { ?>
                                            <p class="text-center">No popular questions at the moment.</p>
                                        <?php } else { ?>
                                            <ul class="no-padding list-unstyled">
                                                <?php foreach ($popular_questions as $item) { ?>
                                                    <li style="margin-bottom: 15px">
                                                        <img class="img-circle" src="<?= base_url(); ?>uploads/avatar/<?= $item['author_avatar']; ?>" width="30px" height="30px">
                                                        <a href="<?= base_url(); ?>community/question/<?= $item['question_id']; ?>"> <?= character_limiter($item['title'], 30); ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                    </div>
                                    <div class="col-md-4" style="background: #fbfbfb; border-right: 1px solid #ccc; border-left: 1px solid #ccc; margin-top: -13px; margin-bottom: -13px; padding-bottom: 12px;">

                                        <form id="process-form">
                                            <h5 class="text-center margin-top-0 padding-top-10"><i class="fa fa-users text-muted"></i> Ask the Community</h5>
                                            <br>
                                            <div id="process-msg" role="alert" style="display:none">
                                           <button type="button" class="close"><i class="fa fa-times"></i></button>
                                           <strong></strong>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Question Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select class="form-control" name="category" id="category">
                                                            <option value="">Please Select</option>
                                                            <?php foreach ($category_list as $item) { ?>
                                                                <option value="<?= $item['cat_id']; ?>"><?= $item['title']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="msg" id="msg" placeholder="What would you like to know or need help with?" rows="5"></textarea>
                                            </div>

                                            <center class="padding-bottom-10">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Post Question</button>
                                                <span id="process-loader">
                                                    <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                                                </span>
                                            </center>
                                        </form>

                                    </div>
                                </div>

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
   $(document).ready(function() {
      // validate form input
      $('#process-form').formValidation({
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
            title: {
               validators: {
                  notEmpty: {
                     message: 'The title is required.'
                  },
                  regexp: {
                     regexp: /^[a-zA-Z0-9?!-\s]+$/,
                     message: 'The title field can only consist of alpha numeric characters.'
                  },
                  stringLength: {
                     max: 80,
                     message: 'The title field must be less than 80 characters.'
                  }
               }
            },
            category: {
               validators: {
                  notEmpty: {
                     message: 'Please select a category.'
                  }
               }
            },
            msg: {
               validators: {
                  notEmpty: {
                     message: 'The message content field is required'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();

         clearMessage();
         var dataString = $("#process-form").serialize();
            var get_cat_data = document.getElementById("category");
            var submit_cat_id = get_cat_data.options[get_cat_data.selectedIndex].value;

         $.ajax({
            url : '<?= base_url(); ?>community/submit-question',
            type: "POST",
            data : dataString,

            beforeSend: function(){
               $('#process-loader').show();
            },
            success:function(response) {
               var oRtn = eval('('+response+')');
               displayMessage('process-msg', oRtn.message, oRtn.success);
              if (oRtn.success == true) {
                  setTimeout(function(){
                     window.location='<?= base_url(); ?>community/category/'+submit_cat_id+'';
                  }, 1500);
               }
            },
            complete: function(){
               $('#process-loader').hide();
            }
         });

      });
   });
</script>