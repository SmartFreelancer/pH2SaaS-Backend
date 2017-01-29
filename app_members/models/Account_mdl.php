<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function update_members($data, $where) {
        $this->db->update('members', $data, $where);
        return $this->db->affected_rows();
    }

} /* End of file Account_mdl.php */
/* Location: ./application/models/Account_mdl.php */