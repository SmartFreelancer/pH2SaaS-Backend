<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/plugin/alertify/css/alertify.css"/>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/plugin/alertify/js/alertify.min.js"></script>

<body>

<div class="full-page">
   <div id="main" role="main">
      <div id="content">

         <section id="widget-grid" class="">
            <div class="jarviswidget" id="apc-ga-mod" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">
               <header>
                  <span class="widget-icon"> <i class="fa fa-rocket"></i> </span>
                  <h2><?= $current_lesson->title; ?></h2>
                  <div class="widget-toolbar" role="menu">
                     <a href="<?= base_url(); ?>academy/course/<?= $current_lesson->course_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-stop"></i> End Lesson</a>
                  </div>
               </header>
               <div>
                  <div id="academy-lesson" class="widget-body no-padding">

                     <div class="row">
                        <div class="col-md-9" style="padding-right: 0;">

                           <div style="height: 84vh; border-right: 1px solid #c2c2c2;">
                              <video id="vii" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="100%" height="100%">
                                 <source src="<?= $current_lesson->video; ?>" type='video/mp4' />
                                 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                              </video>
                           </div>

                        </div>
                        <div class="col-md-3" style="padding-left: 0;">

                           <div class="nav-justified" role="tabpanel">
                              <ul class="nav nav-tabs nav-justified" role="tablist">
                                 <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Description</a></li>
                                 <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Lessons</a></li>
                                 <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Downloads</a></li>
                              </ul>
                           </div>
                           <div class="tab-content">
                              <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                                 <h5><?= $current_lesson->title; ?></h5>
                                 <?= $current_lesson->description; ?>
                                 <br><br>
                                 <em class="font-sm"><i class="fa fa-calendar text-danger"></i> Date Created: <?= $current_lesson->date_added; ?></em>
                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="tab2">
                                 <div class="timeline-centered">
                                 <?php
                                 foreach ($lessons_list as $item) { ?>
                                    <article class="timeline-entry">
                                       <div class="timeline-entry-inner">
                                          <div class="timeline-icon bg-blank">
                                             <i class="entypo-feather"></i>
                                          </div>
                                          <div class="timeline-label">
                                             <a href="<?= base_url(); ?>academy/lesson/<?= $item['course_id']; ?>/<?= $item['lesson_id']; ?>">
                                                <h5 class="no-margin"><?= $item['title']; ?></h5>
                                                <p><?= $item['description']; ?></p>
                                             </a>
                                          </div>
                                       </div>
                                    </article>
                                 <?php } ?>
                                    <article class="timeline-entry">
                                       <div class="timeline-entry-inner">
                                          <div class="timeline-icon bg-end">
                                             <i class="entypo-feather"></i>
                                          </div>
                                          <div class="timeline-label">
                                             <h3 class="no-margin">End of course</h3>
                                          </div>
                                       </div>
                                    </article>
                                 </div>

                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="tab3">
                                 <?php if (empty($lessons_dloads)) { ?>
                                    <div class="text-center">
                                       <br><br>
                                       <i class="fa fa-download fa-5x text-primary"></i>
                                       <p>No downloads available for this lesson.</p>
                                    </div>
                                 <?php } else { ?>
                                    <div class="list-group">
                                    <?php foreach ($lessons_dloads as $item) { ?>
                                       <a href="<?= base_url(); ?>academy/download/<?= $item['dl_id']; ?>" class="list-group-item" target="_blank"><img src="<?= base_url(); ?>assets/img/<?= $item['extension']; ?>.png"> <?= $item['title']; ?></a>
                                    <?php } ?>
                                    </div>
                                 <?php } ?>

                              </div>
                           </div>

                        </div>
                     </div>

                     <div class="widget-footer">
                        <div class="row">

                           <div class="col-md-6 col-md-offset-6">
                              <?php if ($prev_lesson_id > 0) { ?>
                                 <a href="<?= base_url(); ?>academy/lesson/<?= $current_lesson->course_id; ?>/<?= $prev_lesson_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Previous Lesson</a>
                              <?php } ?>
                              <?php if ($next_lesson_id > 0) { ?>
                                 <a href="<?= base_url(); ?>academy/lesson/<?= $current_lesson->course_id; ?>/<?= $next_lesson_id; ?>" class="btn btn-primary btn-sm">Next Lesson <i class="fa fa-arrow-right"></i></a>
                              <?php } ?>
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

<link href="//vjs.zencdn.net/4.11/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.11/video.js"></script>
<script language='javascript' type="text/javascript">
   videojs("vii", {
         autoplay: true
      },
   function(){
      var myPlayer = this;
      var aspectRatio = 9/16;
      myPlayer.on("ended", function(){
         myPlayer.bigPlayButton.show();

         // Update the course tracking table
         $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>academy/lesson-tracking",
            data: {
               usid: <?= $user->id; ?>,
               lesson_id: <?= $current_lesson->lesson_id; ?>,
               status: 2
            }
         });

         var  is_nextlesson = <?= $next_lesson_id; ?>;
         var  is_lessonfeedback = <?= $lesson_feedback; ?>;
         if (is_nextlesson > 0) {
            // lesson ended alert the the user
            alertify.set({ labels: {
               ok     : "Yes Continue",
               cancel : "Deny",
               buttonFocus: "ok"
            } });
            alertify.confirm("<i class='fa fa-thumbs-o-up fa-5x'></i> <br><br> You have reach the end of this lesson. Do you want to continue to the next one?", function (e) {
               if (e) {
                  alertify.success("You are now viewing the next lesson in this course.");
                  // Redirect the user to the next course
                  window.location.href = "<?= base_url(); ?>academy/lesson/<?= $current_lesson->course_id; ?>/<?= $next_lesson_id; ?>";
               } else {
                  alertify.log("You have chosen to re-take this lesson.");
               }
            });
         } else {
            // No more lessons in this course
            if (is_lessonfeedback == 0) {
               // End the course and get feedback
               alertify.set({ labels: {
                  ok     : "Give Feedback",
                  cancel : "No Thanks",
                  buttonFocus: "ok"
               } });
               alertify.prompt("<center><i class='fa fa-graduation-cap fa-5x'></i></center><strong>Congratulations!!!</strong> you have successfully completed this course. <br><br> Please take the time out to provide us with a feedback.", function (e, str) {
                  if (e) {
                     //add feedback
                     $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>academy/lesson_feedback",
                        data: {
                           usid: <?= $user->id; ?>,
                           course_id: <?= $current_lesson->course_id; ?>,
                           feedback: str
                        },
                        success:function() {
                           alertify.success("Thanks for your feedback. It was added successfully.");
                           window.location.href = "<?= base_url(); ?>academy";
                        }
                     });
                  } else {
                     alertify.log("No feedback was given.");
                     window.location.href = "<?= base_url(); ?>academy";
                  }
               } );
            } else {
               // Feedback already given notify and redirect
               alertify.alert("<center><i class='fa fa-graduation-cap fa-5x'></i></center><strong>Congratulations!!!</strong> you have successfully completed this course. Now you can use what you have learned to boost your earnings.", function (e) {
                  if (e) {
                     window.location.href = "<?= base_url(); ?>academy";
                  }
               });
            }
         }
      });
      myPlayer.on("play", function() {
         myPlayer.bigPlayButton.hide();
      });

      function resizeVideoJS(){
         var width = document.getElementById(myPlayer.id).parentElement.offsetWidth;
            myPlayer.width(width).height( width * aspectRatio );
         }
      resizeVideoJS();
      window.onresize = resizeVideoJS;

   });
</script>