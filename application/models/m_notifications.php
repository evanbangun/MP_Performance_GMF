<?php

class m_notifications extends CI_Model
{
	public function insert_notifications_token($table, $data)
	{
        $this->db->insert($table,$data);
	}

	public function update_notifications_token($id, $data)
	{
		$this->db->where('id_user', $id);
		$this->db->update('notifications', $data);
	}

	public function get_notifications_token($id_user)
	{
        $query = $this->db->query(
	    					"SELECT * FROM notifications WHERE id_user = '$id_user'");
		return $query->result_array();
	}

	public function get_concerned_user($ac_type, $resp, $role)
	{
        $query = $this->db->query(
	    					"SELECT u.id_user, n.token
	    					FROM users u
	    					LEFT JOIN notifications n ON n.id_user = u.id_user
	    					WHERE u.ac_type = '$ac_type' AND u.resp = '$resp' AND u.role = '$role'");
		return $query->result_array();
	}

	public function get_concerned_admin($role)
	{
        $query = $this->db->query(
	    					"SELECT u.id_user, n.token
	    					FROM users u
	    					LEFT JOIN notifications n ON n.id_user = u.id_user
	    					WHERE u.role = '$role'");
		return $query->result_array();
	}

	public function notify_batch($table, $data)
	{
		$this->db->insert_batch($table, $data);
	}

	public function notify($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function get_notifications($id)
	{
		$query = $this->db->query(
	    					"SELECT * FROM notifications_history WHERE id_user = '$id' AND unread = 1 LIMIT 10");
		return $query->result_array();
	}

	public function get_notification_data($id)
	{
		$query = $this->db->query(
	    					"SELECT id_user, src_notif FROM notifications_history WHERE id_notif_his = '$id' LIMIT 1");
		return $query->row();
	}

	public function update_notif_read($id_user, $link)
	{
		$data = array('unread' => 0);    
		$this->db->where('id_user', $id_user);
		$this->db->where('src_notif', $link);
		$this->db->update('notifications_history', $data);
	}
}