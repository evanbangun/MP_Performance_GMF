<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
		ROLE 1 : admin gmf
		ROLE 2 : admin garuda
		ROLE 3 : user gmf
		ROLE 4 : user garuda
	*/

	function __construct() {
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		if($this->session->userdata('username'))
		{
			redirect('dashboard');
		}
		$this->load->view("layout/v_login");
	}

	public function check_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data['users'] = $this->m_login->getUser($username, $password);
		if(!empty($data['users']))
		{	
			$newsession = array(
			   'id_user'	=> $data['users'][0]['id_user'],
               'username'	=> $data['users'][0]['username'],
               'name'		=> $data['users'][0]['name'],
               'signature'	=> $data['users'][0]['signature'],
               'role'		=> $data['users'][0]['role'],
               'unit'		=> $data['users'][0]['unit'],
               'ac_type'	=> $data['users'][0]['ac_type'],
               'resp'		=> $data['users'][0]['resp'],
               'logged_in'	=> TRUE
           	);
			$this->session->set_userdata($newsession);
           	redirect('dashboard');
		}
		else
		{
			$data['message'] = 'Login gagal. Cek ulang username dan password anda.';
			$this->load->view("layout/v_login", $data);
		}
	}

	public function logout()
	{
		$unsetsession = array(
			   'id_user'	=> "",
               'username'	=> "",
               'name'		=> "",
               'signature'	=> "",
               'role'		=> "",
               'unit'		=> "",
               'logged_in'	=> FALSE
           	);
		$this->session->unset_userdata($unsetsession);
		$this->session->sess_destroy();
		$this->load->view("layout/v_login");
	}	
}
