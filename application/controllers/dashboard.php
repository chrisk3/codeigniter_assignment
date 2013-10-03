<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// Controller that handles the presentation of all users. Retrieves data from the database to present all user information.
	class Dashboard extends CI_Controller
	{

		protected function fetch_users()
		{
			$this->load->model('verify');
			
			$data = $this->verify->get_all_users();
			return $data;
		}

		public function index()
		{
			if ($this->session->userdata('permission') == 'admin')
				redirect('dashboard/admin');

			$data['users'] = $this->fetch_users();
			$this->load->view('dashboard', $data);
		}

		public function admin()
		{
			if ($this->session->userdata('permission') == 'normal')
				redirect('dashboard');

			$data['users'] = $this->fetch_users();
			$this->load->view('dashboard_admin', $data);
		}

	}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */