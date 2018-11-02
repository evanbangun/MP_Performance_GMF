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

    public function json(){
        $this->datatables->select("md.ms_num, md.ac_type, md.task_code, md.rvcd,
						   		   substr(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date ASC), -1) AS id_user,
						   		   substr(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date ASC), -1) AS status,
        						   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
        						   group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
						   		   group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval");
        $this->datatables->from('msi_data md');
        $this->datatables->join('msi_interval mi', 'md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type', 'left');
        $this->datatables->join('msi_sg ms', 'md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type', 'left');
        $this->datatables->join('ev_task_process etp', 'etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type', 'left');
        $this->datatables->group_by('md.ms_num, md.ac_type');
        return print_r($this->datatables->generate());
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

