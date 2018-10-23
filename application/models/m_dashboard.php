<?php

class m_dashboard extends CI_Model
{
	public function actype()
	{
		$query = $this->db->query("	SELECT DISTINCT ac_type FROM msi_data");
		return $query->result_array();
	}

	public function search($ac_type)
	{
		$query = $this->db->query(
    					"	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp,
											concat(md.task_title,'<br><br>',md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
									WHERE md.ac_type = '$ac_type'
									Group By md.ms_num
									Order By md.ms_num asc
									LIMIT 100");
		return $query->result_array();
	}
}