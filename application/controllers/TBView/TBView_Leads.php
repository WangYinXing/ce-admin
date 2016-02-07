<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Leads extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Leads');
		$this->load->helper("utility");
	}

	public function ajax_list() {
		$ret = [];

		$data = $this->Mdl_Leads->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Leads->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($id = null) {
		$record = new stdClass();

		if ($id != null) {
			$record = $this->Mdl_Leads->get($id);

			$record->isNew = false;
		}
		else {
			$record->isNew = true;

			$record->id = gen_uuid();
			$record->name = "";
			$record->saleprice = "";
			$record->share = "f";
			$record->status = true;
		}

		
		parent::initView("Leads/edit", "Leads", 'Edit Systems information.',
			$record
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);

		$this->Mdl_Systems->save($id, $_POST);

		redirect("/Systems/", 'refresh');
	}

	public function del($id) {
		$this->Mdl_Systems->del($id);

		redirect("/Systems/", 'refresh');
	}
}

?>