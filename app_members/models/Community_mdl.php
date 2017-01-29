<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->comm_db = $this->load->database('comm', true);
    }

    public function count_questions($where) {
        $this->comm_db->from('cm_questions');
        $this->comm_db->where($where);
        $query = $this->comm_db->count_all_results();
        return $query;
    }

    public function get_questions($where, $limit, $start, $ob_field, $ob_order) {
        $this->comm_db->from('cm_questions');
        $this->comm_db->where($where);
        $this->comm_db->order_by($ob_field, $ob_order);
        $this->comm_db->limit($limit, $start);
        $query = $this->comm_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                //format date
                $row['date_asked'] = gmdate('F d, Y', $row['date_asked']);

                //format author
                $user_data = $this->ion_auth->user($row['author_usid'])->row();
                $row['author'] = $user_data->username;

                //format user avatar
                $row['author_avatar'] = $user_data->avatar;

                //format vote count
                $row['vote_count'] = $this->count_vote_tracking(array('question_id'=> $row['question_id']));

                $list[] = $row;
            }
        } else {
            $list = false;
        }
        return $list;
    }

   public function get_question_byid($where) {
      $query = $this->comm_db->get_where('cm_questions', $where);
      if ($query->num_rows() > 0) {
         $row = $query->row();
                //format date
                $row->date_asked = gmdate('F d, Y', $row->date_asked);

                //format author
                $user_data = $this->ion_auth->user($row->author_usid)->row();
                $row->author = $user_data->username;
                $row->author_avatar = $user_data->avatar;

         $list = $row;
      } else {
         $list = false;
      }
      return $list;
   }

   public function get_answers_byid($where) {
      $query = $this->comm_db->get_where('cm_answers', $where);
      if ($query->num_rows() > 0) {
         $row = $query->row();

         $list = $row;
      } else {
         $list = false;
      }
      return $list;
   }

   public function add_question($data) {
      $this->comm_db->insert('cm_questions', $data);
      return $this->comm_db->insert_id();
   }

    public function update_questions($data, $where) {
      $this->comm_db->update('cm_questions', $data, $where);
      return $this->comm_db->affected_rows();
   }

   public function add_answer($data) {
      $this->comm_db->insert('cm_answers', $data);
      return $this->comm_db->insert_id();
   }

    public function count_answers($where) {
        $this->comm_db->from('cm_answers');
        $this->comm_db->where($where);
        $query = $this->comm_db->count_all_results();
        return $query;
    }

   public function get_answers($where, $limit, $start) {
        $this->comm_db->from('cm_answers');
        $this->comm_db->where($where);
        $this->comm_db->limit($limit, $start);
        $query = $this->comm_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                //format date
                $row['date_ans'] = gmdate('F d, Y', $row['date_ans']);

                // add vote option
                $user = $this->ion_auth->user()->row();
                if ($row['author'] == $user->id) {
                    $row['vote_option'] = '<span class="label label-warning">Your Answer</span>';
                } else {
                    $user_vote = $this->count_vote_tracking(array('ans_id'=> $row['ans_id'], 'usid'=> $user->id));
                    if ($user_vote == 0) {
                        $row['vote_option'] = sprintf('<button id="%s" class="btn btn-success btn-circle vote-up-btn"><i class="fa fa-chevron-up fa-lg"></i></button>&nbsp;&nbsp;<button id="%s" class="btn btn-danger btn-circle vote-down-btn"><i class="fa fa-chevron-down fa-lg"></i></button>', $row['ans_id'], $row['ans_id']);
                    } else {
                        $row['vote_option'] = '<span class="label label-primary">Already Voted</span>';
                    }
                }

                //format author
                $user_data = $this->ion_auth->user($row['author'])->row();
                $row['author'] = $user_data->username;
                $row['author_avatar'] = $user_data->avatar;

                $list[] = $row;
            }
        } else {
            $list = FALSE;
        }
        return $list;
    }

    public function update_answers($data, $where) {
      $this->comm_db->update('cm_answers', $data, $where);
      return $this->comm_db->affected_rows();
   }

    public function get_categories($where, $ob_field, $ob_order) {
        $this->comm_db->from('cm_category');
        $this->comm_db->where($where);
        $this->comm_db->order_by($ob_field, $ob_order);
        $query = $this->comm_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                $list[] = $row;
            }
        } else {
            $list = FALSE;
        }
        return $list;
    }

    public function get_category_byid($where) {
      $query = $this->comm_db->get_where('cm_category', $where);
      if ($query->num_rows() > 0) {
         $row = $query->row();

         $list = $row;
      } else {
         $list = FALSE;
      }
      return $list;
   }

    public function update_category($data, $where) {
      $this->comm_db->update('cm_category', $data, $where);
      return $this->comm_db->affected_rows();
   }

   public function add_vote_tracking($data) {
      $this->comm_db->insert('cm_vote_tracking', $data);
      return $this->comm_db->insert_id();
   }

   public function count_vote_tracking($where) {
       $this->comm_db->from('cm_vote_tracking');
       $this->comm_db->where($where);
        $query = $this->comm_db->count_all_results();
        return $query;
   }


} /* End of file Community_mdl.php */
/* Location: ./application/controllers/Community_mdl.php */