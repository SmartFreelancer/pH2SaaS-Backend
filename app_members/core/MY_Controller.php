<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public $data = array();

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('ion_auth', 'form_validation'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');

        $this->data['site_title'] = $this->config->item('app_name') . ' - ';
        $this->data['user'] = $this->ion_auth->user()->row();

        // Login check
        $exception_uris = array(
            'login',
            'logout',
            'register',
            'forgot-password'
        );
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if (!$this->ion_auth->logged_in()) {
                redirect('login');
            }
        }

    }


} /* End of file core/MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
