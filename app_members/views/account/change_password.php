<?php $this->load->view('account/account_nav'); ?>

<div id="main" role="main">

   <div id="ribbon">
      <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
         <li><a href="<?= base_url(); ?>account">Manage Account</a></li>
         <li>Change Password</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-8 col-md-offset-2">
               <div class="jarviswidget" id="wdj-act-settings" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">

                  <header>
                     <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                     <h2>Change Password</h2>
                  </header>

                  <div>
                     <div class="widget-body">

                        <?php echo form_open("account/change_password");?>
                           <fieldset>
                              <legend>
                                 <center>
                                 <h3>Changing your password will log you out.</h3>
                                 </center>
                              </legend>

                              <div class="row">
                                 <div class="col-xs-10 col-xs-offset-1">

                                    <div id="infoMessage">
                                       <?php echo $message;?>
                                    </div>

                                    <input type="hidden" value="<?= $user->id; ?>" name="user_id" id="user_id">

                                    <div class="form-group">
                                       <label>Old Password</label>
                                       <input type="password" name="old" id="old" class="form-control" placeholder="Enter your old password">
                                    </div>

                                    <div class="form-group">
                                       <label>New Password</label>
                                       <input type="password" name="new" id="new" pattern="^.{<?= $min_password_length; ?>}.*$" class="form-control" placeholder="Enter your new password">
                                    </div>

                                    <div class="form-group">
                                       <label>Confirm New Password</label>
                                       <input type="password" name="new_confirm" id="new_confirm" pattern="^.{<?= $min_password_length; ?>}.*$" class="form-control" placeholder="Confirm your new password">
                                    </div>

                                 </div>
                              </div>
                           </fieldset>

                           <div class="form-actions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Change</button>
                                 </div>
                              </div>
                           </div>
                        <?php echo form_close();?>

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
      $('li#act-chge-pswd').addClass('active'); // make the current nav active

   });
</script>