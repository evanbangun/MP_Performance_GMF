<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_task');
	}

	public function task_performance($ms_num, $ac_type)
	{
		$data = array(
			"container" => "layout/v_task_performance"
		);
		$data['list_task'] = $this->m_task->getTaskDataByMSNum($ms_num, $ac_type);
		$data['table_sri'] = $this->m_task->getTableSRI($ms_num);
		$data['table_delay'] = $this->m_task->getTableDelay($ms_num);
		$data['table_removal'] = $this->m_task->getTableRemoval($ms_num);
		//$data['table_summary'] = $this->m_task->getTableSummary($ms_num);
		$data['finding'] = $this->m_task->getFinding($ms_num);
		$data['count_acc'] = $this->m_task->countAcc($ms_num);
		$data['count_finding'] = $this->m_task->countFinding($ms_num);
		$data['task_process_detail'] = $this->m_task->task_process_detail($ms_num, $ac_type);
		$data['task_evaluation'] = $this->m_task->task_evaluation($ms_num, $ac_type);
		$data['task_remarks'] = $this->m_task->task_remarks($ms_num, $ac_type);

		$this->load->view("layout/v_template", $data);
	}

	public function summary()
	{
		$data = array(
			"container" => "layout/v_summary"
		);

		$this->load->view("layout/v_template", $data);
	}
}

