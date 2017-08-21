<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tools_mdl extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tl_db = $this->load->database('tl', true);
    }

    // Status Field
    // 0 - Inactive
    // 1 - Active

    // get all the tools by an identifier or get all the tools
    public function get_tools($where)
    {
        $this->tl_db->from('tl_tools_list');
        $this->tl_db->where($where);
        $this->tl_db->order_by("sort_order", "asc");
        $query = $this->tl_db->get();
        return $query->result_array();
    }

    public function get_tools_intro($where, $limit)
    {
        $this->tl_db->from('tl_tools_list');
        $this->tl_db->where($where);
        $this->tl_db->order_by("date_created", "desc");
        $this->tl_db->limit($limit);
        $query = $this->tl_db->get();
        return $query->result_array();
    }

    // get a specific tool by an identifier
    public function get_tool_byid($where)
    {
        $query = $this->tl_db->get_where('tl_tools_list', $where);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }


} /* End of file tools_mdl.php */
/* Location: ./application/controllers/tools_mdl.php */