<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function payment()
	{

		$this->load->view('checkout/form');
	}

	public function process() 
	{
		$this->form_validation->set_rules('stripeToken', 'Payment Token', 'required');

		if ($this->form_validation->run() !== FALSE) {
			\Stripe\Stripe::setApiKey("sk_test_2sN94fTZ5N8sC2y2oB6AjOru");
			$stripe_token = $this->input->post('stripeToken');

			$charge = \Stripe\Charge::create([
			    'amount' => 1000,
			    'currency' => 'aud',
			    'source' => $stripe_token,
			    'receipt_email' => 'jenny.rosen@example.com',
			]);

			echo "<pre>";
			print_r($charge);
		} else {
			echo json_encode($this->form_validation->error_array());
		}
	}
}
