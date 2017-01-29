<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academy_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->acd_db = $this->load->database('acd', true);
    }

    function count_courses($where) {
        $this->acd_db->from('acd_courses');
        $this->acd_db->where($where);
        $query = $this->acd_db->count_all_results();
        return $query;
    }

    function get_courses($where, $limit, $start) {
        $user = $this->ion_auth->user()->row();

        $this->acd_db->from('acd_courses');
        $this->acd_db->where($where);
        $this->acd_db->limit($limit, $start);
        $this->acd_db->order_by("date_added", "desc");
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                //format the course access
                if ($this->ion_auth->get_users_groups($user->id)->row()->id <= $row['privilege']) {
                    $row['privilege'] = '<button class="btn btn-labeled btn-success" type="button" data-placement="top" data-toggle="tooltip" data-original-title="You have full access to this course."> <span class="btn-label"><i class="fa fa-check"></i></span>Access</button>';
                } else {
                    $row['privilege'] = '<button class="btn btn-labeled btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Access to this course is restricted."> <span class="btn-label"><i class="fa fa-question"></i></span>Restricted</button>';
                }

                //format the course progress
                $course_completed = $this->lesson_tracking_check(array('usid' => $user->id, 'track_course_id' => $row['course_id'], 'status' => 2));
                $row['total_lessons'] = $this->count_lessons(array('course_id' => $row['course_id']));
                if ($row['total_lessons'] != 0) {
                    $row['progress'] = round($course_completed / $row['total_lessons'] * 100, 2);
                } else {
                    $row['progress'] = "0";
                }

                $list[] = $row;
            }
        } else {
            $list = false;
        }

        return $list;
    }

    function get_course_byid($where) {
        $user = $this->ion_auth->user()->row();

        $query = $this->acd_db->get_where('acd_courses', $where);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            // Format date added added
            $row->date_added = gmdate('F j, Y', $row->date_added);

          //format the course access
          if ($this->ion_auth->get_users_groups($user->id)->row()->id <= $row->privilege) {
             $row->privilege = '<button class="btn btn-labeled btn-success" type="button" data-placement="top" data-toggle="tooltip" data-original-title="You have full access to this course."> <span class="btn-label"><i class="fa fa-check"></i></span>Access</button>';
             $row->course_access = TRUE;
          } else {
             $row->privilege = '<button class="btn btn-labeled btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Access to this course is restricted."> <span class="btn-label"><i class="fa fa-question"></i></span>Restricted</button>';
             $row->course_access = FALSE;
          }

          //format the course progress
          $course_completed = $this->lesson_tracking_check(array('usid' => $user->id, 'track_course_id' => $row->course_id, 'status' => 2));
          $row->total_lessons = $this->count_lessons(array('course_id' => $row->course_id));
          if ($row->total_lessons != 0) {
                $row->progress = round($course_completed / $row->total_lessons * 100, 2);
            } else {
                $row->progress = "0";
            }

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function get_lessons($where) {
        $this->acd_db->from('acd_lessons');
        $this->acd_db->where($where);
        $this->acd_db->order_by("sort_order", "asc");
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                // format description
                $row['description'] = word_limiter($row['description'], 20);

                $list[] = $row;
            }
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function count_lessons($where) {
        $this->acd_db->from('acd_lessons');
        $this->acd_db->where($where);
        $query = $this->acd_db->count_all_results();
        return $query;
    }

    function start_lesson($where) {
        $this->acd_db->from('acd_lessons');
        $this->acd_db->where($where);
        $this->acd_db->where('sort_order','1');
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function get_lesson_byid($where) {
        $query = $this->acd_db->get_where('acd_lessons', $where);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            // Format date added added
            $row->date_added = gmdate('F j, Y', $row->date_added);

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function lesson_tracking_check($where) {
        $this->acd_db->from('acd_lesson_tracking');
        $this->acd_db->where($where);
        $query = $this->acd_db->count_all_results();
        return $query;
    }

    function get_lesson_tracking($where) {
        $this->acd_db->from('acd_lesson_tracking');
        $this->acd_db->where($where);
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                $list[] = $row;
            }
        } else {
            $list = "";
        }

        return $list;
    }

    function set_lesson_tracking($data) {
        $this->acd_db->insert('acd_lesson_tracking', $data);
        return $this->acd_db->insert_id();
    }

    function update_lesson_tracking($data, $where) {
        $this->acd_db->update('acd_lesson_tracking', $data, $where);
        return $this->acd_db->affected_rows();
    }

    function set_lesson_feedback($data) {
        $this->acd_db->insert('acd_lesson_feedback', $data);
        return $this->acd_db->insert_id();
    }

    function lesson_feedback_check($where) {
        $this->acd_db->from('acd_lesson_feedback');
        $this->acd_db->where($where);
        $query = $this->acd_db->count_all_results();
        return $query;
    }

    function get_lesson_dloads($where) {
        $this->acd_db->from('acd_lesson_downloads');
        $this->acd_db->where($where);
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {

                $list[] = $row;
            }
        } else {
            $list = "";
        }
        return $list;
    }


/*    function get_lessons($where) {
        $user = $this->ion_auth->user()->row();

        $this->acd_db->from('acd_lessons');
        $this->acd_db->join('acd_lesson_tracking', 'acd_lessons.lesson_id=acd_lesson_tracking.track_lesson_id', 'left');
        $this->acd_db->where($where);
        // $this->acd_db->where(array("usid" => 4));
        $query = $this->acd_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                // format date started
                if ($row['date_started'] > 0) {
                    $row['date_started'] = gmdate('F j, Y &#97;&#116; H:sa', $row['date_started']);
                }

                // format date
                if ($row['date_completed'] > 0) {
                    $row['date_completed'] = gmdate('F j, Y &#97;&#116; H:sa', $row['date_completed']);
                }

                //format course tracking
                if ($row['status'] == 1) {
                    $row['tracking'] = "bg-complete";
                } else if ($row['status'] == 2) {
                    $row['tracking'] = "bg-warning";
                } else if ($row['status'] == 3) {
                    $row['tracking'] = "bg-success";
                } else {
                    $row['tracking'] = "bg-blank";
                }

                //format course tracking info
                if ($row['status'] == 1) {
                    $row['tracking_info'] = sprintf('You started this lesson on %s', $row['date_started']);
                } else if ($row['status'] == 2) {
                    $row['tracking_info'] = sprintf('You skipped this lesson on %s', $row['date_started']);
                } else if ($row['status'] == 3) {
                    $row['tracking_info'] = sprintf('You completed this lesson on %s', $row['date_completed']);
                } else {
                    $row['tracking_info'] = "You have not taken this lesson as yet.";
                }

                // format description
                $row['description'] = word_limiter($row['description'], 20);

                $list[] = $row;
            }
        } else {
            $list = "";
        }
        return $list;
    }*/

    function get_lesson_dloads_byid($where) {
        $query = $this->acd_db->get_where('acd_lesson_downloads', $where);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

} /* End of file academy_mdl.php */
/* Location: ./application/controllers/academy_mdl.php */