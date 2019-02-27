<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		\Stripe\Stripe::setApiKey("sk_test_2sN94fTZ5N8sC2y2oB6AjOru");
    }

	public function form()
	{
		if ($this->input->method() == 'post') {
			$order = \Stripe\Order::create([
			    'currency' => 'aud',
			    'email' => 'jenny.rosen@example.com',
			    'items' => [
			        [
			            'type' => 'sku',
			            'parent' => 'thing-medium',
			            'quantity' => 2,
			        ],
			    ],
			    'shipping' =>  [
			        'name' => 'Jenny Rosen',
			        'address' => [
			            'line1' => '1234 Main Street',
			            'city' => 'San Francisco',
			            'state' => 'CA',
			            'postal_code' => '94111',
			            'country' => 'US',
			        ],
			    ],
			]);
			$this->session->set_userdata('order', $order->id);
			redirect('checkout/payment');
		}

		$this->load->view('checkout/form');
	}

	public function payment()
	{
		$order = \Stripe\Order::retrieve($this->session->userdata('order'));

		if ($this->input->method() == 'post') {
			$this->form_validation->set_rules('stripeToken', 'Payment Token', 'required');
			if ($this->form_validation->run() !== FALSE) {
				$stripe_token = $this->input->post('stripeToken');
				$payment = $order->pay([
				  "source" => $stripe_token 
				]);
			} else {
				echo json_encode($this->form_validation->error_array());
			}
		}
		$this->load->view('checkout/payment', compact('order'));
	}
}
