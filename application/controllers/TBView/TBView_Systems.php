<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TBView_Systems extends CE_Controller {

	public function __construct(){
		parent::__construct();
		// do whatever here - i often use this method for authentication controller

		$this->load->model('Mdl_Systems');
		$this->load->helper("utility");
	}

	public function ajax_list() {
		$ret = [];

		$data = $this->Mdl_Systems->_list(
			$_POST['rp'],
			$_POST['page'],
			$_POST['query'],
			$_POST['qtype'],
			$_POST['sortname'],
			$_POST['sortorder']);

		echo json_encode(array(
		  'page'=>$_POST['page'],
		  'total'=>$this->Mdl_Systems->get_length(),
		  'rows'=>$data,
		));
	}

	public function edit($id = null) {
		$record = new stdClass();

		$ings = $this->Mdl_Systems->getIngredients();

		if ($id != null) {
			$record = $this->Mdl_Systems->get($id);

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

		$share = "";
		$active = "";

		if ($record->share == "t")
			$share = "checked";
		if ($record->status)
			$active = "checked";

		$record->shareHTML = "<input $share id='share' type='checkbox' name='_share'><label for='share'>&nbsp;&nbsp;Share</label>";
		$record->activeHTML = "<input $active id='status' type='checkbox' name='_status'><label for='status'>&nbsp;&nbsp;Active</label>";

		/*
			Colors....
		*/
		$record->ingredientsHTML = "";

		foreach ($ings as $ing) {
			$checked = "";
			$extra = "";
			$factor = "";

			if (!$record->isNew) {
				foreach ($record->selIngs as $selIng) {
					if ($selIng->ingredientid == $ing->id) {
						$checked = "checked";
						$extra = $selIng->extra;
						$factor = $selIng->factor;
					}
				}
			}

			$record->ingredientsHTML .= "<div class='row ing'>";
			$record->ingredientsHTML .= "<div class='col-md-4'>";
			$record->ingredientsHTML .= "<input $checked id='$ing->id' type='checkbox' name='$ing->id' value='1'><label for='$ing->id'>&nbsp;&nbsp;$ing->name</label><br>";
			$record->ingredientsHTML .= "</div>";


			$record->ingredientsHTML .= "<div class='col-md-4'>";
			$record->ingredientsHTML .= "<div class='row item'><div class='col-md-4'><label >$ing->purchaseprice</label></div><div class='col-md-8'><input class='_extra' name='$ing->id' value='$extra'/></div>";
			$record->ingredientsHTML .= "</div></div>";

			$record->ingredientsHTML .= "<div class='col-md-4'>";
			$record->ingredientsHTML .= "<div class='row item'><div class='col-md-4'><label >Units extra</label></div><div class='col-md-8'><input class='_factor' name='$ing->id' value='$factor'/></div>";
			$record->ingredientsHTML .= "</div></div>";

			$record->ingredientsHTML .= "</div>";
		}

		parent::initView("Systems/edit", "Systems", 'Edit Systems information.',
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