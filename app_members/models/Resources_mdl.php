<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Resources_mdl extends CI_Model
{

    // status - field
    // 0 - active
    // 1 - disabled

    public function __construct()
    {
        parent::__construct();
    }

    public function count_resources()
    {
        $this->db->from('resources');
        $this->db->where('status', '0');
        $query = $this->db->count_all_results();
        return $query;
    }

    function get_resources($where, $limit, $start)
    {
        $this->db->from('resources');
        $this->db->where($where);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                // format the link
                $row['link'] = sprintf("<a href='%s' target='_blank' type='button' class='btn %s btn-lg btn-block'>%s</a>", $row['link_url'], $row['btn_style'], $row['link_name']);

                // format the video
                $row['video'] = sprintf("<iframe class='embed-responsive-item' src='%s'></iframe>", $row['intro_video']);

                // format the link
                $row['modal_link'] = sprintf("<a href='%s' target='_blank' type='button' class='btn %s btn-lg'>%s</a>", $row['link_url'], $row['btn_style'], $row['link_name']);

                $list[] = $row;
            }
        } else {
            $list = false;
        }
        return $list;
    }


} /* End of file resources_mdl.php */
/* Location: ./application/controllers/resources_mdl.php */