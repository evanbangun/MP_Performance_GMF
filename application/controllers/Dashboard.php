<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_dashboard');
		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
	}

	public function index()
	{

		$data = array(
			"container" => "layout/v_dashboard"
		);
		$data['list_actype'] = $this->m_dashboard->actype();
		// $this->load->view('layout/layout-fix.php');
		$this->load->view("layout/v_template", $data);
	}

	public function search()
	{
		$data = array(
			"container" => "layout/v_search_result"
		);
		$ac_type = $this->input->post('ac_type');
		$data['result'] = $this->m_dashboard->search($ac_type);
		$this->load->view("layout/v_template", $data);
	}

	public function edit_signature()
	{
		$data = array(
			"container" => "layout/v_edit_signature"
		);
		// $this->load->view('layout/layout-fix.php');
		$this->load->view("layout/v_template", $data);
	}
}
