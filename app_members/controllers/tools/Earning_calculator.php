<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Earning_calculator extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->data['user']->membership_payment == 0) {
            redirect('membership-disabled');
        }
    }

    public function index()
    {
        $this->data['page_title'] = 'Earning Calculator';

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('tools/earning_calculator/main', $this->data);
        $this->load->view('footer', $this->data);
    }
}
