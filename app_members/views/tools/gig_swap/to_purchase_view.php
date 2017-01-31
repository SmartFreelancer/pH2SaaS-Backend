<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Gig Swap
         </span>
      </span>
   </div>

      <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Swap a Gig</span></a>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig-swap/to-purchase"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">To Purchase</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/swap-queue"><i class="fa fa-lg fa-fw fa-clock-o"></i> <span class="menu-item-parent">Swap Queue</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/swap-history"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Swap History</span></a>
         </li>
         <!-- <li>
            <a href="<?= base_url(); ?>tools/gig-swap/tool-training"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">Tool Training</a>
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
         <li><a href="<?= base_url(); ?>tools/gig-swap">Gig Swap</a></li>
         <li><a href="<?= base_url(); ?>tools/gig-swap/to-purchase">To Purchase</a></li>
         <li>View Purchase</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="wdg-gs-purchase-view" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-shopping-cart"></i> </span>
                     <h2>View Purchase</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <?php if ($gig_data->system_verified == 1 && $claim_data->system_verified == 1) { ?>
                        <div class="page-error text-center">
                           <br>
                           <i class="fa fa-trophy fa-5x text-primary"></i> <br>
                           <h3>Hurray!! This swap is completed and verified by both parties and also our system.</h3>
                        </div>
                        <?php } else { ?>

                           <h3 class="text-center no-margin"><?= $gig_data->gig_title; ?></h3>
                           <br>
                           <div class="row">
                              <div class="col-xs-12 col-md-5">
                                 <center class="gs-purchase-view">
                                    <?= $gig_data->gig_img; ?>
                                 </center>
                              </div>
                              <div class="col-xs-12 col-md-7">

                                 <h5>Gig Status:</h5>
                                 <?php if ($gig_data->purchase_status == 1 && $claim_data->purchase_status == 1) { ?>
                                    <div class="highlight text-center">
                                       <br>
                                       <i class="fa fa-shield fa-5x text-muted"></i> <br>
                                       <p>Both parties made a purchase waiting on the final system verification.</p>
                                    </div>
                                       <?php if ($gig_data->system_verified == 1) { ?>
                                          <p><span class="label label-success" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> Your purchase was verified.</span></p>
                                          <p><span class="label label-warning" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Waiting on the other person purchase to be verified.</span></p>
                                       <?php } else if ($claim_data->system_verified == 1) { ?>
                                          <p><span class="label label-success" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> The other person purchase was verified.</span></p>
                                          <p><span class="label label-danger" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Waiting on your purchase to be verified.</span></p>
                                       <?php }?>
                                 <?php } else { ?>

                                    <p>
                                    <?php if ($gig_data->purchase_status == 0) { ?>
                                       <span class="label label-danger" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Waiting on you to make a purchase. </span>
                                    <?php } else { ?>
                                       <span class="label label-info" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> You have made a purchase. </span>
                                    <?php } ?>
                                    </p>
                                    <p>
                                    <?php if ($claim_data->purchase_status == 0) { ?>
                                       <span class="label label-warning" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Waiting on the other person to make a purchase. </span>
                                       <?php if ($gig_data->date_swapped < strtotime('-3 days')) { ?>
                                          <p class="highlight">
                                             it has passed <em>3 days</em> and our system did not detect a purchase from the other person. You can escalate this gig if you need any help from support to have the issue resolved. <br>
                                             <strong>Swap ID: <?= $claim_data->swap_id; ?> </strong>
                                             <br>
                                             <center><a href="<?= base_url(); ?>support" target="_blank" class="btn btn-danger btn-sm">Escalate Gig</a></center>
                                          </p>
                                       <?php } ?>
                                    <?php } else { ?>
                                       <span class="label label-info" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> The other person made a purchase. </span>
                                    <?php } ?>
                                    </p>
                                 <?php } ?>

                                 <?php if ($gig_data->purchase_status == 0) { ?>
                                    <br>
                                    <center>
                                       <h4>Did you purchase this gig?</h4>
                                       <div id="process-loader">
                                          <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                                       </div>
                                       <button id="update-purchase" class="btn btn-success">Yes - Gig Purchased</button>
                                    </center>
                                 <?php } ?>

                              </div>


                           </div>
                           <br>
                           <h5>Notes from the swapper:</h5>
                           <p>
                              <?php if (empty($gig_data->additional_msg)) {
                                 echo "<em>No notes from the swapper.</em>";
                              } else {
                                 echo "<em>".$gig_data->additional_msg."</em>";
                              } ?>
                           </p>
                           <br>
                           <center>
                              <small><strong>NB:</strong> We recommend that you always try to complete the task for all gigs that are purchased.</small>
                           </center>

                        <?php } ?>

                     </div>
                  </div>

               </div>
            </article>

            <div class="col-md-4">

               <div class="jarviswidget well">
                  <div>
                     <div class="widget-body">
                        <?php if ($gig_data->system_verified == 1 && $claim_data->system_verified == 1) { ?>
                           <center class="gs-purchase-view">
                           <h5><?= $gig_data->gig_title; ?></h5>
                              <?= $gig_data->gig_img; ?>
                           </center>
                        <?php } else { ?>
                           <h5><strong><em>What to do?</em></strong></h5>
                           <p>
                              <em>Step 1:</em> First purchase the gig on fiverr by clicking on the purchase button below.
                           </p>
                           <p>
                              <em>Step 2:</em> Click on the "Yes - Gig Purchase" button to confirm your purchase.
                           </p>
                           <hr class="dashed">
                           <div class="text-center">
                              <?php if ($gig_data->purchase_status == 0) { ?>
                                 <i class="fa fa-cart-plus fa-5x text-primary"></i>
                                 <br>
                                 <a href="<?= $gig_data->gig_url; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-external-link"></i> Click here to purchase this gig</a>
                              <?php } else { ?>
                                 <i class="fa fa-check-square-o fa-4x text-success"></i> <br>
                                 <h5>You have marked this gig as purchased.</h5>
                              <?php } ?>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>

            </div>

         </div>

      </section>

   </div>
</div>


<script src="<?= base_url(); ?>assets/js/ajax.js"></script>
<script language='javascript' type="text/javascript">
$("#update-purchase").click(function() {

   swal({
      title: "Did you purchase this gig?",
      text: "Only confirm if you actually purchase this gig on fiverr. Once you mark it as purchase it cannot be undone",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3276b1",
      confirmButtonText: "Yes - Confirm!",
      closeOnConfirm: false
   },
   function(){
      $.ajax({
         type: "POST",
         url: '<?= base_url(); ?>tools/gig-swap/update-claim',
         data: {"purchase_status": 1, "gig_swap_id": <?= $gig_data->swap_id; ?>},

         beforeSend: function(){
            $('#process-loader').show();
         },
         success:function(response) {
            swal({
               title: "The gig status has been updated successfully.",
               type: "success",
              confirmButtonColor: "#3276b1"
            },
            function(){
               window.location='<?= base_url(); ?>tools/gig-swap/to-purchase-view/<?= $gig_data->swap_id; ?>/<?= $claim_data->swap_id; ?>';
            });
         },
         complete: function(){
            $('#process-loader').hide();
         }
      });
   });

});
</script>