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
        $pagination = array('total' => count($products), 'limit' => PER_PAGE);
        $products = $this->paginate($products);

		$this->load->view('all', compact('products', 'pagination'));
	}

	public function category($category)
	{
		echo $category;
	}

    public function paginate($results)
    {
        $page = $this->input->get('page');
        $offset = ($page - 1) * PER_PAGE;
        $length = PER_PAGE;
        $pages = ceil(count($results) / $length);
        if($page)
        {
            return array_slice($results, $offset, $length);

        }
        return array_slice($results, 0, $length);
    }
}
