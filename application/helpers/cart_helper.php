<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function in_cart($sku_id) {
    $ci =& get_instance();
    foreach ($ci->session->userdata('cart') as $item) {
        if ($item->display_sku == $sku_id) {
            return true;
        }
    }
    return false;
}