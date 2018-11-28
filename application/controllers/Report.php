<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            $this->load->model('m_task');
            $this->load->model('m_summary');

            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

    public function report_pdf_performance($ms_num, $ac_type)
    {
        $data['list_task'] = $this->m_task->getTaskDataByMSNum($ms_num, $ac_type);
        $data['table_sri'] = $this->m_task->getTableSRI($ms_num, $ac_type);
        $data['table_delay'] = $this->m_task->getTableDelay($ms_num, $ac_type);
        $data['table_removal'] = $this->m_task->getTableRemoval($ms_num, $ac_type);
        //$data['table_summary'] = $this->m_task->getTableSummary($ms_num);
        $data['count_acc'] = $this->m_task->countAcc($ms_num, $ac_type);
        $data['count_finding'] = $this->m_task->countFinding($ms_num, $ac_type);
        $data['rejected_finding'] = $this->m_task->rejectFinding($ms_num, $ac_type);
        $data['task_evaluation'] = $this->m_task->task_evaluation($ms_num, $ac_type);
        $data['finding'] = $this->m_task->getFinding($ms_num, $ac_type);
       
        $this->load->view('layout/v_pdf_performance', $data);
    }

    public function report_summary($ac_type, $date_min, $date_max)
    {
        $data['list_assignment'] = $this->m_summary->tampilassignment($ac_type, $date_min, $date_max);
        foreach ($data['list_assignment'] as $dla)
        {
            $data['list_task'][] = $this->m_task->getTaskDataByMSNum($dla['ms_num'], $dla['ac_type']);
            $data['table_sri'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableSRI($dla['ms_num'], $dla['ac_type']);
            $data['table_delay'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableDelay($dla['ms_num'], $dla['ac_type']);
            $data['table_removal'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableRemoval($dla['ms_num'], $dla['ac_type']);
            $data['count_acc'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countAcc($dla['ms_num'], $dla['ac_type']);
            $data['count_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countFinding($dla['ms_num'], $dla['ac_type']);
            $data['rejected_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->rejectFinding($dla['ms_num'], $dla['ac_type']);
            $data['task_evaluation'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->task_evaluation($dla['ms_num'], $dla['ac_type']);
            $data['finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getFinding($dla['ms_num'], $dla['ac_type']);
        }
       
        $this->load->view('layout/v_pdf_summary', $data);
    }

    public function report_excel($ac_type, $date_min, $date_max)
    {
        $data['list_assignment'] = $this->m_summary->tampilassignment($ac_type, $date_min, $date_max);
        $this->load->view('layout/v_excel_summary', $data);
    }

    public function report_mpdf_performance($ms_num, $ac_type)
    { 
        $mpdf = new \Mpdf\Mpdf();
        
        $data['list_task'] = $this->m_task->getTaskDataByMSNum($ms_num, $ac_type);
        $data['table_sri'] = $this->m_task->getTableSRI($ms_num, $ac_type);
        $data['table_delay'] = $this->m_task->getTableDelay($ms_num, $ac_type);
        $data['table_removal'] = $this->m_task->getTableRemoval($ms_num, $ac_type);
        $data['count_acc'] = $this->m_task->countAcc($ms_num, $ac_type);
        $data['count_finding'] = $this->m_task->countFinding($ms_num, $ac_type);
        $data['rejected_finding'] = $this->m_task->rejectFinding($ms_num, $ac_type);
        $data['task_evaluation'] = $this->m_task->task_evaluation($ms_num, $ac_type);
        $data['finding'] = $this->m_task->getFinding($ms_num, $ac_type);
        
        $html = $this->load->view('layout/v_mpdf_performance',$data,true);
        $mpdf->SetHTMLHeader('<table>
                                <tr>
                                    <th>
                                        <img src="assets/img/logo.png" alt="test alt attribute" width="100" border="0" />
                                    </th>
                                    <th width="85%%">
                                        <h3>MP PERFORMANCE DATA EVALUATION</h3><br><h4>'.$ac_type.'</h4>
                                    </th>
                                </tr>
                            </table>
                            <hr>', 'O', true);
        $mpdf->SetHTMLFooter('<hr><div style="text-align: right;">{PAGENO} / {nb}</div>');
        $mpdf->SetFont('helvetica');
        $mpdf->SetMargins(30, 30, 30);
        $mpdf->AddPage('P');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();
    }

    public function report_mpdf_summary(){

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont('Arial');
        $html = $this->load->view('layout/v_mpdf_summary',[], true);
        // $mpdf->SetHTMLHeader('<table>
        //                         <tr>0" border="0" />
        //                             </th>
        //                             <th>
        //                                 <img src="assets/img/logo.png" alt="test alt attribute" width="10
        //                             <th width="85%%">
        //                                 <h3>MP PERFORMANCE DATA EVALUATION</h3><br><h4>'.$ac_type.'</h4>
        //                             </th>
        //                         </tr>
        //                     </table>
        //                     <hr>', 'O', true);
        // $mpdf->SetHTMLFooter('<hr><div style="text-align: right;">{PAGENO} / {nb}</div>');
       
        $mpdf->SetMargins(5, 5, 5);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit();


    }

}