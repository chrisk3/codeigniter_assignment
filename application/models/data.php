<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Data extends CI_Model
	{

		function __construct()
		{
			$this->load->database();
			parent::__construct();
		}

		public function get_all_users()
		{
			$this->db->select('id, first_name, last_name, email, permission, created_at');
			$query = $this->db->get('users');
			$data = $query->result();
			return $data;
		}

	}

/* End of file data.php */
/* Location: ./application/models/data.php */