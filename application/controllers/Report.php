<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            $this->load->model('m_task');
        }

    public function report_pdf_performance($ms_num, $ac_type)
    {
        $data['list_task'] = $this->m_task->getTaskDataByMSNum($ms_num, $ac_type);
        $data['table_sri'] = $this->m_task->getTableSRI($ms_num);
        $data['table_delay'] = $this->m_task->getTableDelay($ms_num);
        $data['table_removal'] = $this->m_task->getTableRemoval($ms_num);
        //$data['table_summary'] = $this->m_task->getTableSummary($ms_num);
        $data['finding'] = $this->m_task->getFinding($ms_num, $ac_type);
        $data['count_acc'] = $this->m_task->countAcc($ms_num, $ac_type);
        $data['count_finding'] = $this->m_task->countFinding($ms_num, $ac_type);
        $data['rejected_finding'] = $this->m_task->rejectFinding($ms_num, $ac_type);
        $data['task_process_detail'] = $this->m_task->task_process_detail($ms_num, $ac_type);
        $data['task_evaluation'] = $this->m_task->task_evaluation($ms_num, $ac_type);
        $data['task_remarks'] = $this->m_task->task_remarks($ms_num, $ac_type);
       
        $this->load->view('layout/v_pdf_performance', $data);
    }

}