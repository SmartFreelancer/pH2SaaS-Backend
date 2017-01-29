<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_mdl extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    function add_contributor($data) {
        $this->db->insert('contributor_request', $data);
        return $this->db->insert_id();
    }
}
