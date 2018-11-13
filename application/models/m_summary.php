<?php

class m_summary extends CI_Model
{
	public function tampilassignment($ac_type, $date_min, $date_max)
	{
		$query = $this->db->query("	SELECT CASE WHEN ee.recommendation = 1 THEN 'Remain'
                                                WHEN ee.recommendation = 2 THEN 'Extend'
                                                WHEN ee.recommendation = 3 THEN 'Decoalation'
                                                WHEN ee.recommendation = 4 THEN 'Add Task'
                                                WHEN ee.recommendation = 5 THEN 'Remove Task'
                                            END as recommendation, md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, ee.id_user as id_gmf, er.id_user as id_garuda, 
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mit.code_int,' ',mit.int_num,' ', mit.int_dim ) SEPARATOR '<br>') as intval_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(ee.rec_threshold AS CHAR) ORDER BY ee.create_date DESC),',',1) AS rec_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(ee.rec_interval AS CHAR) ORDER BY ee.create_date DESC),',',1) AS rec_interval
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
									Left Join msi_interval_threshold mit ON md.ms_num = mit.ms_num AND md.ac_type = mit.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
									Left Join ev_evaluation ee ON md.ms_num = ee.ms_num AND md.ac_type = ee.ac_type
									Left Join ev_remarks er ON md.ms_num = er.ms_num AND md.ac_type = er.ac_type
									WHERE md.ac_type = '$ac_type' AND md.effdate >= '$date_min' AND md.effdate <= '$date_max'
									Group By md.ms_num
									Order By md.ms_num asc
									LIMIT 100");
  		return $query->result_array();
	}
}