<?php $this->load->view('account/account_nav'); ?>

<div id="main" role="main">

   <div id="ribbon">
      <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
         <li><a href="<?= base_url(); ?>account">Manage Account</a></li>
         <li>Account Information</li>
      </ol>
   </div>

    <div id="content">


        <section id="widget-grid" class="">

            <div class="row">
                <article class="col-md-8">
                    <div class="jarviswidget" id="wdj-act-settings" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-gears"></i> </span>
                            <h2>Account Information</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                                  <form id="settings-update">
                            <fieldset>
                               <legend>
                                            <button id="refresh" class="btn btn-xs btn-danger pull-right" data-html="true" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-placement="bottom" rel="tooltip" data-title="refresh" data-action="resetWidgets">
                                                <i class="fa fa-refresh"></i> Factory Reset
                                            </button>
                               </legend>
                            </fieldset>

                            <div id="settings-upload-msg" role="alert" style="display:none">
                               <button type="button" class="close"><i class="fa fa-times"></i></button>
                               <strong></strong>
                            </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input class="form-control" type="text" name="fname" id="fname" value="<?= $user->first_name; ?>" placeholder="<?= $user->first_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text" name="lname" id="lname" value="<?= $user->last_name; ?>" placeholder="<?= $user->last_name; ?>">
                                            </div>
                                        </div>
                                      </div>

                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="form-control" type="text" name="email" id="email" value="<?= $user->email; ?>" placeholder="<?= $user->email; ?>">
                                    </div>

                           <div class="form-actions">
                              <div class="row">
                                 <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Update Settings</button>
                                      <span id="su-loader" style="display:none">
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
                <article class="col-md-4">
                    <div class="jarviswidget well" id="act-avatar" data-widget-editbutton="false" data-widget-deletebutton="false">
                        <div>
                            <div class="widget-body">

                        <h5 class="text-center">Change Your Avatar</h5>

                        <div class="alert alert-warning" role="alert">
                            Supported file types: PNG, JPG, GIF <br>
                            Minimum Width: 250px <br>
                            Minimum Height: 250px
                        </div>

                        <center>
                            <img class="img-thumbnail" src="<?= base_url(); ?>uploads/avatar/<?= $user->avatar; ?>">
                        </center>
                        <br>
                                <form id="avatar_upload">
                                    <center>
                                        <input id="userfile" name="userfile" class="btn btn-default" type="file">
                                        <br />
                                        <div id="process-loader">
                                 <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                              </div>
                                        <button type="submit" class="btn btn-primary">Upload Avatar</button>
                                    </center>
                                </form>
                                <br>
                            <div id="process-msg" role="alert" style="display:none">
                           <button type="button" class="close"><i class="fa fa-times"></i></button>
                           <strong></strong>
                        </div>

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
   $(document).ready(function() {
       $('li#act-settings').addClass('active'); // make the current nav active

       // update settings
      $('#settings-update').formValidation({
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
            fname: {
               validators: {
                  notEmpty: {
                     message: 'Your first name is required.'
                  },
                  regexp: {
                     regexp: /^[a-zA-Z\s]+$/,
                     message: 'The first name field can only consist of alphabetical characters.'
                  }
               }
            },
            lname: {
               validators: {
                  notEmpty: {
                     message: 'Your last name is required.'
                  },
                  regexp: {
                     regexp: /^[a-zA-Z\s]+$/,
                     message: 'The last name field can only consist of alphabetical characters.'
                  }
               }
            },
            email: {
               validators: {
                  notEmpty: {
                     message: 'The email address field is required.'
                  },
                  emailAddress: {
                     message: 'The email address you have entered is NOT valid.'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();

         clearMessage();
         var suData = $("#settings-update").serialize();
         $.ajax({
            url : '<?= base_url(); ?>account/update_account_info',
            type: "POST",
            data : suData,

            beforeSend: function(){
               $('#su-loader').show();
            },
            success:function(response) {
               var oRtn = eval('('+response+')');
               displayMessage('settings-upload-msg', oRtn.message, oRtn.success);
               if (oRtn.success == true) {
                  setTimeout(function(){
                     window.location='<?= base_url(); ?>account';
                  }, 2000);
               }
            },
            complete: function(){
               $('#su-loader').hide();
            }
         });

      });

       // avatar image
        $("#avatar_upload").submit(function(e) {
            e.preventDefault();

          clearMessage();
          var formData = new FormData($(this)[0]);
          $.ajax({
             url : '<?= base_url(); ?>account/upload_avatar',
             type: "POST",
                mimeType: "multipart/form-data",
                async: false,
                cache: false,
                contentType: false,
                processData: false,
             data : formData,

             beforeSend: function(){
                $('#process-loader').show();
             },
             success:function(response) {
                var oRtn = eval('('+response+')');
                displayMessage('process-msg', oRtn.message, oRtn.success);
                if (oRtn.success == true) {
                        setTimeout(function(){
                            window.location='<?= base_url(); ?>account';
                        }, 1000);
                }
             },
             complete: function(){
                $('#process-loader').hide();
             }
          });
       });

    });
</script>