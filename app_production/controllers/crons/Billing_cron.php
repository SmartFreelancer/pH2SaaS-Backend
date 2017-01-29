<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_cron extends CI_Controller
{

    function __construct() {
        parent::__construct();
        if (!$this->input->is_cli_request()) show_error('Direct access is not allowed');

        $this->load->model('billing_mdl');
        $this->load->model('notification_mdl');
        $this->load->library('email');
    }

    //--------------------------------------------------------------/
    // Run all the function for the billing account cron
    // ../crons/billing_cron/membership
    // runs once a day
    //--------------------------------------------------------------/
    public function membership() {

        // Run Crons and Add statistic
        $this->load->model('statistic_mdl');
        $this->statistic_mdl->add_billing_cron(array('date' => date('Y-m-d'), 'close_account' => $this->close_account(), 'invoice_warning' => $this->invoice_warning(), 'invoice_due' => $this->invoice_due(), 'invoice_generated' => $this->invoice_generate()));
    }

    //--------------------------------------------------------------/
    // Check the membership cycle for accounts that will expire in 3 days
    // Generate invoices, Notify the users and update the last scan instance
    private function invoice_generate() {
        $invoice_date = date('Y-m-d', strtotime("+3 day"));
        $expire = $this->billing_mdl->get_mbship_cycle(array('due_date' => date($invoice_date), 'scan' => 1, 'scan_date !=' => date('Y-m-d')));

        if (empty($expire)) {

            // Record Report
            $res = 0;
            return $res;
        }

        foreach ($expire as $item) {

            // Generate user invoice
            $inv_number = uniqid('INV_');
            $plan_data = $this->billing_mdl->get_mbship_plan_byid(array('id' => $item['user_plan']));
            $invoice_id = $this->billing_mdl->add_invoice(array('inv_number' => $inv_number, 'usid' => $item['usid'], 'plan_id' => $item['user_plan'], 'date_generated' => time(), 'date_due' => $item['due_date'], 'amount' => $plan_data->price, 'currency' => $plan_data->currency));
            if ($invoice_id == FALSE) {
                log_message('error', 'Failed to generate invoice for USID: ' . $item['usid'] . '');
            }

            // Notify the user via system
            $notify = $this->notification_mdl->add_notify(array('usid' => $item['usid'], 'desc' => 'New invoice generated and due in 5 days.', 'link' => base_url("billing/invoices/" . $invoice_id . ""), 'type' => 1));
            if ($notify == FALSE) {
                log_message('error', 'Failed to notify the user via system for newly generated invoice USID:' . $item['usid'] . '');
            }

            // Email data
            $user_data = $this->ion_auth->user($item['usid'])->row();

            $this->data['member_name'] = ($this->data['require_username'] == TRUE) ? $user_data->username : $user_data->first_name . '' . $user_data->last_name;
            $this->data['invoice_number'] = $inv_number;
            $this->data['invoice_amount'] = $plan_data->price . " " . $plan_data->currency;
            $format_duedate = strtotime($item['due_date']);
            $this->data['due_date'] = date('M d, Y', $format_duedate);

            $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('invoice_new', 'ion_auth'), $this->data, true);

            // Send email
            $this->email->clear();
            $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
            $this->email->to($user_data->email);
            $this->email->subject('New Invoice Generated');
            $this->email->message($message);
            $this->email->send();
            if ($this->email->send() == FALSE) {
                log_message('error', 'Unable to send newly generated invoice to: ' . $user_data->email . '');
            }

            // Update last scan date and stop generating invoice
            $this->billing_mdl->update_mbship_cycle(array('id' => $item['id']), array('scan' => 0, 'scan_date' => date('Y-m-d')));
        }

        // Record Report
        $res = count($expire);
        return $res;
    }

    //--------------------------------------------------------------/
    // Notify users that their payments are currently due
    // Notify the users and update the last scan instance
    private function invoice_due() {
        $due = $this->billing_mdl->get_invoices(array('date_due' => date('Y-m-d'), 'scan' => 1, 'scan_date !=' => date('Y-m-d'), 'status' => 0));

        if (empty($due)) {

            // Record Report
            $res = 0;
            return $res;
            exit();
        }

        foreach ($due as $item) {

            // Notify the user via system
            $notify = $this->notification_mdl->add_notify(array('usid' => $item['usid'], 'desc' => 'The invoice on your account is currently due.', 'link' => base_url("billing/invoices/" . $item['inv_id'] . ""), 'type' => 2));
            if ($notify == FALSE) {
                log_message('error', 'Failed to notify the user via system for due invoice USID:' . $item['usid'] . '');
            }

            // Email data
            $user_data = $this->ion_auth->user($item['usid'])->row();

            $this->data['member_name'] = ($this->data['require_username'] == TRUE) ? $user_data->username : $user_data->first_name . '' . $user_data->last_name;
            $this->data['invoice_number'] = $item['inv_number'];
            $this->data['due_date'] = $item['date_due'];
            $this->data['invoice_date'] = $item['date_generated'];
            $this->data['invoice_amount'] = $item['amount'] . " " . $item['currency'];

            $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('invoice_due', 'ion_auth'), $this->data, true);

            // Send email
            $this->email->clear();
            $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
            $this->email->to($user_data->email);
            $this->email->subject('Invoice Due');
            $this->email->message($message);
            $this->email->send();
            if ($this->email->send() == FALSE) {
                log_message('error', 'Unable to send due invoice to: ' . $user_data->email . '');
            }

            // Update invoice last scan date
            $this->billing_mdl->update_invoice(array('inv_id' => $item['inv_id']), array('scan_date' => date('Y-m-d')));
        }

        // Record Report
        $res = count($due);
        return $res;
    }

    //--------------------------------------------------------------/
    // Warn users about outstanding payment that is over 1 day
    // Notify the users and update the last scan instance
    private function invoice_warning() {
        $pass_due = date('Y-m-d', strtotime("-1 day"));
        $overdue = $this->billing_mdl->get_invoices(array('date_due' => date($pass_due), 'scan' => 1, 'scan_date !=' => date('Y-m-d'), 'status' => 0));

        if (empty($overdue)) {

            // Record Report
            $res = 0;
            return $res;
            exit();
        }

        foreach ($overdue as $item) {

            // Notify the user via system
            $notify = $this->notification_mdl->add_notify(array('usid' => $item['usid'], 'desc' => 'The invoice on your account is now overdue.', 'link' => base_url("billing/invoices/" . $item['inv_id'] . ""), 'type' => 3));
            if ($notify == FALSE) {
                log_message('error', 'Failed to notify the user via system for overdue invoice USID:' . $item['usid'] . '');
            }

            // Email data
            $user_data = $this->ion_auth->user($item['usid'])->row();

            $this->data['member_name'] = ($this->data['require_username'] == TRUE) ? $user_data->username : $user_data->first_name . '' . $user_data->last_name;
            $this->data['invoice_number'] = $item['inv_number'];
            $this->data['due_date'] = $item['date_due'];
            $this->data['invoice_date'] = $item['date_generated'];
            $this->data['invoice_amount'] = $item['amount'] . " " . $item['currency'];

            $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('invoice_overdue', 'ion_auth'), $this->data, true);

            // Send email
            $this->email->clear();
            $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
            $this->email->to($user_data->email);
            $this->email->subject('Overdue Invoice');
            $this->email->message($message);
            $this->email->send();
            if ($this->email->send() == FALSE) {
                log_message('error', 'Unable to send overdue invoice to: ' . $user_data->email . '');
            }

            // Update invoice last scan date
            $this->billing_mdl->update_invoice(array('inv_id' => $item['inv_id']), array('scan_date' => date('Y-m-d')));
        }

        // Record Report
        $res = count($overdue);
        return $res;
    }

    //--------------------------------------------------------------/
    // Disable all accounts that has outstanding payments for 2 days
    // Notify the users, disable accounts and stop scanning
    private function close_account() {
        $scan_date = date('Y-m-d', strtotime("-2 day"));
        $past_due = $this->billing_mdl->get_invoices(array('date_due' => date($scan_date), 'scan' => 1, 'status' => 0));

        if (empty($past_due)) {

            // Record Report
            $res = 0;
            return $res;
            exit();
        }

        foreach ($past_due as $item) {

            // Notify the user via system
            $notify = $this->notification_mdl->add_notify(array('usid' => $item['usid'], 'desc' => 'Your membership has been disabled due to non-payment. Please address this issue to have your membership access restored.', 'link' => base_url("billing/invoices/" . $item['inv_id'] . ""), 'type' => 2));
            if ($notify == FALSE) {
                log_message('error', 'Failed to notify the user via system for disabled membership USID:' . $item['usid'] . '');
            }

            // Email data
            $user_data = $this->ion_auth->user($item['usid'])->row();

            $this->data['member_name'] = ($this->data['require_username'] == TRUE) ? $user_data->username : $user_data->first_name . '' . $user_data->last_name;
            $this->data['invoice_number'] = $item['inv_number'];
            $this->data['due_date'] = $item['date_due'];
            $this->data['invoice_date'] = $item['date_generated'];
            $this->data['invoice_amount'] = $item['amount'] . " " . $item['currency'];

            $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('membership_disabled', 'ion_auth'), $this->data, true);

            // Send email
            $this->email->clear();
            $this->email->from($this->data['general_email'], $this->data['site_name'] . ' Support');
            $this->email->to($user_data->email);
            $this->email->subject('Your membership has been disabled');
            $this->email->message($message);
            $this->email->send();
            if ($this->email->send() == FALSE) {
                log_message('error', 'Unable to send disabled email to: ' . $user_data->email . '');
            }

            // Disable the user account
            $disable = $this->ion_auth->update($item['usid'], array('membership_payment' => 0));
            if ($disable == FALSE) {
                log_message('error', 'Unable to disable user membership USID:' . $item['usid'] . '');
            }

            // Stop scanning to generate new invoices and also expire invoices
            $this->billing_mdl->update_mbship_cycle(array('usid' => $item['usid']), array('scan' => 0));
            $this->billing_mdl->update_invoice(array('inv_id' => $item['inv_id']), array('scan' => 0));
        }

        // Record Report
        $res = count($past_due);
        return $res;
    }
}