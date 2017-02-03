<body class="smart-style-2 fixed-header">

   <header id="header">

      <div id="logo-group">
         <span id="logo"> <a href="<?= base_url(); ?>"><?= config_item('app_name') ?></a> </span>
      </div>

      <div class="head-links hidden-sm hidden-xs">
         <ul class="list-unstyled">
            <li><a href="<?= base_url(); ?>">Dashboard</a></li>
            <li><a href="<?= base_url(); ?>tools">Tools</a></li>
           <!-- <li><a href="<?= base_url(); ?>academy">Academy</a></li> -->
            <li><a href="<?= base_url(); ?>community">Community <span class="badge bg-color-red flash animated">new!</span></i></em></a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Extras <span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="<?= base_url(); ?>resources"><i class="fa fa-fw fa-briefcase"></i> Resources</a></li>
                  <li class="divider"></li>
                  <li><a href="<?= base_url(); ?>monthly-bonus"><i class="fa fa-fw fa-calendar"></i> Monthly Bonus</a></li>
               </ul>
            </li>

            <?php
               $group = array('developer', 'administrator', 'moderator');
               if ($this->ion_auth->in_group($group)) {
            ?>
               <li><a href="<?= base_url(); ?>admin">Admin cPanel</a></li>
            <?php } ?>
         </ul>
      </div>

      <div class="pull-right">
         <div id="hide-menu" class="btn-header hidden-md hidden-lg pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
         </div>

         <ul id="avator-block" class="header-dropdown-list padding-5">
            <li>
               <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                  <img src="<?= base_url(); ?>uploads/avatar/<?= $user->avatar; ?>" alt="avatar" class="img-circle" />
                   <span class="username hidden-xs"><?= $user->username; ?> <i class="fa fa-caret-down"></i></span>
               </a>
               <ul class="dropdown-menu pull-right">
                  <li>
                     <a href="<?= base_url(); ?>account"><i class="fa fa-user"></i> Manage Account</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <a href="<?= base_url(); ?>billing"><i class="fa fa-credit-card"></i> Billing</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <a href="mailto:<?= config_item('support_email'); ?>?subject=Private Support"><i class="fa fa-support"></i> Private Support</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                     <a href="<?= base_url(); ?>logout" data-action="userLogout" data-logout-title="<?= $user->username; ?>" data-logout-msg="Are you sure you want to end your active session? anything that is currently open will not be save."><i class="fa fa-sign-out fa-lg"></i> <strong>Logout</strong></a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>

   </header>
