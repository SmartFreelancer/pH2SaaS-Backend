<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Keyword Gen...
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/keyword_generator"><i class="fa fa-lg fa-fw fa-key"></i> <span class="menu-item-parent">Keyword Generator</span></a>
         </li>
         <!--<li>
            <a href="<?= base_url(); ?>tools/keyword_generator/tool_training"><i class="fa fa-lg fa-fw fa fa-graduation-cap"></i> <span class="menu-item-parent">Tool Training</a>
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
         <li>Keyword Generator</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="ga-submit-gig" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                     <h2>Keyword Generator</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <form id="process-form">

                           <fieldset>
                              <legend>
                                 <center>
                                 <p>
                                    Optimize your Gigs by getting keywords suggestion to improve your ranking within Fiverr search. Enter a keyword phrase one per line.
                                 </p>
                                 </center>
                              </legend>

                              <div class="row">
                                 <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                       <textarea class="form-control" name="keywords" id="keywords" rows="2"></textarea>
                                    </div>
                                 </div>
                              </div>
                           </fieldset>

                           <div id="process_data_status"></div>

                           <div class="form-actions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <button id="submit_btn" class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Get Keywords</button>
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

                  <article class="jarviswidget well" id="ga-submit-info" data-widget-editbutton="false" data-widget-deletebutton="false">
                     <div>
                        <div class="widget-body">
                           <h5><strong><em>Getting Keywords</em></strong></h5>
                           <p>Not sure how to use the keyword tool? see the tool training section <a href="<?= base_url(); ?>tools/keyword_generator/tool_training">Tool Training</a>.</p>
                           <center>
                              <img class="img-responsive" src="<?= base_url(); ?>assets/img/gif-animation/keyword-generator.gif">
                           </center>
                        </div>
                     </div>
                  </article>

               </div>
            </span>

         </div>

      </section>

   </div>
</div>


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
            keywords: {
               validators: {
                  notEmpty: {
                     message: 'Please enter one or more keywords/key phrase.'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();
         $("#submit_btn").removeAttr("disabled"); // enable submit button
         $("#submit_btn").removeClass("disabled"); // enable submit button

         var dataString = $("#process-form").serialize();
         $.ajax({
            url : '<?= base_url(); ?>tools/keyword-generator/process-data',
            type: "POST",
            data : dataString,

            beforeSend: function(){
               $('#process-loader').fadeIn('slow');
               $('#process_data_status').fadeOut(700);
            },
            success:function(response) {
               $('#process_data_status').fadeIn(700);
               $('#process_data_status').html(response);
            },
            complete: function(){
               $('#process-loader').fadeOut('slow');
            }
         });
      });

   });
</script>