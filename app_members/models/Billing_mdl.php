<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Billing_mdl extends CI_Model
{

    /******* invoices
     * | ---- STATUS field
     * | 0 = unpaid
     * | 1 = paid
     **********************/

    /******* invoices & membership_cycle
     * | ---- SCAN field
     * | 0 = do not scan
     * | 1 = can scan
     **********************/

    /******* membership_plans
     * | ---- TYPE field
     * | 0 = membership
     * |
     * | ---- STATUS field
     * | 0 = inactive
     * | 1 = active
     **********************/

    public function __construct()
    {
        parent::__construct();
        $this->billing_db = $this->load->database('billing', true);
    }

    function add_invoice($data)
    {
        $this->billing_db->insert('invoices', $data);
        return $this->billing_db->insert_id();
    }

    function update_invoice($where, $data)
    {
        $this->billing_db->where($where);
        $this->billing_db->update('invoices', $data);
        return $this->billing_db->affected_rows();
    }

    function get_invoices($where)
    {
        $this->billing_db->from('invoices');
        $this->billing_db->where($where);
        $query = $this->billing_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {
                // Format date
                $row['date_generated'] = date('M j, Y', $row['date_generated']);
                if ($row['date_due'] != "0000-00-00") {
                    $due_date = strtotime($row['date_due']);
                    $row['date_due'] = date('M j, Y', $due_date);
                }

                // Format payment status
                if ($row['status'] == 1) {
                    $row['p_status'] = "PAID";
                } else {
                    $row['p_status'] = "UNPAID";
                }

                $list[] = $row;
            }
        } else {
            $list = false;
        }
        return $list;
    }

    function get_invoice_byid($where)
    {
        $this->billing_db->from('invoices');
        $this->billing_db->where($where);
        $query = $this->billing_db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();

            // Format date
            $row->date_generated = date('M j, Y', $row->date_generated);
            if ($row->date_due != "0000-00-00") {
                $due_date = strtotime($row->date_due);
                $row->date_due = date('M j, Y', $due_date);
            }

            // Format payment status
            if ($row->status == 1) {
                $row->p_status = "PAID";
            } else {
                $row->p_status = "UNPAID";
            }

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function get_mbship_cycle($where)
    {
        $this->billing_db->from('membership_cycle');
        $this->billing_db->where($where);
        $query = $this->billing_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                $list[] = $row;
            }
        } else {
            $list = false;
        }
        return $list;
    }

    function update_mbship_cycle($where, $data)
    {
        $this->billing_db->where($where);
        $this->billing_db->update('membership_cycle', $data);
        return $this->billing_db->affected_rows();
    }

    function add_mbship_cycle($data)
    {
        $this->billing_db->insert('membership_cycle', $data);
        return $this->billing_db->insert_id();
    }

    function get_mbship_plans($where)
    {
        $this->billing_db->from('membership_plans');
        $this->billing_db->where($where);
        $this->billing_db->order_by("sort_order", "asc");
        $query = $this->billing_db->get();
        if ($query->num_rows() > 0) {
            $list = array();
            foreach ($query->result_array() as $row) {

                $list[] = $row;
            }
        } else {
            $list = false;
        }
        return $list;
    }

    function get_mbship_plan_byid($where)
    {
        $this->billing_db->from('membership_plans');
        $this->billing_db->where($where);
        $query = $this->billing_db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();

            // Format the member roles
            $row->member_role = json_decode($row->member_role, true);

            $list = $row;
        } else {
            $list = FALSE;
        }
        return $list;
    }

    function remove_lead($where)
    {
        $this->billing_db->delete('leads', $where);
        return $this->billing_db->affected_rows();
    }

    function add_payment($data)
    {
        $this->billing_db->insert('payments', $data);
        return $this->billing_db->insert_id();
    }

    public function pre_register($member_roles)
    {
        $members_data = array('ip_address' => $this->input->ip_address(), 'created_on' => time(), 'active' => 1, 'membership_payment' => 1);

        // Add the user
        $this->db->insert('members', $members_data);
        $user_id = $this->db->insert_id();

        // Set the user membership levels
        foreach ($member_roles as $role) {
            $this->ion_auth_model->add_to_group($role, $user_id);
        }

        $this->session->set_userdata('reg_userid', $user_id);
    }
}
