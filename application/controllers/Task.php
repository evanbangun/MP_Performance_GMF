<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_task');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
	}

	public function task_performance($ms_num, $ac_type)
	{
		$data = array(
			"container" => "layout/v_task_performance"
		);
		$data['list_resp'] = $this->m_task->getResp();
		$data['list_task'] = $this->m_task->getTaskDataByMSNum($ms_num, $ac_type);
		$data['table_sri'] = $this->m_task->getTableSRI($ms_num, $ac_type);
		$data['table_delay'] = $this->m_task->getTableDelay($ms_num, $ac_type);
		$data['table_removal'] = $this->m_task->getTableRemoval($ms_num, $ac_type);
		//$data['table_summary'] = $this->m_task->getTableSummary($ms_num);
		$data['finding'] = $this->m_task->getFinding($ms_num, $ac_type);
		$data['count_acc'] = $this->m_task->countAcc($ms_num, $ac_type);
		$data['count_finding'] = $this->m_task->countFinding($ms_num, $ac_type);
		$data['rejected_finding'] = $this->m_task->rejectFinding($ms_num, $ac_type);
		$data['task_process_detail'] = $this->m_task->task_process_detail($ms_num, $ac_type);
		$data['task_evaluation'] = $this->m_task->task_evaluation($ms_num, $ac_type);
		$data['task_remarks'] = $this->m_task->task_remarks($ms_num, $ac_type);
		$data['history_log_remarks'] = $this->m_task->history_log_remarks($ms_num, $ac_type);
		$data['history_log_reason'] = $this->m_task->history_log_reason($ms_num, $ac_type);

		$this->load->view("layout/v_template", $data);
	}

	public function garuda_check_task_bulk($ac_type, $resp)
	{
		$check = $this->m_task->garuda_check_task_bulk($ac_type, $resp);

		if($check->evaluated == $check->count_data)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function summary()
	{
		$data = array(
			"container" => "layout/v_summary"
		);

		$this->load->view("layout/v_template", $data);
	}

	public function update_resp()
	{
		$array_where = array('ms_num' => $this->input->post('ms_num_post'),
					   'ac_type' => $this->input->post('ac_type_post'));
		$array_change = array('resp' => $this->input->post('resp_change_post'));
		$this->m_task->update_resp($array_where, $array_change);
		redirect($_SERVER['HTTP_REFERER']);
	}
}

