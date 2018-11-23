<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_notifications');
	}

	public function notifications_token()
	{
		$data = array('id_user' => $this->input->post('id_user'),
					  'token' =>  $this->input->post('token'));
		
		$notifications = $this->m_notifications->get_notifications_token($this->input->post('id_user'));

		if(empty($notifications))
		{
			$this->m_notifications->insert_notifications_token('notifications', $data);
		}
		else
		{
			$this->m_notifications->update_notifications_token($this->input->post('id_user'), $data);
		}
	}

	public function read_notif()
	{
		$this->m_notifications->update_notif_read($this->input->post('id_notif_his'));
	}

	public function get_notifications()
	{
		echo json_encode($this->m_notifications->get_notifications($this->input->post('id_user')));
	}

}

