<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignment extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_assignment');
		$this->load->model('m_notifications');
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

		$data['ac_type'] = $ac_type;
		$data['resp'] = $resp;

		// $data['list_assignment'] = $this->m_assignment->tampilassignment($ac_type, $resp);
		// $data['list_user'] = $this->m_assignment->get_user($this->session->userdata('role'));

		$this->load->view("layout/v_template", $data);
	}
	
	public function detail_assignment_ajax()
	{
		$ac_type = $_POST['ac_type'];
		$resp = $_POST['resp'];

		$list = $this->m_assignment->detail_assignment($ac_type, $resp);
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
			"recordsTotal" 		=> $this->m_assignment->count_all($ac_type, $resp),
			"recordsFiltered" 	=> $this->m_assignment->count_filtered($ac_type, $resp),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}
	

	public function assignment_eval()
	{
		$ac_type = $this->input->post('ac_type_post');
		$resp = $this->input->post('resp_post');
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

		$notif = $this->m_notifications->get_concerned_user($ac_type, $resp, 3);
		foreach ($notif as $i)
		{
			$data_notif[] = array(
						'id_user' => $i['id_user'],
						'src_notif' => 'index.php/user',
						'notif_message' => 'New task has been assigned',
						'unread' => '1',
						);
		}
		if(count($notif))
		{
			$this->m_notifications->notify_batch('notifications_history', $data_notif);
		}
		$this->sendFCMA($notif);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function assignment_verif()
	{
		$ac_type = $this->input->post('ac_type_post');
		$resp = $this->input->post('resp_post');
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

		$notif = $this->m_notifications->get_concerned_user($ac_type, $resp, 4);
		foreach ($notif as $i)
		{
			$data_notif[] = array(
						'id_user' => $i['id_user'],
						'src_notif' => 'index.php/user',
						'notif_message' => 'New task has been assigned',
						'unread' => '1',
						);
		}
		if(count($notif))
		{
			$this->m_notifications->notify_batch('notifications_history', $data_notif);
		}
		$this->sendFCMA($notif);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sendFCMA($notif)
	{
		foreach ($notif as $n) {
			$token_list[] = $n['token'];
		}
	    $API_ACCESS_KEY = "AAAAQdKriDo:APA91bGtSE9UogoA2Y3q5U_OrEbRHf1Rrxo8Ih-cgOa-oSAgxFgHK-T83722-6AJLMpAfvPBWPZtY9lnzVPQplz3zLmIW9iWHzLLCMZZPPT6XAIOA7lm3XSA7Ow_WZFdt5u3XIYkbMMt";

	    $url = 'https://fcm.googleapis.com/fcm/send';
	    if(count($token_list) > 1)
	    {
		    $fields = array (
		            'registration_ids' => $token_list,
		            'priority' => 'high',
		            'notification' => array(
		                        'title' => 'NEW TASK',
		                        'body' => 'New task has been assigned',                            
		            ),
		    );
	    }
	    else
	    {
	    	$fields = array (
		            'to' => $token_list[0],        
		            'priority' => 'high',
		            'notification' => array(
		                        'title' => 'NEW TASK',
		                        'body' => 'New task has been assigned',                            
		            ),
		    );
	    }
	    $fields = json_encode ( $fields );

	    $headers = array (
	            'Authorization: key=' . $API_ACCESS_KEY,
	            'Content-Type: application/json'
	    );
	    $ch = curl_init ();
	    curl_setopt ( $ch, CURLOPT_URL, $url );
	    curl_setopt ( $ch, CURLOPT_POST, true );
	    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}
}

