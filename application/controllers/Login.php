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

	private function show_login($error = "") {
	    $data['error'] = $error;

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
		  $this->show_login($this->Mdl_Accounts->latestErr);
		}
	}

	public function logout() {
		$this->Mdl_Accounts->destroy_session();

		redirect('/Login');

	    //$this->show_login(false);
	}

	public function verify() {
		$data['error'] = "";

		if (!isset($_GET["token"])) {
			$data['content'] = "Sorry. Your token has been expired or invalid.";
			$this->load->view('vw_error', $data);
			return;
		}

		$data['token'] = $token = $_GET["token"];

		$this->load->model("Mdl_Tokens");

		$tokenRecords = $this->Mdl_Tokens->getAll("token", $token);

		if (count($tokenRecords) == 0) {
			$data['content'] = "Sorry. Your token is illegal.";
			$this->load->view('vw_error', $data);
			return;
		}

		$this->load->model("Mdl_Accounts");
		$account = $this->Mdl_Accounts->get($tokenRecords[0]->account);

		$this->Mdl_Accounts->updateEx($account->id, array("status" => 1));
		$this->Mdl_Tokens->remove($tokenRecords[0]->id);

		$data['info'] = "Your account has been verified. You can login now.";
		$this->load->view('Login/login',$data);
	}

	public function forgotpassword() {
		$data['error'] = "";

		if (!isset($_GET["token"])) {
			$data["error"] = "Sorry. Your token has been expired or invalid.";
			$this->load->view('invalidtoken',$data);
			return;
		}

		$data['token'] = $token = $_GET["token"];

		$this->load->model("Mdl_Tokens");

		$tokenRecords = $this->Mdl_Tokens->getAll("token", $token);

		if (count($tokenRecords) == 0) {
			$data["error"] = "Sorry. Your token has been expired or invalid.";
			$this->load->view('invalidtoken',$data);
			return;
		}

		$this->load->view('resetpassword',$data);
		
	}

	public function resetpassword() {
		$token = $data['token'] = $_POST["token"];

		if (!isset($_POST["password"]) || !isset($_POST["confirmpassword"])) {
			$data['error'] = "Please input password and confirm.";
			$this->load->view('resetpassword',$data);
			return;
		}

		if ($_POST["password"] != $_POST["confirmpassword"]) {
			$data['error'] = "Confirm password doesn't match.";
			$this->load->view('resetpassword',$data);
			return;
		}

		$this->load->model("Mdl_Tokens");

		$tokenRecords = $this->Mdl_Tokens->getAll("token", $token);

		if (count($tokenRecords) == 0) {
			$data['error'] = "Sorry. Your token has been expired or invalid.";
			$this->load->view('invalidtoken',$data);
			return;
		}

		$this->load->model("Mdl_Users");

		$user = $this->Mdl_Users->get($tokenRecords[0]->user);

		$this->Mdl_Users->updateEx($user->id, array("password" => md5($_POST["password"])));

		$this->Mdl_Tokens->remove($tokenRecords[0]->id);

		$data['success'] = "Your password has been reset. You can login with new password immediately.";
		$this->load->view('Login/login',$data);
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
				$account['token'] = $hash = hash('tiger192,3', $account['username'] . date("y-d-m-h-m-s"));
    			$baseurl = $this->config->base_url();

    			$this->load->model('Mdl_Tokens');
			    $this->Mdl_Tokens->create(array(
			      "token" => $hash,
			      "account" =>  $account['id'],
			      'type' => 0,
			      ));

				$email = loadVerificationEmailTemplate($this, $account);
				send([$account["username"]], "Please verify your account.", $email);

				return;
			}
		}


		$this->load->view('Login/register',$data);
	}
}

?>