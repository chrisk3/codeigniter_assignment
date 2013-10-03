<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Database retrieval and insertion model for the messages table. 
	class Messages extends CI_Model
	{

		function __construct()
		{
			$this->load->database();
			parent::__construct();
		}

		// Inserts a new message into the messages table. Accepts an associative arrays with keys matching column names. Returns no values.
		public function insert_message($data)
		{
			$this->db->insert('messages', $data);
		}

		// Retrieves all messages from the database for a certain user. Accepts the user's ID as an argument and returns an associative array of all the messages.
		public function fetch_messages($id)
		{
			$this->db->select('messages.id AS id, messages.user_id AS user_id, messages.poster_id AS poster, messages.message AS message, messages.created_at AS created_at, users.first_name AS first_name, users.last_name AS last_name');
			$this->db->from('messages');
			$this->db->join('users', 'messages.poster_id = users.id', 'inner');
			$this->db->where('user_id', $id);
			$this->db->order_by('created_at', 'desc');
			$query = $this->db->get();

			return $query->result_array();
		}

	}

/* End of file messages.php */
/* Location: ./application/models/messages.php */