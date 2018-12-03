<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRUD_user extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_crud_user');
		$this->load->model('m_dashboard');
        $this->load->library('datatables');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
		elseif ($this->session->userdata('role') == 3 || $this->session->userdata('role') == 4 ) 
		{
			redirect('user');
		}
	}

	public function index()
	{
		$data = array(
			"container" => "layout/v_add_user"
		);

		$data['user'] = $this->m_crud_user->get_all_user();
		$data['list_actype'] = $this->m_dashboard->actype();
		$data['list_resp'] = $this->m_crud_user->get_all_resp();
		$this->load->view("layout/v_template", $data);
	}

	public function add_user()
	{	

		$data = array(
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password')),
						'name' => $this->input->post('name'),
						'no_pegawai' => $this->input->post('no_pegawai'),
						'role' => $this->input->post('role'),
						'unit' => $this->input->post('unit')
						);
		if($this->input->post('role') == 3 || $this->input->post('role') == 4)
		{
			$data += ['ac_type' => $this->input->post('ac_type'),
						'resp' => $this->input->post('resp')];
		}						

		$this->m_crud_user->add_user('users', $data);
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit_user()
	{		
		$data = array(
						'username' => $this->input->post('username'),
						'name' => $this->input->post('name'),
						'no_pegawai' => $this->input->post('no_pegawai'),
						'role' => $this->input->post('role'),
						'unit' => $this->input->post('unit')
						);
		if($this->input->post('role') == 3 || $this->input->post('role') == 4)
		{
			$data += ['ac_type' => $this->input->post('ac_type'),
						'resp' => $this->input->post('resp')];
		}
		else if($this->input->post('role') == 1 || $this->input->post('role') == 2)
		{
			$data += ['ac_type' => "",
						'resp' => ""];
		}

		$this->m_crud_user->update_user('users', $data, $this->input->post('id_user'));
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function reset_password()
	{
		$data = array(
						'password' => md5('Aeroas1@')
						);
		$this->m_crud_user->update_user('users', $data, $this->input->post('id_user'));
	}

	public function get_user_by_id()
	{
    	echo json_encode($this->m_crud_user->get_user_by_id($this->input->post("id_user")));
	}

	public function delete_user_by_id()
	{
    	$this->m_crud_user->delete_user('users', $this->input->post("id_user"));
	}
}

