<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_assignment');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
		elseif ($this->session->userdata('role') > 2) 
		{
			redirect('user');
		}
	}

	public function index()
	{
		$data = array(
			"container" => "layout/v_assignment"
		);

		$data['list_assignment'] = $this->m_assignment->tampilassignment();	
		$data['list_user'] = $this->m_assignment->get_user($this->session->userdata('role'));

		$this->load->view("layout/v_template", $data);
	}

	public function assignment()
	{
		extract($_POST);
		$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $user_id
						);
		$this->m_assignment->assign('ev_task_assign', $data);
		$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $user_id,
						'status' => $status+1
						);
		$this->m_assignment->assign('ev_task_process', $data);
	}
}

