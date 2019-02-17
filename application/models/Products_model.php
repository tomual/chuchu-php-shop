<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('id');
        $this->db->from('products');
        $results = $this->db->get()->result();

        return $results;
    }

    public function get($id) {
        $this->db->where('id', $id);
        $this->db->from('products');
        $result = $this->db->get()->first_row();

        return $result;
    }

    public function get_details($id) {
        $this->db->where('product_id', $id);
        $this->db->from('product_details');
        $result = $this->db->get()->first_row();

        return $result;
    }
}
