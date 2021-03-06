<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function get($session_id = null) {
        if (!$session_id) {
            $session_id = $this->session->session_id;
        }
        $this->db->where('session_id', $session_id);
        $this->db->from('cart');
        $this->db->join('skus', 'cart.sku_id = skus.id', 'left');
        $this->db->join('products', 'products.id = skus.product', 'left');
        $results = $this->db->get()->result();

        return $results;
    }

    public function add($data) {
        $session_id = $data['session_id'];
        $sku_id = $data['sku_id'];
        if (!$item = $this->in_cart($session_id, $sku_id)) {
            $this->db->insert('cart', $data);
            $this->add_cart_count(1);
            return $this->db->insert_id();
        } else {
            unset($item->id);
            $item->quantity++;
            $this->db->where('session_id', $session_id);
            $this->db->where('sku_id', $sku_id);
            $this->db->update('cart', $item);
        }
        $this->update_session_cart();
    }

    public function remove($session_id, $sku_id) {
        $this->db->where('session_id', $session_id);
        $this->db->where('sku_id', $sku_id);
        $this->db->delete('cart');
        $this->add_cart_count(-1);
        $this->update_session_cart();
    }

    public function in_cart($session_id, $sku_id) {
        if ($session_id) {
            $session_id = $this->session->session_id;
        }
        $this->db->where('session_id', $session_id);
        $this->db->where('sku_id', $sku_id);
        $this->db->from('cart');
        $results = $this->db->get()->first_row();

        return $results ?? false;
    }

    public function add_cart_count($add)
    {
        $cart_count = $this->session->userdata('cart_count');
        if ($cart_count) {
            $this->session->set_userdata('cart_count', $cart_count + $add);
        } else {
            $this->session->set_userdata('cart_count', 1);
        }
    }

    public function update_session_cart()
    {
        $this->session->set_userdata('cart', $this->get());
    }
}
