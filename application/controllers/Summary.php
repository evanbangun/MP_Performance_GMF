<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_summary');

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

		$data['list_assignment'] = $this->m_summary->tampilassignment();
		//var_dump($this->m_assignment->tampilassignment());die();

		$this->load->view("layout/v_template", $data);
	}
}

