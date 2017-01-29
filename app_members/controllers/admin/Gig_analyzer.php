<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gig_analyzer extends Admin_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model("gig_analyzer_mdl");
   }

   public function index() {
      $this->data['page_title'] = "Gig Analyzer Moderation List";

      $gig_list_data = $this->gig_analyzer_mdl->acp_get_gigs(array('status'=> 0));
      $list = '';
      foreach($gig_list_data as $list_item) {
         $list .= sprintf('<tr> <td><center>%s</center></td> <td>%s</td> <td>%s</td> <td>%s</td> <td class="text-center">%s</td> </tr>', $list_item['gig_img'], $list_item['title'], $list_item['date_submitted'], $list_item['mod_status'], $list_item['action']);
      }
      $this->data['gig_list'] = $list;

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('admin_cpanel/gig_analyzer/moderation_list', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function moderation($gig_id = NULL) {
      if($gig_id == NULL) {
         show_404();
      }
      if ($gig_id == 0) {
         // Set session flush msg then redirect
         $this->session->set_flashdata('flush_msg', '
            <div class="alert alert-info alert-block">
               <a class="close" href="#" data-dismiss="alert">×</a>
               <h4 class="alert-heading">Auto Load Complete!</h4>
               Unable to auto load anymore gigs at the moment, as you might have skipped the gigs that are in queue or its empty.
            </div>
         ');
         redirect("admin/gig-analyzer");
      } else {
         $this->data['page_title'] = "Gig Analyzer Moderation";

         //update the gig mod status
         $this->gig_analyzer_mdl->update_gig(array('mod_status'=> 1), array('id'=> $gig_id));

         // get gig data
         $this->data['gig_data'] = $this->gig_analyzer_mdl->get_gig_byid(array('id'=> $gig_id));

         //get next gig
         $next_gig_data = $this->gig_analyzer_mdl->get_gig_byid(array('id >'=> $gig_id, 'status'=> 0, 'mod_status'=> 0));
         if (empty($next_gig_data)) {
            $this->data['next_gig'] = 0;
         } else {
            $this->data['next_gig'] = $next_gig_data->id;
         }

         $this->load->view('header', $this->data);
         $this->load->view('admin_cpanel/gig_analyzer/moderation', $this->data);
         $this->load->view('footer', $this->data);
      }
   }

   public function gig_frame($gig_id) {
      //get the gig data from the DB
      $gig_data = $this->gig_analyzer_mdl->get_gig_byid(array('id'=> $gig_id));

      //scrape fiverr
      $gig_page_data = page_get($gig_data->gig_url);

      // Clean up the page
      $find = array(
               '/<div id="main-wrapper-header">(.*?)<div class="main-content">/s',
               '/<nav class="js-gig-nav-bar cf">(.*?)<\/nav>/s',
               '/<footer class="mp-box main-footer border-top">(.*?)<\/footer>/s',
               '/<div class="box-row mp-gig-cover-container"(.*?)<\/div>/s',
               '/<aside class="gig-sidebar">(.*?)<\/aside>/s',

               '/<div class="box-row mp-gig-wrapper js-mp-gig-wrapper"(.*?)>/s',
               '/<div class="mp-gig"(.*?)>/s',
               '/<div class="gig-page-section gig-page-section-extras "(.*?)>/s',
               '/<meta content="(.*?)<\/meta>/s',
               '/gallery-gig-detail "(.*?)>/s',
               '/<div class="js-deliveries-gallery mp-gig-deliveries-thumbs"(.*?)>/s',
            );
      $replace = array(
               '',
               '',
               '',
               '',
               '',
               '<div class="box-row mp-gig-wrapper js-mp-gig-wrapper" style="width: 100%;"">',
               '<div class="mp-gig" style="width: 85%; padding-top: 10px;">',
               '<div class="gig-page-section gig-page-section-extras" style="display: none;">',
               '',
               'gallery-gig-detail " style="width: 100%">',
               '<div class="js-deliveries-gallery mp-gig-deliveries-thumbs has-deliveries" style="width: 100%;">',
            );
      $clean_gig_page = preg_replace($find, $replace, $gig_page_data);

      echo $clean_gig_page;
   }

   public function mod_submit() {
      $user = $this->ion_auth->user()->row();
      $data = array (
         "title_msg" => trim($this->input->post('gig_title_msg')),
         "category_msg" => trim($this->input->post('gig_category_msg')),
         "img_msg" => trim($this->input->post('gig_img_msg')),
         "vid_msg" => trim($this->input->post('gig_video_msg')),
         "desc_msg" => trim($this->input->post('gig_desc_msg')),
         "keywords_msg" => trim($this->input->post('gig_keywords_msg')),
         "additional_msg" => trim($this->input->post('gig_addinfo_msg')),
         "status" => $this->input->post('status'),
         "mod_status" => $this->input->post('mod_status'),
         "mod_user" => $this->input->post('mod_user'),
         "mod_date" => $this->input->post('mod_date')
      );
      $this->gig_analyzer_mdl->update_gig($data, array('id'=> $this->input->post('gig_id')));
   }

   public function resubmitted_gigs() {
      $this->data['page_title'] = "Gig Analyzer Resubmitted Gigs";

      $user = $this->ion_auth->user()->row();

      $gig_list_data = $this->gig_analyzer_mdl->acp_get_resubmit_gigs(array('mod_user'=> $user->id, 'status' => 3));
      $list = '';
      foreach($gig_list_data as $list_item) {
         $list .= sprintf('<tr> <td><center>%s</center></td> <td>%s</td> <td>%s</td> <td>%s</td> <td class="text-center">%s</td> </tr>', $list_item['gig_img'], $list_item['title'], $list_item['date_submitted'], $list_item['mod_status'], $list_item['action']);
      }
      $this->data['gig_list'] = $list;

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('admin_cpanel/gig_analyzer/resubmitted_gigs', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function resubmit_mod($gig_id = NULL) {
      if($gig_id == NULL) {
         show_404();
      }
      if ($gig_id == 0) {
         // Set session flush msg then redirect
         $this->session->set_flashdata('flush_msg', '
            <div class="alert alert-info alert-block">
               <a class="close" href="#" data-dismiss="alert">×</a>
               <h4 class="alert-heading">Auto Load Complete!</h4>
               Unable to auto load anymore gigs at the moment, as you might have skipped the gigs that are in queue or its empty.
            </div>
         ');
         redirect("admin/gig-analyzer/resubmitted_gigs");
      } else {
         $this->data['page_title'] = "Gig Analyzer Moderation";

         // get gig data
         $this->data['gig_data'] = $this->gig_analyzer_mdl->get_gig_byid(array('id'=> $gig_id));

         //get next gig
         $next_gig_data = $this->gig_analyzer_mdl->get_gig_byid(array('id >'=> $gig_id, 'status'=> 0, 'mod_status'=> 0));
         if (empty($next_gig_data)) {
            $this->data['next_gig'] = 0;
         } else {
            $this->data['next_gig'] = $next_gig_data->id;
         }

         $this->load->view('header', $this->data);
         $this->load->view('admin_cpanel/gig_analyzer/resubmit_mod', $this->data);
         $this->load->view('footer', $this->data);
      }
   }

   public function gig_list() {
      $this->data['page_title'] = "Gig Analyzer Gig List";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('admin_cpanel/gig_analyzer/gig_list', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function mod_gigs_json_data() {
      $gigs = json_encode($this->gig_analyzer_mdl->get_all_gigs());
      echo '{"data":'. $gigs.'}';
   }

} /* End of file admin/Gig_analyzer.php */
/* Location: ./application/controllers/admin/Gig_analyzer.php */