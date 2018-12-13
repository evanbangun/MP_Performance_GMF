<?php

class m_assignment extends CI_Model
{    
	public function tampilassignment($ac_type, $resp)
	{
		$resp = str_replace('%20', ' ', $resp);
		$ac_type = str_replace('%20', ' ', $ac_type);
		// if($this->session->userdata('role') == 1)
		// {
			// $query_text = "SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp,
			// 			   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date DESC),',',1) AS id_user, 
			// 			   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
			// 			   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
			// 			   group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
			// 			   group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
  	// 					   FROM msi_data md
			// 		 	   LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
			// 			   LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
			// 			   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
			// 			   GROUP BY md.ms_num, md.ac_type
			// 			   ORDER BY md.ms_num ASC
			// 			   LIMIT 100";
		$query_text = "SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp,
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date DESC),',',1) AS id_user, 
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
					   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
					   group_concat(DISTINCT concat(ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
					   group_concat(DISTINCT concat(mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
						   FROM msi_data md
				 	   LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
					   LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
					   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   WHERE md.ac_type = '$ac_type' AND md.resp = '$resp'
					   GROUP BY md.ms_num, md.ac_type
					   ORDER BY md.ms_num ASC";
		// }
		// else if($this->session->userdata('role') == 2)
		// {
		// 	$query_text = "SELECT etp.ms_num, etp.ac_type, md.task_code, md.rvcd, max(etp.status) as checked, u.name, u.no_pegawai,
		// 				   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date DESC),',',1) AS id_user, 
		// 				   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
		// 				   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
		// 				   group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
		// 				   group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
  // 						   FROM ev_task_process etp
		// 				   LEFT JOIN msi_data md ON md.ms_num = etp.ms_num AND md.ac_type = etp.ac_type
		// 			 	   LEFT JOIN msi_interval mi ON mi.ms_num = etp.ms_num AND mi.ac_type = etp.ac_type
		// 				   LEFT JOIN msi_sg ms ON ms.ms_num = etp.ms_num AND ms.ac_type = etp.ac_type
		// 				   LEFT JOIN users u ON u.id_user = etp.id_user
		// 				   WHERE status >= 2 
		// 				   GROUP BY etp.ms_num, etp.ac_type
		// 				   ORDER BY etp.ms_num ASC
		// 				   LIMIT 100";
		// }
		$query = $this->db->query($query_text);
  		return $query->result_array();
	}

	public function tampilassignment_bulk()
	{
		if($this->session->userdata('role') == 1)
		{
			$query_text = "SELECT mdq.ac_type, mdq.resp, sqcd.count_data, sqf.finished, squ.unassigned
  						   FROM msi_data mdq
  						   LEFT JOIN (SELECT at, rsp, count(*) as count_data FROM(SELECT md.ac_type AS at, md.resp AS rsp,
						   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
  						   FROM msi_data md
					 	   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
						   GROUP BY md.ms_num, md.ac_type
						   ORDER BY md.ms_num ASC) as tablecd group by at,rsp) as sqcd ON sqcd.at = mdq.ac_type AND sqcd.rsp = mdq.resp
						   LEFT JOIN (SELECT at, rsp, count(*) as finished FROM(SELECT md.ac_type AS at, md.resp AS rsp,
						   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
  						   FROM msi_data md
					 	   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
						   GROUP BY md.ms_num, md.ac_type
						   ORDER BY md.ms_num ASC) as tablecd WHERE status = '6' group by at,rsp) as sqf ON sqf.at = mdq.ac_type AND sqf.rsp = mdq.resp
						   LEFT JOIN (SELECT at, rsp, count(*) as unassigned FROM(SELECT md.ac_type AS at, md.resp AS rsp,
						   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
  						   FROM msi_data md
					 	   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
						   GROUP BY md.ms_num, md.ac_type
						   ORDER BY md.ms_num ASC) as tablecd WHERE status = '0' OR status IS NULL group by at,rsp) as squ ON squ.at = mdq.ac_type AND squ.rsp = mdq.resp
  						   GROUP BY mdq.resp, mdq.ac_type
						   ORDER BY mdq.ac_type ASC, mdq.resp ASC";
		}
		else if($this->session->userdata('role') == 2)
		{
			$query_text = "SELECT mdq.ac_type as ac_type, mdq.resp as resp, sqcd.count_data as count_data, sqf.evaluated as evaluated, sqp.progressed as progressed
  						   FROM msi_data mdq
  						   LEFT JOIN (SELECT at, rsp, count(*) as count_data FROM(SELECT md.ac_type AS at, md.resp AS rsp,
									  SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
			  						  FROM msi_data md
								 	  LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
									  GROUP BY md.ms_num, md.ac_type
									  ORDER BY md.ms_num ASC) as tablecd group by at,rsp)
						   			  as sqcd ON sqcd.at = mdq.ac_type AND sqcd.rsp = mdq.resp
						   LEFT JOIN (SELECT at, rsp, count(*) as evaluated FROM(SELECT md.ac_type AS at, md.resp AS rsp,
									  SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
			  						  FROM msi_data md
								 	  LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
									  GROUP BY md.ms_num, md.ac_type
									  ORDER BY md.ms_num ASC)
									  as tablecd WHERE status = '3' group by at,rsp)
						   			  as sqf ON sqf.at = mdq.ac_type AND sqf.rsp = mdq.resp
						   LEFT JOIN (SELECT at, rsp, count(*) as progressed FROM(SELECT md.ac_type AS at, md.resp AS rsp,
						   			  SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status
			  						  FROM msi_data md
								 	  LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
									  GROUP BY md.ms_num, md.ac_type
									  ORDER BY md.ms_num ASC) as tablecd WHERE status > '3' group by at,rsp)
					       			  as sqp ON sqp.at = mdq.ac_type AND sqp.rsp = mdq.resp
						   WHERE evaluated = count_data OR progressed IS NOT NULL
  						   GROUP BY mdq.resp, mdq.ac_type
						   ORDER BY mdq.ac_type ASC, mdq.resp ASC";
		}
		$query = $this->db->query($query_text);
  		return $query->result_array();
	}

	public function get_user($role)
	{

		$query = $this->db->query("	SELECT *
									FROM users
									WHERE role = '$role' + 2");
  		return $query->result_array();
	}

	public function assign_batch($table, $data)
	{
		$this->db->insert_batch($table,$data);
	}


	private $column_search 	= array('ms_num', 'ac_type', 'task_code', 'rvcd', 'resp', 'id_user', 'status', 'descr', 'camp_sg', 'intval');  

	public function __construct()
    {
        parent::__construct();
    }

    private function _query($ac_type, $resp)
    {
    	$query = "SELECT * FROM (SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp,
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.id_user ASC, etp.create_date DESC),',',1) AS id_user, 
					   SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
					   concat(md.task_desc,'<br><br>', md.task_subdesc) AS descr,
					   group_concat(DISTINCT concat(ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') AS camp_sg,
					   group_concat(DISTINCT concat(mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') AS intval
						   FROM msi_data md
				 	   LEFT JOIN msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
					   LEFT JOIN msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
					   LEFT JOIN ev_task_process etp ON etp.ms_num = md.ms_num AND etp.ac_type = md.ac_type
					   WHERE md.ac_type = '$ac_type' AND md.resp = '$resp'
					   GROUP BY md.ms_num, md.ac_type
				       ORDER BY md.ms_num ASC) as temp_table";
    	
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
		return $query;
    }

	public function detail_assignment($ac_type, $resp)
	{
		$query = $this->_query($ac_type, $resp);
		if($_POST['length'] != -1)
		{
			$query .= " LIMIT ".$_POST['start'].", ".$_POST['length'];
		}
		$query_result = $this->db->query($query);
		return $query_result->result_array();
	}

	public function count_filtered($ac_type, $resp) {
		$query = $this->_query($ac_type, $resp);
		$query_result = $this->db->query($query);
		return $query_result->num_rows();
	}

	public function count_all($ac_type, $resp) {
		$query = $this->_query($ac_type, $resp);
		$query_result = $this->db->query($query);
		return $query_result->num_rows();
	}
}