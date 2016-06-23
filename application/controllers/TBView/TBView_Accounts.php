<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Accounts extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Accounts');
		$this->load->helper("utility");
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

		foreach ($data as $key => $val) {
			if ($val->id == null) {
				$val->id = $val->accountid;
			}
		}

		echo json_encode(array(
		  'page' => $_POST['page'],
		  'total' => $this->Mdl_Accounts->get_length(),
		  'rows' => $data,
		  'query' => $_POST['query'],
		));
	}

	public function edit($arg = null) {
		$account = new stdClass();


		if ($arg != null) {
			$account = $this->Mdl_Accounts->get($arg);
			$account->isNew = false;
		}
		else {
			$account->isNew = true;

			$account->id = gen_uuid();
			$account->username = "";
			$account->firstname = "";
			$account->lastname = "";
			$account->status = 1;
			$account->role = "administrator";
		}

		$arrRoles = [
			"user",
			"administrator",
			"subscriber",
			"machine",
			"concreteprotector"
		];

		$account->rolesHTML = "<select name='role'>";

		foreach ($arrRoles as $role) {
			$selected = "";
			
			$selected = ($role == $account->role) ? " selected " : "";

			$Role = ucfirst($role);

			$account->rolesHTML .= "<option $selected value='$role'>$Role</option>";
		}

		$account->rolesHTML .= "</select>";

		parent::initView(get_class($this) . '/edit', 'Accounts', 'Edit account information.',
			$account
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);



		$this->Mdl_Accounts->save($id, $_POST);

		redirect('/Accounts/', 'refresh');
	}

	public function del($id) {
		$this->Mdl_Accounts->del($id);

		redirect('/Accounts/', 'refresh');
	}
}

?>