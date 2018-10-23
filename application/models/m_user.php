<?php

class m_user extends CI_Model
{
	public function tampilassignment($id_user)
	{
		$query = $this->db->query("	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp, etp.status,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
									LEFT JOIN ev_task_process etp ON etp.ms_num = (SELECT ms_num FROM ev_task_process
																				   WHERE ms_num = md.ms_num AND ac_type = md.ac_type
																				   ORDER BY create_date DESC LIMIT 1)
									WHERE md.ms_num = mi.ms_num AND etp.id_user = '$id_user'
									Group By md.ms_num
									Order By md.ms_num asc
									LIMIT 100");
  		return $query->result_array();
	}
}