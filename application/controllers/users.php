<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Controller handles the manipulation of the users. Supports adding/editing users and manages comments/messages by the users.
	class Users extends CI_Controller
	{

		public function index()
		{
			$this->load->view('dashboard');
		}

		public function add()
		{
			$this->load->view('new');
		}

		public function edit()
		{
			$this->load->view('edit');
		}

		public function admin_edit($id)
		{
			$this->load->model('verify');

			$data['users'] = $this->verify->get_user_by_id($id);
			$this->load->view('admin_edit', $data);
		}

		// Alters user information in the users DB table. Accepts user's id as arguments and returns no values.
		public function update_user($id)
		{
			$this->load->model('verify');
			$this->load->library('form_validation');
			$this->load->library('encrypt');

			if ($this->input->post('action') == 'edit_info')
			{
				$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|xss_clean');
				$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|xss_clean');
				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');

				if ($this->session->userdata('permission') == 'admin')
				{
					$data = array('first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'permission' => $this->input->post('user_level'),
							'updated_at' => date('Y-m-d H:i:s')
					);
				}
				else
				{
					$data = array('first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'updated_at' => date('Y-m-d H:i:s')
					);
				}
			}
			else if ($this->input->post('action') == 'edit_password')
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', "required|min_length[8]|matches[password]");

				$data = array('password' => $this->encrypt->sha1($this->input->post('password')),
							'updated_at' => date('Y-m-d H:i:s')
					);
			}
			else if ($this->input->post('action') == 'edit_desc')
			{
				$this->form_validation->set_rules('description', 'Description', 'required');

				$data = array('description' => $this->input->post('description'),
							'updated_at' => date('Y-m-d H:i:s')
					);
			}

			if ($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$this->verify->update_user_info($id, $data);
				$this->session->set_userdata($data);
				$this->session->set_userdata('logged_in', 'true');

				if ($this->session->userdata('permission') == 'admin')
					redirect('dashboard/admin');
				else
					redirect('dashboard');
			}
		}

		// Removes user records from users DB table. Accepts user's id as an argument and returns no values.
		public function remove_user($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('users');

			redirect('dashboard/admin');
		}

		// Retrieves user's information from the DB and loads the user's profile with this data. Accepts user's id as an argument and returns no values.
		public function show($id)
		{

			$this->load->model('verify');
			$this->load->model('messages');
			$this->load->model('comments');

			$data['user'] = $this->verify->get_user_by_id($id);
			$data['messages'] = $this->messages->fetch_messages($id);
			$data['comments'] = $this->comments->fetch_comments($id);

			$this->load->view('profile', $data);
		}

		// Inserts a posted message into the messages DB table. Accepts no arguments and returns no values.
		public function message()
		{
			$this->load->model('messages');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('post_message', 'Message', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$data = array('user_id' => $this->input->post('user_id'),
							'poster_id' => $this->input->post('poster_user_id'),
							'message' => $this->input->post('post_message', TRUE),
							'created_at' => date('Y-m-d H:i:s')
					);

				$this->messages->insert_message($data);

				redirect("/users/show/{$data['user_id']}");
			}
		}

		// Inserts a posted comment into the comments DB table. Accepts no arguments and returns no values.
		public function comment()
		{
			$this->load->model('comments');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('post_comment', 'Comment', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$user_id = $this->input->post('profile_user_id');
				$data = array('user_id' => $this->input->post('profile_user_id'),
							'message_id' => $this->input->post('comment_message_id'),
							'poster_id' => $this->input->post('comment_poster_user_id'),
							'comment' => $this->input->post('post_comment', TRUE),
							'created_at' => date('Y-m-d H:i:s')
					);

				$this->comments->insert_comment($data);

				redirect("/users/show/{$user_id}");
			}
		}

	}

/* End of file users.php */
/* Location: ./application/controllers/users.php */