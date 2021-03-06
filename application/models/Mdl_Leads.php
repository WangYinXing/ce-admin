<?php



Class Mdl_Leads extends Mdl_Campus {

	function __construct() {
		parent::__construct();

		$this->table = 'lead';
		$this->selectClause = "lead.id, person.firstname,person.lastname, person.company, leaddetail.email,
			leaddetail.besttimetocall, phone.number, phone.type, leaddetail.hearaboutus,
			leaddetail.howcanwehelp, address.address1, address.address2, address.city, address.state, address.zip,
			lead.added, lead.addedby, lead.changed, lead.changedby
			";
	}

	function _list($rp = 10, $page = 0, $query = '', $qtype = '', $sortname = '', $sortorder = '', $count = false) {
		$this->db->select($this->selectClause);
		$this->db->from("lead");
		$this->db->join("person", "lead.personid = person.id", "left");
		$this->db->join("address", "person.id = address.personid", "left");
		$this->db->join("phone", "person.id = phone.personid", "left");
		$this->db->join("leaddetail", "lead.id = leaddetail.leadid", "left");

		if ($count)
			return $this->db->count_all_results();

		$this->db->limit($rp, $rp * ($page - 1));

		return $this->db->get()->result();
	}

	function save($id, $record) {
		// Update ....
		if (!$record['isNew']) {
			$this->db->update('system', [
				"name" => $record['name'],
				"saleprice" => $record['saleprice'],
				"status" => $record['status'],
				"share" => $record['share'],
				], "id = '$id'");

			// Colors
			// Remove all colors first.
			$this->db->delete('systemdetail', ['systemid'=>$id]);
		}
		// Insert...
		else {
			$this->db->insert('system', buildBaseParam([
				"id" => $id = gen_uuid(),
				"name" => $record['name'],
				"saleprice" => $record['saleprice'],
				"status" => $record['status'],
				"share" => $record['share'],
				], $this->session->userdata('id')));
		}

		$selIngs = json_decode($record['selIngs']);

		$arrSelectedIngs = [];

		foreach ($selIngs as $key=>$val) {
			if ($val->checked) {
				array_push($arrSelectedIngs, buildBaseParam([
					'systemid' => $id,
					'ingredientid' => $key,
					'extra' => $val->extra,
					'factor' => $val->factor,
					'id' => gen_uuid(),
					'status' => 1,
					], $this->session->userdata('id')));
			}
		}

		// Re-add all colors.
		if (count($arrSelectedIngs))
			$this->db->insert_batch('systemdetail', $arrSelectedIngs);
		
	}

	function del($id) {
		$this->db->delete("system", ["id" => $id]);
	}

	function get($id) {
		$this->db->select($this->selectClause);
		$this->db->from("lead");
		$this->db->join("person", "lead.personid = person.id", "left");
		$this->db->join("address", "person.id = address.personid", "left");
		$this->db->join("phone", "person.id = phone.personid", "left");
		$this->db->join("leaddetail", "lead.id = leaddetail.leadid", "left");
		$this->db->where("lead.id", $id);

		$record = $this->db->get()->result()[0];

		$this->getDetail($record);

		return $record;
	}

	function getIngredients() {
		$this->db->select("name, purchaseprice, id");
		$this->db->from("ingredient");

		return $this->db->get()->result();
	}

	function getDetail($record) {
		$this->db->select("*");
		$this->db->from("project");
		$this->db->join("projectdetail", "project.id = projectdetail.projectid", "left");
		$this->db->where("leadid", $record->id);

		$record->projects = $this->db->get()->result();

		$this->db->select("*");
		$this->db->from("phone");

		$record->phones = $this->db->get()->result();

		print_r($record);
		exit;
	}
}
?>