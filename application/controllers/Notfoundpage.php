
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfoundpage extends CE_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->output->set_status_header('404');
		$data['content'] = 'error_404';
		$this->load->view('vw_404', $data);
	}

}