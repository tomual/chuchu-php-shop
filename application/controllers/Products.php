<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Authenticated_Controller {

	public function remap()
	{
        set_title('Page');
		$this->load->view('page');
	}
}
