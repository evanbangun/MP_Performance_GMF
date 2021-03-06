<?php

class m_summary extends CI_Model
{
	public function tampilassignment($ac_type, $date_min, $date_max, $ms_num, $resp)
	{
		$query_msg = "	SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
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
					   				LEFT JOIN msi_performance_all mpa ON mpa.ms_num = md.ms_num AND mpa.ac_type = md.ac_type
									Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
									Left Join (SELECT ee.ms_num as ms_num, ee.ac_type as ac_type, ee.id_user as id_gmf, ee.recommendation as recommendation, u.name as name_gmf, ee.rec_threshold as rec_threshold, ee.rec_interval as rec_interval, ee.create_date as create_date, u.signature as signature
											   FROM ev_evaluation ee
											   LEFT JOIN users u on ee.id_user = u.id_user) as gmfu ON md.ms_num = gmfu.ms_num AND md.ac_type = gmfu.ac_type
									Left Join (SELECT er.ms_num as ms_num, er.ac_type as ac_type, er.id_user as id_garuda, u.name as name_garuda
											   FROM ev_remarks er
											   LEFT JOIN users u on er.id_user = u.id_user) as garudau ON md.ms_num = garudau.ms_num AND md.ac_type = garudau.ac_type
									WHERE md.ac_type = '$ac_type'";
		if($date_max != "" && $date_min != "")
		{
			$query_msg .= " AND mpa.date_acc <= '$date_max' AND mpa.date_acc >= '$date_min'";
		}
		if($ms_num != "")
		{
			$query_msg .= " AND md.ms_num LIKE '%$ms_num%'";
		}
		if($resp != "")
		{
			$query_msg .= " AND md.resp = '$resp'";
		}
		$query_msg .= " Group By md.ms_num, md.ac_type
						Order By md.ms_num ASC";
		$query = $this->db->query($query_msg);
  		return $query->result_array();
	}

	private $column_search 	= array('recommendation', 'ms_num', 'ac_type', 'task_code', 'ac_eff', 'ref_man', 'id_gmf', 'name_gmf', 'id_garuda', 'name_garuda', 'descr', 'camp_sg', 'intval_threshold', 'rec_threshold', 'rec_interval');
	private $column_view 	= array('ms_num', 'task_code', 'ac_eff', 'descr', 'intval_threshold', 'rec_threshold', 'intval', 'rec_interval', 'camp_sg', 'ref_man', 'recommendation', 'name_gmf', 'name_garuda');  

	public function __construct()
    {
        parent::__construct();
    }
	
	private function _query($ac_type, $date_min, $date_max, $ms_num, $resp)
    {
    	$query = "SELECT * FROM (SELECT CASE WHEN gmfu.recommendation = 1 THEN 'Remain'
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
		$query .= "Group By md.ms_num, md.ac_type
				   Order By md.ms_num ASC) as temp_table";
    	
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

	public function detail_summary($ac_type, $date_min, $date_max, $ms_num, $resp)
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