<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Academy
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li>
            <a href="<?= base_url(); ?>academy"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">All Courses</a>
         </li>
         <li>
            <a href="<?= base_url(); ?>academy"><i class="fa fa-lg fa-fw fa fa-user-secret"></i> <span class="menu-item-parent">My Courses</a>
         </li>
         <?php $this->load->view('quick_links'); ?>
      </ul>
   </nav>

   <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
   </span>

</aside>

<span id="page-bg">
   <div id="main" role="main">
      <div id="ribbon">
         <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?= base_url(); ?>academy">Academy</a></li>
            <li>Courses</li>
         </ol>
      </div>

      <div id="content" class="academy">

         <div class="row">
            <div class="col-md-9">

               <div class="padding-10">

               <a href="<?= base_url(); ?>academy/lesson/<?= $start_course->course_id; ?>/<?= $start_course->lesson_id; ?>" class="btn btn-warning btn-lg pull-right" style="text-transform: uppercase;">Take this Course</a>

                  <h3 class="no-margin"><?= $course->name; ?></h3>
                  <p><em><i class="fa fa-calendar text-danger"></i> Date Created: <?= $course->date_added; ?></em></p>

                     <div style="border: 1px dashed #ddd; padding: 10px; margin: 20px 0;">
                     <h2 class="text-primary text-center" style="font-weight: 800;">Course Description</h2>
                      <p>
                         <?= $course->description; ?>
                      </p>
                    </div>
               </div>

               <?php if ($course->course_access == FALSE) { ?>
                  <div class="alert alert-warning alert-block" role="alert">
                  <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Please Note!</h4>
                  You do not have any access to view this course, please consider upgrading your account to have full access to all the tools and courses that are available.
                  </div>
               <?php } ?>

               <section id="widget-grid" class="">

                  <div class="jarviswidget" id="wdj-course-list" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                     <header>
                        <span class="widget-icon"><i class="fa fa-graduation-cap text-muted"></i> </span>
                        <h2>Course Lessons</h2>
                     </header>
                     <div>
                        <div class="widget-body">

                           <?php if ($lessons_list == false) { ?>

                              <div class="page-error">
                                 <i class="fa fa-laptop text-primary"></i>
                                 <h3>No lessons are available for this course at the moment!</h3>
                              </div>

                           <?php } else { ?>

                              <div class="timeline-centered">
                                 <?php foreach ($lessons_list as $item) { ?>
                                    <article class="timeline-entry">
                                       <div class="timeline-entry-inner">
                                          <div class="timeline-icon bg-blank">
                                             <i class="entypo-feather"></i>
                                          </div>
                                          <div class="timeline-label">
                                             <?php if ($course->course_access == FALSE) { ?>
                                                <a href="#" data-toggle="modal" data-target="#courseModal">
                                             <?php } else { ?>
                                                <a href="<?= base_url(); ?>academy/lesson/<?= $item['course_id']; ?>/<?= $item['lesson_id']; ?>">
                                             <?php } ?>
                                                <h5><?= $item['title']; ?>
                                                <?php if ($course->course_access == FALSE) { ?>
                                                <span class="pull-right"><i class="fa fa-lock text-muted"></i></span>
                                                <?php } ?>
                                                </h5>
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

                           <?php } ?>


                        </div>
                     </div>
                  </div>

               </section>

            </div>
            <div class="col-md-3" id="course-list">
             <?php
                $course_author = $this->ion_auth->user($course->course_author)->row();
             ?>
            <img style="margin-right: 20px;" class="pull-left img-circle" width="60px" src="<?= base_url(); ?>uploads/avatar/<?= $course_author->avatar; ?>" alt="<?= $course_author->username; ?>">
            <h3 style="margin: 0;">Course By:</h3>
            <h4><em> <?= $course_author->username; ?> </em></h4>
                <br><br>

               <div class="thumbnail">
                  <img src="<?= base_url(); ?>uploads/academy/course-img/<?= $course->img_name; ?>" alt="course">
                  <div class="caption">
                     <?= $course->name; ?>
                     <hr class="dashed">
                     <div class="text-center">
                        <div class="progress">
                           <div class="progress-bar" role="progressbar" aria-valuenow="<?= $course->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $course->progress; ?>%;">
                              <?= $course->progress; ?>% Completed
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>

      </div>
   </div>
</span>


<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Course Restricted</h4>
      </div>
      <div class="modal-body">

         <div class="upgrade-msg text-center">
            <i class="fa fa-laptop fa-5x text-primary"></i>
            <h3>You do not have permission to access this course.</h3>
            <h5>
               You currently have a <strong>Silver Membership Account</strong> this only gives you limited access to courses. Please consider upgrading your account to have full membership access to all the courses that are here.
            </h5>
         </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Upgrade Your Account</button>
      </div>
    </div>
  </div>
</div>