<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gig_rank_checker extends MY_Controller {

   public function __construct() {
      parent::__construct();

      if ($this->data['user']->membership_payment == 0) {
         redirect('membership-disabled');
      }
   }

   public function index() {
      $this->data['page_title'] = "Gig Rank Checker";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_rank_checker/main', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function process_data($result_found = false) {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){

         $clean_url = preg_replace('/\\?.*/', '', $this->input->post('gig_url'));
         $gig_page_data = page_get(trim($clean_url));

         if (!preg_match('/"gig_id":(.*),/Us', $gig_page_data, $gig_id)) {
            // Log Error - WHERE & ERROR MSG
            log_message('error', '
            <strong>WHERE:</strong> controllers/tools/gig_rank_checker.php <em>(process_data)</em> <br>
            <strong>ERROR MSG:</strong> preg_match failed was unable to get the gig_id value.
            <br><br><hr><br><br>');

            echo "<div class='page-error'>";
            echo "<h3>Ooops! Something went wrong...</h3> <i class='fa fa-lightbulb-o fa-5x text-primary'></i><br> <p>An error occurred while processing your request. Please check the gig URL and try again.</p>";
            echo "</div>";
            exit();
         }

         if (!preg_match('/"gig_cat_id":(.*),/Us', $gig_page_data, $gig_cat_id)) {
            // Log Error - WHERE & ERROR MSG
            log_message('error', '
            <strong>WHERE:</strong> controllers/tools/gig_rank_checker.php <em>(process_data)</em> <br>
            <strong>ERROR MSG:</strong> preg_match failed was unable to get the gig_cat_id value.
            <br><br><hr><br><br>');

            echo "<div class='page-error'>";
            echo "<h3>Ooops! Something went wrong...</h3> <i class='fa fa-lightbulb-o fa-5x text-primary'></i><br> <p>An error occurred while processing your request. Please check the gig URL and try again.</p>";
            echo "</div>";
            exit();
         }

         if (!preg_match('/("categoryName":"(.*)")/Us', $gig_page_data, $category_data)) {
            // Log Error - WHERE & ERROR MSG
            log_message('error', '
            <strong>WHERE:</strong> controllers/tools/gig_rank_checker.php <em>(process_data)</em> <br>
            <strong>ERROR MSG:</strong> preg_match failed was unable to get the Category name.
            <br><br><hr><br><br>');

            echo "<div class='page-error'>";
            echo "<h3>Ooops! Something went wrong...</h3> <i class='fa fa-lightbulb-o fa-5x text-primary'></i><br> <p>An error occurred while processing your request. Please check the gig URL and try again.</p>";
            echo "</div>";
            exit();
         } else {
            $category = str_replace('\u0026', '&', $category_data[2]);
         }

         if (!preg_match('/("subCategoryName":"(.*)")/Us', $gig_page_data, $sub_category_data)) {
            // Log Error - WHERE & ERROR MSG
            log_message('error', '
            <strong>WHERE:</strong> controllers/tools/gig_rank_checker.php <em>(process_data)</em> <br>
            <strong>ERROR MSG:</strong> preg_match failed was unable to get the sub Category name.
            <br><br><hr><br><br>');

            echo "<div class='page-error'>";
            echo "<h3>Ooops! Something went wrong...</h3> <i class='fa fa-lightbulb-o fa-5x text-primary'></i><br> <p>An error occurred while processing your request. Our developers are working quickly to resolve the issue.</p>";
            echo "</div>";
            exit();
         } else {
            $sub_category = str_replace('\u0026', '&', $sub_category_data[2]);
         }

         // Do the first scrape to get the data we need
         $url = sprintf("https://www.fiverr.com/gigs/endless_page_as_json?host=subcategory&amp;type=endless_auto&amp;category_id=%d&amp;sub_category_id=0&amp;limit=48&amp;filter=rating&amp;use_single_query=true", $gig_cat_id[1]);
         $json_data = json_decode(page_get($url), TRUE);

         $first_scrape = search_array_func($json_data['advanced_search'], 'alias', $sub_category);

         // Fiverr has a limit to only 48 gigs per page.
         // Do some maths to get the total pages (total gigs divide by gigs per page)
         $cal_page_count = $first_scrape[0]['count'] / 48;
         $page_total = floor($cal_page_count);

         // Loop thru all the pages
         for ($page = 1; $page <= $page_total+1; $page++) {
            $url_loop = sprintf("https://www.fiverr.com/gigs/endless_page_as_json?host=subcategory&amp;type=endless_auto&amp;category_id=%d&amp;sub_category_id=%d&amp;&page=%d&amp;limit=48&amp;filter=rating&amp;use_single_query=true", $gig_cat_id[1], $first_scrape[0]['id'], $page);
            $json_loop_data = json_decode(page_get($url_loop), TRUE);

            $page_rank = get_array_key($json_loop_data['gigs'], 'gig_id', $gig_id[1]);
            $final_result = search_array_func($json_loop_data['gigs'], 'gig_id', $gig_id[1]);

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
               echo "<h3>I will ".$final_result[0]['title_full']." for $5</h3>";
               echo "<div class='row'><div class='col-xs-12 col-md-4'>";
               if ($final_result[0]['img_medium'] == true) {
                  echo "<center>".$final_result[0]['img_medium']."</center>";
               } else {
                  echo "<center>".$final_result[0]['video_thumb']."</center>";
               }
               echo "</div><div class='col-xs-12 col-md-8'>";

               /*echo "<div class='row'>";
               echo "<div class='col-xs-5'>";
               echo "Page: <span class='label label-info'><strong>#".$page."</strong></span> <br>";
               echo "Page Rank: <span class='label label-info'>#<strong>".$page_rank."</strong></span><br>";
               echo "<em>High Rating Section</em> <br>";
               echo "</div>";
               echo "<div class='col-xs-7'>";
               echo "Overal Rank: <span class='label label-info'>#<strong>".$overal_rank."</strong> </span><br>";
               echo "Total Gigs: <span class='label label-info'>#<strong>".$first_scrape[0]['count']."</strong></span><br>";
               echo "Category: <strong>".$category."</strong> / <strong>".$sub_category."</strong><br>";
               echo "</div></div>";*/

               echo "Your gig is on page: <strong>#".$page."</strong> <br>";
               echo "Current rank on that page is: <strong>#".$page_rank."</strong> <br><br>";
               echo "Your GIG is ranked <span class='label label-info'><strong>#".$overal_rank."</strong></span> out of <span class='label label-default'><strong>".$first_scrape[0]['count']."</strong></span> GIG(s). <br>";
               echo "<em>High Rating Section</em>";
               //echo "Category: <em><strong>".$category."</strong> / <strong>".$sub_category."</strong></em>.";

               echo "<br><br><strong>Result Summary</strong> <br>";
               echo '<div class="alert alert-info" role="alert">';
               echo "Your GIG is on page <strong>#".$page."</strong> in the <strong>".$category."</strong> / <strong>".$sub_category."</strong> Category. It is ranked <strong>#".$overal_rank."</strong> out of <strong>".$first_scrape[0]['count']."</strong> GIGS in that same category.";
               echo "</div>";

               echo "</div></div> ";


               echo '<br><div class="alert alert-block alert-warning">
                           <a class="close" href="#" data-dismiss="alert">×</a>
                           <h4 class="alert-heading">Want to improve your gig ranking?</h4>
                           Submit your gig to our gig analyzer tool to receive feedback on how you can make your gig better. <br>
                           <center>
                              <a href="'.base_url().'tools/gig_analyzer/submit_gig" class="btn btn-primary">Submit Now</a>
                           </center>
                        </div>';

               echo "</div></div>";
            }
         }
         if ($result_found == false) {
            echo "<div class='page-error'>";
            echo '<i class="fa fa-meh-o fa-3x text-primary" style="font-size: 8em;"></i> <br>';
            echo '<div class="alert alert-block alert-warning text-left">
            <h4 class="alert-heading">Not Ranking!</h4>
            Your gig is not ranking in the category its in. Please consider tweaking your gig to improve its ranking.</div>';
            echo "Your Gig Category: <strong>".$category."</strong> / <strong>".$sub_category."</strong>";

            echo "</div>";
         }
      } else {
         redirect('/', 'refresh');
      }
   }

   public function tool_training() {
      $this->data['page_title'] = "Gig Rank Checker Training";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_rank_checker/tool_training', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function test() {
         $url = "https://www.fiverr.com/danthecoder/create-a-responsive-mobile-website-optimize-for-ui?funnel=9d65c701-0a3b-487d-bda6-de3d3bb522d8";
         $clean_url = preg_replace('/\\?.*/', '', $url);
         $gig_page_data = page_get(trim($clean_url));

         $category = "Programming Tech";
         $sub_category = "WordPress";
         $gig_id[1] = 2630428;
         $gig_cat_id[1] = 10;

         // Do the first scrape to get the data we need
         $url = sprintf("https://www.fiverr.com/gigs/endless_page_as_json?host=subcategory&amp;type=endless_auto&amp;category_id=%d&amp;sub_category_id=0&amp;limit=48&amp;filter=rating&amp;use_single_query=true", $gig_cat_id[1]);
         $json_data = json_decode(page_get($url), TRUE);

         $first_scrape = search_array_func($json_data['advanced_search'], 'alias', $sub_category);

         // Fiverr has a limit to only 48 gigs per page.
         // Do some maths to get the total pages (total gigs divide by gigs per page)
         $cal_page_count = $first_scrape[0]['count'] / 48;
         $page_total = floor($cal_page_count);

         // Loop thru all the pages
         for ($page = 1; $page <= $page_total+1; $page++) {
            $url_loop = sprintf("https://www.fiverr.com/gigs/endless_page_as_json?host=subcategory&amp;type=endless_auto&amp;category_id=%d&amp;sub_category_id=%d&amp;&page=%d&amp;limit=48&amp;filter=rating&amp;use_single_query=true", $gig_cat_id[1], $first_scrape[0]['id'], $page);
            $json_loop_data = json_decode(page_get($url_loop), TRUE);

            $page_rank = get_array_key($json_loop_data['gigs'], 'gig_id', $gig_id[1]);
            $final_result = search_array_func($json_loop_data['gigs'], 'gig_id', $gig_id[1]);

            if ($page == 1) {
                $overal_rank = $page_rank;
            } else if ($page > 1) {
                $cal_or = $page - 1;
                $cal_or2 = $cal_or * 48;
                $overal_rank = $cal_or2 + $page_rank;
            }

            echo "<pre>";
            var_dump($final_result);
            echo "</pre>";

            // Only display data for the gig that matches
           /* if ($final_result) {
               // $result_found = true;

              echo "<div class='panel panel-default'><div class='panel-body'>";
               echo "<h3>I will ".$final_result[0]['title_full']." for $5</h3>";
               echo "<div class='row'><div class='col-xs-12 col-md-4'>";
               if ($final_result[0]['img_medium'] == true) {
                  echo "<center>".$final_result[0]['img_medium']."</center>";
               } else {
                  echo "<center>".$final_result[0]['video_thumb']."</center>";
               }
               echo "</div><div class='col-xs-12 col-md-8'>";
               echo "Your gig is on page: <strong>".$page."</strong> <br>";
               echo "Current rank on that page is: <strong>".$page_rank."</strong> <br><br>";
               echo "Your GIG is ranked <span class='label label-info'><strong>".$overal_rank."</strong></span> out of <span class='label label-default'><strong>".$first_scrape[0]['count']."</strong></span> GIG(s). <br>";
               echo "Category: <em><strong>".$category."</strong> / <strong>".$sub_category."</strong></em>.";
               echo "</div></div> </div></div>";
            }*/
         }
   }


} /* End of file gig_rank_checker.php */
/* Location: ./application/controllers/tools/gig_rank_checker.php */