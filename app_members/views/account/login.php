<div id="main" role="main">

   <div id="content" class="container">
      <span class="hidden-xs"><br><br></span>
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
            <div class="well no-padding">

               <?php
                  $attributes = array('class' => 'smart-form client-form', 'id' => 'login-form');
                  echo form_open('login', $attributes);
               ?>
                  <header>
                     <i class="fa fa-sign-in"></i> Sign In
                  </header>

                  <fieldset>

                     <div id="infoMessage">
                        <?php echo $message;?>
                     </div>

                     <section>
                        <label class="label">E-mail Address</label>
                        <label class="input"> <i class="icon-append fa fa-user"></i>
                           <input type="email" name="identity" id="identity" placeholder="Enter your email address">
                           <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter your email address</b></label>
                     </section>

                     <section>
                        <label class="label">Password</label>
                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                           <input type="password" name="password" id="password" placeholder="Enter your password">
                           <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Please enter your password</b> </label>
                        <div class="note">
                           <a href="<?= base_url(); ?>forgot-password"><i class="fa fa-arrow-circle-o-right"></i> Forgot password?</a>
                        </div>
                     </section>

                     <section>
                        <label class="checkbox">
                           <input type="checkbox" name="remember" checked="">
                           <i></i>Stay signed in</label>
                     </section>
                  </fieldset>
                  <footer>
                     <button type="submit" class="btn btn-primary">
                        Sign in
                     </button>
                  </footer>
               <?php echo form_close();?>

            </div>


         </div>
      </div>
   </div>

</div>