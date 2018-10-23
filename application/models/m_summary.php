<?php

class m_summary extends CI_Model
{
	public function tampilassignment()
	{
		$query = $this->db->query("	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									WHERE md.ms_num = mi.ms_num
									Group By md.ms_num
									Order By md.ms_num asc
									LIMIT 100");
  		return $query->result_array();
	}
}