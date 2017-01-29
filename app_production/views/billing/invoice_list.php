<?php foreach ($invoices as $item) { ?>
<a href="<?= base_url(); ?>billing/invoices/<?= $item['inv_id']; ?>"><?= $item['inv_number']; ?></a>
<br>
Status: <?= $item['p_status'] ;?>
<br>
Date Due: <?= $item['date_due'] ;?>
<br>
Date Generated: <?= $item['date_generated'] ;?>
<br>
<hr>
<br>
<?php } ?>
