<strong><?= $invoice->p_status; ?></strong>
<br><br>

Invoice No: <?= $invoice->inv_number; ?>
<br>
Invoice Date: <?= $invoice->date_generated; ?>
<br>
<?php if ($invoice->date_due != "0000-00-00") { ?>
Due Date: <?= $invoice->date_due; ?>
<br>
<?php } ?>
Total Due: $<?= $invoice->amount; ?> <?= $invoice->currency; ?>
<br><br>

<?php if ($invoice->status == 0) { ?>
<a href="<?= base_url(); ?>payment/membership/<?= $invoice->plan_id; ?>/<?= $invoice->inv_id; ?>">Pay Now</a>
<?php } ?>
