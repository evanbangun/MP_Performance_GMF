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
			$date_range = explode(" - ",$reservation);
			$date = date_create_from_format('m/d/Y', $date_range[0]);
			$date_min = $date->format('Y-m-d');
			$date = date_create_from_format('m/d/Y', $date_range[1]);
			$date_max = $date->format('Y-m-d');
		
			$data['list_assignment'] = $this->m_summary->tampilassignment($ac_type, $date_min, $date_max);
		}

		$data['list_actype'] = $this->m_dashboard->actype();

		$this->load->view("layout/v_template", $data);
	}
}

