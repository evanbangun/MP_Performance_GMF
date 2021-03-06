<?php

class m_dashboard extends CI_Model
{
	public function actype()
	{
		$query = $this->db->query("	SELECT DISTINCT ac_type FROM msi_data");
		return $query->result_array();
	}

	public function resp()
	{
		$query = $this->db->query("	SELECT DISTINCT resp FROM msi_data WHERE resp != ''");
		return $query->result_array();
	}

	// public function search($ac_type)
	// {
	// 	$query = $this->db->query(
	//     					"SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
 //                                         WHEN gmfu.recommendation = 2 THEN 'Extend'
 //                                         WHEN gmfu.recommendation = 3 THEN 'Decoalation'
 //                                         WHEN gmfu.recommendation = 4 THEN 'Add Task'
 //                                         WHEN gmfu.recommendation = 5 THEN 'Remove Task'
 //                                            END as recommendation,
 //                                            md.resp, md.rvcd, md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, gmfu.id_gmf as id_gmf, gmfu.name_gmf as name_gmf, garudau.id_garuda as id_garuda, garudau.name_garuda as name_garuda, gmfu.signature,
	// 										concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
	// 										SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
	// 										group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
	// 										group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
	// 										group_concat(DISTINCT concat('>>', mit.code_int,' ',mit.int_num,' ', mit.int_dim ) SEPARATOR '<br>') as intval_threshold,
	// 										SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_threshold AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_threshold,
	// 										SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_interval AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_interval
	// 								FROM msi_data md
	// 								Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
	// 								Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
	// 								Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
	// 								Left Join msi_interval_threshold mit ON md.ms_num = mit.ms_num AND md.ac_type = mit.ac_type
	// 								Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
	// 				   				LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
	// 								Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
	// 										   FROM ev_evaluation ee
	// 										   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
	// 								Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
	// 										   FROM ev_remarks er
	// 										   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
	// 								WHERE md.ac_type = '$ac_type'
	// 								Group By md.ms_num, md.ac_type
	// 								Order By md.ms_num ASC");
	// 	return $query->result_array();
	// }

	// public function filter_search($ac_type, $date_min, $date_max, $ms_num, $resp)
	// {
	// 	$query_msg = "SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
 //                                                WHEN gmfu.recommendation = 2 THEN 'Extend'
 //                                                WHEN gmfu.recommendation = 3 THEN 'Decoalation'
 //                                                WHEN gmfu.recommendation = 4 THEN 'Add Task'
 //                                                WHEN gmfu.recommendation = 5 THEN 'Remove Task'
 //                                            END as recommendation,
 //                                            md.resp, md.rvcd, md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, gmfu.id_gmf as id_gmf, gmfu.name_gmf as name_gmf, garudau.id_garuda as id_garuda, garudau.name_garuda as name_garuda, gmfu.signature,
	// 										concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
	// 										group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
	// 										group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval, 
	// 				   						SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
	// 										group_concat(DISTINCT concat('>>', mit.code_int,' ',mit.int_num,' ', mit.int_dim ) SEPARATOR '<br>') as intval_threshold,
	// 										SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_threshold AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_threshold,
	// 										SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_interval AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_interval
	// 								FROM msi_data md
	// 								Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
	// 								Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
	// 								Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
	// 								Left Join msi_interval_threshold mit ON md.ms_num = mit.ms_num AND md.ac_type = mit.ac_type
	// 								Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
	// 				   				LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
	// 								Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
	// 										   FROM ev_evaluation ee
	// 										   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
	// 								Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
	// 										   FROM ev_remarks er
	// 										   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
	// 								WHERE md.ac_type = '$ac_type'
	// 								";
	// 	if($date_max != "" && $date_min != "")
	// 	{
	// 		$query_msg .= "  AND md.effdate >= '$date_min' AND md.effdate <= '$date_max'";
	// 	}
	// 	if($ms_num != "")
	// 	{
	// 		$query_msg .= " AND md.ms_num LIKE '%$ms_num%'";
	// 	}
	// 	if($resp != "")
	// 	{
	// 		$query_msg .= " AND md.resp = '$resp'";
	// 	}
	// 	$query_msg .= " Group By md.ms_num, md.ac_type
	// 					Order By md.ms_num ASC";
	// 	$query = $this->db->query($query_msg);
	// 	return $query->result_array();
	// }

