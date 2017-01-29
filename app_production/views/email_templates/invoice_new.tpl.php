<?php $this->load->view('email_templates/mail_header'); ?>
<p>Hello <?= $member_name; ?>,</p>
<p>This email is to inform you that an invoice has been generated and is due within 3 days from now.</p>
<p>
<strong>Invoice #:</strong> <?= $invoice_number; ?> <br>
<strong>Amount Due:</strong> $<?= $invoice_amount; ?><br>
<strong>Due Date:</strong> <?= $due_date; ?> <br>
</p>
<p>You can view this invoice by signing in to your <?= $site_name; ?> account at <a href="<?= base_url(); ?>login"><?= $site_name; ?> Login</a></p>
<?php $this->load->view('email_templates/mail_footer'); ?>