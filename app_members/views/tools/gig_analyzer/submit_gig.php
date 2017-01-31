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
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig_analyzer/submit_gig"><i class="fa fa-lg fa-fw fa-magic"></i> <span class="menu-item-parent">Submit a Gig</span></a>
         </li>
         <li>
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
         <li>Submit a Gig</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="ga-submit-gig" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-newspaper-o"></i> </span>
                     <h2>Gig Analyzer</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <form id="process-form">

                           <fieldset>
                              <legend>
                                 <center>
                                 <h3>Submit Your Gig</h3>
                                 <p>
                                    It normally takes up to 72 hours for our team to fully analyze your gig and provide you with feedback on how you can improve it, so that you stand a better chance to make more sales.
                                 </p>
                                 </center>
                              </legend>

                              <div class="row">
                                 <div class="col-xs-10 col-xs-offset-1">

                                    <div id="process-msg" role="alert" style="display:none">
                                       <button type="button" class="close"><i class="fa fa-times"></i></button>
                                       <strong></strong>
                                    </div>

                                    <div class="form-group">
                                       <label>Fiverr Gig URL</label>
                                       <input type="text" name="user_gig" id="user_gig" class="form-control" placeholder="Enter the link to your gig on fiverr">
                                    </div>

                                    <div class="form-group">
                                       <label>Main Keyword</label>
                                       <input type="text" name="keyword" id="keyword" class="form-control" placeholder="What is the keyword you want to rank for?">
                                    </div>
                                 </div>
                              </div>
                           </fieldset>

                           <div class="form-actions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <button id="submit_btn" class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit Your Gig</button>
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

                  <div class="jarviswidget well" id="ga-submit-info" data-widget-editbutton="false" data-widget-deletebutton="false">
                     <div>
                        <div class="widget-body">
                           <h5><strong><em>Submitting your Gig</em></strong></h5>
                           <p>Not sure how to submit your gig? see the tool training section <a href="<?= base_url(); ?>tools/gig_analyzer/tool_training">Tool Training</a>.</p>
                           <center>
                              <img class="img-responsive" src="<?= base_url(); ?>assets/img/gif-animation/gig-analyzer-submit-gig.gif">
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
            user_gig: {
               validators: {
                  notEmpty: {
                     message: 'Your fiverr gig URL is required'
                  },
                  uri: {
                     message: 'The URL you have entered is invalid'
                  }
               }
            },
            keyword: {
               validators: {
                  notEmpty: {
                     message: 'Your main keyword is required.'
                  },
                  regexp: {
                     regexp: /^[a-zA-Z\s]+$/,
                     message: 'The keyword field can only consist of alphabetical characters.'
                  },
                  stringLength: {
                     max: 30,
                     message: 'The Keyword field must be less than 30 characters'
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
            url : '<?= base_url(); ?>tools/gig_analyzer/submit_gig_process',
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
                     window.location='<?= base_url(); ?>tools/gig_analyzer/submitted_gigs';
                  }, 2000);
               }
            },
            complete: function(){
               $('#process-loader').hide();
            }
         });

      });
   });
</script>