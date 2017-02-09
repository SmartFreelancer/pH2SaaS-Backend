<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academy extends MY_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('academy_mdl');
      $this->load->helper('text');
   }

   public function index() {
      $this->data['page_title'] = "Academy";
      $this->load->library("pagination");

      $config = array();
      $config["base_url"] = base_url() . "/academy/index/";
      $config["total_rows"] = $this->academy_mdl->count_courses(array("status" => "1"));
      $config["per_page"] = 12;
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

      $this->data['course_list'] = $this->academy_mdl->get_courses(array("status" => "1"), $config["per_page"], $page);
      $this->data['all_course_pagin'] = $this->pagination->create_links();

      $user = $this->ion_auth->user()->row();
      $user_group = $this->ion_auth->get_users_groups($user->id)->row()->id;
      $this->data['user_course_list'] = $this->academy_mdl->get_courses(array("status" => "1", "privilege >=" => $user_group), "", "");

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('academy/main', $this->data);
      $this->load->view('footer', $this->data);
   }


   public function course($course_id) {
      $this->data['page_title'] = "Course";
      $user = $this->ion_auth->user()->row();

      $this->data['course'] = $this->academy_mdl->get_course_byid(array("course_id" => $course_id));
      $this->data['lessons_list'] = $this->academy_mdl->get_lessons(array("course_id" => $course_id));
      $this->data['start_course'] = $this->academy_mdl->start_lesson(array("course_id" => $course_id));

      $this->load->view('header', $this->data);
      $this->load->view('head_nav', $this->data);
      $this->load->view('academy/course', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function lesson($course_id, $lesson_id) {
      $this->data['page_title'] = "Lesson";
      $user = $this->ion_auth->user()->row();

      // check if the user has rights to view this lesson
      $lesson_parent = $this->academy_mdl->get_course_byid(array("course_id" => $course_id));
      if ($lesson_parent->course_access == FALSE) {
         redirect('account-upgrade', 'refresh');
      }

      $this->data['current_lesson'] = $this->academy_mdl->get_lesson_byid(array("lesson_id" => $lesson_id));
      $this->data['lessons_list'] = $this->academy_mdl->get_lessons(array("course_id" => $course_id));
      $this->data['lessons_dloads'] = $this->academy_mdl->get_lesson_dloads(array("dl_lesson_id" => $lesson_id));

      //Next lession ID
      $next_lesson_data = $this->academy_mdl->get_lesson_byid(array("lesson_id >" => $lesson_id, "course_id" => $course_id));
      if ($next_lesson_data ==  TRUE) {
         $this->data['next_lesson_id'] = $next_lesson_data->lesson_id;
      } else {
         $this->data['next_lesson_id'] = "0";
      }

      //Prev lession ID
      $prev_lesson_data = $this->academy_mdl->get_lesson_byid(array("lesson_id <" => $lesson_id, "course_id" => $course_id));
      if ($prev_lesson_data ==  TRUE) {
         $this->data['prev_lesson_id'] = $prev_lesson_data->lesson_id;
      } else {
         $this->data['prev_lesson_id'] = "0";
      }

      //check to see if the user gave a feedback for this course before
      $this->data['lesson_feedback'] = $this->academy_mdl->lesson_feedback_check(array("fb_course_id" => $course_id, "usid" => $user->id));

      // check to see if the user already started this lesson
      $lesson_started = $this->academy_mdl->lesson_tracking_check(array("track_lesson_id" => $lesson_id, "usid" => $user->id));
       // Set the lesson tracking data
      if ($lesson_started == 0) {
         $this->academy_mdl->set_lesson_tracking(array("track_lesson_id" => $lesson_id, "track_course_id" => $course_id, "status" => 1,"usid" => $user->id, "date_started" => time()));
      }

      $this->load->view('header', $this->data);
      $this->load->view('academy/lesson', $this->data);
      $this->load->view('footer', $this->data);
   }

   public function lesson_tracking() {
      // only allow access via Ajax request
      if ($this->input->is_ajax_request()){
         // Update the user lesson tracking table
         $data = array(
            'status' => $this->input->post('status'),
            'date_completed' => time()
         );
         $this->academy_mdl->update_lesson_tracking($data, array(
            'usid' => $this->input->post('usid'),
            'track_lesson_id' => $this->input->post('lesson_id')
         ));
      } else {
         redirect('/', 'refresh');
      }
   }

   public function lesson_feedback() {
      // only allow access via Ajax request
      if ($this->input->is_ajax_request()){
         // Update the user lesson tracking table
         $feedback = $this->input->post('feedback');
         if (empty($feedback)) {
            $feedback = "It was awesome!!!";
         }
         $data = array(
            'usid' => $this->input->post('usid'),
            'fb_course_id' => $this->input->post('course_id'),
            'feedback' => $feedback,
            'date' => time()
         );
         $this->academy_mdl->set_lesson_feedback($data);
      } else {
         redirect('/', 'refresh');
      }
   }

   public function download($download_id) {
      $get_download = $this->academy_mdl->get_lesson_dloads_byid(array("dl_id" => $download_id));
      $this->load->helper('download');

      $data = file_get_contents('uploads/academy/downloads/' . $get_download->dload_link);
      $name = $get_download->title.".".$get_download->extension."";
      force_download($name, $data);
   }


} /* End of file academy.php */
/* Location: ./application/controllers/academy.php */