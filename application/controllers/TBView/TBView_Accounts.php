<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Accounts extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Accounts');

	}

	public function ajax_list() {
		$ret = [];


		$data = $this->Mdl_Accounts->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Accounts->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($arg) {
		$account = $this->Mdl_Accounts->get($arg);

		$arrRoles = [
			"user",
			"administrator",
			"subscriber",
			"machine",
			"concreteprotector"
		];

		$account->rolesHTML = "<select>";

		foreach ($arrRoles as $role) {
			$selected = ($role == $account->role) ? " selected " : "";

			$account->rolesHTML .= "<option $selected value='$role'>$role</option>";
		}

		$account->rolesHTML .= "</select>";

		parent::initView(get_class($this) . '/edit', 'Accounts', 'Edit iprayee information.',
			$account
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);

		//$this->Mdl_Accounts->updateEx($id, $_POST);

		redirect('/Users/', 'refresh');
	}

	public function del($arg) {
		$this->Mdl_Accounts->remove($arg);

		redirect('/Users/', 'refresh');
	}
}

?>