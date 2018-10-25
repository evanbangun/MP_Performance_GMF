<?php

class m_user extends CI_Model
{
	public function tampilassignment($id_user)
	{
		$query = $this->db->query("	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
									FROM ev_task_assign eta
									LEFT JOIN msi_data md ON md.ms_num = eta.ms_num AND md.ac_type = eta.ac_type
									Left Join msi_interval mi ON mi.ms_num = eta.ms_num AND mi.ac_type = eta.ac_type
									Left Join msi_sg ms ON ms.ms_num = eta.ms_num AND ms.ac_type = eta.ac_type
									Left Join msi_ref mr ON mr.ms_num = eta.ms_num AND mr.ac_type = eta.ac_type
									Left Join ev_task_process etp ON etp.ms_num = eta.ms_num AND etp.ac_type = eta.ac_type 
									WHERE eta.id_user = '$id_user'
									Order By md.ms_num ASC
									LIMIT 100");

  		return $query->result_array();
	}

	public function get_status()
	{
		
	}
}