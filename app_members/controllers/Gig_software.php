<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gig_software extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->data['user']->membership_payment == 0) {
            redirect('membership-disabled');
        }
    }

    public function gig_image_creator()
    {
        $this->data['page_title'] = "Gig Image Creator";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('gig_software/gig_image_creator', $this->data);
        $this->load->view('footer', $this->data);
    }

    public function gig_image_creator_training()
    {
        $this->data['page_title'] = "Gig Image Creator Training";

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('gig_software/gig_image_creator_training', $this->data);
        $this->load->view('footer', $this->data);
    }

} /* End of file Gig_software.php */
/* Location: ./application/controllers/tools/Gig_software.php */