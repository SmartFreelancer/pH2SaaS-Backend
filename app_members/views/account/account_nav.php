<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Account
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>
            <li id="act-settings">
                <a href="<?= base_url(); ?>account"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Account Information</span></a>
            </li>
            <li id="act-chge-pswd">
                <a href="<?= base_url(); ?>account/change-password"><i class="fa fa-lg fa-fw fa-key "></i> <span class="menu-item-parent">Change Password</span></a>
            </li>
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>
