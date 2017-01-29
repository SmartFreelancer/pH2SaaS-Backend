<?php $this->load->view('email_templates/mail_header'); ?>
<p>Hello <?= ($require_username == TRUE) ? $user->username : $user->first_name.' '.$user->last_name; ?>,</p>
<p>Your <?= $site_name; ?> membership has been renew. This is a payment receipt confirming your payment for Invoice # <strong><?= $invoice_number; ?></strong> sent on <strong><?= $invoice_date; ?></strong>.</p>
<p>
<strong>Invoice #:</strong> <?= $invoice_number; ?> <br>
<strong>Transaction ID:</strong> <?= $trans_id; ?> <br>
<strong>Amount:</strong> $<?= $payment_amount; ?><br>
<strong>Date Paid:</strong> <?= date('M d, Y'); ?><br>
<strong>Status:</strong> <span style="font-weight: 800; color: green; font-size: 15px;">PAID</span> <br>
</p>
<p>You may review your invoice history at any time by signing in to your <?= $site_name; ?> account at <a href="<?= base_url(); ?>login"><?= $site_name; ?> Login</a></p>
<p><strong>Note:</strong> This email will serve as an official receipt for this payment.</p>
<?php $this->load->view('email_templates/mail_footer'); ?>