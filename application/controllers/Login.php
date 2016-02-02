<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CE_Controller {
/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	function __construct() {
		parent::__construct();
		//$this->load->model('Mdl_AdminUsers', '', TRUE);
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		if( $this->session->userdata('isLoggedIn') ) {
	        redirect('/dashboard');
	        $this->show_login(false);
	    } else {
	        $this->show_login(false);
	    }
	}

	private function show_login( $show_error = false ) {
	    $data['error'] = $show_error;

	    //$this->load->helper('form');
	    $this->load->view('vw_login',$data);
	}
}

?>