
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfoundpage extends CE_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->output->set_status_header('404');
		$data['content'] = 'Opps. Page not found.';
		$this->load->view('vw_error', $data);
	}

}