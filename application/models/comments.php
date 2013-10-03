<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Database retrieval and insertion model for the comments table. 
	class Comments extends CI_Model
	{

		function __construct()
		{
			$this->load->database();
			parent::__construct();
		}

		// Inserts a new comment into the comments table. Accepts an associative arrays with keys matching column names. Returns no values.
		public function insert_comment($data)
		{
			$this->db->insert('comments', $data);
		}

		// Retrieves all comments from the database for a certain user. Accepts the user's ID as an argument and returns an associative array of all the comments.
		public function fetch_comments($id)
		{
			$this->db->select('comments.id AS id, comments.poster_id AS poster_id, comments.message_id AS message_id, comments.comment AS comment, comments.created_at AS created_at, users.first_name AS first_name, users.last_name AS last_name');
			$this->db->from('comments');
			$this->db->join('users', 'comments.poster_id = users.id', 'inner');
			$this->db->where('user_id', $id);
			$this->db->order_by('created_at', 'asc');
			$query = $this->db->get();

			return $query->result_array();
		}

	}

/* End of file comments.php */
/* Location: ./application/models/comments.php */