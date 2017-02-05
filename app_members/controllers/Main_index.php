<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_index extends MY_Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   public function index()
   {
      if ($this->ion_auth->logged_in()) {
         redirect('dashboard');
      } else {
         redirect('login');
   }


   /*   $this->data['page_title'] = "Supercharge your freelance earnings";

      $this->load->view('header', $this->data);
      $this->load->view('account/login', $this->data);
      $this->load->view('footer', $this->data); */
   }

   public function dashboard()
   {
      $this->load->model("tools_mdl");

      $this->data['page_title'] = "Tools";

      $this->data['all_tools'] = $this->tools_mdl->get_tools(array("status >=" => "1"));
      $this->data['gig_tools'] = $this->tools_mdl->get_tools(array("tool_type" => "0", "status >=" => "1",));
      $this->data['gig_software'] = $this->tools_mdl->get_tools(array("tool_type" => "1", "status >=" => "1",));

      if ($this->ion_auth->in_group(4)) {
         $tool_data = $this->tools_mdl->get_tools(array("tool_privilege >=" => "4", "status >=" => "1"));
      }
      else if ($this->ion_auth->in_group(5)) {
         $tool_data = $this->tools_mdl->get_tools(array("tool_privilege >=" => "5", "status >=" => "1"));
      }
      else if ($this->ion_auth->in_group(6)) {
         $tool_data = $this->tools_mdl->get_tools(array("tool_privilege >=" => "6", "status >=" => "1"));
      }
      else {
         $tool_data = $this->tools_mdl->get_tools(array("status >=" => "1"));
      }
      $this->data['user_tools'] = $tool_data;

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/tools_dashboard', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function membership_disabled()
   {
      $this->data['page_title'] = "Upgrade Your Account";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('membership_disabled', $this->data);
      $this->load->view('footer', $this->data);
   }
}
