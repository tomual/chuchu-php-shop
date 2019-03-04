<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {

    public function index() {
    	$this->load->view('faq');
    }
}
