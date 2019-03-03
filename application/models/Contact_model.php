<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public function create($data) {
        $this->db->insert('contact', $data);
        return $this->db->insert_id();
    }
}
