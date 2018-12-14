<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_summary');
		$this->load->model('m_dashboard');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			"container" => "layout/v_summary"
		);
		if(!empty($_POST))
		{
			$ac_type = $this->input->post('ac_type');
			$reservation = $this->input->post('reservation');
			$ms_num = $this->input->post('ms_num');
			$resp = $this->input->post('resp');
			// var_dump($_POST);
			if($reservation != '')
			{
				$date_range = explode(" - ",$reservation);
				$date = date_create_from_format('m/d/Y', $date_range[0]);
				$date_min = $date->format('Y-m-d');
				$date = date_create_from_format('m/d/Y', $date_range[1]);
				$date_max = $date->format('Y-m-d');
			}
			else
			{
				$date_min = '';
				$date_max = '';
			}
			
			// $data['list_assignment'] = $this->m_summary->tampilassignment($ac_type, $date_min, $date_max, $ms_num, $resp);
			$data['ac_type'] = $ac_type;
			$data['date_min'] = $date_min;
			$data['date_max'] = $date_max;
			$data['reservation'] = $reservation;
			$data['ms_num'] = $ms_num;
			$data['resp'] = $resp;
		}

		$data['list_actype'] = $this->m_dashboard->actype();
		$data['list_resp'] = $this->m_dashboard->resp();
		$this->load->view("layout/v_template", $data);
	}

	public function summary_ajax()
	{
		$ac_type = $_POST['ac_type'];
		$ms_num = $_POST['ms_num'];
		$resp = $_POST['resp'];
		$date_max = $_POST['date_max'];
		$date_min = $_POST['date_min'];
		
		$list = $this->m_summary->detail_summary($ac_type, $date_min, $date_max, $ms_num, $resp);
		$data=array();

		$i = 1;
		foreach ($list as $grid) {
			$row=array();

			$row[]=($_POST['start']) + $i++;
			$row[]='<a href="'.base_url('index.php/task/task_performance/'.$grid['ms_num'].'/'.$grid['ac_type']).'">'.$grid['ms_num'].'</a>';
       	    $row[]=$grid['task_code'];
          	$row[]=$grid['ac_eff'];
            $row[]=$grid['descr'];
            $row[]=$grid['intval_threshold'];
            $row[]=$grid['rec_threshold'];
            $row[]=$grid['intval'];
       	    $row[]=$grid['rec_interval'];
          	$row[]=$grid['camp_sg'];
            $row[]=$grid['ref_man'];
            $row[]=$grid['recommendation'];
            $row[]=$grid['name_gmf'];
            $row[]=$grid['name_garuda'];
            
            $data[] = $row;          

		}


		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->m_summary->count_all($ac_type, $date_min, $date_max, $ms_num, $resp),
			"recordsFiltered" 	=> $this->m_summary->count_filtered($ac_type, $date_min, $date_max, $ms_num, $resp),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}
}

