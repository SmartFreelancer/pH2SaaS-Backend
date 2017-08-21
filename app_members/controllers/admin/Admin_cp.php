<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_cp extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['page_title'] = "Admin Cpanel Dashboard";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('admin_cpanel/dashboard', $this->data);
        $this->load->view('footer', $this->data);
    }


} /* End of file admin/Admin_cp.php */
/* Location: ./application/controllers/admin/Admin_cp.php */