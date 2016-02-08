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

		$this->load->model('Mdl_Accounts', '', TRUE);
	}

	public function index() {
		if( $this->session->userdata('isLoggedIn') ) {
	        redirect('/Accounts');
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

	public function login_user() {
		$username = $this->input->post('username');
		$pass  = $this->input->post('password');

		//Ensure values exist for email and pass, and validate the user's credentials
		if( $username && $pass && $this->Mdl_Accounts->login($username, $pass)) {
		  // If the user is valid, redirect to the main view
		  redirect('/Accounts');
		} else {
		  // Otherwise show the login screen with an error message.
		  $this->show_login(true);
		}
	}

	public function logout() {
		$this->Mdl_Accounts->destroy_session();

	    $this->show_login(false);
	}
}

?>