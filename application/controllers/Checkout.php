<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('cart_model');
		\Stripe\Stripe::setApiKey($this->config->item('stripe_api_key'));
    }

	public function form()
	{
		$cart = $this->cart_model->get();
		$total = array_sum(array_column($cart, 'price')); 

		if ($this->input->method() == 'post') {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('line1', 'Address', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('postal_code', 'ZIP', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if ($this->form_validation->run() !== FALSE) {
				$items = array();
				foreach ($cart as $index => $item) {
					$items[] = array(
						'type' => 'sku',
						'parent' => $item->sku_id,
						'quantity' => $item->quantity
					);
				}
				try {
					$order = \Stripe\Order::create([
					    'currency' => 'aud',
					    'email' => $this->input->post('email'),
					    'items' => $items,
					    'shipping' =>  [
					        'name' => $this->input->post('name'),
					        'address' => [
					            'line1' => $this->input->post('line1'),
					            'city' => $this->input->post('city'),
					            'state' => $this->input->post('state'),
					            'postal_code' => $this->input->post('postal_code'),
					            'country' => 'AU',
					        ],
					    ],
					]);
				} catch(\Stripe\Error\Base $e) {
					$body = $e->getJsonBody();
				  	$error = $body['error'];
				  	$this->session->set_flashdata('error', $error['message']);
					$this->load->view('checkout/form', compact('cart', 'total'));
				  	return;
				}
				$this->session->set_userdata('order', $order->id);
				redirect('checkout/payment', compact('order'));
			}
		}

		$this->load->view('checkout/form', compact('cart', 'total'));
	}

	public function payment()
	{
		$order = \Stripe\Order::retrieve($this->session->userdata('order'));

		if ($this->input->method() == 'post') {
			$this->form_validation->set_rules('stripeToken', 'Payment Token', 'required');
			if ($this->form_validation->run() !== FALSE) {
				$stripe_token = $this->input->post('stripeToken');
				try {
					$payment = $order->pay([
						"source" => $stripe_token
					]);
				} catch(\Stripe\Error\Base $e) {
					$body = $e->getJsonBody();
				  	$error = $body['error'];
				  	$this->session->set_flashdata('error', $error['message']);
					$this->load->view('checkout/payment', compact('order'));
				  	return;
				}

				$charge = \Stripe\Charge::retrieve($payment->charge);
				$this->receipt($charge);
				return;

			} else {
				echo json_encode($this->form_validation->error_array());
			}
		}
		$this->load->view('checkout/payment', compact('order'));
	}

	public function receipt($charge)
	{
		$this->load->view('checkout/receipt', compact('charge'));
	}
}
