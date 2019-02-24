<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function get($session_id = null) {
        if (!$session_id) {
            $session_id = $this->session->session_id;
        }
        $this->db->where('session_id', $session_id);
        $this->db->from('cart');
        $this->db->join('products', 'cart.product_id = products.id', 'left');
        $results = $this->db->get()->result();

        return $results;
    }

    public function add($data) {
        $session_id = $data['session_id'];
        $product_id = $data['product_id'];
        if (!$item = $this->in_cart($session_id, $product_id)) {
            $this->db->insert('cart', $data);
            $this->add_cart_count(1);
            return $this->db->insert_id();
        } else {
            unset($item->id);
            $item->quantity++;
            $this->db->where('session_id', $session_id);
            $this->db->where('product_id', $product_id);
            $this->db->update('cart', $item);
        }
    }

    public function in_cart($session_id, $product_id) {
        if ($session_id) {
            $session_id = $this->session->session_id;
        }
        $this->db->where('session_id', $session_id);
        $this->db->where('product_id', $product_id);
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
}
