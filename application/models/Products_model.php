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

    public function fetch_products() {
        \Stripe\Stripe::setApiKey("sk_test_2sN94fTZ5N8sC2y2oB6AjOru");
        $products = \Stripe\Product::all(["limit" => 3]);
        return $products;
    }
}
