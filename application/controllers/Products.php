<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller {

	public function _remap($method, $params = array())
	{
		if (!empty($params[0])) {
			$this->view($params[0]);
			return;
		}

		$this->$method();
	}

	public function view($id)
	{
		$product = $this->products_model->get($id);
		$details = $this->products_model->get_details($id);

		$this->load->view('products/view', compact('product', 'details'));
	}

	public function sync()
	{
		$skus = $this->skus_model->fetch_from_stripe();
		$products = $this->products_model->fetch_from_stripe();
		echo "<pre>";
		foreach ($skus['data'] as $index => $stripe_sku) {
			$sku = $this->skus_model->get($stripe_sku->id);
			$this->update_or_add_sku($sku, $stripe_sku);
		}
		foreach ($products['data'] as $index => $stripe_product) {
			$product = $this->products_model->get($stripe_product->id);
			$this->update_or_add_product($product, $stripe_product);
		}
	}

	public function update_or_add_product($product, $stripe_product) {
		if ($product) {
			if ($product->updated != $stripe_product->updated) {
				$data = array(
					'images' => json_encode($stripe_product->images),
					'name' => $stripe_product->name,
					'description' => $stripe_product->description,
					'updated' => $stripe_product->updated,
				);
				if (!$product->display_sku) {
					$data['display_sku'] = $this->skus_model->get_new_display_sku($product->id);
				}
				$product_id = $this->products_model->update($product->id, $data);
			}
		} else {
			$data = array(
				'id' => $stripe_product->id,
				'name' => $stripe_product->name,
				'images' => json_encode($stripe_product->images),
				'description' => $stripe_product->description,
				'display_sku' => $this->skus_model->get_new_display_sku($stripe_product->id),
				'created' => $stripe_product->created,
				'updated' => $stripe_product->updated,
			);
			$product_id = $this->products_model->add($data);
		}
	}

	public function update_or_add_sku($sku, $stripe_sku) {
		if ($sku) {
			if ($sku->updated != $stripe_sku->updated) {
				$data = array(
					'product' => $stripe_sku->product,
					'price' => $stripe_sku->price,
					'inventory_quantity' => $stripe_sku->inventory->quantity,
					'inventory_type' => $stripe_sku->inventory->type,
					'inventory_value' => $stripe_sku->inventory->value,
					'created' => $stripe_sku->created,
					'updated' => $stripe_sku->updated,
				);
				$sku_id = $this->skus_model->update($sku->id, $data);
			}
		} else {
			$data = array(
				'id' => $stripe_sku->id,
				'product' => $stripe_sku->product,
				'price' => $stripe_sku->price,
				'inventory_quantity' => $stripe_sku->inventory->quantity,
				'inventory_type' => $stripe_sku->inventory->type,
				'inventory_value' => $stripe_sku->inventory->value,
				'created' => $stripe_sku->created,
				'updated' => $stripe_sku->updated,
			);
			$sku_id = $this->skus_model->add($data);
		}
	}
}
