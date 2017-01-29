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
                <a href="<?= base_url(); ?>billing"><i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">Invoices</span></a>
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
            <li><a href="<?= base_url(); ?>billing">Billing</a></li>
            <li>Invoices</li>
        </ol>
    </div>
    <div id="content">
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-md-8 col-md-offset-2">
                    <div class="jarviswidget" id="wdj-act-settings" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-gears"></i> </span>
                            <h2>View Invoice</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <div class="padding-10">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <strong>INVOICE NO :</strong>
                                                    <span class="pull-right"> <?= $invoice->inv_number; ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <div>
                                                    <strong>INVOICE DATE :</strong>
                                                    <span class="pull-right">
                                                    <?= $invoice->date_generated; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-md">
                                                    <strong>DUE DATE :</strong>
                                                    <span class="pull-right">
                                                    <i class="fa fa-calendar"></i>
                                                    <?php if ($invoice->date_due != "0000-00-00") { ?>
                                                    <?= $invoice->date_due; ?>
                                                    <?php } ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="well well-sm bg-color-darken txt-color-white no-border">
                                                <div class="fa-lg">
                                                    Amount :
                                                    <span class="pull-right"> $<?= $invoice->amount; ?> <?= $invoice->currency; ?> </span>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <h1 class="font-400"><?= $invoice->p_status; ?></h1>
                                            <?php if ($invoice->status == 0) { ?>
                                            <a class="btn btn-primary btn-lg" href="http://fiverrtools.com/payment/membership/<?= $invoice->plan_id; ?>/<?= $invoice->inv_id; ?>">Pay Now</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <p class="note">**To avoid any service interruption, please make payments before the due date.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>