<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('contact_model');
    }

	public function form()
	{
		if ($this->input->method() == 'post') {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('message', 'Message', 'required');
			if ($this->form_validation->run() !== FALSE) {
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'message' => $this->input->post('message')
				);
				$this->contact_model->create($data);

				$this->load->library('email');

				$this->email->to($this->config->item('admin_email'));
				$this->email->subject($this->config->item('site_name') . ' Contact Form Submission');
				$message = "{$data['name']} <{$data['name']}>";
				$message .= "<br>";
				$message .= $data['message'];
				$this->email->message($message);

				$this->email->send();

				$this->session->set_flashdata('success', 'Thank you for contacting us. We will reply to you shortly.');
				redirect('contact/form');
			}
		}

		$this->load->view('contact');
	}

}
