<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $group = array(1, 2, 3);
        if (!$this->ion_auth->in_group($group)) {
            redirect('/', 'refresh');
        }
    }

} /* End of file Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */