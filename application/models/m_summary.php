<?php

class m_summary extends CI_Model
{
	public function tampilassignment($ac_type, $date_min, $date_max)
	{
		$query = $this->db->query("	SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
                                                WHEN gmfu.recommendation = 2 THEN 'Extend'
                                                WHEN gmfu.recommendation = 3 THEN 'Decoalation'
                                                WHEN gmfu.recommendation = 4 THEN 'Add Task'
                                                WHEN gmfu.recommendation = 5 THEN 'Remove Task'
                                            END as recommendation,
                                            md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, gmfu.id_gmf as id_gmf, gmfu.name_gmf as name_gmf, garudau.id_garuda as id_garuda, garudau.name_garuda as name_garuda, gmfu.signature,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mit.code_int,' ',mit.int_num,' ', mit.int_dim ) SEPARATOR '<br>') as intval_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_threshold AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_interval AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_interval
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
									Left Join msi_interval_threshold mit ON md.ms_num = mit.ms_num AND md.ac_type = mit.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
									Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
											   FROM ev_evaluation ee
											   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
									Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
											   FROM ev_remarks er
											   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
									WHERE md.ac_type = '$ac_type' AND md.effdate >= '$date_min' AND md.effdate <= '$date_max'
									Group By md.ms_num
									Order By md.ms_num desc
									limit 100");
  		return $query->result_array();
	}
	

	
}