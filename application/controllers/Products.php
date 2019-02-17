<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	public function _remap($method, $params = array())
	{
		if (!empty($params[0])) {
			$this->view($params[0]);
		}
	}

	public function view($id)
	{
		$product = $this->products_model->get($id);
		$details = $this->products_model->get_details($id);

		$this->load->view('products/view', compact('product', 'details'));
	}
}
