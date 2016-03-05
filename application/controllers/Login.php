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
		$this->load->helper("utility");
		$this->load->helper("email");
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
	    $this->load->view('Login/login',$data);
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

		redirect('/Login');

	    //$this->show_login(false);
	}

	public function register() {
		$data['error'] = $data['msg'] = '';
		$id = gen_uuid();

		if (isset($_POST['email'])) {

			$account = [
				'id' =>  $id,
				'isNew' => true,
				'username' => $_POST['email'],
				'password' => $_POST['password'],
				'firstname' => $_POST['firstname'],
				'lastname' => $_POST['lastname'],
				'role' => 'Administrator',
			];

			$data['msg'] = "Succeeded to sign up.<br>Please check verify your account via email.</p>";

			$this->Mdl_Accounts->save($id, $account);

			$data['error'] = $this->Mdl_Accounts->latestErr;

			// Succeeded to sign up. now it's time to send verification email...
			if ($data['error'] == "") {
				$email = loadVerificationEmailTemplate($this, $account);
				send(['wangyinxing19@gmail.com'], "Please verify your account.", $email);

				return;
			}
		}


		$this->load->view('Login/register',$data);
	}
}

?>