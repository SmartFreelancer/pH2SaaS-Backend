<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gig_analyzer extends MY_Controller {

   public function __construct() {
      parent::__construct();

      if ($this->data['user']->membership_payment == 0) {
         redirect('membership-disabled');
      }

      if ( $this->data['user']->id >= 44 && $this->data['user']->id <= 62 ) {
         redirect('tools');
      }

      $this->load->model("gig_analyzer_mdl");
   }

   public function index() {
      $this->data['page_title'] = "Gig Analyzer";

      //Statistic
      $user = $this->ion_auth->user()->row();
      $this->data['total_gigs'] = $this->gig_analyzer_mdl->user_gig_stats(array("usid" => $user->id));
      $this->data['rejected_gigs'] = $this->gig_analyzer_mdl->user_gig_stats(array("usid" => $user->id, "status" => 2));
      $this->data['perfect_gigs'] = $this->gig_analyzer_mdl->user_gig_stats(array("usid" => $user->id, "status" => 1));
      $re_submit = $this->gig_analyzer_mdl->user_gig_stats(array("usid" => $user->id, "status" => 3));
      $pending = $this->gig_analyzer_mdl->user_gig_stats(array("usid" => $user->id, "status" => 0));
      $this->data['pending_gigs'] = $re_submit + $pending;

      //Perfect gigs list
      $perfect_gig_data = $this->gig_analyzer_mdl->get_user_gigs_intro(array('usid'=> $user->id, "status" => 1), '6');
      $perfect_list = '';
      foreach($perfect_gig_data as $list_item) {
         $perfect_list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br> %s</td></tr>', $list_item['gig_img'], $list_item['title'], $list_item['internal_link']);
      }
      $this->data['perfect_gig_list'] = $perfect_list;

      //pending gigs list
      $pending_gig_data = $this->gig_analyzer_mdl->get_user_gigs_intro(array('usid'=> $user->id, "status" => 0), '3');
      $pending_list = '';
      foreach($pending_gig_data as $list_item) {
         $pending_list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br> %s</td> <td>%s</td></tr>', $list_item['gig_img'], $list_item['title'], $list_item['internal_link'], $list_item['date_ago']);
      }
      $this->data['pending_gig_list'] = $pending_list;

      //rejected gigs list
      $rejected_gig_data = $this->gig_analyzer_mdl->get_user_gigs_intro(array('usid'=> $user->id, "status" => 2), '3');
      $rejected_list = '';
      foreach($rejected_gig_data as $list_item) {
         $rejected_list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br> %s</td> <td>%s</td></tr>', $list_item['gig_img'], $list_item['title'], $list_item['internal_link'], $list_item['date_ago']);
      }
      $this->data['rejected_gig_list'] = $rejected_list;


      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_analyzer/main', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function submit_gig() {
      $this->data['page_title'] = "Gig Analyzer | Submit a Gig";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_analyzer/submit_gig', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function submit_gig_process() {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){
         $user = $this->ion_auth->user()->row();

         $clean_url = preg_replace('/\\?.*/', '', $this->input->post('user_gig'));
         $gig_url = trim($clean_url);
         $fiverr_data = page_get($gig_url);

         // check to see if the gig URL is broken
         preg_match("/\<title>(.*)\<\/title\>/isU", $fiverr_data, $head_title);
         if ($head_title[1] == "Fiverr: The marketplace for creative &amp; professional services") {
            echo json_encode(array(
               'success'=> false,
               'message'=> 'Unable to get any information for your gig, please check the gig URL and try again.'
            ));
         } else {

            //check to see if a gig was return form the scrape
            preg_match_all('/("gig_id":(.*),)/Us', $fiverr_data, $f_gig_id);
            $fiverr_gig_id = $f_gig_id[2][0];
            if ($fiverr_gig_id) {

               // check to see if the gig is live in the swap queue.
               $gig_check_callback = $this->gig_analyzer_mdl->gig_callback_check(array('fiverr_gig_id'=> $fiverr_gig_id));
               if ($gig_check_callback >= 1) {
                  echo json_encode(array(
                     'success'=> false,
                     'message'=> 'This gig was already submitted, click on <em>"My submitted Gigs"</em> to view your gig submissions.'
                  ));
               } else {

                  // get the gig title
                  preg_match_all('/<span class="gig-title">(.*?)<\/span>/s', $fiverr_data, $title);
                  $gig_title = trim($title[1][0]);

                  // get the gig image
                  preg_match_all('/<div class="img-holder js-img-holder gig-item-ll">(.*?)<\/div>/s', $fiverr_data, $image);
                  $gig_image = trim($image[1][0]);

                  // Insert Data
                  $insert_data = $this->gig_analyzer_mdl->submit_gig(array('title'=> $gig_title, 'gig_img'=> $gig_image, 'fiverr_gig_id'=> $fiverr_gig_id, 'keyword'=> trim($this->input->post('keyword')), 'gig_url'=> $gig_url, 'usid'=> $user->id, 'date_submitted'=> time()));
                  if ($insert_data) {
                     echo json_encode(array(
                        'success'=> true,
                        'message'=> 'Your gig was submitted successfully and is now pending revision. You will be redirected to your gig in 2 seconds.'
                     ));
                  } else {
                     echo json_encode(array(
                        'success'=> false,
                        'message'=> 'Unable to submit your gig at the moment!'
                     ));
                  }
               }
            } else {
               echo json_encode(array(
                  'success'=> false,
                  'message'=> 'Unable to get any information for your gig, please check the gig URL and try again.'
               ));
            }
         }
      } else {
         redirect('/', 'refresh');
      }
   }

   public function submitted_gigs($gig_id = FALSE) {

      $user = $this->ion_auth->user()->row();
      $this->data['page_title'] = "Gig Analyzer | Submitted Gigs";

      if ($gig_id == FALSE) {
         $gig_list_data = $this->gig_analyzer_mdl->get_user_gigs(array('usid'=> $user->id));

         // create gig list
         $list = '';
         foreach($gig_list_data as $list_item) {
            $list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br> %s</td> <td>%s</td> <td class="text-center">%s</td> </tr>', $list_item['gig_img'], $list_item['title'], $list_item['internal_link'], $list_item['date_submitted'], $list_item['status']);
         }
         $this->data['gig_list'] = $list;

         $this->load->view('header', $this->data);
         $this->load->view('head_nav', $this->data);
         $this->load->view('tools/gig_analyzer/submitted_gigs_list', $this->data);
         $this->load->view('footer', $this->data);
      } else {
         $this->data['gig_view_data'] = $this->gig_analyzer_mdl->get_gig_byid(array('id'=> $gig_id, 'usid'=> $user->id));

         if (empty($this->data['gig_view_data'])) {
            show_404();
         }

         $this->load->view('header', $this->data);
         $this->load->view('head_nav', $this->data);
         $this->load->view('tools/gig_analyzer/submitted_gig_view', $this->data);
         $this->load->view('footer', $this->data);
      }
   }

   public function resubmit_gig() {
      $data = array('status'=> '3');
      $where = array('id'=> $this->input->post('gig_id'));

      $update_gig = $this->gig_analyzer_mdl->update_gig($data, $where);
   }

   public function tool_training() {
      $this->data['page_title'] = "Gig Analyzer Training";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_analyzer/tool_training', $this->data);
      $this->load->view('footer', $this->data);
   }

/*   public function test() {
      $string = '<header class="mp-gig-header">
<h1 itemprop="name">
<span class="gig-title"> I will create the BEST amazon affiliate website for $5 </span>
</h1>
<div class="header-bottom cf">
</header>';

preg_match_all('/<span class="gig-title">(.*?)<\/span>/s', $string, $title);
                  $gig_title = trim($title[1][0]);
var_dump($gig_title);

   }*/

} /* End of file gig_analyzer.php */
/* Location: ./application/controllers/tools/gig_analyzer.php */