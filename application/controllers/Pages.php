<?php
	class Pages extends CI_Controller 
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('band_model');
			$this->load->helper('security');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->library('email');
		}	

		public function view($page = 'home')
			{
		        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
		        {
		            show_404();
		        }
		 
		    $data['band'] = $this->band_model->get_bands('bandname');
			$data['band'] = $this->band_model->get_bands('wikipedia');
			$data['band'] = $this->band_model->get_bands('website');

			$create = array('application', 'views', 'bands', 'create');

			$this->load->helper('url');
			$this->load->helper('utility');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/header-nav',$data);
			$this->load->view('bands/index', $data, $create);
			$this->load->view('templates/footer');

			if(empty($data['band']))
			{
				show_404();
			}

		        $data['title'] = ucfirst($page); // Capitalize the first tletter
			}

		public function index()
		{

			$data['band'] = $this->Band_model->get_bands();
			$data['title'] = 'Bands';

		}

		public function create() 
		{
			$this->form_validation->set_rules('bandName', 'Bandname', 'required');
			$this->form_validation->set_rules('wikipedia', 'Wikipedia', 'required');
			$this->form_validation->set_rules('website', 'Website', 'required');

			if($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('templates/header-nav');
				$this->load->view('bands/create');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->band_model->set_bands();
				redirect(base_url());
			}
		}

		public function delete()
		{
			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$id = $this->uri->segment(3);

				$data['band'] = $this->band_model->delete_bands_page($id); 
				
				$this->load->view('templates/header');
				$this->load->view('templates/header-nav');
				$this->load->view('bands/delete', $data);
				$this->load->view('templates/footer');
			}
			else 
			{
				$id = $this->uri->segment(3);
				$this->band_model->delete_bands($id);

				redirect(base_url());
			}
		}

		public function update()
		{
			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$id = $this->uri->segment(3);

				$data['band'] = $this->band_model->update_bands_page($id);

				$this->load->view('templates/header');
				$this->load->view('templates/header-nav');
				$this->load->view('bands/update', $data);
				$this->load->view('templates/footer');
			}
			elseif($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$id = $this->uri->segment(3);
				$data = array(
					'bandname' => $this->input->post('bandname'),
					'wikipedia' => $this->input->post('wikipedia'),
					'website' => $this->input->post('website')
					);
				$this->band_model->update_bands($id,$data);

				redirect(base_url());
			} 
		}

		public function register()
		{
			$this->form_validation->set_rules('userName', 'username', 'required|xss_clean|is_unique[users.userName]');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.userEmail]');
			$this->form_validation->set_rules('password', 'password', 'trim|required|matches[passwordVal]|min_length[6]');
			$this->form_validation->set_rules('passwordVal', 'password confirmation', 'required');

			$this->form_validation->set_message('is_unique', 'This username already exists');
			//$this->form_validation->set_message('password_check', 'The password needs to consist of atleast one letter and number');

			function password_check($str)
			{
				if(preg_match('/[0-9]/', $str) && preg_match('/[a-zA-Z]/', $str))
				{
					return true;
				}
					return false;
			}
			

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('templates/header-nav');
				$this->load->view('user/register');
				$this->load->view('templates/footer');
			}
			else
			{
				$data = array(
					'userName' 	=> $this->input->post('userName'),
					'userEmail' => $this->input->post('email'),
					'userPass'  => $this->input->post('password'),
					'hash' => md5(rand(0, 1000))
					);

				$result = $this->band_model->register_user($data);
				$result = $this->band_model->send_mail($data);

				if ($result == TRUE) 
				{
							$session_data = $data['userName'];
							$this->session->set_userdata('logged_in', $session_data);
							$this->band_model->register_user($data);
							redirect(base_url());
				}
				else {
					redirect(base_url('index.php/user/register'));
				}
			}	
		}
		public function register_verify()
		{
			$this->load->view('templates/header');
			$this->load->view('templates/header-nav');
			$this->load->view('user/register_verify');
			$this->load->view('templates/footer');

			$result = $this->band_model->get_hash_value($_GET['email']);
			if ($result)
			{
				if($result['hash'] == $_GET['hash'])
				{
					 $this->band_model->verify_user($_GET['email']);
					 header('refresh:5;url='.base_url().'');
				}
			}
		}

		public function login() 
		{
			$this->form_validation->set_rules('username', 'username', 'callback_login_check');
			$this->form_validation->set_rules('password', 'password', 'callback_login_check');

			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('templates/header-nav');
				$this->load->view('user/login');
				$this->load->view('templates/footer');
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$data = array(
					'userName' => $this->input->post('userName'),
					'userPass' => $this->input->post('password')
					);

			 	$result = $this->band_model->login_user($data);
			 	
			 	function login_check()
			 	{
			 		if($result == true)
			 		{
			 			return true;
			 		}
			 		return false;
			 	}

				if($result == TRUE)
				{
					$session_data = $data['userName'];
					$this->session->set_userdata('logged_in',$session_data);
					redirect(base_url());
				}
				else
				{
					$this->form_validation->set_message('login_check','You need to enter the right credentials');
					redirect(base_url('index.php/user/login/'));
				}
			}
		}

		public function logout()
		{
			$this->session->unset_userdata('logged_in');
			$logout = true;
			redirect(base_url());
		}
	}