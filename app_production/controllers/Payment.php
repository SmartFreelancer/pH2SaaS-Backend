<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Omnipay\Omnipay;
class Payment extends MY_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('billing_mdl');
        $this->load->model('notification_mdl');

        //initialize payment gateways
        $this->gateway = Omnipay::create('PayPal_Express');
        $this->gateway->setUsername('XXXXX_api1.XXXX.com');
        $this->gateway->setPassword(XXXXXXXXXXX);
        $this->gateway->setSignature(XXXX.XXXXXXXXXXXXXXX);
        $this->gateway->settestMode(false);
    }

    public function membership($plan_id = NULL, $invoice = NULL) {
        $plan_data = $this->billing_mdl->get_mbship_plan_byid(array('status' => 1, 'id' => $plan_id));
        if ($plan_data == FALSE) {
            $this->session->set_flashdata('response_msg', array('msg' => '<h4 class="alert-heading">No Plan Selected!</h4> Please select a membership plan in order to proceed.', 'class' => 'info'));
            redirect($_SERVER['HTTP_REFERER']);
            exit();
        }

        // Invoice or new membership
        if ($invoice) {

            // Check the invoice
            $invoice_check = $this->billing_mdl->get_invoice_byid(array('inv_id' => $invoice, 'usid' => $this->data['user']->id));
            if ($invoice_check == FALSE) {
                $this->session->set_flashdata('response_msg', array('msg' => '<h4 class="alert-heading">Something Went Wrong!</h4> Unable to complete your invoice payment, please contact supoort.', 'class' => 'warning'));
                redirect($_SERVER['HTTP_REFERER']);
                exit();
            }

            $invoice_data = array('payment_type' => '1', 'invoice_id' => $invoice);
            $this->session->set_userdata($invoice_data);
        }
        else {
            $this->session->set_userdata('payment_type', '0');
        }

        try {
            $response = $this->gateway->purchase(array('cancelUrl' => base_url('payment/payment-cancel'), 'returnUrl' => base_url('payment/process-payment'), 'brandName' => $this->data['payment_company_name'], 'amount' => $plan_data->price, 'description' => $plan_data->item_desc, 'currency' => $plan_data->currency))->send();

            if ($response->isSuccessful()) {

                // mark order as complete


            }
            elseif ($response->isRedirect()) {

                // Store the payment details in the user session to use to complete the order
                $payment_data = array('plan_id' => $plan_data->id, 'payment_total' => $plan_data->price, 'currency' => $plan_data->currency, 'member_role' => $plan_data->member_role, 'plan_period' => $plan_data->period, 'user_referer' => $_SERVER['HTTP_REFERER'], 'trans_reference' => $response->getTransactionReference());
                $this->session->set_userdata($payment_data);

                $response->redirect();
            }
            else {
                log_message("error", $response->getMessage());
                $this->session->set_flashdata('response_msg', array('msg' => '<h4 class="alert-heading">Payment Unsuccessful!</h4>' . $response->getMessage() . '', 'class' => 'danger'));
                redirect($_SERVER['HTTP_REFERER']);
                exit();
            }
        }
        catch(\Exception $e) {
            log_message("error", $e);
            $this->session->set_flashdata('response_msg', array('msg' => '<h4 class="alert-heading">Payment Unsuccessful!</h4>Sorry, there was an error processing your payment. Please try again later.', 'class' => 'warning'));
            redirect($_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function process_payment() {
        $trans_id = md5($this->session->userdata('trans_reference'));

        // Complete the order
        $response = $this->gateway->completePurchase(array('amount' => $this->session->userdata('payment_total'), 'currency' => $this->session->userdata('currency'), 'transactionId' => $trans_id, 'transactionReference' => $this->session->userdata('trans_reference')))->send();

        $complete_data = $response->getData();

        // Check if the payment was successful
        if (isset($complete_data['PAYMENTINFO_0_ACK']) && $complete_data['PAYMENTINFO_0_ACK'] === 'Success') {

            // Check the type of payment
            if ($this->session->userdata('payment_type') == 0) {
                $this->membership_signup($complete_data, $trans_id);
            }
            else if ($this->session->userdata('payment_type') == 1) {
                $this->membership_invoice($complete_data, $trans_id);
            }
        }
        else {
            $this->session->set_flashdata('response_msg', array('msg' => '<h4 class="alert-heading">Payment Failed!</h4>Sorry, there was an error processing your payment. Please try again later.', 'class' => 'danger'));
            redirect($this->session->userdata('user_referer'));
        }
    }

    public function payment_cancel() {
        redirect('/');
    }

    private function membership_signup($complete_data, $trans_id) {

        // Pre-register the user
        $this->billing_mdl->pre_register($this->session->userdata('member_role'));

        // Create an invoice
        $inv_number = uniqid('INV_');
        $invoice_id = $this->billing_mdl->add_invoice(array('inv_number' => $inv_number, 'usid' => $this->session->userdata('reg_userid'), 'plan_id' => $this->session->userdata('plan_id'), 'date_generated' => time(), 'status' => 1, 'amount' => $complete_data['PAYMENTINFO_0_AMT'], 'currency' => $complete_data['PAYMENTINFO_0_CURRENCYCODE'], 'scan' => 0));

        // Add payment data
        $this->billing_mdl->add_payment(array('invoice_id' => $invoice_id, 'date_completed' => time(), 'trans_fee' => $complete_data['PAYMENTINFO_0_FEEAMT'], 'pp_ref_id' => $this->session->userdata('trans_reference'), 'trans_id' => $trans_id, 'gateway' => "PayPal"));

        // Add membership Cycle
        $due_date = date('Y-m-d', strtotime("+" . $this->session->userdata('plan_period') . " day"));
        $this->billing_mdl->add_mbship_cycle(array('usid' => $this->session->userdata('reg_userid'), 'user_plan' => $this->session->userdata('plan_id'), 'due_date' => $due_date));

        // Remove any created lead for this user
        if ($this->session->userdata('email')) {
            $this->billing_mdl->remove_lead(array('email' => $this->session->userdata('email')));
        }

        // Record lead conversion tracking
        if ($this->session->userdata('lead_referer')) {
            $this->billing_mdl->add_conversion_tracking(array('referer' => $this->session->userdata('lead_referer'), 'usid' => $this->session->userdata('reg_userid')));
        }

        redirect('auth/payment-register');
    }

    private function membership_invoice($complete_data, $trans_id) {

        // Add payment
        $this->billing_mdl->add_payment(array('invoice_id' => $this->session->userdata('invoice_id'), 'date_completed' => time(), 'trans_fee' => $complete_data['PAYMENTINFO_0_FEEAMT'], 'pp_ref_id' => $this->session->userdata('trans_reference'), 'trans_id' => $trans_id, 'gateway' => "PayPal"));

        // Mark invoice as paid
        $this->billing_mdl->update_invoice(array('inv_id' => $this->session->userdata('invoice_id'), 'usid' => $this->data['user']->id), array('status' => 1, 'scan' => 0));

        // Update membership cycle
        $due_date = date('Y-m-d', strtotime("+" . $this->session->userdata('plan_period') . " day"));
        $this->billing_mdl->update_mbship_cycle(array('usid' => $this->data['user']->id), array('due_date' => $due_date, 'scan' => 1));

        // Reactivate the user membership
        $this->ion_auth_model->update($this->data['user']->id, array('membership_payment' => 1));

        // Notify the user via system
        $notify = $this->notification_mdl->add_notify(array('usid' => $this->data['user']->id, 'desc' => 'Your membership has been renew!', 'link' => "", 'type' => 1));
        if ($notify == FALSE) {
            log_message('error', 'Failed to notify the user via system for paid membership invoice USID:' . $this->data['user']->id . '');
        }

        $pay_data = $this->billing_mdl->get_invoice_byid(array('inv_id' => $this->session->userdata('invoice_id'), 'usid' => $this->data['user']->id));

        $this->data['invoice_number'] = $pay_data->inv_number;
        $this->data['trans_id'] = $trans_id;
        $this->data['invoice_date'] = $pay_data->date_generated;
        $this->data['payment_amount'] = $pay_data->amount . ' ' . $pay_data->currency;
        $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('membership_renewal', 'ion_auth'), $this->data, true);

        // Email the user
        $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
        $this->email->to($this->data['user']->email);
        $this->email->subject('Membership Renewal Completed');
        $this->email->message($message);
        $this->email->send();
        if ($this->email->send() == FALSE) {
            log_message('error', 'Unable to send membership renewal email to: ' . $this->data['user']->email . '');
        }

        // Redirect the user to where they were referred from
        redirect($this->session->userdata('user_referer'));
    }

    public function jvzoo() {
        if ($this->jvzoo_valid() == 1) {

            // Record who made the payment
            $this->load->model('statistic_mdl');
            $this->statistic_mdl->add_jvzoo( array('identifer' => $this->input->get('cemail') ));

            // Pre-register the user
            $this->billing_mdl->pre_register(array('4', '5', '6'));

            // Create an invoice
            $inv_number = uniqid('INV_');
            $invoice_id = $this->billing_mdl->add_invoice(array('inv_number' => $inv_number, 'usid' => $this->session->userdata('reg_userid'), 'plan_id' => "1", 'date_generated' => time(), 'status' => 1, 'amount' => "9.95", 'currency' => "USD", 'scan' => 0));

            // Add payment data
            $this->billing_mdl->add_payment(array('invoice_id' => $invoice_id, 'date_completed' => time(), 'trans_fee' => "0", 'gateway' => "JVZoo"));

            // Add membership Cycle
            $due_date = date('Y-m-d', strtotime("+ 30 day"));
            $this->billing_mdl->add_mbship_cycle(array('usid' => $this->session->userdata('reg_userid'), 'user_plan' => "1", 'due_date' => $due_date));

            // add some data to the user session for email
            $j_data = array(
                'payment_total' => '9.95',
                'currency' => "USD",
                'plan_period' => "30",
                );
            $this->session->set_userdata($j_data);

            redirect('auth/payment-register');
        } else {
            redirect('/');
            log_message('error','Unable to verify JvZoo sale.');
        }
    }

    public function jvzipn() {

        $this->load->model('statistic_mdl');
        if ($this->jvzipn_verify() == 1) {

            if ($this->input->get('ctransaction') == 'SALE') {

                // for now put everything in a test DB for

                $do = $this->statistic_mdl->update_jvzoo(array('identifer' => $this->input->get('ccustemail')), array('ipn_data' => json_encode($this->input->get()) ));
                if ($do == FALSE) {
                    $this->statistic_mdl->add_jvzoo( array('ipn_data' => json_encode($this->input->get()) ));
                }

                // Format Amout
                /*$amount = $this->input->get('ctransamount')/100;

                // Pre-register the user
                $this->billing_mdl->pre_register( array('4','5','6') );

                // Create an invoice
                $inv_number = uniqid('INV_');
                $invoice_id = $this->billing_mdl->add_invoice(array(
                    'inv_number' => $inv_number,
                    'usid' => $this->session->userdata('reg_userid'),
                    'plan_id' => "1",
                    'date_generated' => time(),
                    'status' => 1,
                    'amount' => $amount,
                    'currency' => "USD",
                    'scan' => 0));

                // Add payment data
                $this->billing_mdl->add_payment(array(
                    'invoice_id' => $invoice_id,
                    'date_completed' => time(),
                    'trans_fee' => "0",
                    'gateway' => "JVZoo"));

                // Add membership Cycle
                $due_date = date('Y-m-d', strtotime("+30 day"));
                $this->billing_mdl->add_mbship_cycle(array(
                    'usid' => $this->session->userdata('reg_userid'),
                    'user_plan' => "1",
                    'due_date' => $due_date));

                // Remove any created lead for this user
                if ($this->session->userdata('email')) {
                    $this->billing_mdl->remove_lead(array('email' => $this->session->userdata('email')));
                }

                // Record lead conversion tracking
                if ($this->session->userdata('lead_referer')) {
                    $this->billing_mdl->add_conversion_tracking(array('referer' => $this->session->userdata('lead_referer'), 'usid' => $this->session->userdata('reg_userid')));
                }

                redirect('auth/payment-register');*/
            }
        }
        else {
            $this->statistic_mdl->add_jvzoo( array('ipn_data' => json_encode($this->input->get()) ));
        }
    }

    private function jvzipn_verify() {
        $secretKey = "hghjklk";
        $pop = "";
        $ipnFields = array();
        foreach ($this->input->get() AS $key => $value) {
            if ($key == "cverify") {
                continue;
            }
            $ipnFields[] = $key;
        }
        sort($ipnFields);
        foreach ($ipnFields as $field) {

            // if Magic Quotes are enabled $_POST[$field] will need to be
            // un-escaped before being appended to $pop
            $pop = $pop . $this->input->get($field) . "|";
        }
        $pop = $pop . $secretKey;
        $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
        $calcedVerify = strtoupper(substr($calcedVerify, 0, 8));

        return $calcedVerify == $this->input->get("cverify");
    }

    private function jvzoo_valid() {
        $key = 'hghjklk';
        $rcpt = $this->input->get('cbreceipt');
        $time = $this->input->get('time');
        $item = $this->input->get('item');
        $cbpop = $this->input->get('cbpop');

        $xxpop = sha1("$key|$rcpt|$time|$item");
        $xxpop = strtoupper(substr($xxpop, 0, 8));

        if ($cbpop == $xxpop) return 1;
        else return 0;
    }

}
