<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_ranking extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->data['user']->membership_payment == 0) {
         redirect('membership-disabled');
      }
   }

   public function index() {
      $this->data['page_title'] = "Search Ranking";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/search_ranking/main', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function process_data($result_found = false) {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){

         $identifier = trim($this->input->post('fiverr_username'));
         $search_query = str_replace(' ', '%20', trim($this->input->post('search_term')));
         $filter = $this->input->post('filter');
         $category = $this->input->post('cat_id');
         $sub_category = $this->input->post('sub_cat_id');

         // Rename the filter for display
         if ($filter == 'rating') {
            $filter_rename = "High Rating";
         } else if ($filter == 'auto') {
            $filter_rename = "Recommended";
         } else if ($filter == 'new') {
            $filter_rename = "New";
         }

         // Set the scrapping URL base on category search or global search
         if ($this->input->post('search_by_cat') == "active") {
            $url = sprintf("https://www.fiverr.com/gigs/gigs_as_json?host=search&amp;type=single_query&amp;query_string=%s&amp;search_filter=%s&amp;category_id=%d&amp;sub_category_id=%d&amp;limit=48&amp;use_single_query=true", $search_query, $filter, $category, $sub_category);
         } else {
            $url = sprintf("https://www.fiverr.com/gigs/gigs_as_json?host=search&amp;type=single_query&amp;query_string=%s&amp;search_filter=%s&amp;category_id=99912&amp;limit=48&amp;use_single_query=true", $search_query, $filter);
         }
         $json_data = json_decode(page_get($url), TRUE);

         // Check to if we get back any gigs
         if (empty($json_data['gigs'])) {
               echo "<div class='page-error'>";
               echo "<div class='page-error'>";
              echo '<i class="fa fa-exclamation-triangle fa-5x text-primary" style="font-size: 8em;"></i> <br>';

                echo '<div class="alert alert-block alert-warning text-left">';
                 echo '<h2>Opps! You do not have any Gig(s) ranking for this search term.</h2>
                 <p>Try narrowing your search by category or filter.</p>
                 </div>';
               echo "</div>";
         } else {
            // Fiverr has a limit to only 48 gigs per page.
            // Do some maths to get the total pages (total gigs divide by gigs per page)
            $cal_page_count = $json_data['total_results'] / 48;
            $page_total = floor($cal_page_count);

            // Loop thru all the pages
            for ($page = 1; $page <= $page_total+1; $page++) {

               // Set the LOOP scrapping URL base on category search or global search
               if ($this->input->post('search_by_cat') == "active") {
                  $url_loop = sprintf("https://www.fiverr.com/gigs/gigs_as_json?host=search&amp;type=single_query&amp;query_string=%s&amp;search_filter=%s&amp;category_id=%d&amp;sub_category_id=%d&amp;page=%&amp;limit=48&amp;use_single_query=true", $search_query, $filter, $category, $sub_category, $page);
               } else {
                  $url_loop = sprintf("https://www.fiverr.com/gigs/gigs_as_json?host=search&amp;type=single_query&amp;query_string=%s&amp;search_filter=%s&amp;category_id=99912&amp;page=%d&amp;limit=48&amp;use_single_query=true", $search_query, $filter, $page);
               }
               $json_loop_data = json_decode(page_get($url_loop), TRUE);

               $page_rank = get_array_key($json_loop_data['gigs'], 'seller_name', $identifier);
               $final_result = search_array_func($json_loop_data['gigs'], 'seller_name', $identifier);

               if ($page == 1) {
                  $overal_rank = $page_rank;
               } else if ($page > 1) {
                  $cal_or = $page - 1;
                  $cal_or2 = $cal_or * 48;
                  $overal_rank = $cal_or2 + $page_rank;
               }

               // Only display data for the gig that matches
               if ($final_result) {
                  $result_found = true;

                  echo "<div class='panel panel-default'><div class='panel-body'>";
                  echo "I will ".$final_result[0]['title_full']." for $5 <br><br>";
                  echo "<div class='row'><div class='col-xs-12 col-md-4'>";
                  if ($final_result[0]['img_medium'] == true) {
                     echo "<center class='gig-img'>".$final_result[0]['img_medium']."</center>";
                  } else {
                     echo "<center class='gig-img'>".$final_result[0]['video_thumb']."</center>";
                  }
                  echo "</div><div class='col-xs-12 col-md-8'>";
                  echo "Your gig is on page: <strong>".$page."</strong> <br>";
                  echo "Current rank on that page is: <strong>".$page_rank."</strong> <br><br>";
                  echo "Your GIG is ranked <span class='label label-info'><strong>".$overal_rank."</strong></span> out of <span class='label label-default'><strong>".$json_data['total_results']."</strong></span> GIG(s) <br>";
                  echo "<strong>Section:</strong> ".$filter_rename." <br>";
                  echo "<strong>Search Term:</strong> <em>`".str_replace('%20', ' ', $search_query)."`</em>";
                  echo "</div></div> </div></div>";
               }
            }
            if ($result_found == false) {
               echo "<div class='page-error'>";
              echo '<i class="fa fa-exclamation-triangle fa-5x text-primary" style="font-size: 8em;"></i> <br>';

                echo '<div class="alert alert-block alert-warning text-left">';
                 echo '<h2>Opps! You do not have any Gig(s) ranking for this search term.</h2>
                 <p>Try narrowing your search by category or filter.</p>
                 </div>';
               echo "</div>";
            }
         }
      } else {
         redirect('/', 'refresh');
      }
   }

   public function tool_training() {
      $this->data['page_title'] = "Search Ranking Training";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/search_ranking/tool_training', $this->data);
      $this->load->view('footer', $this->data);
   }

} /* End of file search_ranking.php */
/* Location: ./application/controllers/tools/search_ranking.php */