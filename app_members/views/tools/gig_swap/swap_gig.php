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
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig-swap"><i class="fa fa-lg fa-fw fa-exchange"></i> <span class="menu-item-parent">Swap a Gig</span></a>
         </li>
         <li>
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
         <li>Swap a Gig</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="wdg-gs-submit-gig" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-exchange"></i> </span>
                     <h2>Swap a Gig</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <form id="process-form">

                           <fieldset>
                              <legend>
                                 <center>
                                 <h3>Swapping Your Gig</h3>
                                 <p>
                                    We recommend that you always try to complete the task for all gigs that are purchased.
                                 </p>
                                 </center>
                              </legend>
                              <div id="confirm-gig"></div>
                              <div id="form-div" class="row">
                                 <div class="col-xs-10 col-xs-offset-1">

                                    <div id="process-msg" role="alert" style="display:none">
                                       <button type="button" class="close"><i class="fa fa-times"></i></button>
                                       <strong></strong>
                                    </div>

                                    <div class="form-group">
                                       <label for="gig_url">Gig URL</label>
                                       <input type="text" class="form-control" id="gig_url" name="gig_url" placeholder="Your fiverr gig url">
                                    </div>

                                    <div class="form-group">
                                       <label for="additional_msg">Additional Information (optional)</label>
                                       <textarea class="form-control" id="additional_msg" name="additional_msg" placeholder="Additional information you would like to provide the swapper with." rows="2"></textarea>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>

                           <div class="form-actions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <button id="submit_btn" class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit Gig</button>
                                    <span id="process-loader">
                                       <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                                    </span>
                                 </div>
                              </div>
                           </div>

                        </form>

                     </div>
                  </div>

               </div>
            </article>

            <span class="hidden-xs hidden-sm">
               <div class="col-md-4">

                  <div class="jarviswidget well">
                     <div>
                        <div class="widget-body">
                           <h5><strong><em>How to swap your gig?</em></strong></h5>
                           <p>Not sure how to submit your gig for swapping? see the tool training section <a href="<?= base_url(); ?>tools/gig-swap/tool-training">Tool Training</a>.</p>
                           <center>
                              <img class="img-responsive" src="<?= base_url(); ?>assets/img/gif-animation/gig-swap-submit.gif">
                           </center>
                        </div>
                     </div>
                  </div>

               </div>
            </span>

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
            gig_url: {
               validators: {
                  notEmpty: {
                     message: 'Your fiverr gig URL is required.'
                  },
                  uri: {
                     message: 'The URL you have entered is invalid.'
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
         $.ajax({
            url : '<?= base_url(); ?>tools/gig-swap/swap-gig-process',
            type: "POST",
            data : dataString,

            beforeSend: function(){
               $('#process-loader').fadeIn('slow');
            },
            success:function(response) {
               var oRtn = eval('('+response+')');
               displayMessage('process-msg', oRtn.message, oRtn.success);
               if (oRtn.success == true) {
                  setTimeout(function(){
                  window.location='<?= base_url(); ?>tools/gig-swap/swap-queue';
                  }, 3000);
               }
            },
            complete: function(){
               $('#process-loader').fadeOut('slow');
            }
         });

      });

   });
</script>