<?php

class m_dashboard extends CI_Model
{
	public function actype()
	{
		$query = $this->db->query("	SELECT DISTINCT ac_type FROM msi_data");
		return $query->result_array();
	}

	public function search($ac_type, $date_min, $date_max)
	{
		$query = $this->db->query(
	    					"SELECT md.ms_num, md.ac_type, md.rvcd, md.resp,
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
					   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
					   group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
					   group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
					   FROM msi_data md
				 	   LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
					   LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
					   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   WHERE md.ac_type = '$ac_type' AND md.effdate >= '$date_min' AND md.effdate <= '$date_max'
					   GROUP BY md.ms_num, md.ac_type
					   ORDER BY md.ms_num ASC");
		return $query->result_array();
	}

	public function filter_search($ac_type, $date_min, $date_max, $ms_num, $resp)
	{
		$query_msg = "SELECT md.ms_num, md.ac_type, md.rvcd, md.resp,
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
					   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
					   group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
					   group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
					   FROM msi_data md
				 	   LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
					   LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
					   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   WHERE md.ac_type = '$ac_type' AND md.effdate >= '$date_min' AND md.effdate <= '$date_max'";
		if($ms_num != "")
		{
			$query_msg .= " AND md.ms_num = '$ms_num'";
		}
		if($resp != "")
		{
			$query_msg .= " AND md.resp = '$resp'";
		}				   
		$query_msg .= " GROUP BY md.ms_num, md.ac_type
					   ORDER BY md.ms_num ASC";
		$query = $this->db->query($query_msg);
		return $query->result_array();
	}
}