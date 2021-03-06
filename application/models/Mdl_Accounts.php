<?php



Class Mdl_Accounts extends Mdl_Campus {

	function __construct() {
		parent::__construct();

		$this->table = 'account';
	}


	function login($username, $password) {
		$this->db->select("*");
		$this->db->from("account");

		$this->db->where("username", $username);
		$this->db->where("password", MD5($password));

		$login = $this->db->get()->result();

		$this->latestErr = "Email or password is not correct. Please make sure them correctly and try again.";

		// The results of the query are stored in $login.
	    // If a value exists, then the user account exists and is validated
	    if ( is_array($login) && count($login) == 1 ) {
	        // Set the users details into the $details property of this class
	        $this->details = $login[0];

	        // This user is not verified yet...
	        if ($this->details->status == 0) {
	        	$this->latestErr = "This account is not verified. please verify via email and try again.";
	        	return false;
	        }

	        $this->latestErr = "";
	        // Call set_session to set the user's session vars via CodeIgniter
	        $this->set_session();
	        return true;
	    }

	    return false;
	}

	function _list($rp = 10, $page = 0, $query = '', $qtype = '', $sortname = '', $sortorder = '', $count = false) {
		$this->db->select("*");
		$this->db->from("account");
		$this->db->join("accountrole", "account.id = accountrole.accountid", "left");
		$this->db->join("person", "account.id = person.id", "left");

		if ($qtype != '' && $query != '') {
			$this->db->like($qtype, $query);
		}

		if ($count)
			return $this->db->count_all_results();

		$this->db->limit($rp, $rp * ($page - 1));

		return $this->db->get()->result();
	}

	function save($id, $account) {
		// Update ....
		if (!$account['isNew']) {
			$this->db->update('person', [
				"firstname" => $account['firstname'],
				"lastname" => $account['lastname'],
				], "id = '$id'");

			$this->db->update('accountrole', [
				"role" => $account['role']
				], "accountid = '$id'");

			if (isset($account['password']) && strlen($account['password']) > 5) {
				$this->db->update('account', [
				"password" => md5($account['password']),
				], "id = '$id'");
			}
			else {
				$this->latestErr = "Password didn't match or shoter than 5 characters.";
				return false;
			}
		}
		// Insert...
		else {
			$username = $account['username'];

			$this->db->from('account');
			$this->db->where('username', $username);
			
			if (count($this->db->get()->result())) {
				$this->latestErr = "Email has already taken.";
				return false;
			}

			$this->db->insert('account', buildBaseParam([
				"id" => $id,
				"username" => $account['username'],
				"password" => md5($account['password']),
				"status" => 0,
				], $id));

			$this->db->insert('person', buildBaseParam([
				"id" => $id,
				"firstname" => $account['firstname'],
				"lastname" => $account['lastname'],
			], $id));

			$this->db->insert('accountrole', buildBaseParam([
				"id" => gen_uuid(),
				"accountid" => $id,
				"role" => strtolower($account['role']),
				], $id));
		}

		return true;
		
	}

	function del($id) {
		$this->db->delete("account", ["id" => $id]);
		$this->db->delete("accountrole", ["accountid" => $id]);
		$this->db->delete("person", ["id" => $id]);
	}

	function get($id) {
		$this->db->select("*");
		$this->db->from("account");
		$this->db->join("accountrole", "account.id = accountrole.accountid", "left");
		$this->db->join("person", "account.id = person.id", "left");
		$this->db->where("account.id", $id);

		return $this->db->get()->result()[0];
	}

	function set_session() {
	    // session->set_userdata is a CodeIgniter function that
	    // stores data in a cookie in the user's browser.  Some of the values are built in
	    // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
	    $this->session->set_userdata( array(
	            'id'=>$this->details->id,
	            'username'=> $this->details->username,
	            'email'=>$this->details->email,
	            'isLoggedIn'=>true
	        )
	    );
	}

	function destroy_session() {
	    // session->set_userdata is a CodeIgniter function that
	    // stores data in a cookie in the user's browser.  Some of the values are built in
	    // to CodeIgniter, others are added (like the IP address).  See CodeIgniter's documentation for details.
	    $this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');

		$this->session->set_userdata(array('isLoggedIn'=>false));

		$this->session->sess_destroy();
	}
}
?>