<aside id="left-panel">

    <div class="login-info">
        <span>
            <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
            <span class="nav-hidden">
                Admin Cpanel
            </span>
        </span>
    </div>

    <nav>
        <ul>
            <li class="nav-hidden">
                <strong>Actions</strong>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-newspaper-o"></i> <span class="menu-item-parent">Gig Analyzer</span></a>
                <ul>
                    <li id="mod-list">
                        <a href="<?= base_url(); ?>admin/gig-analyzer"><i class="fa fa-fw fa-arrow-circle-right"></i> Gig Moderation</a>
                    </li>
                    <li id="resubmit-list">
                        <a href="<?= base_url(); ?>admin/gig-analyzer/resubmitted_gigs"><i class="fa fa-fw fa-arrow-circle-right"></i> Re-submitted Gigs</a>
                    </li>
                    <li id="gig-list">
                        <a href="<?= base_url(); ?>admin/gig-analyzer/gig_list"><i class="fa fa-fw fa-arrow-circle-right"></i> Gig List (all gigs)</a>
                    </li>
                </ul>
            </li>


        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu">
        <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>