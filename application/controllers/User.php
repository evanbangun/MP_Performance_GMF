<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_task');
		$this->load->model('m_notifications');

		if(!$this->session->userdata('username'))
		{
			redirect('login');
		}
		elseif ($this->session->userdata('role') < 3) 
		{
			redirect('assignment');
		}
	}

	public function index()
	{
		$data = array(
			"container" => "layout/v_user"
		);

		$data['list_assignment'] = $this->m_user->tampilassignment($this->session->userdata('ac_type'), $this->session->userdata('resp'));

		$this->load->view("layout/v_template", $data);
	}

	public function assign_task($ms_num, $ac_type, $resp)
	{
		if($this->session->userdata('role') == 3)
		{
			$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $this->session->userdata('id_user')
						);
			$this->m_task->insert_task('ev_task_assign', $data);
			$data = array(
							'ms_num' => $ms_num,
							'ac_type' => $ac_type,
							'resp' => $resp,
							'id_user' => $this->session->userdata('id_user'),
							'status' => '2'
							);
			$this->m_task->insert_task('ev_task_process', $data);
		}
		else if($this->session->userdata('role') == 4)
		{
			$data = array(
						'ms_num' => $ms_num,
						'ac_type' => $ac_type,
						'id_user' => $this->session->userdata('id_user')
						);
			$this->m_task->insert_task('ev_task_assign', $data);
			$data = array(
							'ms_num' => $ms_num,
							'ac_type' => $ac_type,
							'resp' => $resp,
							'id_user' => $this->session->userdata('id_user'),
							'status' => '5'
							);
			$this->m_task->insert_task('ev_task_process', $data);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function insert_eval()
	{
		$back_and_forth = $this->m_task->back_and_forth($this->input->post("ms_num"), $this->input->post("ac_type"));
		if($this->input->post("rec") == "" || $this->input->post("reason") == "" )
		{
			redirect_back();
		}
		if($this->input->post("rec") == "2" || $this->input->post("rec") == "3")
		{
			if($this->input->post("rec_threshold") == "" || $this->input->post("rec_interval") == "")
			{
				redirect_back();
			}
			else
			{
				$data = array(
								'ms_num' => $this->input->post("ms_num"),
								'ac_type' => $this->input->post("ac_type"),
								'id_user' => $this->session->userdata('id_user'),
								'recommendation' => $this->input->post("rec"),
								'rec_threshold' => $this->input->post("rec_threshold"),
								'rec_interval' => $this->input->post("rec_interval"),
								'reason' => $this->input->post("reason")
								);
			}
		}
		else
		{
			$data = array(
							'ms_num' => $this->input->post("ms_num"),
							'ac_type' => $this->input->post("ac_type"),
							'id_user' => $this->session->userdata('id_user'),
							'recommendation' => $this->input->post("rec"),
							'rec_threshold' => "",
							'rec_interval' => "",
							'reason' => $this->input->post("reason")
							);
		}
		if(!$back_and_forth)
		{
			$this->m_task->insert_task('ev_evaluation', $data);
			$data = array(
				'ms_num' => $this->input->post("ms_num"),
				'ac_type' => $this->input->post("ac_type"),
				'id_user' => $this->session->userdata('id_user'),
				'resp' => $this->input->post("resp"),
				'status' => $this->input->post("status") + 1
				);
		}
		else
		{
			$id_reason = $this->m_task->get_id_reason($this->input->post("ms_num"), $this->input->post("ac_type"));
			$verificator = $this->m_task->get_id_user($this->input->post("ms_num"), $this->input->post("ac_type"), 4);
			$this->m_task->update_task('ev_evaluation', $data, 'id_reason', $id_reason);
			$data = array(
				'ms_num' => $this->input->post("ms_num"),
				'ac_type' => $this->input->post("ac_type"),
				'id_user' => $verificator->id_user,
				'resp' => $this->input->post("resp"),
				'status' => $this->input->post("status") + 3
				);


			$data_notif = array(
						'id_user' => $verificator->id_user,
						'src_notif' => 'index.php/task/task_performance/'.$this->input->post("ms_num").'/'.$this->input->post("ac_type"),
						'notif_message' => 'Task has been evaluated',
						'unread' => '1',
						);
			$this->m_notifications->notify('notifications_history', $data_notif);
			$this->sendFCMU($verificator->token, $data, 4);
		}
		$this->m_task->insert_task('ev_task_process', $data);

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function insert_rem()
	{
		if($this->input->post("remarks") == "")
		{
			redirect_back();
		}
		$back_and_forth = $this->m_task->back_and_forth($this->input->post("ms_num"), $this->input->post("ac_type"));
		if($this->input->post('submit_rem') == "Deny")
		{
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'remarks' => $this->input->post("remarks"),
						'status' => 'Denied'
						);
			if(!$back_and_forth)
			{
				$this->m_task->insert_task('ev_remarks', $data);
			}
			else
			{
				$id_remarks = $this->m_task->get_id_remarks($this->input->post("ms_num"), $this->input->post("ac_type"));	
				$this->m_task->update_task('ev_remarks', $data, 'id_remarks', $id_remarks);
			}
			$evaluator = $this->m_task->get_id_user($this->input->post("ms_num"), $this->input->post("ac_type"), 3);
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $evaluator->id_user,
						'resp' => $this->input->post("resp"),
						'status' => $this->input->post("status") - 3
						);
			$this->m_task->insert_task('ev_task_process', $data, 3);

			$data_notif = array(
						'id_user' => $evaluator->id_user,
						'src_notif' => 'index.php/task/task_performance/'.$this->input->post("ms_num").'/'.$this->input->post("ac_type"),
						'notif_message' => 'Task has been denied',
						'unread' => '1',
						);
			$this->m_notifications->notify('notifications_history', $data_notif);
			$this->sendFCMU($evaluator->token, $data, 3);
		}
		else if($this->input->post('submit_rem') == "Verify")
		{
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'remarks' => $this->input->post("remarks"),
						'status' => 'Verified'
						);
			if(!$back_and_forth)
			{
				$this->m_task->insert_task('ev_remarks', $data);
			}
			else
			{
				$id_remarks = $this->m_task->get_id_remarks($this->input->post("ms_num"), $this->input->post("ac_type"));	
				$this->m_task->update_task('ev_remarks', $data, 'id_remarks', $id_remarks);
			}
			$data = array(
						'ms_num' => $this->input->post("ms_num"),
						'ac_type' => $this->input->post("ac_type"),
						'id_user' => $this->session->userdata('id_user'),
						'resp' => $this->input->post("resp"),
						'status' => $this->input->post("status") + 1
						);
			$this->m_task->insert_task('ev_task_process', $data);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function reject_finding()
	{
		$this->m_task->reject_finding($this->input->post("id_ms_performance_all"));
	}

	public function sendFCMU($token, $data, $role)
	{
		if($role == 3)
		{
			$title = 'EVALUTION DENIED';
			$body = 'Your evaluation on '.$data['ms_num'].'/'.$data['ac_type'].' was denied';
		}
		else if ($role == 4)
		{
			$title = 'TASK EVALUATED';
			$body = ''.$data['ms_num'].'/'.$data['ac_type'].' has been evaluated';
		}
		//var_dump($token_list);die();
	    $API_ACCESS_KEY = "AAAAQdKriDo:APA91bGtSE9UogoA2Y3q5U_OrEbRHf1Rrxo8Ih-cgOa-oSAgxFgHK-T83722-6AJLMpAfvPBWPZtY9lnzVPQplz3zLmIW9iWHzLLCMZZPPT6XAIOA7lm3XSA7Ow_WZFdt5u3XIYkbMMt";

	    $url = 'https://fcm.googleapis.com/fcm/send';

	    $fields = array (
	            'to' => $token,
	      //       "data" => array (
			    //     "title" => "my title",
			    //     "message"=> "my message",
			    //     "image"=> "http://www.androiddeft.com/wp-content/uploads/2017/11/Shared-Preferences-in-Android.png",
			    //     "action"=> "url",
			    //     "action_destination"=> "http://androiddeft.com"
			    // ),                
	            'priority' => 'high',
	            'notification' => array(
	                        'title' => $title,
	                        'body' => $body,                            
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

