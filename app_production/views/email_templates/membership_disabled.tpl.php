<?php $this->load->view('email_templates/mail_header'); ?>
<p>Hello <?= $member_name; ?>,</p>
<p>This is a notification that your membership has now been disabled, due to non-payment.</p>
<p>
<strong>Invoice #:</strong> <?= $invoice_number; ?> <br>
<strong>Amount Due:</strong> $<?= $invoice_amount; ?> <br>
<strong>Due Date:</strong> <?= $due_date; ?> <br>
</p>
<p>Please address this issue to have your membership access restored. You can login to your <?= $site_name; ?> account to view and pay the invoice at <a href="<?= base_url(); ?>login"><?= $site_name; ?> Login</a></p>
<?php $this->load->view('email_templates/mail_footer'); ?>