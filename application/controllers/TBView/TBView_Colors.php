<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Colors extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Colors');
		$this->load->helper("utility");
	}

	public function ajax_list() {
		$ret = [];


		$data = $this->Mdl_Colors->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Colors->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($id = null) {
		$color = new stdClass();


		if ($id != null) {
			$color = $this->Mdl_Colors->get($id);

			$color->isNew = false;
		}
		else {
			$color->isNew = true;

			$color->id = gen_uuid();
			$color->name = "";
		}

		parent::initView(get_class($this) . '/edit', 'Colors', 'Edit color information.',
			$color
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);

		$this->Mdl_Colors->save($id, $_POST);

		redirect('/Colors/', 'refresh');
	}

	public function del($id) {
		$this->Mdl_Colors->del($id);

		redirect('/Colors/', 'refresh');
	}
}

?>