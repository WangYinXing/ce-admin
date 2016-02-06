<?php



Class Mdl_Ingredients extends Mdl_Campus {

	function __construct() {
		parent::__construct();

		$this->table = 'ingredient';
	}

	function _list($rp = 10, $page = 0, $query = '', $qtype = '', $sortname = '', $sortorder = '', $count = false) {
		$this->db->select("*");
		$this->db->from("ingredient");

		if ($count)
			return $this->db->count_all_results();

		$this->db->limit($rp, $rp * ($page - 1));

		return $this->db->get()->result();
	}

	function save($id, $ingredient) {


		// Update ....
		if (!$ingredient['isNew']) {
			$this->db->update('ingredient', [
				"name" => $ingredient['name'],
				"coverage" => $ingredient['coverage'],
				"purchaseprice" => $ingredient['purchaseprice'],
				], "id = '$id'");
			
		}
		// Insert...
		else {
			$this->db->insert('ingredient', buildBaseParam([
				"id" => $id = gen_uuid(),
				"name" => $ingredient['name'],
				"coverage" => $ingredient['coverage'],
				"purchaseprice" => $ingredient['purchaseprice'],
				], $this->session->userdata('id')));
		}

		// Colors
		// Remove all colors first.
		$this->db->delete('ingredientcolor', ['ingredientid'=>$id]);

		$selColors = json_decode($ingredient['selCols']);

		$arrSelectedColors = [];

		foreach ($selColors as $key=>$val) {
			if ($val == 1) {
				array_push($arrSelectedColors, buildBaseParam([
					'colorid' => $key,
					'ingredientid' => $id,
					'id' => gen_uuid(),
					], $this->session->userdata('id')));
			}
		}

		// Re-add all colors.
		if (count($arrSelectedColors))
			$this->db->insert_batch('ingredientcolor', $arrSelectedColors);

		// Patterns
		// Remove all patterns first.
		$this->db->delete('ingredientpattern', ['ingredientid'=>$id]);

		$selPatterns = json_decode($ingredient['selPats']);

		$arrSelectedPatterns = [];

		foreach ($selPatterns as $key=>$val) {
			if ($val == 1) {
				array_push($arrSelectedPatterns, buildBaseParam([
					'patternid' => $key,
					'ingredientid' => $id,
					'id' => gen_uuid(),
					], $this->session->userdata('id')));
			}
		}

		// Re-add all colors.
		if (count($arrSelectedPatterns))
			$this->db->insert_batch('ingredientpattern', $arrSelectedPatterns);
		
	}

	function del($id) {
		$this->db->delete("ingredient", ["id" => $id]);

		// Remove all colors and patterns.
		$this->db->delete('ingredientcolor', ['ingredientid'=>$id]);
		$this->db->delete('ingredientpattern', ['ingredientid'=>$id]);
	}

	function get($id) {
		$this->db->select("*");
		$this->db->from("ingredient");
		$this->db->where("id", $id);

		$ing = $this->db->get()->result()[0];

		$this->getDetail($ing);

		return $ing;
	}

	function getColors() {
		$this->db->select("*");
		$this->db->from("color");

		return $this->db->get()->result();
	}

	function getPatterns() {
		$this->db->select("*");
		$this->db->from("pattern");

		return $this->db->get()->result();
	}

	function getDetail($ing) {
		$this->db->select("colorid");
		$this->db->from("ingredientcolor");
		$this->db->where("ingredientid", $ing->id);

		$ing->selectedColors = $this->db->get()->result();

		$this->db->select("patternid");
		$this->db->from("ingredientpattern");
		$this->db->where("ingredientid", $ing->id);

		$ing->selectedPatterns = $this->db->get()->result();
	}
}
?>