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
                <article class="col-md-12">
                    <div class="jarviswidget" id="wdj-act-settings" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-gears"></i> </span>
                            <h2>All Invoices</h2>
                        </header>
                        <div>
                            <div class="widget-body">

                     <?php if ($invoices == FALSE) { ?>
                     <br>
                         <center><h2>You do not have any invoices at the moment.</h2></center>
                         <br>
                     <?php } else { ?>

                     <table class="table">
<table class="table">
<thead>
<tr>
<th>Invoice #</th>
<th>Invoice Date</th>
<th>Due Date</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>


<?php foreach ($invoices as $item) { ?>
<tr>
<td><?= $item['inv_number']; ?></td>
<td><?= $item['date_generated']; ?></td>
<td><?= $item['date_due']; ?></td>
<td>$<?= $item['amount']; ?> <?= $item['currency']; ?></td>
<td><strong><?= $item['p_status']; ?></strong></td>
<td>
<a class="btn btn-primary" href="<?= base_url(); ?>billing/invoices/<?= $item['inv_id']; ?>">View Invoice</a>
</td>
</tr>
<?php } ?>

</tbody>
</table>




                     <?php } ?>


                            </div>
                        </div>

                    </div>
                </article>
            </div>

        </section>

    </div>
</div>
