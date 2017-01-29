<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Billing
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>
            <li id="act-settings">
                <a href="<?= base_url(); ?>billing/invoices"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Invoices</span></a>
            </li>
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
