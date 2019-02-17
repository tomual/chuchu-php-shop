<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    public function get_all() {
        $this->db->order_by('product_id');
        $this->db->from('products');
        $results = $this->db->get()->result();

        return $results;
    }
}
