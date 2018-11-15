<?php

class m_user extends CI_Model
{
	public function tampilassignment($ac_type, $resp)
	{
		$id_user = $this->session->userdata('id_user');
		// $query = $this->db->query("	SELECT eta.ms_num, eta.ac_type, md.task_code, md.rvcd, md.resp,
		// 									SUBSTRING_INDEX(GROUP_CONCAT(CAST(status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
		// 									concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
		// 									group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
		// 									group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
		// 									group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
		// 							FROM ev_task_assign eta
		// 							LEFT JOIN msi_data md ON md.ms_num = eta.ms_num AND md.ac_type = eta.ac_type
		// 							Left Join msi_interval mi ON mi.ms_num = eta.ms_num AND mi.ac_type = eta.ac_type
		// 							Left Join msi_sg ms ON ms.ms_num = eta.ms_num AND ms.ac_type = eta.ac_type
		// 							Left Join msi_ref mr ON mr.ms_num = eta.ms_num AND mr.ac_type = eta.ac_type
		// 							Left Join ev_task_process etp ON etp.ms_num = eta.ms_num AND etp.ac_type = eta.ac_type 
		// 							WHERE eta.id_user = '$id_user' OR (eta.ac_type = '$ac_type' AND  eta.resp = '$resp')
		// 							Group By eta.ms_num, eta.ac_type
		// 							Order By eta.ms_num ASC
		// 							LIMIT 100");
		$query = "	SELECT tmp.ms_num, tmp.ac_type, tmp.task_code, tmp.rvcd, tmp.resp, tmp.id_user,  tmp.status, tmp.descr, tmp.camp_sg, tmp.intval, tmp.ref, tmp.eva_ver FROM (SELECT etp.ms_num as ms_num, etp.ac_type as ac_type, md.task_code as task_code, md.rvcd as rvcd, md.resp as resp,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(etp.id_user AS CHAR) ORDER BY etp.create_date DESC),',',1) AS id_user,
											SUBSTRING_INDEX(GROUP_CONCAT(CAST(status AS CHAR) ORDER BY etp.create_date DESC),',',1) AS status,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('-', eta.id_user,'-') SEPARATOR '') as eva_ver,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
									FROM ev_task_process etp
									LEFT JOIN msi_data md ON md.ms_num = etp.ms_num AND md.ac_type = etp.ac_type
									Left Join msi_interval mi ON mi.ms_num = etp.ms_num AND mi.ac_type = etp.ac_type
									Left Join msi_sg ms ON ms.ms_num = etp.ms_num AND ms.ac_type = etp.ac_type
									Left Join msi_ref mr ON mr.ms_num = etp.ms_num AND mr.ac_type = etp.ac_type
									Left Join ev_task_assign eta ON eta.ms_num = etp.ms_num AND eta.ac_type = etp.ac_type 
									Group By etp.ms_num, etp.ac_type
									Order By etp.ms_num ASC) AS tmp
									WHERE tmp.ac_type = '$ac_type' AND tmp.resp = '$resp'";
		if($this->session->userdata('role') == 3)
		{
			$query .= " AND (status = 1 OR tmp.eva_ver LIKE '%-$id_user-%')";
		}
		else if($this->session->userdata('role') == 4)
		{
			$query .= " AND (status = 4 OR tmp.eva_ver LIKE '%-$id_user-%')";
		}
		$run_query = $this->db->query($query);
  		return $run_query->result_array();
	}

	public function assign($table, $data)
	{
		$this->db->insert($table,$data);
	}

	public function update_signature($username)
	{
		$data = array(
        'signature' => $username.'_signature.jpg'
		);
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}

	public function get_user($username)
	{
		$query = "	SELECT *
					FROM users
					WHERE username = '$username'";
		$run_query = $this->db->query($query);
  		return $run_query->row();
	}
}