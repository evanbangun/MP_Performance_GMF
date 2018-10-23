<?php

class m_assignment extends CI_Model
{
	public function tampilassignment()
	{
		$query = $this->db->query("	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, etp.status, etp.id_user,
											concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
									FROM msi_data md
									LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									LEFT JOIN ev_task_process etp ON etp.ms_num = (SELECT ms_num FROM ev_task_process
																				   WHERE ms_num = md.ms_num AND ac_type = md.ac_type
																				   ORDER BY create_date DESC LIMIT 1)
									WHERE md.ms_num = mi.ms_num
									GROUP BY md.ms_num
									ORDER BY md.ms_num ASC
									LIMIT 100");
  		return $query->result_array();
	}

	public function get_user($role)
	{

		$query = $this->db->query("	SELECT *
									FROM users
									WHERE role = '$role' + 2");
  		return $query->result_array();
	}

	public function assign($table, $data)
	{
		$this->db->insert($table,$data);
	}
}