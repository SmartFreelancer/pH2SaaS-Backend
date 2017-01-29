<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('resources_mdl');
    }

    public function index() {
      $this->data['page_title'] = "Resources";

      $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/resources/index/";
        $config["total_rows"] = $this->resources_mdl->count_resources();
        $config["per_page"] = 8;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['prev_link'] = '<i class="fa fa-arrow-left"></i> Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next <i class="fa fa-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->data['resources_list'] = $this->resources_mdl->get_resources(array("status" => "0"), $config["per_page"], $page);
        $this->data['pagination'] = $this->pagination->create_links();

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('extras/resources', $this->data);
      $this->load->view('footer', $this->data);
    }


} /* End of file resources.php */
/* Location: ./application/controllers/resources.php */
