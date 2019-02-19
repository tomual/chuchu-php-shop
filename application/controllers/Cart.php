<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->library('form_validation');
    }

	public function add()
	{
		$this->form_validation->set_rules('product_id', 'Product ID', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'session_id' => $this->session->session_id,
				'product_id' => $this->input->post('product_id')
			);
			$cart_id = $this->cart_model->add($data);
			$this->view();
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}

	public function view() 
	{
		$products = $this->cart_model->get();
		$this->load->view('cart/view', compact('products'));
	}
}
