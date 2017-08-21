<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gig_analyzer_mdl extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tl_db = $this->load->database('tl', true);
    }

    //----- status field
    // 0 - Pending
    // 1 - Perfect (moderate and okay)
    // 2 - Rejected (moderate need changes)
    // 3 - Re-submitted

    //------ mod_status field
    // 0 = Open
    // 1 = Being Moderated
    // 2 = Moderated

    public function submit_gig($data)
    {
        $this->tl_db->insert('tl_gig_analyzer', $data);
        return $this->tl_db->insert_id();
    }

    public function gig_callback_check($where)
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->where($where);
        $query = $this->tl_db->count_all_results();
        return $query;
    }

    public function get_all_gigs()
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->order_by("date_submitted", "desc");
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {

                //format title
                $user_data = $this->ion_auth->user($row['usid'])->row();
                $row['title'] = sprintf('%s<br><small class="text-muted"><i>Gig Owner: %s<i></small>', $row['title'], $user_data->username);

                // format date
                $row['date_submitted'] = gmdate('m-d-Y', $row['date_submitted']);

                // format gig status
                if ($row['status'] == "1") {
                    $row['status'] = "<span class='label label-success'>Approved</span>";
                } else if ($row['status'] == "2") {
                    $row['status'] = "<span class='label label-danger'>Improvement</span>";
                } else if ($row['status'] == "3") {
                    $row['status'] = "<span class='label label-info'>Re-Submitted</span>";
                } else {
                    $row['status'] = "<span class='label label-warning'>Pending</span>";
                }

                //format mod status
                if ($row['mod_status'] == "2") {
                    $row['mod_status'] = "<span class='label label-success'>Moderated</span>";
                } else if ($row['mod_status'] == "1") {
                    $row['mod_status'] = "<span class='label label-primary'>Being Moderated</span>";
                } else {
                    $row['mod_status'] = "<span class='label label-danger'>Pending Moderation</span>";
                }

                // format date
                if (empty($row['mod_date'])) {
                    $row['mod_date'] = ' ';
                } else {
                    $row['mod_date'] = gmdate('m-d-Y', $row['mod_date']);
                }

                //get moderator name
                if ($row['mod_user'] == 0) {
                    $row['mod_user'] = ' ';
                } else {
                    $mod_user_data = $this->ion_auth->user($row['mod_user'])->row();
                    $row['mod_user'] = "<strong>" . $mod_user_data->username . "</strong>";
                }

                //fiverr link
                $row['fiverr_link'] = sprintf("<a href='%s' target='_blank' class='btn btn-xs btn-default pull-right'><i class='fa fa-external-link'></i> View on Fiverr</a>", $row['gig_url']);

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '<h2>You do not have any gig listed at the moment.</h2> <a class="btn btn-primary" href="' . base_url() . 'tools/gig_analyzer/submit_gig"><i class="fa fa-paper-plane"></i> Submit a Gig</a>', 'internal_link' => '', 'title' => '', 'date_submitted' => '', 'status' => '');
        }
        return $list;
    }

    public function get_user_gigs($where)
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->where($where);
        $this->tl_db->order_by("date_submitted", "desc");
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                // format date
                $row['date_submitted'] = gmdate('F j, Y &#97;&#116; H:sa', $row['date_submitted']);

                $row['internal_link'] = sprintf('<a href="' . base_url() . 'tools/gig_analyzer/submitted_gigs/%s" class="btn btn-primary btn-xs">Click Here To View Your Gig</a>', $row['id']);

                // format status
                if ($row['status'] == "1") {
                    $row['status'] = "<span class='label label-success'>Approved</span>";
                } else if ($row['status'] == "2") {
                    $row['status'] = "<span class='label label-danger'>Improvement</span>";
                } else if ($row['status'] == "3") {
                    $row['status'] = "<span class='label label-info'>Re-Submitted</span>";
                } else {
                    $row['status'] = "<span class='label label-warning'>Pending</span>";
                }

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '<h2>You do not have any gig listed at the moment.</h2> <a class="btn btn-primary" href="' . base_url() . 'tools/gig_analyzer/submit_gig"><i class="fa fa-paper-plane"></i> Submit a Gig</a>', 'internal_link' => '', 'title' => '', 'date_submitted' => '', 'status' => '');
        }
        return $list;
    }

    public function get_user_gigs_intro($where, $limit)
    {
        $query = $this->tl_db->get_where('tl_gig_analyzer', $where, $limit, '0');
        if ($query->num_rows() > 0) {
            $list = array();

            foreach ($query->result_array() as $row) {
                $row['date_ago'] = timespan($row['date_submitted'], time()) . " Ago";

                $row['internal_link'] = sprintf('<a href="' . base_url() . 'tools/gig_analyzer/submitted_gigs/%s" class="btn btn-default btn-xs">Click Here To View Your Gig</a>', $row['id']);

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '<h2>You do not have any gig listed at the moment.</h2>', 'date_ago' => '', 'internal_link' => '', 'title' => '');
        }
        return $list;
    }

    public function get_gig_byid($where)
    {
        $query = $this->tl_db->get_where('tl_gig_analyzer', $where);
        return $query->row();
    }

    public function user_gig_stats($where)
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->where($where);;
        $query = $this->tl_db->count_all_results();
        return $query;
    }

    public function update_gig($data, $where)
    {
        $this->tl_db->update('tl_gig_analyzer', $data, $where);
        return $this->tl_db->affected_rows();
    }


    /* Admin functions */
    public function acp_get_gigs($where)
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->where($where);
        $this->tl_db->order_by("date_submitted", "asc");
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {
                // format date
                $row['date_submitted'] = gmdate('m-d-Y', $row['date_submitted']);

                // action button
                $row['action'] = sprintf('<a href="' . base_url() . 'admin/gig-analyzer/moderation/%s" class="btn btn-primary"><i class="fa fa-flag"></i> Moderate</a>', $row['id']);

                // mod status
                if ($row['mod_status'] == 1) {
                    $row['mod_status'] = '<span class="label label-danger">Being Moderated</span>';
                } else {
                    $row['mod_status'] = '<span class="label label-success">Open</span>';
                }

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '', 'title' => '<h2 class="text-center">The moderation queue is empty at the moment.</h2>', 'action' => '', 'date_submitted' => '', 'mod_status' => '');
        }
        return $list;
    }

    public function acp_get_resubmit_gigs($where)
    {
        $this->tl_db->from('tl_gig_analyzer');
        $this->tl_db->where($where);
        $this->tl_db->order_by("date_submitted", "asc");
        $query = $this->tl_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {
                // format date
                $row['date_submitted'] = gmdate('m-d-Y', $row['date_submitted']);

                // action button
                $row['action'] = sprintf('<a href="' . base_url() . 'admin/gig-analyzer/resubmit_mod/%s" class="btn btn-primary"><i class="fa fa-flag"></i> Moderate</a>', $row['id']);

                // mod status
                if ($row['mod_status'] == 1) {
                    $row['mod_status'] = '<span class="label label-danger">Being Moderated</span>';
                } else {
                    $row['mod_status'] = '<span class="label label-success">Open</span>';
                }

                $list[] = $row;
            }
        } else {
            $list[] = array('gig_img' => '', 'title' => '<h2 class="text-center">The resubmitted moderation queue is empty at the moment.</h2>', 'action' => '', 'date_submitted' => '', 'mod_status' => '');
        }
        return $list;
    }

} /* End of file Gig_analyzer_mdl.php */
/* Location: ./application/models/Gig_analyzer_mdl.php */