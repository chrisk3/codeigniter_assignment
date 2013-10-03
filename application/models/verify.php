<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Database retrieval and insertion model for users table. 
	class Verify extends CI_Model
	{

		function __construct()
		{
			$this->load->database();
			parent::__construct();
		}

		// retrives a specific user's information from database. Accepts an email address and returns an associative array with the data.
		public function get_user_info($email)
		{
			$this->db->where('email', $email);
			$query = $this->db->get('users');

			$data = $query->row_array();
			return $data;
		}

		// checks if a specific email address exists in database. Accepts an email address and returns TRUE if user exists and FALSE if user doesn't exist.
		public function check_if_exists($email)
		{
			$this->db->where('email', $email);
			$query = $this->db->get('users');

			if ($query->num_rows() > 0)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		// validates a users email and password to ensure they match. Accepts an email address and unencrypted password. Returns TRUE if they match and FALSE if they don't.
		public function validate_credentials($email, $password)
		{
			$this->load->library('encrypt');

			$this->db->where('email', $email);
			$query = $this->db->get('users');

			$password = $this->encrypt->sha1($password);
			$results = $query->result_array();

			if ($query->num_rows() > 0)
			{
				if ($password == $results[0]['password'])
					return TRUE;
				else
					return FALSE;
			}
			else
			{
				return FALSE;
			}
		}

		// inserts user data into database. accepts associative array and returns the new users id.
		public function insert_users($query)
		{
			$return = $this->db->get('users', 1);

			if (empty($return))
				$query['permission'] = 'admin';

			$this->db->insert('users', $query);
			$id = mysql_insert_id();
			$query['id'] = $id;

			return $id;
		}

		// Retrieves id, first name, last name, email, permission level, and created date from dB. returns an array of objects. Accepts no arguments.
		public function get_all_users()
		{
			$this->db->select('id, first_name, last_name, email, permission, created_at');
			$query = $this->db->get('users');
			$data = $query->result();
			return $data;
		}

		// Retrieves user from DB using ID. Accepts the user's ID and returns an associative array of the user's information.
		public function get_user_by_id($id)
		{
			$this->db->select('id, first_name, last_name, email, permission, description, created_at');
			$this->db->where('id', $id);
			$query = $this->db->get('users');
			$query = $query->row_array();

			return $query;
		}

		// Updates the users table. Accepts a user's ID and an associative array containing the values that require updating. Returns no values.
		public function update_user_info($id, $data)
		{
			$this->db->where('id', $id);
			$this->db->update('users', $data);
		}

	}

/* End of file verify.php */
/* Location: ./application/models/verify.php */