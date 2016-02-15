<?php



Class Mdl_Colors extends Mdl_Campus {

	function __construct() {
		parent::__construct();

		$this->table = 'color';
	}

	function _list($rp = 10, $page = 0, $query = '', $qtype = '', $sortname = '', $sortorder = '', $count = false) {
		$this->db->select("*");
		$this->db->from("color");

		if ($count)
			return $this->db->count_all_results();

		$this->db->limit($rp, $rp * ($page - 1));

		return $this->db->get()->result();
	}

	function save($id, $color) {
		// Update ....
		if (!$color['isNew']) {
			$this->db->update('color', [
			"name" => $color['name'],
			], "id = '$id'");
		}
		// Insert...
		else {
			$this->db->insert('color', buildBaseParam([
				"id" => $id,
				"name" => $color['name']
				], $this->session->userdata('id')));
		}
		
	}

	function del($id) {
		$this->db->delete("color", ["id" => $id]);
	}

	function get($id) {
		$this->db->select("*");
		$this->db->from("color");
		$this->db->where("id", $id);

		return $this->db->get()->result()[0];
	}
}
?>