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
		$this->m_notifications->notify_batch('notifications_history', $data_notif);
		$this->sendFCMA($notif);
		redirect($_SERVER['HTTP_REFERER']);
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
		$this->m_notifications->notify_batch('notifications_history', $data_notif);
		$this->sendFCMA($notif);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sendFCMA($notif)
	{
		foreach ($notif as $n) {
			$token_list[] = $n['token'];
		}
		//var_dump($token_list);die();
	    $API_ACCESS_KEY = "AAAAQdKriDo:APA91bGtSE9UogoA2Y3q5U_OrEbRHf1Rrxo8Ih-cgOa-oSAgxFgHK-T83722-6AJLMpAfvPBWPZtY9lnzVPQplz3zLmIW9iWHzLLCMZZPPT6XAIOA7lm3XSA7Ow_WZFdt5u3XIYkbMMt";

	    $url = 'https://fcm.googleapis.com/fcm/send';

	    $fields = array (
	            'registration_ids' => $token_list,
	      //       "data" => array (
			    //     "title" => "my title",
			    //     "message"=> "my message",
			    //     "image"=> "http://www.androiddeft.com/wp-content/uploads/2017/11/Shared-Preferences-in-Android.png",
			    //     "action"=> "url",
			    //     "action_destination"=> "http://androiddeft.com"
			    // ),                
	            'priority' => 'high',
	            'notification' => array(
	                        'title' => 'NEW TASK',
	                        'body' => 'New task has been assigned',                            
	            ),
	    );
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

