<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Resources
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <?php $this->load->view('extras/side_nav'); ?>
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
         <li>Resources</li>
      </ol>
   </div>

   <div id="content">
      <?php if ($resources_list == false) { ?>

      <section id="widget-grid" class="">
         <div class="jarviswidget" id="wdg-mb" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
            <header>
               <span class="widget-icon"> <i class="fa fa-briefcase"></i> </span>
               <h2>Resources</h2>
            </header>

            <div>
               <div class="widget-body">

                  <div class="page-error">
                     <i class="fa fa-laptop fa-5x text-primary"></i>
                     <br>
                     <h3 class="text-center">No resources are available at the moment!</h3>
                  </div>

               </div>
            </div>

         </div>
      </section>

      <?php } else { ?>
         <div class="row">
            <?php foreach ($resources_list as $item) { ?>
               <div class="col-md-6">
                  <div class="well">
                     <div class="row">
                        <div class="col-xs-12 col-md-3">
                           <center>
                              <img class="img-responsive" src="<?= base_url(); ?>uploads/resources-img/<?= $item['img_name']; ?>" alt="<?= $item['name']; ?>">
                           </center>
                        </div>
                        <div class="col-xs-12 col-md-9">
                           <h3 class="margin-top-0">
                              <?= $item['name']; ?>
                              <?php if ($item['price_before']) { ?>
                                 <span class="pull-right"><em class="text-muted">was</em> <span class="resources-price">$<?= $item['price_before']; ?></span></span>
                              <?php } ?>
                           </h3>
                           <p><?= $item['description']; ?></p>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-xs-12 col-md-6">
                           <?php if ($item['intro_video']) { ?>
                              <p>
                                 <a href="javascript:void(0)" data-toggle="modal" data-target="#res-modal" data-video="<?= $item['video']; ?>" data-name="<?= $item['name']; ?>" data-link="<?= $item['modal_link']; ?>"><i class="fa fa-video-camera"></i> Watch Intro Video</a>
                              </p>
                           <?php } ?>
                        </div>
                        <div class="col-xs-12 col-md-6 text-center">
                           <?= $item['link']; ?>
                        </div>
                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>

         <div class="text-center">
            <?= $pagination; ?>
         </div>
      <?php } ?>

   </div>
</div>


<!-- Modal -->
<div class="modal fade" id="res-modal" tabindex="-1" role="dialog" aria-labelledby="res-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
        <h4 class="modal-title" id="res-modalLabel"><!-- title will be loaded here --></h4>
      </div>
      <div class="modal-body">
         <div class="embed-responsive embed-responsive-16by9">
           <!--  video will be loaded here -->
         </div>
      </div>
      <div class="modal-footer">
         <!-- link will be loaded here -->
      </div>
    </div>
  </div>
</div> <!-- Modal ENDING -->

<script language='javascript' type="text/javascript">
   $('li#res-nav').addClass('active'); // make the current nav active

   // Stop the modal video when the modal is close
   jQuery('#res-modal').on('hidden.bs.modal', function (e) {
      jQuery('#res-modal iframe').attr("src", jQuery("#res-modal  iframe").attr("src"));
   });

   $('#res-modal').on('show.bs.modal', function (event) {
      var res_data = $(event.relatedTarget);
      var res_name = res_data.data('name');
      var res_video = res_data.data('video');
      var res_link = res_data.data('link');
      var modal = $(this);

      modal.find('.modal-title').html(res_name);
      modal.find('.modal-body .embed-responsive').html(res_video);
      modal.find('.modal-footer').html(res_link);
   })
</script>