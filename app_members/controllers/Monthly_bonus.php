<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Monthly_bonus extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page_title'] = "Monthly Bonus";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('extras/monthly_bonus', $this->data);
        $this->load->view('footer', $this->data);
    }


} /* End of file Monthly_bonus.php */
/* Location: ./application/controllers/Monthly_bonus.php */
