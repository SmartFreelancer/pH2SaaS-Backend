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
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/to-purchase"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">To Purchase</span></a>
         </li>
         <li>
            <a href="<?= base_url(); ?>tools/gig-swap/swap-queue"><i class="fa fa-lg fa-fw fa-clock-o"></i> <span class="menu-item-parent">Swap Queue</span></a>
         </li>
         <li class="active">
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
         <li><a href="<?= base_url(); ?>tools/gig-swap/swap-history">Swap History</a></li>
         <li>Swap History View</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8 col-md-offset-2">

               <div class="jarviswidget" id="wdg-gs-purchase-view" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-shopping-cart"></i> </span>
                     <h2>Swap History (view gig)</h2>
                  </header>
                  <div>
                     <div class="widget-body">


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

                                 <?php if ($gig_data->system_verified == 1 && $claim_data->system_verified == 1) { ?>
                                 <div class="page-error text-center">
                                    <br>
                                    <i class="fa fa-trophy fa-5x text-primary"></i> <br>
                                    <h3>Hurray!! This swap is completed and verified by both parties and also our system.</h3>
                                 </div>
                                 <?php } else { ?>


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
                                    <?php if ($claim_data->purchase_status == 1) { ?>
                                       <span class="label label-sucess" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> The other person purchased your gig.</span>
                                    <?php } ?>
                                    </p>

                                 <?php } ?>

                              </div>


                           </div>

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