	public function data_dashboard()
	{
		$query_text = "SELECT SUM(CASE WHEN status IS NULL OR status = 0 THEN 1 ELSE 0 END) unassigned,
							  SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) assigned_gmf,
							  SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) evaluating,
							  SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) evaluated,
							  SUM(CASE WHEN status = 4 THEN 1 ELSE 0 END) assigned_garuda,
							  SUM(CASE WHEN status = 5 THEN 1 ELSE 0 END) verifying,
							  SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) verified
						  FROM (SELECT SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
					   FROM msi_data md
				 	   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   GROUP BY md.ms_num, md.ac_type
					   ORDER BY md.ms_num ASC) as data_dasboard";
		$query = $this->db->query($query_text);
  		return $query->row();
	}

	public function tampilassignment($data)
	{
		$query_text = "	SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
                                                WHEN gmfu.recommendation = 2 THEN 'Extend'
                                                WHEN gmfu.recommendation = 3 THEN 'Decoalation'
                                                WHEN gmfu.recommendation = 4 THEN 'Add Task'
                                                WHEN gmfu.recommendation = 5 THEN 'Remove Task'
                                            END as recommendation,
                                            md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, gmfu.id_gmf as id_gmf, gmfu.name_gmf as name_gmf, garudau.id_garuda as id_garuda, garudau.name_garuda as name_garuda, gmfu.signature,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat(ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat(mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat(mit.code_int,' ',mit.int_num,' ', mit.int_dim ) SEPARATOR '<br>') as intval_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_threshold AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_threshold,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(gmfu.rec_interval AS CHAR) ORDER BY gmfu.create_date DESC),',',1) AS rec_interval
									FROM msi_data md
									Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
									Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
									Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
									Left Join msi_interval_threshold mit ON md.ms_num = mit.ms_num AND md.ac_type = mit.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
					   				LEFT JOIN msi_performance_all mpa ON mpa.ms_num = md.ms_num AND mpa.ac_type = md.ac_type
									Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
											   FROM ev_evaluation ee
											   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
									Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
											   FROM ev_remarks er
											   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
									WHERE md.ac_type = '$data[ac_type_post]'";
		if($data['date_min_post'] != "" && $data['date_max_post'] != "")
		{
			$query_text .= " AND mpa.date_acc >= '".$data['date_min_post']."' AND mpa.date_acc <= '".$data['date_max_post']."'";
		}
		if($data['ms_num_post'] != '')
		{
			$query_text .= " AND md.ms_num = '".$data['ms_num_post']."'";
		}
		if(($data['resp_post']) != '')
		{
			$query_text .= " AND md.resp = '".$data['resp_post']."'";
		}
		$query_text .= " Group By md.ms_num, md.ac_type
						 Order By md.ms_num ASC";
		$query = $this->db->query($query_text);
  		return $query->result_array();
	}

	private $column_search 	= array('recommendation', 'ms_num', 'ac_type', 'task_code', 'ac_eff', 'ref_man', 'id_gmf', 'name_gmf', 'id_garuda', 'name_garuda', 'descr', 'camp_sg', 'intval_threshold', 'rec_threshold', 'rec_interval', 'status_text');  
	private $column_view 	= array('ms_num', 'ac_type', 'resp', 'descr', 'intval', 'rvcd', 'camp_sg', 'status_text');

	public function __construct()
    {
        parent::__construct();
    }
	
	private function _query($ac_type, $date_min, $date_max, $ms_num, $resp)
    {
    	$query = "SELECT * FROM (SELECT *, (CASE WHEN status = 0 OR status IS NULL THEN 'Unassigned'
								            WHEN status = 1 THEN 'Assigned'
								            WHEN status = 2 THEN 'Evaluating'
								            WHEN status = 3 THEN 'Evaluated'
								            WHEN status = 4 THEN 'Verifying'
								            WHEN status = 5 THEN 'Verified'
								            WHEN status = 6 THEN 'Verifying'
								            END) as status_text  FROM (SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
                                         WHEN gmfu.recommendation = 2 THEN 'Extend'
                                         WHEN gmfu.recommendation = 3 THEN 'Decoalation'
                                         WHEN gmfu.recommendation = 4 THEN 'Add Task'
                                         WHEN gmfu.recommendation = 5 THEN 'Remove Task'
                                            END as recommendation,
                                            md.resp, md.rvcd, md.ms_num, md.ac_type, md.task_code, me.ac_eff, mr.ref_man, gmfu.id_gmf as id_gmf, gmfu.name_gmf as name_gmf, garudau.id_garuda as id_garuda, garudau.name_garuda as name_garuda, gmfu.signature,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
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
					   				LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   				LEFT JOIN msi_performance_all mpa ON mpa.ms_num = md.ms_num AND mpa.ac_type = md.ac_type
									Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
											   FROM ev_evaluation ee
											   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
									Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
											   FROM ev_remarks er
											   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
									WHERE md.ac_type = '$ac_type'";
		if($ms_num != "")
		{
			$query .= " AND md.ms_num = '$ms_num'";
		}
		if($date_min != "" && $date_max != "")
		{
			$query .= " AND mpa.date_acc < '$date_max' AND mpa.date_acc > '$date_min'";
		}
		if($resp != "")
		{
			$query .= " AND md.resp < '$resp' AND mpa.date_acc > '$resp'";
		}
		$query .= " Group By md.ms_num, md.ac_type
					Order By md.ms_num ASC) as temp_table) as temp_temp_table";
    	
    	$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0){ 
					$query .= " WHERE ".$item." LIKE '%". $_POST['search']['value']."%'";
				}
				else{
					$query .= " OR ".$item." LIKE '%". $_POST['search']['value']."%'";
				}
				
			}
			$i++;
		}
		
		$i = 0;
		foreach($_POST['order'] as $order_by)
		{
			if($order_by['column'] > 0)
			{
				if($i===0)
				{
					$query .= " ORDER BY ".$this->column_view[$order_by['column'] - 1]." ". $order_by['dir'];
				}
				else
				{
					$query .= ", ".$this->column_view[$order_by['column'] - 1]." ".$order_by['dir'];
				}
				$i++;
			}
		}
		return $query;
    }

	public function detail_search($ac_type, $date_min, $date_max, $ms_num, $resp)
	{
		$query = $this->_query($ac_type, $date_min, $date_max, $ms_num, $resp);
		if($_POST['length'] != -1)
		{
			$query .= " LIMIT ".$_POST['start'].", ".$_POST['length'];
		}
		$query_result = $this->db->query($query);
		return $query_result->result_array();
	}

	public function count_filtered($ac_type, $date_min, $date_max, $ms_num, $resp) {
		$query = $this->_query($ac_type, $date_min, $date_max, $ms_num, $resp);
		$query_result = $this->db->query($query);
		return $query_result->num_rows();
	}

	public function count_all($ac_type, $date_min, $date_max, $ms_num, $resp) {
		$query = $this->_query($ac_type, $date_min, $date_max, $ms_num, $resp);
		$query_result = $this->db->query($query);
		return $query_result->num_rows();
	}
}