<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_mdl extends CI_Model
{

    /******* notifications
    | ---- TYPE notification
    | 1 = general
    | 2 = important
    | 3 = warning
    **********************/

    public function __construct() {
        parent::__construct();
    }

    function add_notify($data) {
        $this->db->insert('notifications', $data);
        return $this->db->insert_id();
    }
}
