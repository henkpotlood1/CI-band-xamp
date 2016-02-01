<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function create() 
		{
			echo "test";
			exit;
			$this->load->helper('form_helper');
			$this->load->library('form_validation');
			$this->load->helper('url');

			$this->form_validation->set_rules('bandName', 'Bandname', 'required');
			$this->form_validation->set_rules('wikipedia', 'Wikipedia', 'required');
			$this->form_validation->set_rules('website', 'Website', 'required');
			/*
			//if($this->form_validation->run() === FALSE)
			//{
				$this->load->view('templates/header', $data);
				$this->load->view('templates/header-nav', $data);
				$this->load->view('bands/create');
				$this->load->view('templates/footer');
			//}*/
		}
}
