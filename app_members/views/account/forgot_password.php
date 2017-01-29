<div id="main" role="main">
   <div id="content" class="container">


      <span class="hidden-xs"><br><br></span>
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">

            <div class="well no-padding">

               <?php
                  $attributes = array('class' => 'smart-form client-form', 'id' => 'login-form');
                  echo form_open('forgot-password', $attributes);
               ?>
                  <header>
                     <i class="fa fa-unlock-alt"></i> Forget Password
                  </header>

                  <fieldset>

                     <div id="infoMessage">
                        <?php echo $message;?>
                     </div>

                     <p class="text-center">
                     Please enter your e-mail address below so we can send you an email to reset your password.
                     </p>
                     <br>

                     <section>
                        <label class="label">E-mail Address</label>
                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                           <input type="email" name="email" id="email" placeholder="Enter your email address">
                           <b class="tooltip tooltip-top-right"><i class="fa fa-envelope-o txt-color-teal"></i> Please enter your email address</b></label>
                     </section>

                  </fieldset>
                  <footer>
                     <button type="submit" class="btn btn-primary">
                        Retrieve Password
                     </button>
                  </footer>
               <?php echo form_close();?>

            </div>


         </div>
      </div>


   </div>
</div>


