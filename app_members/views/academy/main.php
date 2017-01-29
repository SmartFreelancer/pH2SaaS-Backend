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
         <li class="active">
            <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">All Courses</a>
         </li>
         <li>
            <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><i class="fa fa-lg fa-fw fa fa-user-secret"></i> <span class="menu-item-parent">My Courses</a>
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
         <li>Academy</li>
      </ol>
   </div>

   <div id="content" class="academy">

      <div id="course-list" role="tabpanel">
         <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active" id="tab1">
               <div class="row">
                  <?php foreach ($course_list as $item) { ?>
                     <div class="col-sm-4 col-md-3">
                        <a href="<?= base_url(); ?>academy/course/<?= $item['course_id']; ?>" class="thumbnail">
                           <img src="<?= base_url(); ?>uploads/academy/course-img/<?= $item['img_name']; ?>" alt="course">
                           <div class="caption">
                              <?= $item['name']; ?>
                              <hr class="dashed">
                              <div class="row">
                                 <div class="col-xs-4">
                                    Lessons<br>
                                    <span class="label label-primary"><?= $item['total_lessons']; ?></span>
                                 </div>
                                 <div class="col-xs-8">
                                 <?php
                                    $course_author = $this->ion_auth->user($item['course_author'])->row();
                                 ?>
                                 <img style="margin-right: 10px;" class="pull-left img-circle" width="40px" src="<?= base_url(); ?>uploads/avatar/<?= $course_author->avatar; ?>" alt="<?= $course_author->username; ?>">
                                 Course By:<br>
                                <em> <?= $course_author->username; ?> </em>
                                 </div>
                              </div>
                              <div class="text-center">
                                 <div class="progress progress-sm">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $item['progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $item['progress']; ?>%;">
                                       <?= $item['progress']; ?>% Completed
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  <?php } ?>
               </div>

               <div class="text-center">
                  <?= $all_course_pagin; ?>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab2">

               <div class="row">
                  <?php foreach ($user_course_list as $item) { ?>
                     <div class="col-sm-4 col-md-3">
                        <a href="<?= base_url(); ?>academy/course/<?= $item['course_id']; ?>" class="thumbnail">
                           <img src="<?= base_url(); ?>uploads/academy/course-img/<?= $item['img_name']; ?>" alt="course">
                           <div class="caption">
                              <?= $item['name']; ?>
                              <hr class="dashed">
                              <div class="row">
                                 <div class="col-xs-4">
                                    Lessons<br>
                                    <span class="label label-primary"><?= $item['total_lessons']; ?></span>
                                 </div>
                                 <div class="col-xs-8 text-right">
                                    <?= $item['privilege']; ?>
                                 </div>
                              </div>
                              <div class="text-center">
                                 <div class="progress progress-sm">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $item['progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $item['progress']; ?>%;">
                                       <?= $item['progress']; ?>% Completed
                                    </div>
                                 </div>
                              </div>
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