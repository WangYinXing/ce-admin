<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Mdl_Tokens extends Mdl_Campus {

	function __construct() {
		parent::__construct();

		$this->table = 'tokens';
	}

	public function create($arg) {
		$this->latestErr = "";

		$arg['added'] = date("Y-m-d H:i:s");

		if (!$this->db->insert($this->table, $arg)) {
			$this->latestErr = "Failed to create excute sql with : " . json_encode($arg);
			return;
		}

		$arg['id'] = $this->db->insert_id();

		return $arg;
	}
}

?>