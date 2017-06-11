<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('account_mdl');
      $this->data['page_header'] = "";
   }

   public function index() {
      $this->data['page_title'] = "Account";

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('account/account_settings', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function upload_avatar() {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){

         $config['upload_path'] = './uploads/avatar/';
         $config['allowed_types'] = 'gif|jpg|png';
         $config['min_width']  = '250';
         $config['min_height']  = '250';
         $config['file_ext_tolower'] = TRUE;
         $config['encrypt_name'] = TRUE;

         $this->load->library('upload', $config);

         if ( ! $this->upload->do_upload()) {

            $error_msg = array('error' => $this->upload->display_errors());
            $remove = array("<p>", "</p>");
            $msg = str_replace($remove, "", $error_msg['error']);

            echo json_encode(array(
               'success'=> false,
               'message'=>$msg
            ));

         } else {

            $user = $this->ion_auth->user()->row();
            $image_data = $this->upload->data();
            $this->img_thumb($image_data);

            $this->account_mdl->update_members(array("avatar" => $image_data['file_name']), array("id" => $user->id));

            // Delete old avatar
            if (file_exists('./uploads/avatar/'. $user->avatar.'')) {
               unlink('./uploads/avatar/'. $user->avatar.'');
            }

            echo json_encode(array(
               'success'=> true,
               'message'=> 'Your avatar has been uploaded successfully.'
            ));
         }
      } else {
         redirect('/', 'refresh');
      }
   }

   private function img_thumb($data) {
      $config['image_library'] = 'gd2';
      $config['source_image'] = $data['full_path'];
      $config['maintain_ratio'] = TRUE;
      $config['width'] = 250;
      $config['height'] = 250;
      $this->load->library('image_lib', $config);
      $this->image_lib->resize();
   }

   public function update_account_info() {
      // only allow access via Ajax request
      if($this->input->is_ajax_request()){
         $user = $this->ion_auth->user()->row();

         $data = array(
               "first_name"=> trim($this->input->post('fname')),
               "last_name"=> trim($this->input->post('lname')),
               "email"=> trim($this->input->post('email'))
            );
         $update_data = $this->account_mdl->update_members($data, array('id'=> $user->id));

         if ($update_data) {
            echo json_encode(array(
               'success'=> true,
               'message'=> 'Your account information was successfully updated.'
            ));
         } else {
            echo json_encode(array(
               'success'=> false,
               'message'=> 'Unable to update your account information at the moment.'
            ));
         }
      } else {
         redirect('/', 'refresh');
      }
   }

   public function change_password() {
      $this->data['page_title'] = "Change Password";

      $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
      $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
      $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

      if ($this->form_validation->run() == false) {

         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
         $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

         $this->load->view('header', $this->data);
         $this->load->view('head_nav', $this->data);
         $this->_render_page('account/change_password', $this->data);
         $this->load->view('footer', $this->data);

      } else {
         $identity = $this->session->userdata('identity');
         $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

         if ($change) {
            //if the password was successfully changed
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->logout();
         } else {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('account/change_password', 'refresh');
         }
      }
   }

   public function register() {
      // check if the user is coming from jvzoo
/*      if( isset( $this->input->post('ctransaction') )) {
         redirect('/'); // redirect to sales page
      }


       $secretKey = "hghjklk";
       $pop = "";
       $ipnFields = array();

       var_dump($this->input->get());

       foreach ($this->input->get() AS $key => $value) {
           if ($key == "cverify") {
               continue;
           }
           $ipnFields[] = $key;
       }
       sort($ipnFields);
       foreach ($ipnFields as $field) {
           // if Magic Quotes are enabled $_POST[$field] will need to be
           // un-escaped before being appended to $pop
           $pop = $pop . $this->input->get($field) . "|";
       }
       $pop = $pop . $secretKey;
       $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
       $calcedVerify = strtoupper(substr($calcedVerify,0,8));
       return $calcedVerify == $this->input->get("cverify");

var_dump($calcedVerify == $this->input->get("cverify"));
*/
      // pre register the user
/*      if($this->jvzipnVerification() == 1)
         //register sale
         if($_POST['ctransaction'] == 'SALE') {
            //execute code when sale has been made
         }
      }*/

/*      $this->data['page_title'] = "Register";
      $this->data['page_header'] = "register";

      $this->load->view('account/header', $this->data);
      $this->_render_page('account/register', $this->data);
      $this->load->view('account/footer', $this->data);*/
   }

   private function jvzipnVerification() {
       $secretKey = "<YOUR_SECRET_KEY>";
       $pop = "";
       $ipnFields = array();
       foreach ($_POST AS $key => $value) {
           if ($key == "cverify") {
               continue;
           }
           $ipnFields[] = $key;
       }
       sort($ipnFields);
       foreach ($ipnFields as $field) {
           // if Magic Quotes are enabled $_POST[$field] will need to be
           // un-escaped before being appended to $pop
           $pop = $pop . $_POST[$field] . "|";
       }
       $pop = $pop . $secretKey;
       $calcedVerify = sha1(mb_convert_encoding($pop, "UTF-8"));
       $calcedVerify = strtoupper(substr($calcedVerify,0,8));
       return $calcedVerify == $_POST["cverify"];
   }


   public function login() {

      if ($this->ion_auth->logged_in()) {
         redirect('dashboard');
      }

      $this->data['page_title'] = "Login";
      $this->data['page_header'] = "login";

      //validate form input
      $this->form_validation->set_rules('identity', 'Identity', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == true) {
         //check to see if the user is logging in
         //check for "remember me"
         $remember = (bool) $this->input->post('remember');

         if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
            //if the login is successful
            //redirect them back to the home page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect('/', 'refresh');
         } else {
            //if the login was un-successful
            //redirect them back to the login page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect('login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
         }
      } else {

         //the user is not logged in so display the login page
         //set the flash data error message if there is one
         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

         $this->load->view('account/header', $this->data);
         $this->_render_page('account/login', $this->data);
         $this->load->view('account/footer', $this->data);
      }
   }


   public function logout() {
      $this->data['page_title'] = "Logout";

      //log the user out
      $logout = $this->ion_auth->logout();

      //redirect them to the login page
      $this->session->set_flashdata('message', $this->ion_auth->messages());
      redirect('/', 'refresh');
   }

   public function forgot_password() {
      $this->data['page_title'] = "Forgot Password";
      $this->data['page_header'] = "forgot-password";

      //setting validation rules by checking wheather identity is username or email
      if($this->config->item('identity', 'ion_auth') == 'username' )
      {
         $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
      }
      else
      {
         $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
      }

      if ($this->form_validation->run() == false) {
         if ( $this->config->item('identity', 'ion_auth') == 'username' ){
            $this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
         } else {
            $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
         }

         //set any errors and display the form
         $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
         $this->load->view('account/header', $this->data);
         $this->_render_page('account/forgot_password', $this->data);
         $this->load->view('account/footer', $this->data);

      } else {
         // get identity from username or email
         if ( $this->config->item('identity', 'ion_auth') == 'username' ){
            $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
         }
         else
         {
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
         }
                  if(empty($identity)) {

                     if($this->config->item('identity', 'ion_auth') == 'username')
                     {
                                   $this->ion_auth->set_message('forgot_password_username_not_found');
                     }
                     else
                     {
                        $this->ion_auth->set_message('forgot_password_email_not_found');
                     }

                      $this->session->set_flashdata('message', $this->ion_auth->messages());
                     redirect("account/forgot_password", 'refresh');
                  }

         //run the forgotten password method to email an activation code to the user
         $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

         if ($forgotten)
         {
            //if there were no errors
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("account/login", 'refresh'); //we should display a confirmation page here instead of the login page
         }
         else
         {
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("account/forgot_password", 'refresh');
         }
      }
   }

   public function reset_password($code = NULL) {
      if (!$code)
      {
         show_404();
      }

      $user = $this->ion_auth->forgotten_password_check($code);

      if ($user)
      {
         //if the code is valid then display the password reset form

         $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
         $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

         if ($this->form_validation->run() == false)
         {
            //display the form

            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $this->data['new_password'] = array(
               'name' => 'new',
               'id'   => 'new',
               'type' => 'password',
               'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['new_password_confirm'] = array(
               'name' => 'new_confirm',
               'id'   => 'new_confirm',
               'type' => 'password',
               'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
            );
            $this->data['user_id'] = array(
               'name'  => 'user_id',
               'id'    => 'user_id',
               'type'  => 'hidden',
               'value' => $user->id,
            );
            $this->data['csrf'] = $this->_get_csrf_nonce();
            $this->data['code'] = $code;

            //render
            $this->load->view('account/header', $this->data);
            $this->_render_page('account/reset_password', $this->data);
            $this->load->view('account/header', $this->data);
         }
         else
         {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
            {

               //something fishy might be up
               $this->ion_auth->clear_forgotten_password_code($code);

               show_error($this->lang->line('error_csrf'));

            }
            else
            {
               // finally change the password
               $identity = $user->{$this->config->item('identity', 'ion_auth')};

               $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

               if ($change)
               {
                  //if the password was successfully changed
                  $this->session->set_flashdata('message', $this->ion_auth->messages());
                  $this->logout();
               }
               else
               {
                  $this->session->set_flashdata('message', $this->ion_auth->errors());
                  redirect('account/reset_password/' . $code, 'refresh');
               }
            }
         }
      }
      else
      {
         //if the code is invalid then send them back to the forgot password page
         $this->session->set_flashdata('message', $this->ion_auth->errors());
         redirect("account/forgot_password", 'refresh');
      }
   }

   function _get_csrf_nonce() {
      $this->load->helper('string');
      $key   = random_string('alnum', 8);
      $value = random_string('alnum', 20);
      $this->session->set_flashdata('csrfkey', $key);
      $this->session->set_flashdata('csrfvalue', $value);

      return array($key => $value);
   }

   function _valid_csrf_nonce() {
      if ($this->input->post($this->session->flashdata('csrfkey')) !== false &&
         $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }

   function _render_page($view, $data=null, $render=false) {

      $this->viewdata = (empty($data)) ? $this->data: $data;

      $view_html = $this->load->view($view, $this->viewdata, $render);

      if (!$render) return $view_html;
   }

}
