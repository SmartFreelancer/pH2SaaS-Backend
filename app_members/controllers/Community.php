<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community extends MY_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model('community_mdl');

      $this->data['latest_posts'] = $this->community_mdl->get_questions(array(), 10, 0, 'date_asked', 'desc');
      $this->data['popular_questions'] = $this->community_mdl->get_questions(array(), 6, 0, 'answers', 'desc');
      $this->data['category_list'] = $this->community_mdl->get_categories(array(), 'sort_order', 'asc');
        $this->data['total_unanswered'] = $this->community_mdl->count_questions(array('answers'=> 0));
   }

   public function index() {
       $this->data['page_title'] = "Community - Explore Ask Discover";

        //category list
       $this->data['cat_one'] = $this->community_mdl->get_categories(array('cat_type'=> 0), 'sort_order', 'asc');
        $this->data['cat_two'] = $this->community_mdl->get_categories(array('cat_type'=> 1), 'sort_order', 'asc');
        $this->data['cat_three'] = $this->community_mdl->get_categories(array('cat_type'=> 2), 'sort_order', 'asc');

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('community/main', $this->data);
        $this->load->view('footer', $this->data);
   }

   public function category($cat_id = FALSE) {
       if ($cat_id == FALSE) {
           show_404();
       }

       $this->data['page_title'] = "Categories";

       $this->load->library("pagination");
       $this->load->helper('text');

        $config = array();
        $config["base_url"] = base_url() . "/community/category/".$cat_id."/";
        $config["total_rows"] = $this->community_mdl->count_questions(array('cat_id'=> $cat_id));
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['question_list'] = $this->community_mdl->get_questions(array('cat_id'=> $cat_id), $config["per_page"], $page, "date_asked", "desc");
        $this->data['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('community/category', $this->data);
        $this->load->view('footer', $this->data);
   }

   public function question($question_id = FALSE) {
       if ($question_id == FALSE) {
           show_404();
       }

       $this->data['asked_question'] = $this->community_mdl->get_question_byid(array('question_id'=> $question_id));
       if (empty($this->data['asked_question'])) {
           show_404();
       }

        $this->data['page_title'] = "View Question";
        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = base_url() . "/community/question/".$question_id."";
        $config["total_rows"] = $this->community_mdl->count_answers(array('question_id'=> $question_id));
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['total_answers'] = $this->community_mdl->count_answers(array('question_id'=> $question_id));
        $this->data['answer_list'] = $this->community_mdl->get_answers(array('question_id'=> $question_id), $config["per_page"], $page);
        $this->data['pagination'] = $this->pagination->create_links();


        // update question views
      $views_count = $this->data['asked_question']->views + 1;
        $this->community_mdl->update_questions(array('views' => $views_count), array('question_id'=> $question_id));

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('community/question', $this->data);
        $this->load->view('footer', $this->data);
   }

   public function submit_question() {
       $user = $this->ion_auth->user()->row();
        $data = array(
                    "title"=> trim($this->input->post('title')),
                    "msg"=> trim($this->input->post('msg')),
                   "date_asked"=> time(),
                   "cat_id"=> $this->input->post('category'),
                   "author_usid"=> $user->id
               );

        //update category answers
        $cat_data = $this->community_mdl->get_category_byid(array('cat_id'=> $this->input->post('category')));
        $cat_ans_count = $cat_data->answers + 1;
        $this->community_mdl->update_category(array('answers' => $cat_ans_count), array('cat_id'=> $this->input->post('category')));

      $insert_data = $this->community_mdl->add_question($data);
      if ($insert_data) {
         echo json_encode(array(
            'success'=> true,
            'message'=> 'Your question was successfully submitted.'
         ));
      } else {
         echo json_encode(array(
            'success'=> false,
            'message'=> 'Unable to submit your question at the moment!'
         ));
      }
   }

   public function submit_answer() {
        $user = $this->ion_auth->user()->row();

      //update question answers
      $ans_count_get = $this->community_mdl->get_question_byid(array('question_id'=> $this->input->post('question_id')));
      $answer_count = $ans_count_get->answers + 1;
      $this->community_mdl->update_questions(array('answers' => $answer_count), array('question_id'=> $this->input->post('question_id')));

        $data = array(
                    "question_id"=> $this->input->post('question_id'),
                    "ans_msg"=> trim($this->input->post('ans_msg')),
                   "date_ans"=> time(),
                   "author"=> $user->id
               );

      $insert_data = $this->community_mdl->add_answer($data);
      if ($insert_data) {
         echo json_encode(array(
            'success'=> true,
            'message'=> 'Your answer to this question was successfully submitted.'
         ));
      } else {
         echo json_encode(array(
            'success'=> false,
            'message'=> 'Unable to submit your answer at the moment!'
         ));
      }
   }

   public function add_vote() {
       $user = $this->ion_auth->user()->row();
       $vote_data = $this->community_mdl->get_answers_byid(array('ans_id'=> $this->input->post('ans_id')));
       if ($this->input->post('vote_type') == "positive") {

           //update answer positive vote
          $pos_vote_count = $vote_data->positive_vote + 1;
          $this->community_mdl->update_answers(array('positive_vote' => $pos_vote_count), array('ans_id'=> $this->input->post('ans_id')));

          // add tracking
           $this->community_mdl->add_vote_tracking(array('ans_id'=> $this->input->post('ans_id'), 'usid'=> $user->id, 'question_id'=> $this->input->post('question_id')));

       } else if ($this->input->post('vote_type') == "negative") {

           //update answer positive vote
          $pos_vote_count = $vote_data->negative_vote + 1;
          $this->community_mdl->update_answers(array('negative_vote' => $pos_vote_count), array('ans_id'=> $this->input->post('ans_id')));

          // add tracking
           $this->community_mdl->add_vote_tracking(array('ans_id'=> $this->input->post('ans_id'), 'usid'=> $user->id, 'question_id'=> $this->input->post('question_id')));

       }
   }

   public function user_question() {
       $this->data['page_title'] = "Community - My Question";

       $user = $this->ion_auth->user()->row();
       $this->load->library("pagination");
       $this->load->helper('text');

        $config = array();
        $config["base_url"] = base_url() . "/community/user-question/";
        $config["total_rows"] = $this->community_mdl->count_questions(array('author_usid'=> $user->id));
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
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

        $this->data['question_list'] = $this->community_mdl->get_questions(array('author_usid'=> $user->id), $config["per_page"], $page, "date_asked", "desc");
        $this->data['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('community/user_question', $this->data);
        $this->load->view('footer', $this->data);
   }

   public function unanswered() {
       $this->data['page_title'] = "Community - Unanswered Question";

       $user = $this->ion_auth->user()->row();
       $this->load->library("pagination");
       $this->load->helper('text');

        $config = array();
        $config["base_url"] = base_url() . "/community/unanswered/";
        $config["total_rows"] = $this->community_mdl->count_questions(array('answers'=> 0));
        $config["per_page"] = 10;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
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

        $this->data['question_list'] = $this->community_mdl->get_questions(array('answers'=> 0), $config["per_page"], $page, "date_asked", "desc");
        $this->data['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $this->data);
        $this->load->view('head_nav', $this->data);
        $this->load->view('community/unanswered', $this->data);
        $this->load->view('footer', $this->data);
   }


} /* End of file Community.php */
/* Location: ./application/controllers/Community.php */