<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Gig Rank Ch...
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/gig-rank-checker"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">GR Checker</span></a>
         </li>
         <!-- <li>
            <a href="<?= base_url(); ?>tools/gig-rank-checker/tool-training"><i class="fa fa-lg fa-fw fa-graduation-cap "></i> <span class="menu-item-parent">Tool Training</span></a>
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
         <li>Gig Rank Checker</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="wdg-ga-tool" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
                     <h2>Gig Rank Checker</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <form id="process-form">
                           <fieldset>
                              <legend class="text-center">

                                 <h3>This tool tells you where your gig is currently ranking in the category that it's in. </h3>

                              </legend>


                              <div class="row">
                                 <div class="col-md-10 col-md-offset-1">
                                    <div class="input-group">
                                       <div class="form-group">
                                          <input type="text" name="gig_url" id="gig_url" class="form-control" placeholder="What is the URL of your gig?">
                                       </div>
                                       <span class="input-group-btn">
                                          <button id="submit_btn" class="btn btn-primary" type="submit">Check!</button>
                                       </span>
                                    </div>
                                 </div>
                              </div>

                           </fieldset>
                        </form>
                        <br>
                        <center>
                           <div id="process-loader">
                              <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                              <br>
                              <p class="text-muted">Please Wait... This might take some time!</p>
                           </div>
                        </center>
                        <div id="process_data_status" class="img-style"></div>

                     </div>
                  </div>

               </div>

            </article>
            <article class="col-md-4">

               <div class="jarviswidget well" id="wdg-ga-tl-intro">
                  <div>
                     <div class="widget-body">
                        <h5><strong><em>How this tool works?</em></strong></h5>
                        <p>
                           Not sure how to use the gig rank checker tool? see the tool training section <a href="<?= base_url(); ?>tools/gig-rank-checker/tool-training">Tool Training</a>.
                        </p>
                        <center>
                           <img class="img-responsive" src="<?= base_url(); ?>assets/img/gif-animation/gr-checker-submit.gif">
                        </center>
                     </div>
                  </div>

               </div>

            </article>
         </div>

      </section>

   </div>

</div>


<script language='javascript' type="text/javascript">
   $(document).ready(function() {
      // validate form input
      $('#process-form').formValidation({
         err: {
            container: 'tooltip'
         },
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
            gig_url: {
               validators: {
                  notEmpty: {
                     message: 'Please enter the URL to your fiverr gig.'
                  },
                  uri: {
                     message: 'The URL you have entered is invalid.'
                  }
               }
            }
         }
      })

      .on('success.form.fv', function(e) {
         // on validation success submit via Ajax
         e.preventDefault();
         $("#submit_btn").removeAttr("disabled"); // enable submit button
         $("#submit_btn").removeClass("disabled"); // enable submit button

         var dataString = $("#process-form").serialize();
         $.ajax({
            url : '<?= base_url(); ?>tools/gig-rank-checker/process-data',
            type: "POST",
            data : dataString,

            beforeSend: function(){
               $('#process-loader').fadeIn('slow');
               $('#process_data_status').fadeOut(600);
               $('#onload-content').fadeOut(600);
            },
            success:function(response) {
               $('#process_data_status').fadeIn(1200);
               $('#process_data_status').html(response);
            },
            complete: function(){
               $('#process-loader').fadeOut('slow');
            }
         });

     });

   });
</script>