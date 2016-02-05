<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Ingredients extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Ingredients');
		$this->load->helper("utility");
	}

	public function ajax_list() {
		$ret = [];


		$data = $this->Mdl_Ingredients->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Ingredients->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($id = null) {
		$record = new stdClass();

		$colors = $this->Mdl_Ingredients->getColors();
		$patterns = $this->Mdl_Ingredients->getPatterns();

		if ($id != null) {
			$record = $this->Mdl_Ingredients->get($id);

			$record->isNew = false;
		}
		else {
			$record->isNew = true;

			$record->id = gen_uuid();
			$record->name = "";
			$record->coverage = "";
			$record->purchaseprice = "";
		}

		/*
			Colors....
		*/
		$record->colorsHTML = "";

		foreach ($colors as $col) {
			$checked = "";

			if (!$record->isNew) {
				foreach ($record->selectedColors as $selCol) {
					if ($selCol->colorid == $col->id) {
						$checked = "checked";
					}
				}
			}


			$record->colorsHTML .= "<input $checked id='$col->id' type='checkbox' name='$col->id' value='1'><label for='$col->id'>&nbsp;&nbsp;$col->name</label><br>";
		}

		/*
			Patterns....
		*/
		$record->patternsHTML = "";

		foreach ($patterns as $pat) {
			$checked = "";

			if (!$record->isNew) {
				foreach ($record->selectedPatterns as $selPat) {
					if ($selPat->patternid == $pat->id) {
						$checked = "checked";
					}
				}
			}
			

			$record->patternsHTML .= "<input $checked id='$pat->id' type='checkbox' name='$pat->id' value='1'><label for='$pat->id'>&nbsp;&nbsp;$pat->name</label><br>";
		}

		parent::initView("Ingredients/edit", "Ingredients", 'Edit ingredient information.',
			$record
		);

		parent::loadView();
	}

	public function save() {
		$id = $_POST["id"];
		unset($_POST["id"]);

		$this->Mdl_Ingredients->save($id, $_POST);

		redirect("/Ingredients/", 'refresh');
	}

	public function del($id) {
		$this->Mdl_Ingredients->del($id);

		redirect("/Ingredients/", 'refresh');
	}
}

?>