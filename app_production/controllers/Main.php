<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends FrontEnd_Controller
{

    function __construct() {
        parent::__construct();
        $this->data['default_price'] = "9.95";
        $this->data['price_dollar'] = "9";
        $this->data['price_cents'] = "95";
    }

    public function index() {
        $this->data['page_title'] = "Tools For Fiverr Sellers";

        $this->load->view('v1/header', $this->data);
        $this->load->view('v1/home', $this->data);
        $this->load->view('v1/footer', $this->data);
    }

    public function features() {
        $this->data['page_title'] = "Fiverr Tools Features";

        $this->load->view('v1/header', $this->data);
        $this->load->view('v1/landing/features', $this->data);
        $this->load->view('v1/footer', $this->data);
    }

    public function pricing() {
        $this->data['page_title'] = "Pricing";

        $this->load->view('v1/header', $this->data);
        $this->load->view('v1/landing/pricing', $this->data);
        $this->load->view('v1/footer', $this->data);
    }

    public function offer() {
        $this->data['page_title'] = "Special Offer Contribute";

        $this->load->view('v1/header', $this->data);
        $this->load->view('v1/landing/offer', $this->data);
        $this->load->view('v1/footer', $this->data);
    }

    public function jvzoo() {
        $this->data['page_title'] = "jvzoo";

        $this->load->view('v1/header2', $this->data);
        $this->load->view('v1/landing/jvzoo', $this->data);
        $this->load->view('v1/footer2', $this->data);
    }
}
