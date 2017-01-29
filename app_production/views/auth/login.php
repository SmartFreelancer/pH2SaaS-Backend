<div class="container">
   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <br><br><br>

         <div id="process-msg" role="alert" style="display:none">
            <button type="button" class="close"><i class="fa fa-times"></i></button>
            <strong></strong>
         </div>

         <form id="process-form">

            <div class="form-group">
               <label for="identity">E-mail Address</label> <br>
               <input type="email" class="form-control" name="identity" id="identity" placeholder="Enter your email address">
            </div>

            <div class="form-group">
               <label for="password">Password</label> <br>
               <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            </div>

            <div class="checkbox">
               <label>
                <input type="checkbox" name="remember" checked=""> Stay signed in
               </label>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            <span id="process-loader" style="display:none">
               <img src="<?= base_url('assets/images/ajax-loader.gif'); ?>">
            </span>

         </form>

      </div>
   </div>
</div>

<script src="<?= base_url('assets/js/ajax.js'); ?>"></script>
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
            identity: {
               validators: {
                  notEmpty: {
                     message: 'Your email address is required.'
                  },
                  emailAddress: {
                     message: 'The email you entered is not a valid email address.'
                  }
               }
            },
            password: {
               validators: {
                  notEmpty: {
                     message: 'Please enter your password.'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();

         clearMessage(); // Clear response msg if any
         var formData = $("#process-form").serialize();

         $.ajax({
            url : '<?= base_url(); ?>auth/login-ajax',
            type: "POST",
            data : formData,

            beforeSend: function(){
               $('#process-loader').show();
            },
            success:function(response) {
               var oRtn = eval('('+response+')');
               displayMessage('process-msg', oRtn.message, oRtn.success);
              if (oRtn.success == true) {
                  setTimeout(function(){
                     window.location= "<?= base_url('dashboard'); ?>";
                  }, 1500);
               }
            },
            complete: function(){
               $('#process-loader').hide();
            }
         });

      });
   });
</script>