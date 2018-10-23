<?php

class m_login extends CI_Model
{
	public function getUser($username, $password)
	{
		$query = $this->db->query("	SELECT *
									FROM users
									WHERE username = '$username' AND password = md5('$password') ");
  		return $query->result_array();
	}
}