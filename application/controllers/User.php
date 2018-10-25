<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_task');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
		elseif ($this->session->userdata('role') < 3) 
		{
			redirect('assignment');
		}
	}

	public function index()
	{
		$data = array(
			"container" => "layout/v_user"
		);

		$data['list_assignment'] = $this->m_user->tampilassignment($this->session->userdata('id_user'));

		$this->load->view("layout/v_template", $data);
	}

	public function insert_eval()
	{
		if($this->input->post("rec") == "" || $this->input->post("reason") == "" )
		{
			redirect_back();
		}
		$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'recommendation' => $this->input->post("rec"),
						'reason' => $this->input->post("reason")
						);
		$this->m_task->insert_task('ev_evaluation', $data);
		
		$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'status' => $this->input->post("status") + 1
						);
		$this->m_task->insert_task('ev_task_process', $data);

		$data = array(
			"container" => "layout/v_user"
		);
		$data['list_assignment'] = $this->m_user->tampilassignment($this->session->userdata('id_user'));
		
		$this->load->view("layout/v_template", $data);
	}
}

