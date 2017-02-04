<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $data = array();
    function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->data['user'] = $this->ion_auth->user()->row();

        // Admin Configuratons
        $this->data['site_name'] = $this->config->item('app_name');
        $this->data['general_email'] = $this->config->item('support_email');
        $this->data['payment_company_name'] = $this->config->item('app_name');
        $this->data['require_username'] = TRUE;
        $this->data['lead_url'] = base_url().'payment/membership/1';
    }
}

class BackEnd_Controller extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }
    }
}

class FrontEnd_Controller extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->session->set_userdata('lead_referer', $_SERVER['HTTP_REFERER']);
        }
    }
}
