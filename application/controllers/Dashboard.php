<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_crud_user');
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
		$data['data_dashboard'] = $this->m_dashboard->data_dashboard();
		// $this->load->view('layout/layout-fix.php');
		$this->load->view("layout/v_template", $data);
	}

	public function filter_search()
	{
		$data = array(
			"container" => "layout/v_search_result"
		);
		$ac_type = $this->input->post('ac_type_post');
		$reservation = $this->input->post('reservation');
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
		
		$ms_num = $this->input->post('ms_num_post');
		$resp = $this->input->post('resp_post');
		
		$data['ac_type'] = $ac_type;
		$data['date_min_post'] = $date_min;
		$data['date_max_post'] = $date_max;
		$data['reservation'] = $reservation;
		$data['ms_num'] = $ms_num;
		$data['resp'] = $resp;
		$data['list_actype'] = $this->m_dashboard->actype();
		$data['list_resp'] = $this->m_dashboard->resp();
		$this->load->view("layout/v_template", $data);
	}

	public function edit_signature()
	{
		$data = array(
			"container" => "layout/v_edit_signature"
		);
		$data['user'] = $this->m_user->get_user($this->session->userdata('username'));
		$this->load->view("layout/v_template", $data);
	}

	public function save_signature()
	{
		if (isset($_POST['imageData'])) {
		    $imgData = base64_decode($_POST['imageData']);
		    $image_name= $_POST['image_name'];

		    // Path where the image is going to be saved
		    $filePath = 'assets/img/signature/'.$image_name.'_signature.jpg';
		    // Delete previously uploaded image
		    if (file_exists($filePath)) { unlink($filePath); }

		    // Write $imgData into the image file
		    $file = fopen($filePath, 'w');
		    fwrite($file, $imgData);
		    fclose($file);
			$this->m_user->update_signature($this->session->userdata('username'));
		} else {
		    echo "imgData doesn't exists";
		}
	}

	public function change_password()
	{
		// var_dump($this->input->post('old_password'));die();
		if(md5($this->input->post('old_password')) == $this->session->userdata('password'))
		{
			$data = array('password' => md5($this->input->post('new_password')));
			$this->m_crud_user->update_user('users', $data, $this->session->userdata("id_user"));
			$return['success'] = True;
			$return['message'] = 'Password berhasil diubah';
			echo json_encode($return);
		}
		else
		{
			$return['success'] = False;
			$return['message'] = 'Gagal mengubah password !';
			echo json_encode($return);
		}
	}

	public function search_ajax()
	{
		$ac_type = $_POST['ac_type'];
		$ms_num = $_POST['ms_num'];
		$resp = $_POST['resp'];
		$date_max = $_POST['date_max'];
		$date_min = $_POST['date_min'];
		
		$list = $this->m_dashboard->detail_search($ac_type, $date_min, $date_max, $ms_num, $resp);
		$data=array();

		$i = 1;
		foreach ($list as $grid) {
			$row=array();

			$row[]=($_POST['start']) + $i++;
			$row[]='<a href="'.base_url('index.php/task/task_performance/'.$grid['ms_num'].'/'.$grid['ac_type']).'">'.$grid['ms_num'].'</a>';
       	    $row[]=$grid['ac_type'];
          	$row[]=$grid['resp'];
            $row[]=$grid['descr'];
            $row[]=$grid['intval'];
            $row[]=$grid['rvcd'];
            $row[]=$grid['camp_sg'];
            if($grid['status'] == "" || $grid['status'] == 0 )
            {
              $row[] = '<span class="label label-default">Unassigned</span>';
            }
            else if($grid['status'] == 1 || $grid['status'] == 4)
            {
              $row[] = '<span class="label label-primary">Assigned</span>';
            }
            else if($grid['status'] == 2)
            {
              $row[] = '<span class="label label-warning">Evaluating</span>';
            }
            else if($grid['status'] == 3)
            {
              $row[] = '<span class="label label-info">Evaluated</span>';
            }
            else if($grid['status'] == 5)
            {
              $row[] = '<span class="label label-warning">Verifying</span>';
            }
            else if($grid['status'] == 6)
            {
              $row[] = '<span class="label label-success">Verified</span>';
            }

            $data[] = $row;          

		}


		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->m_dashboard->count_all($ac_type, $date_min, $date_max, $ms_num, $resp),
			"recordsFiltered" 	=> $this->m_dashboard->count_filtered($ac_type, $date_min, $date_max, $ms_num, $resp),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}
}
