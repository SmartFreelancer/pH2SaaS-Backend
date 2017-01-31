<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gig_swap extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->data['user']->membership_payment == 0) {
         redirect('membership-disabled');
      }

      $this->load->model('gig_swap_mdl');
   }

   public function index() {
      $this->data['page_title'] = "Swap a Gig";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_swap/swap_gig', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function swap_gig_process() {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){
         $user = $this->ion_auth->user()->row();

         // Clean the URL the user input
         $clean_url = preg_replace('/\\?.*/', '', $this->input->post('gig_url'));
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
            preg_match_all('/("gigOwner":"(.*)")/Us', $fiverr_data, $f_username);
            $fiverr_username = $f_username[2][0];
            if ($fiverr_username) {

               //get the gig ID
               preg_match_all('/("gig_id":(.*),)/Us', $fiverr_data, $f_gig_id);
               $fiverr_gig_id = $f_gig_id[2][0];

               // check to see if the gig is live in the swap queue.
               $gig_check_callback = $this->gig_swap_mdl->swap_callback_check(array('fiverr_gig_id'=> $fiverr_gig_id, 'claim_status'=> 0));
               if ($gig_check_callback >= 1) {
                  echo json_encode(array(
                     'success'=> false,
                     'message'=> 'You cannot submit this gig at the moment as its already live within the swap queue.'
                  ));
               } else {

                  // Get and format the gig data
                  preg_match_all('/("gigOwner":"(.*)")/Us', $fiverr_data, $f_username);
                  $fiverr_username = $f_username[2][0];

                  preg_match_all('/<span class="gig-title">(.*?)<\/span>/s', $fiverr_data, $title);
                  $gig_title = trim($title[1][0]);

                  preg_match_all('/<div class="img-holder js-img-holder gig-item-ll">(.*?)<\/div>/s', $fiverr_data, $image);
                  $gig_image = trim($image[1][0]);

                  // Insert the data
                  $insert_data = $this->gig_swap_mdl->add_gig_swap(array(
                     'gig_title'=> $gig_title,
                     'gig_url'=> $gig_url,
                     'gig_img'=> $gig_image,
                     'additional_msg'=> trim($this->input->post('additional_msg')),
                     'date_submitted'=> time(),
                     'swapper_usid'=> $user->id,
                     'fiverr_gig_id'=> $fiverr_gig_id,
                     'swapper_fusername'=> $fiverr_username
                  ));

                  if($insert_data) {

                     // Try to swap the gig
                     $current_gig = $this->gig_swap_mdl->get_swap_byid(array('gig_url'=> $gig_url));
                     $random_gig = $this->gig_swap_mdl->get_swap_byid(array('claim_status'=> 0, 'swap_id <'=> $current_gig->swap_id, 'swapper_usid !='=> $user->id));
                     if ($random_gig == TRUE) {
                        // add the gig to the claim list (submitting gig)
                        $this->gig_swap_mdl->add_gig_claim(array(
                           'gig_swap_id'=> $current_gig->swap_id,
                           'gig_claim_id'=> $random_gig->swap_id,
                           'claimer_usid'=> $random_gig->swapper_usid,
                           'claimer_fusername'=> $random_gig->swapper_fusername,
                           'date_swapped'=> time()
                        ));
                        // update swap queue
                        $this->gig_swap_mdl->update_gig_queue(array('claim_status'=> 1), array('swap_id'=> $current_gig->swap_id));

                        // add the gig to the claim list (random gig)
                        $this->gig_swap_mdl->add_gig_claim(array(
                           'gig_swap_id'=> $random_gig->swap_id,
                           'gig_claim_id'=> $current_gig->swap_id,
                           'claimer_usid'=> $current_gig->swapper_usid,
                           'claimer_fusername'=> $current_gig->swapper_fusername,
                           'date_swapped'=> time()
                        ));
                        // update swap queue
                        $this->gig_swap_mdl->update_gig_queue(array('claim_status'=> 1), array('swap_id'=> $random_gig->swap_id));

                        // ajax respond msg
                        echo json_encode(array(
                           'success'=> true,
                           'message'=> 'Your gig was successfully swapped, please wait while we redirect you to your gig.'
                        ));
                     } else {
                        // ajax respond msg
                        echo json_encode(array(
                           'success'=> true,
                           'message'=> 'We are unable to swap your gig at the moment however it was added to the swap queue and will be swap with the next available gig.'
                        ));
                     }

                  } else {
                     // Ajax respond msg
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

   public function swap_queue() {
      $this->data['page_title'] = "My Queue";

      $user = $this->ion_auth->user()->row();
      $queue_list_data = $this->gig_swap_mdl->get_user_swap(array("claim_status" => 0, "swapper_usid" => $user->id));
      $swapped_list_data = $this->gig_swap_mdl->get_user_swap(array("claim_status" => 1, "swapper_usid" => $user->id));

      // create swap queue gig list
      $queue_list = '';
      foreach($queue_list_data as $list_item) {
         $queue_list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br> <span class="text-primary">%s</span></td></tr>', $list_item['gig_img'], $list_item['gig_title'], $list_item['pending_date']);
      }
      $this->data['swap_queue_list'] = $queue_list;

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_swap/swap_queue', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function swap_history() {
      $this->data['page_title'] = "My Swaps";

      $user = $this->ion_auth->user()->row();
      $queue_list_data = $this->gig_swap_mdl->get_user_swap(array("claim_status" => 0, "swapper_usid" => $user->id));
      $swapped_list_data = $this->gig_swap_mdl->get_user_swap(array("claim_status" => 1, "swapper_usid" => $user->id));


      // create swap history list
      $swapped_list = '';
      foreach($swapped_list_data as $list_item) {
         $swapped_list .= sprintf('<tr><td><center>%s</center></td> <td><a href="'.base_url().'tools/gig-swap/history-view/'.$list_item['swap_id'].'/'.$list_item['gig_claim_id'].'"> %s <br> <span class="text-muted">%s</span> <br><br> %s </a></td> </tr>', $list_item['gig_img'], $list_item['gig_title'], $list_item['swapped_date'], $list_item['status_msg']);
      }
      $this->data['swapped_list'] = $swapped_list;

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_swap/swap_history', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function history_view($gig_id, $gig_claim_id) {
      if ($gig_id == FALSE) {
         // Whoops, we don't have a page for that!
         show_404();
      } else if ($gig_claim_id == FALSE) {
         // Whoops, we don't have a page for that!
         show_404();
      } else {
         $this->data['gig_data'] = $this->gig_swap_mdl->get_swap_cliams_byid(array('swap_id'=> $gig_id));
         $this->data['claim_data'] = $this->gig_swap_mdl->get_swap_cliams_byid(array('swap_id'=> $gig_claim_id));

         // wrong param in the URL show 404
         if (empty($this->data['gig_data'])) {
            show_404();
         } else if (empty($this->data['claim_data'])) {
            show_404();
         }
         $this->data['page_title'] = "Swap History";

         $this->load->view('header', $this->data);
         $this->load->view('head_nav', $this->data);
         $this->load->view('tools/gig_swap/history_view', $this->data);
         $this->load->view('footer', $this->data);
      }
   }

   public function to_purchase() {
      $this->data['page_title'] = "To Purchase";

      $user = $this->ion_auth->user()->row();
      $swap_list_data = $this->gig_swap_mdl->get_swap_cliams(array("purchase_status" => "0", "claim_status" => "1", "claimer_usid" => $user->id));

      // create swap gig list
      $list = '';
      foreach($swap_list_data as $list_item) {
         $list .= sprintf('<tr> <td><center>%s</center></td> <td>%s <br><br> %s</td> <td class="text-center" style="padding-top: 30px">%s</td> </tr>', $list_item['gig_img'], $list_item['gig_title'], $list_item['status_msg'], $list_item['action']);
      }
      $this->data['swap_claim_list'] = $list;


      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_swap/to_purchase', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function to_purchase_view($gig_id, $gig_claim_id) {
      if ($gig_id == FALSE) {
         // Whoops, we don't have a page for that!
         show_404();
      } else if ($gig_claim_id == FALSE) {
         // Whoops, we don't have a page for that!
         show_404();
      } else {
         $this->data['gig_data'] = $this->gig_swap_mdl->get_swap_cliams_byid(array('swap_id'=> $gig_id));
         $this->data['claim_data'] = $this->gig_swap_mdl->get_swap_cliams_byid(array('swap_id'=> $gig_claim_id));

         // wrong param in the URL show 404
         if (empty($this->data['gig_data'])) {
            show_404();
         } else if (empty($this->data['claim_data'])) {
            show_404();
         }
         $this->data['page_title'] = "To Purchase Gig View";

         $this->load->view('header', $this->data);
         $this->load->view('head_nav', $this->data);
         $this->load->view('tools/gig_swap/to_purchase_view', $this->data);
         $this->load->view('footer', $this->data);
      }
   }

   public function update_claim(){
      $this->gig_swap_mdl->update_gig_claim(array('purchase_status'=> $this->input->post('purchase_status')), array('gig_swap_id'=> $this->input->post('gig_swap_id')));
   }

   public function tool_training() {
      $this->data['page_title'] = "Gig Swap Tool Training";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('tools/gig_swap/tool_training', $this->data);
      $this->load->view('footer', $this->data);
   }


} /* End of file gig_swap.php */
/* Location: ./application/controllers/tools/gig_swap.php */