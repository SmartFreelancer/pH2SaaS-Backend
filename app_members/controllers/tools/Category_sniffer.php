<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_sniffer extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->data['user']->membership_payment == 0) {
         redirect('membership-disabled');
      }
   }

   public function index() {
      $this->data['page_title'] = "Competition Sniffer";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/category_sniffer/main', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function process_data() {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){
         $url = "https://www.fiverr.com/gigs/endless_page_as_json?host=subcategory&amp;type=endless_auto&amp;category_id=".$this->input->post('cat_id')."&amp;sub_category_id=".$this->input->post('sub_cat_id')."&amp;limit=48&amp;filter=rating&amp;use_single_query=true";
         $json_data = json_decode(page_get($url), TRUE);

         $cat_data = search_array_func($json_data['advanced_search'], 'id', ''.$this->input->post('sub_cat_id').'');
         $new_sellers = search_array_func($json_data['advanced_search'], 'id', 'na');
         $level_one_sellers = search_array_func($json_data['advanced_search'], 'id', 'level_one_seller');
         $level_two_sellers = search_array_func($json_data['advanced_search'], 'id', 'level_two_seller');
         $top_rated_sellers = search_array_func($json_data['advanced_search'], 'id', 'top_rated_seller');

         $this->data['total_gigs'] = $cat_data[0]['count'];
         $this->data['new_sellers'] = $new_sellers[0]['count'];
         $this->data['level_one_sellers'] = $level_one_sellers[0]['count'];
         $this->data['level_two_sellers'] = $level_two_sellers[0]['count'];
         $this->data['top_rated_sellers'] = $top_rated_sellers[0]['count'];

         $this->load->view('tools/category_sniffer/process_data', $this->data);
      } else {
         redirect('/', 'refresh');
      }
   }

   public function tool_training() {
      $this->data['page_title'] = "Competition Sniffer Tool Training";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/category_sniffer/tool_training', $this->data);
      $this->load->view('footer', $this->data);
   }

} /* End of file Category_sniffer.php */
/* Location: ./application/controllers/tools/category_sniffer.php */