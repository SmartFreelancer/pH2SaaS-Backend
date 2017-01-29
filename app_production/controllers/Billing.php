<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends BackEnd_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('billing_mdl');
    }

    public function index() {
        $this->data['page_title'] = "Billing";

        $this->load->view('header', $this->data);
        $this->load->view('billing/main', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function invoices($invoice_id = NULL) {

        if ($invoice_id == TRUE) {
            $this->data['invoice'] = $this->billing_mdl->get_invoice_byid( array('inv_id' => $invoice_id,'usid' => $this->data['user']->id) );
            if ($this->data['invoice'] == FALSE) {
                show_404();
            }
            $this->data['page_title'] = "View Invoice";

            $this->load->view('header', $this->data);
            $this->load->view('billing/invoice_view', $this->data);
            $this->load->view('footer', $this->data);
        } else {
            $this->data['invoices'] = $this->billing_mdl->get_invoices( array('usid' => $this->data['user']->id) );
            $this->data['page_title'] = "Invoices";

            $this->load->view('header', $this->data);
            $this->load->view('billing/invoice_list', $this->data);
            $this->load->view('footer', $this->data);
        }


    }
}
