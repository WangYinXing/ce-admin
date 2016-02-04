<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Patterns extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Patterns');
		$this->load->helper("utility");
	}

	public function ajax_list() {
		$ret = [];


		$data = $this->Mdl_Patterns->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Patterns->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($id = null) {
		$color = new stdClass();


		if ($id != null) {
			$color = $this->Mdl_Patterns->get($id);

			$color->isNew = false;
		}
		else {
			$color->isNew = true;

			$color->id = gen_uuid();
			$color->name = "";
		}

		parent::initView("Patterns/edit", "Patterns", 'Edit pattern information.',
			$color
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);

		$this->Mdl_Patterns->save($id, $_POST);

		redirect("/Patterns/", 'refresh');
	}

	public function del($id) {
		$this->Mdl_Patterns->del($id);

		redirect("/Patterns/", 'refresh');
	}
}

?>