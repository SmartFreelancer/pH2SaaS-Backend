<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Statistic_mdl extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->stats_db = $this->load->database('stats', true);
    }

    function add_billing_cron($data) {
        $this->stats_db->insert('stats_billing', $data);
        return $this->stats_db->insert_id();
    }

    function add_jvzoo($data) {
        $this->stats_db->insert('stats_jvdata', $data);
        return $this->stats_db->insert_id();
    }

    function update_jvzoo($where, $data) {
        $this->stats_db->where($where);
        $this->stats_db->update('stats_jvdata', $data);
        return $this->stats_db->affected_rows();
    }

}
