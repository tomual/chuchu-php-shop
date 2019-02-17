<?php
defined('BASEPATH') OR exit('No direct script access allowed');

const PER_PAGE = 20;

class Products_model extends CI_Model {

    public function get_all() {
        $this->db->offset(0);
        $this->db->limit(PER_PAGE);
        $this->db->order_by('product_id');
        $this->db->from('products');
        $results = $this->db->get()->result();

        return $results;
    }
}
