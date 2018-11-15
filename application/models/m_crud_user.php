<?php

class m_crud_user extends CI_Model
{
	public function get_all_user()
	{
		$query = $this->db->query("	SELECT *,	CASE WHEN role = 1 THEN 'Admin GMF'
                                                WHEN role = 2 THEN 'Admin Garuda'
                                                WHEN role = 3 THEN 'User GMF'
                                                WHEN role = 4 THEN 'User Garuda'
                                            END as role_word
									FROM users
									");
  		return $query->result_array();
	}

	public function get_user_by_id($id)
	{
		$query = $this->db->query("	SELECT *,	CASE WHEN role = 1 THEN 'Admin GMF'
                                                WHEN role = 2 THEN 'Admin Garuda'
                                                WHEN role = 3 THEN 'User GMF'
                                                WHEN role = 4 THEN 'User Garuda'
                                            END as role_word
									FROM users
									WHERE id_user = '$id'
									");
  		return $query->row();
	}

	public function get_all_resp()
	{
		$query = $this->db->query("	SELECT DISTINCT resp FROM msi_data WHERE resp != ''");
		return $query->result_array();
	}

	public function add_user($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function update_user($table, $data, $id)
	{
		$this->db->where('id_user', $id);
		$this->db->update($table, $data);
	}
}