<?php $this->load->view('email_templates/mail_header'); ?>
<p>Hello <?= $member_name; ?>,</p>
<p>Welcome to <?= $site_name; ?> and thanks for signing up! Your account information is listed below.</p>
<p>
Email/Login: <?= $msg_email; ?> <br>
Password: (as chosen) <br>
Plan Cost: $<?= $this->session->userdata('payment_total'); ?> <?= $this->session->userdata('currency'); ?> <br>
Expiration Date: <?= $plan_expire; ?>
</p>
<p>
<strong>Sign in to your account:</strong> <br>
<a href="<?= base_url(); ?>login"><?= $site_name; ?> Login</a>
</p>
<br>
<p>We genuinely value user feedback. So please don't hesitate to get in contact with us at <?= $general_email; ?>, even if its just to say Hi! Or you can reply to this email and someone from the team will get back to you.</p>
<?php $this->load->view('email_templates/mail_footer'); ?>