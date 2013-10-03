<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Controller that handles login and registration. Process user inputted information to verify it's acceptable, logs the user in, and inserts all relevant information into DB.
	class Login extends CI_Controller 
	{

		public function index()
		{
			$this->load->view('welcome');
		}

		public function form()
		{
			$this->load->view('form');
		}

		public function process_login()
		{
			$this->load->library('form_validation');
			$this->load->model('verify');

			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

			if ($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$email = $this->input->post('email', TRUE);
				$password = $this->input->post('password');

				$query = $this->verify->validate_credentials($email, $password);

				if ($query === FALSE)
				{
					echo "Email and password don't match.";
				}
				else
				{
					$data = $this->verify->get_user_info($email);
					$this->session->set_userdata($data);
					$this->session->set_userdata('logged_in', 'true');

					if ($this->session->userdata('permission') == 'admin')
						redirect('dashboard/admin');
					else
						redirect('/dashboard');
				}
			}
		}

		public function process_registration()
		{
			$this->load->library('form_validation');
			$this->load->library('encrypt');
			$this->load->model('verify');

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|alpha|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', "required|min_length[8]|matches[password]");

			if ($this->form_validation->run() === FALSE)
			{
				echo validation_errors();
			}
			else
			{
				$email = $this->input->post('email', TRUE);

				$query = $this->verify->check_if_exists($email);

				if ($query === TRUE)
				{
					echo "This email account has already been reigstered";
				}
				else
				{
					if ($this->session->userdata('permission') == 'admin')
					{
						$data = array('first_name' => $this->input->post('first_name', TRUE),
							'last_name' => $this->input->post('last_name', TRUE),
							'email' => $this->input->post('email', TRUE),
							'password' => $this->encrypt->sha1($this->input->post('password')),
							'permission' => 'normal',
							'description' => 'Enter your description here',
							'created_at' => date('Y-m-d H:i:s')
						);

						$this->verify->insert_users($data);

						redirect('dashboard/admin');
					}
					else
					{
						$data = array('first_name' => $this->input->post('first_name', TRUE),
							'last_name' => $this->input->post('last_name', TRUE),
							'email' => $this->input->post('email', TRUE),
							'password' => $this->encrypt->sha1($this->input->post('password')),
							'permission' => 'normal',
							'description' => 'Enter your description here',
							'created_at' => date('Y-m-d H:i:s')
						);

						$id = $this->verify->insert_users($data);

						$session_data = array('first_name' => $this->input->post('first_name', TRUE),
							'last_name' => $this->input->post('last_name', TRUE),
							'email' => $this->input->post('email', TRUE),
							'permission' => 'normal',
							'description' => '',
							'created_at' => date('Y-m-d H:i:s'),
							'logged_in' => TRUE,
							'id' => $id
						);

						$this->session->set_userdata($session_data);

						redirect('/dashboard');
					}
				}
			}
		}

		public function logout()
		{
			$this->session->sess_destroy();
			redirect(base_url('/welcome'));
		}

	}

/* End of file login.php */
/* Location: ./application/controllers/login.php */