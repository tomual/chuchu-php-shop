<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skus_model extends CI_Model {

    public function fetch_from_stripe() {
        \Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
        $skus = \Stripe\SKU::all(["limit" => 100]);
        return $skus;
    }

    public function find($product_id, &$skus) 
    {
        foreach ($skus['data'] as $index => $sku) {
            if ($sku['product'] == $product_id) {
                return $sku;
            }
        }
    }

    public function get($id) {
        $this->db->where('id', $id);
        $this->db->from('skus');
        $result = $this->db->get()->first_row();

        return $result;
    }

    public function get_by_product($product_id) {
        $this->db->where('product', $product_id);
        $this->db->from('skus');
        $result = $this->db->get()->result();

        return $result;
    }

    public function get_new_display_sku($product_id) {
        $skus = $this->get_by_product($product_id);
        if ($skus) {
            return $skus[0]->id;
        }
    }

    public function add($data)
    {
        $this->db->insert('skus', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('skus', $data);
    }
}
