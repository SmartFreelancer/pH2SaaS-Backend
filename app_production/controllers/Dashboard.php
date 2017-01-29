<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends BackEnd_Controller
{

    function __construct() {
        parent::__construct();
    }

    public function index() {
        header('Location: http://members.fiverrtools.com');
        exit();
        /*$this->data['page_title'] = "Dashboard";

        $this->load->view('header', $this->data);
        $this->load->view('dashboard/main', $this->data);
        $this->load->view('footer', $this->data);*/
    }

}
