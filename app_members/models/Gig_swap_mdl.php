<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gig_swap_mdl extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tl_db = $this->load->database('tl', true);
    }

    // ----- claim status field
    // 0 - pending claim
    // 1 - claim

    public function swap_callback_check($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->where($where);
        $query = $this->tl_db->count_all_results();
        return $query;
    }

    public function count_swaps($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->where($where);
        $query = $this->tl_db->count_all_results();
        return $query;
    }

    public function add_gig_swap($data)
    {
        $this->tl_db->insert('tl_gig_swap_queue', $data);
        return $this->tl_db->insert_id();
    }

    public function get_swap_byid($where)
    {
        $query = $this->tl_db->get_where('tl_gig_swap_queue', $where);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    public function update_gig_queue($data, $where)
    {
        $this->tl_db->update('tl_gig_swap_queue', $data, $where);
        return $this->tl_db->affected_rows();
    }

    public function add_gig_claim($data)
    {
        $this->tl_db->insert('tl_gig_swap_claim', $data);
        return $this->tl_db->insert_id();
    }

    public function count_cliams($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->join('tl_gig_swap_claim', 'tl_gig_swap_queue.swap_id=tl_gig_swap_claim.gig_swap_id', 'left');
        $this->tl_db->where($where);
        $query = $this->tl_db->count_all_results();
        return $query;
    }

    public function get_swap_cliams($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->join('tl_gig_swap_claim', 'tl_gig_swap_queue.swap_id=tl_gig_swap_claim.gig_swap_id', 'left');
        $this->tl_db->where($where);
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {
                // format ation
                $row['action'] = sprintf('<a href="%stools/gig-swap/to-purchase-view/%s/%s" class="btn btn-primary">View Gig Details</a>', base_url(), $row['swap_id'], $row['gig_claim_id']);

                // format status msg
                $claim_gig = $this->get_swap_cliams_byid(array('swap_id' => $row['gig_claim_id']));
                $system_verified = $claim_gig->system_verified + $row['system_verified'];

                if ($system_verified == 2) {
                    $row['status_msg'] = '<span class="label label-success" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> Swap is completed and verified.</span>';
                } else if ($system_verified == 1) {
                    $row['status_msg'] = '<span class="label label-warning" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Both parties made a purchase waiting on the final system verification.</span>';
                } else {
                    if ($row['purchase_status'] == 1) {
                        $row['status_msg'] = '<span class="label label-info" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> You have made a purchase.</span>';
                    } else {
                        $row['status_msg'] = '<span class="label label-danger" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> You need to purchase this gig.</span>';
                    }
                }

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '<h2>Your to purchase list is empty at the moment.</h2>', 'gig_title' => '', 'action' => '', 'status_msg' => '');
        }
        return $list;
    }

    public function get_swap_cliams_byid($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->join('tl_gig_swap_claim', 'tl_gig_swap_queue.swap_id=tl_gig_swap_claim.gig_swap_id', 'left');
        $this->tl_db->where($where);
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    public function update_gig_claim($data, $where)
    {
        $this->tl_db->update('tl_gig_swap_claim', $data, $where);
        return $this->tl_db->affected_rows();
    }

    public function get_user_swap($where)
    {
        $this->tl_db->from('tl_gig_swap_queue');
        $this->tl_db->join('tl_gig_swap_claim', 'tl_gig_swap_queue.swap_id=tl_gig_swap_claim.gig_swap_id', 'left');
        $this->tl_db->where($where);
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {
                // format queue pending date
                $row['pending_date'] = "Pending Since: " . timespan($row['date_submitted'], time()) . " Ago";

                // format swapped date
                $row['swapped_date'] = "Swapped Date: " . gmdate('F j, Y &#97;&#116; H:sa', $row['date_swapped']);

                // format status msg
                $claim_gig = $this->get_swap_cliams_byid(array('swap_id' => $row['swap_id']));
                $system_verified = $claim_gig->system_verified + $row['system_verified'];

                if ($system_verified == 2) {
                    $row['status_msg'] = '<span class="label label-success" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> Swap is completed and verified.</span>';
                } else if ($system_verified == 1) {
                    $row['status_msg'] = '<span class="label label-warning" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Both parties made a purchase waiting on the final system verification.</span>';
                } else {
                    if ($row['purchase_status'] == 1) {
                        $row['status_msg'] = '<span class="label label-info" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-check"></i> The swapper purchased your gig.</span>';
                    } else {
                        $row['status_msg'] = '<span class="label label-danger" style="font-weight: 700; font-size: 12.5px"><i class="fa fa-clock-o"></i> Waiting on the swapper to purchase.</span>';
                    }
                }

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '<h2>You do not have any gig listed at the moment.</h2>', 'gig_title' => '', 'swapped_date' => '', 'status_msg' => '', 'pending_date' => '');
        }
        return $list;
    }


} /* End of file Gig_swap_mdl.php */
/* Location: ./application/models/Gig_swap_mdl.php */