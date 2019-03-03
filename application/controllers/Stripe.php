<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends MY_Controller {

	public function sync()
	{
		$skus = $this->skus_model->fetch_from_stripe();
		$products = $this->products_model->fetch_from_stripe();
		foreach ($skus['data'] as $index => $stripe_sku) {
			$sku = $this->skus_model->get($stripe_sku->id);
			$this->update_or_add_sku($sku, $stripe_sku);
		}
		foreach ($products['data'] as $index => $stripe_product) {
			$product = $this->products_model->get($stripe_product->id);
			$this->update_or_add_product($product, $stripe_product);
		}
	}

	private function update_or_add_product($product, $stripe_product) 
	{
		pretty_print($product);
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

	private function update_or_add_sku($sku, $stripe_sku) 
	{
		if ($sku) {
			if ($sku->updated != $stripe_sku->updated) {
				$data = array(
					'product' => $stripe_sku->product,
					'price' => $stripe_sku->price,
					'inventory_quantity' => $stripe_sku->inventory->quantity,
					'inventory_type' => $stripe_sku->inventory->type,
					'inventory_value' => $stripe_sku->inventory->value,
					'image' => $stripe_sku->image,
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
					'image' => $stripe_sku->image,
				'created' => $stripe_sku->created,
				'updated' => $stripe_sku->updated,
			);
			$sku_id = $this->skus_model->add($data);
		}
	}

	public function populate()
	{
		\Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
		$products = [
			[
				"name" => 'Cartoon Print Sandal',
				"type" => "good",
				"description" => "Comfortable cotton t-shirt",
				"attributes" => ["size"],
				"images" => [
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042324126608455_im_405x552.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042312389725820_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042311883116080_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042321188111914_im_600x799.jpg"
				]
			],
			[
				"name" => 'Color Block Tunic Tee',
				"type" => "good",
				"description" => "Comfortable cotton t-shirt",
				"attributes" => ["size"],
				"images" => [
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042324126608455_im_405x552.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042312389725820_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042311883116080_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042321188111914_im_600x799.jpg"
				]
			],
			[
				"name" => 'Green Mystery Notebook',
				"type" => "good",
				"description" => "Comfortable cotton t-shirt",
				"attributes" => ["size"],
				"images" => [
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042324126608455_im_405x552.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042312389725820_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042311883116080_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042321188111914_im_600x799.jpg"
				]
			],
			[
				"name" => 'Cash Print Leggings',
				"type" => "good",
				"description" => "Comfortable cotton t-shirt",
				"attributes" => ["color", "size"],
				"images" => [
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042324126608455_im_405x552.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042312389725820_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042311883116080_im_600x799.jpg",
					"https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042321188111914_im_600x799.jpg"
				]
			]
		];

		$stripe_products = array();

		foreach ($products as $product) {
			$stripe_products[] = \Stripe\Product::create($product);
		}

		foreach ($stripe_products as $product) {
			$sku = [
				"product" => $product->id,
				"attributes" => array(),
				"price" => 1500,
				"currency" => "aud",
				"image" => "https://img.ltwebstatic.com/origin/images2_pi/2018/11/12/15420042324126608455_im_405x552.jpg",
				"inventory" => [
					"type" => "finite",
					"quantity" => 500
				]
			];

			if ($product->attributes) {
				foreach ($product->attributes as $attribute) {
					if ($attribute == 'size') {
						$sku['attributes']['size'] = "Medium"; 
					}
					if ($attribute == 'color') {
						$sku['attributes']['color'] = "Purple"; 
					}
				}
			}
			\Stripe\SKU::create($sku);
		}

		pretty_print($stripe_products);
	}
}
