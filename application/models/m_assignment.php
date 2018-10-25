<?php

class m_assignment extends CI_Model
{
	public function tampilassignment()
	{
		$query_text = "SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, ";
		if($this->session->userdata('role') == 1)
		{
			$query_text .= "SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date DESC),',',1) AS id_user, ";
		}
		else if($this->session->userdata('role') == 2)
		{
			$query_text .= "SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY  etp.id_user DESC, etp.create_date DESC),',',1) AS id_user, ";
		}								

		$query_text .=	"SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
						 concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
						 group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
						 group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
  						 FROM msi_data md
					 	 LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
						 LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
						 Left Join ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
						 WHERE md.ms_num = mi.ms_num ";
		if($this->session->userdata('role') == 2)
		{
			$query_text .= "AND status >=2 ";
		}
		$query_text.=	"GROUP BY md.ms_num
						ORDER BY md.ms_num ASC
						LIMIT 100";

		$query = $this->db->query($query_text);
  		return $query->result_array();
	}

	public function get_status()
	{
		
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