<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_task extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

  //   public function getTaskData(){

  //   	$q_detailmsi = $this->db->query(
  //   					"Select msi_data.ms_num as ms_num, msi_data.ac_type, msi_data.task_title, msi_data.task_desc, msi_data.task_subdesc,
		// 				msi_data.task_code, msi_data.effdate, msi_data.revdate, msi_data.rvcd,
		// 				msi_data.qtyac, msi_data.cat, msi_data.resp,
		// 				group_concat(DISTINCT concat(msi_sg.sg_code,' ', msi_sg.sg_num) SEPARATOR '\n') as msi_sg,
		// 				group_concat(DISTINCT concat( msi_interval.code_int,msi_interval.int_num,' ', msi_interval.int_dim ) SEPARATOR '  ') as msi_interval,
		// 				group_concat(DISTINCT msi_pn.part_number  SEPARATOR '\n') as msi_pn,
		// 				group_concat(DISTINCT msi_access.access SEPARATOR ' ') as msi_access,
		// 				group_concat(DISTINCT msi_zone.zone  SEPARATOR ' ') as msi_zone,
		// 				group_concat(DISTINCT msi_eff.ac_eff  SEPARATOR '\n') as msi_eff,
		// 				group_concat(DISTINCT msi_ref.ref_man  SEPARATOR '\n') as msi_reference
		// 				From msi_data Left Join msi_access ON msi_data.ms_num = msi_access.ms_num AND msi_data.ac_type = msi_access.ac_type
		// 				Left Join msi_eff ON msi_data.ms_num = msi_eff.ms_num AND msi_data.ac_type = msi_eff.ac_type
		// 				Left Join msi_interval ON msi_data.ms_num = msi_interval.ms_num AND msi_data.ac_type = msi_interval.ac_type
		// 				Left Join msi_pn ON msi_data.ms_num = msi_pn.ms_num AND msi_data.ac_type = msi_pn.ac_type
		// 				Left Join msi_sg ON msi_data.ms_num = msi_sg.ms_num AND msi_data.ac_type = msi_sg.ac_type
		// 				Left Join msi_zone ON msi_data.ms_num = msi_zone.ms_num AND msi_data.ac_type = msi_zone.ac_type
		// 				Left Join msi_ref ON msi_data.ms_num = msi_ref.ms_num AND msi_data.ac_type = msi_ref.ac_type
		// 				Inner Join table_listcamp ON msi_data.ms_num = table_listcamp.camp_no
		// 				Where msi_data.ac_type = 'B777' and msi_data.rvcd not in ('x','X')
		// 				Group By msi_data.ms_num
		// 				Order By msi_data.ms_num asc");

		// return $q_detailmsi->result();
  //   }


    public function getTaskDataByMSNum($ms_num, $ac_type){
    	$q_detailmsi = $this->db->query("	SELECT md.ms_num, md.ac_type, md.task_code, md.rvcd, md.resp, md.task_title, md.effdate, md.cat, mz.zone, ma.access, me.ac_eff,
											concat(md.task_desc,'<br><br>', md.task_subdesc) as descr,
											group_concat(DISTINCT concat('>>', ms.sg_code,' ', ms.sg_num) SEPARATOR '<br>') as camp_sg,
											group_concat(DISTINCT concat('>>', mi.code_int,' ',mi.int_num,' ', mi.int_dim ) SEPARATOR '<br>') as intval,
											group_concat(DISTINCT concat('>>', mr.ref_man)  SEPARATOR '<br>') as ref
											FROM msi_data md
											Left Join msi_access ma ON md.ms_num = ma.ms_num AND md.ac_type = ma.ac_type
											Left Join msi_interval mi ON md.ms_num = mi.ms_num AND md.ac_type = mi.ac_type
											Left Join msi_sg ms ON md.ms_num = ms.ms_num AND md.ac_type = ms.ac_type
											Left Join msi_ref mr ON md.ms_num = mr.ms_num AND md.ac_type = mr.ac_type
											Left Join msi_zone mz ON md.ms_num = mz.ms_num AND md.ac_type = mz.ac_type
											Left Join msi_eff me ON md.ms_num = me.ms_num AND md.ac_type = me.ac_type
											Where md.ac_type = '$ac_type' AND md.ms_num='$ms_num'
											Group By md.ms_num
											Order By md.ms_num asc");


    	// $q_detailmsi = $this->db->query(
    	// 				"Select msi_data.ms_num as ms_num, msi_data.ac_type, msi_data.task_title, msi_data.task_desc, msi_data.task_subdesc,
					// 	msi_data.task_code, msi_data.effdate, msi_data.revdate, msi_data.rvcd,
					// 	msi_data.qtyac, msi_data.cat, msi_data.resp,
					// 	group_concat(DISTINCT concat(msi_sg.sg_code,' ', msi_sg.sg_num) SEPARATOR '\n') as msi_sg,
					// 	group_concat(DISTINCT concat( msi_interval.code_int,msi_interval.int_num,' ', msi_interval.int_dim ) SEPARATOR '  ') as msi_interval,
					// 	group_concat(DISTINCT msi_pn.part_number  SEPARATOR '\n') as msi_pn,
					// 	group_concat(DISTINCT msi_access.access SEPARATOR ' ') as msi_access,
					// 	group_concat(DISTINCT msi_zone.zone  SEPARATOR ' ') as msi_zone,
					// 	group_concat(DISTINCT msi_eff.ac_eff  SEPARATOR '\n') as msi_eff,
					// 	group_concat(DISTINCT msi_ref.ref_man  SEPARATOR '\n') as msi_reference
					// 	From msi_data Left Join msi_access ON msi_data.ms_num = msi_access.ms_num AND msi_data.ac_type = msi_access.ac_type
					// 	Left Join msi_eff ON msi_data.ms_num = msi_eff.ms_num AND msi_data.ac_type = msi_eff.ac_type
					// 	Left Join msi_interval ON msi_data.ms_num = msi_interval.ms_num AND msi_data.ac_type = msi_interval.ac_type
					// 	Left Join msi_pn ON msi_data.ms_num = msi_pn.ms_num AND msi_data.ac_type = msi_pn.ac_type
					// 	Left Join msi_sg ON msi_data.ms_num = msi_sg.ms_num AND msi_data.ac_type = msi_sg.ac_type
					// 	Left Join msi_zone ON msi_data.ms_num = msi_zone.ms_num AND msi_data.ac_type = msi_zone.ac_type
					// 	Left Join msi_ref ON msi_data.ms_num = msi_ref.ms_num AND msi_data.ac_type = msi_ref.ac_type
					// 	Inner Join table_listcamp ON msi_data.ms_num = table_listcamp.camp_no
					// 	Where msi_data.ac_type = '$ac_type' and msi_data.rvcd not in ('x','X') and msi_data.ms_num='$ms_num'
					// 	Group By msi_data.ms_num
					// 	Order By msi_data.ms_num asc");
    	
		return $q_detailmsi->row();
    }

    public function task_process_detail($ms_num, $ac_type)
    {
    	$q_sri = $this->db->query("SELECT * FROM ev_task_process
    										WHERE ms_num = '$ms_num' AND ac_type = '$ac_type'
    										ORDER BY create_date DESC LIMIT 1"); 

    	return $q_sri->row();
    }

    public function getTableSRI($ms_num){
    	$q_sri = $this->db->query(
    				"select * from table_sri where camp_no = '$ms_num'"); 

    	return $q_sri->row();
    }

    public function getTableDelay($ms_num){
		$q_delay = $this->db->query(
					"select * from table_delay where camp_no = '$ms_num'");

		return $q_delay->row();
    }

    public function getTableRemoval($ms_num){
		$q_ucr = $this->db->query(
					"select * from table_compremoval where camp = '$ms_num'");

		return $q_ucr->row();
    }

    public function getTableSummary($ms_num){
		$q_summary = $this->db->query(
					"select * from table_summary where camp_no = '$ms_num'");

		return $q_summary->row();
    }

    public function getFinding($ms_num){
    	$q_performance = $this->db->query("SELECT DISTINCT msi_performance_all.ac_reg as ac_reg, msi_performance_all.maint_type, msi_performance_all.date_acc, msi_performance_all.fhrs, msi_performance_all.fcyl, msi_performance_all.finding, msi_performance_all.operation, msi_performance_all.remark_finding FROM msi_performance_all where msi_performance_all.ac_type = 'B777' and ms_num = '$ms_num'");

    	return $q_performance->result();
    }

    public function countAcc($ms_num){
    	$q_hitung_acc = $this->db->query("SELECT DISTINCT order_no, count(finding) as count_acc FROM msi_performance_all where msi_performance_all.ac_type = 'B777' and  ms_num = '$ms_num'");

    	return $q_hitung_acc->row();
    }

    public function countFinding($ms_num){
    	$q_hitung_acc = $this->db->query("SELECT DISTINCT count(finding) as count_acc FROM msi_performance_all where msi_performance_all.ac_type = 'B777' and  ms_num = '$ms_num'")->row();

    	$q_hitung_nil = $this->db->query("select distinct order_no, count(finding) as count_nil from msi_performance_all where finding = 'NIL' and msi_performance_all.ac_type = 'B777' and ms_num = '$ms_num'")->row();

    	// $q_hitung_acc->count_acc - $q_hitung_nil->count_nil
    	return ($q_hitung_acc->count_acc - $q_hitung_nil->count_nil);
    }

    public function task_evaluation($ms_num, $ac_type)
    {
    	$query = $this->db->query(" SELECT ee.recommendation, ee.reason, ee.create_date, u.name
    								FROM ev_evaluation ee
    								LEFT JOIN users u ON ee.id_user = u.id_user
    								WHERE ee.ms_num = '$ms_num' AND ee.ac_type = '$ac_type'
    								ORDER BY ee.create_date DESC
    								");
    	return $query->result_array();
    }

    public function task_remarks($ms_num, $ac_type)
    {
    	$query = $this->db->query(" SELECT ev.remarks, ev.create_date, u.name
    								FROM ev_remarks ev
    								LEFT JOIN users u ON ev.id_user = u.id_user
    								WHERE ev.ms_num = '$ms_num' AND ev.ac_type = '$ac_type'
    								ORDER BY ev.create_date DESC
    								");
    	return $query->result_array();
    }

    public function insert_task($table, $data)
    {
		$this->db->insert($table,$data);
    }
}