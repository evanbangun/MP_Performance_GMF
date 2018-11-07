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

		$data['list_assignment'] = $this->m_user->tampilassignment($this->session->userdata('ac_type'), $this->session->userdata('resp'));

		$this->load->view("layout/v_template", $data);
	}

	public function assign_task($ms_num, $ac_type, $resp)
	{
		if($this->session->userdata('role') == 3)
		{
			$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $this->session->userdata('id_user')
						);
			$this->m_task->insert_task('ev_task_assign', $data);
			$data = array(
							'ms_num' => $ms_num,
							'ac_type' => $ac_type,
							'resp' => $resp,
							'id_user' => $this->session->userdata('id_user'),
							'status' => '2'
							);
			$this->m_task->insert_task('ev_task_process', $data);
		}
		else if($this->session->userdata('role') == 4)
		{
			$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $this->session->userdata('id_user')
						);
			$this->m_task->insert_task('ev_task_assign', $data);
			$data = array(
							'ms_num' => $ms_num,
							'ac_type' => $ac_type,
							'resp' => $resp,
							'id_user' => $this->session->userdata('id_user'),
							'status' => '5'
							);
			$this->m_task->insert_task('ev_task_process', $data);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function insert_eval()
	{
		$back_and_forth = $this->m_task->back_and_forth($this->input->post("ms_num"), $this->input->post("ac_type"));
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
		if(!$back_and_forth)
		{
			$this->m_task->insert_task('ev_evaluation', $data);
			$data = array(
				'ms_num' => $this->input->post("ms_num"),
				'ac_type' => $this->input->post("ac_type"),
				'id_user' => $this->session->userdata('id_user'),
				'resp' => $this->input->post("resp"),
				'status' => $this->input->post("status") + 1
				);
		}
		else
		{
			$id_reason = $this->m_task->get_id_reason($this->input->post("ms_num"), $this->input->post("ac_type"));
			$id_verificator = $this->m_task->get_id_user($this->input->post("ms_num"), $this->input->post("ac_type"), 4);
			$this->m_task->update_task('ev_evaluation', $data, 'id_reason', $id_reason);
			$data = array(
				'ms_num' => $this->input->post("ms_num"),
				'ac_type' => $this->input->post("ac_type"),
				'id_user' => $id_verificator,
				'resp' => $this->input->post("resp"),
				'status' => $this->input->post("status") + 3
				);
		}
		$this->m_task->insert_task('ev_task_process', $data);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function insert_rem()
	{
		if($this->input->post("remarks") == "")
		{
			redirect_back();
		}
		$back_and_forth = $this->m_task->back_and_forth($this->input->post("ms_num"), $this->input->post("ac_type"));
		if($this->input->post('submit_rem') == "Deny")
		{
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'remarks' => $this->input->post("remarks"),
						'status' => 'Denied'
						);
			if(!$back_and_forth)
			{
				$this->m_task->insert_task('ev_remarks', $data);
			}
			else
			{
				$id_remarks = $this->m_task->get_id_remarks($this->input->post("ms_num"), $this->input->post("ac_type"));	
				$this->m_task->update_task('ev_remarks', $data, 'id_remarks', $id_remarks);
			}
			$id_evaluator = $this->m_task->get_id_user($this->input->post("ms_num"), $this->input->post("ac_type"), 3);
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $id_evaluator,
						'resp' => $this->input->post("resp"),
						'status' => $this->input->post("status") - 3
						);
			$this->m_task->insert_task('ev_task_process', $data);
		}
		else if($this->input->post('submit_rem') == "Verify")
		{
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'remarks' => $this->input->post("remarks"),
						'status' => 'Verified'
						);
			if(!$back_and_forth)
			{
				$this->m_task->insert_task('ev_remarks', $data);
			}
			else
			{
				$id_remarks = $this->m_task->get_id_remarks($this->input->post("ms_num"), $this->input->post("ac_type"));	
				$this->m_task->update_task('ev_remarks', $data, 'id_remarks', $id_remarks);
			}
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'resp' => $this->input->post("resp"),
						'status' => $this->input->post("status") + 1
						);
			$this->m_task->insert_task('ev_task_process', $data);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function reject_finding()
	{
		$this->m_task->reject_finding($this->input->post("id_ms_performance_all"));
	}
}

