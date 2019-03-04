<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->library('form_validation');
    }

    public function index() {
    	$this->view();
    }

	public function add()
	{
		$this->form_validation->set_rules('sku_id', 'SKU', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$data = array(
				'session_id' => $this->session->session_id,
				'sku_id' => $this->input->post('sku_id')
			);
			$cart_id = $this->cart_model->add($data);
			redirect('cart');
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}

	public function remove()
	{
		$this->form_validation->set_rules('sku_id', 'SKU', 'required');

		if ($this->form_validation->run() !== FALSE) {
			$cart_id = $this->cart_model->remove($this->session->session_id, $this->input->post('sku_id'));
		}
		redirect('cart');
	}

	public function view() 
	{
		$items = $this->cart_model->get();
		$total = array_sum(array_column($items, 'price')); 
		$this->load->view('cart/view', compact('items', 'total'));
	}
}
