<?php $this->load->view('email_templates/mail_header'); ?>
<p>Hello <?= $member_name; ?>,</p>
<p>This is the second billing notice that your invoice <strong>#<?= $invoice_number; ?></strong> which was generated on <strong><?= $invoice_date; ?></strong> is now overdue.</p>
<p>
<strong>Invoice #:</strong> <?= $invoice_number; ?> <br>
<strong>Amount Due:</strong> $<?= $invoice_amount; ?><br>
<strong>Due Date:</strong> <?= $due_date; ?> <br>
</p>
<p>Please pay your outstanding invoice as soon as possible to avoid service interruption. You can login to your <?= $site_name; ?> account to view and pay the invoice at <a href="<?= base_url(); ?>login"><?= $site_name; ?> Login</a></p>
<?php $this->load->view('email_templates/mail_footer'); ?>