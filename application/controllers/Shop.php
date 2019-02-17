<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller {

	public function _remap($method)
	{
		if (preg_match('/^category-(.*)/', $method, $matches)) {
            $this->category($matches);
        } else {
            $this->home();
        }
	}

	public function home()
	{
		$products = $this->products_model->get_all();

		$this->load->view('all', compact('products'));
	}

	public function category($category)
	{
		echo $category;
	}
}
