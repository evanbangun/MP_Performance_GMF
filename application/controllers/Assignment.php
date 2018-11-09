<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_assignment');
        $this->load->library('datatables');

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
			"container" => "layout/v_assignment_bulk"
		);

		$data['list_assignment'] = $this->m_assignment->tampilassignment_bulk();	
		$data['list_user'] = $this->m_assignment->get_user($this->session->userdata('role'));

		$this->load->view("layout/v_template", $data);
	}

	public function detail_assignment($ac_type, $resp)
	{
		$data = array(
			"container" => "layout/v_detail_assignment"
		);

		$data['list_assignment'] = $this->m_assignment->tampilassignment($ac_type, $resp);
		$data['list_user'] = $this->m_assignment->get_user($this->session->userdata('role'));

		$this->load->view("layout/v_template", $data);
	}

	public function assignment_eval($ac_type, $resp)
	{
		$input = $this->m_assignment->tampilassignment($ac_type, $resp);
		foreach ($input as $i)
		{
			$data[] = array(
						'ms_num' => $i['ms_num'],
						'ac_type' => $i['ac_type'],
						'resp' => $i['resp'],
						'status' => '1',
						);
		}
		$this->m_assignment->assign_batch('ev_task_process', $data);
		redirect($_SERVER['HTTP_REFERER']);
		// $data = array(
		// 				'ms_num' => $ms_num,
		// 				'ac_type' => $ac_type,
		// 				'id_user' => $user_id
		// 				);
		// $this->m_assignment->assign('ev_task_assign', $data);
		// $data = array(
		// 				'ms_num' => $ms_num,
		// 				'ac_type' => $ac_type,
		// 				'id_user' => $user_id,
		// 				'status' => $status+1
		// 				);
		// $this->m_assignment->assign('ev_task_process', $data);
	}

	public function assignment_verif($ac_type, $resp)
	{
		$input = $this->m_assignment->tampilassignment($ac_type, $resp);
		foreach ($input as $i)
		{
			$data[] = array(
						'ms_num' => $i['ms_num'],
						'ac_type' => $i['ac_type'],
						'resp' => $i['resp'],
						'status' => '4',
						);
		}
		$this->m_assignment->assign_batch('ev_task_process', $data);
		redirect($_SERVER['HTTP_REFERER']);
		// $data = array(
		// 				'ms_num' => $ms_num,
		// 				'ac_type' => $ac_type,
		// 				'id_user' => $user_id
		// 				);
		// $this->m_assignment->assign('ev_task_assign', $data);
		// $data = array(
		// 				'ms_num' => $ms_num,
		// 				'ac_type' => $ac_type,
		// 				'id_user' => $user_id,
		// 				'status' => $status+1
		// 				);
		// $this->m_assignment->assign('ev_task_process', $data);
	}
}

