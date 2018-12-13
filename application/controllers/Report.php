<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends CI_Controller {
    public function __construct()
        {   
            parent::__construct();
            $this->load->library('Pdf');
            // $this->load->library('Wkhtml');
            $this->load->model('m_task');
            $this->load->model('m_summary');
            $this->load->model('m_dashboard');

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

    public function report_summary()
    {
        $post = $this->input->post();
        $ac_type = $post['ac_type_post'];
        $data['list_assignment'] = $this->m_summary->tampilassignment($post['ac_type_post'], $post['date_min_post'], $post['date_max_post'], $post['ms_num_post'], $post['resp_post']);
        // foreach ($data['list_assignment'] as $dla)
        // {
        //     $data['list_task'][] = $this->m_task->getTaskDataByMSNum($dla['ms_num'], $dla['ac_type']);
        //     $data['table_sri'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableSRI($dla['ms_num'], $dla['ac_type']);
        //     $data['table_delay'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableDelay($dla['ms_num'], $dla['ac_type']);
        //     $data['table_removal'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableRemoval($dla['ms_num'], $dla['ac_type']);
        //     $data['count_acc'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countAcc($dla['ms_num'], $dla['ac_type']);
        //     $data['count_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countFinding($dla['ms_num'], $dla['ac_type']);
        //     $data['rejected_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->rejectFinding($dla['ms_num'], $dla['ac_type']);
        //     $data['task_evaluation'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->task_evaluation($dla['ms_num'], $dla['ac_type']);
        //     $data['finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getFinding($dla['ms_num'], $dla['ac_type']);
        // }
        
        $ms_nums = '(';
        foreach ($data['list_assignment'] as $dla)
        {
            $ms_nums .= "'".$dla['ms_num']."',";
        }
        $ms_nums = substr($ms_nums, 0, -1);
        $ms_nums .= ')';
        // var_dump($ms_nums);die();

        $data['list_task'] = $this->m_task->getTaskDataByMSNum_bulk($ms_nums, $ac_type);

        $data['count_acc_bulk'] = $this->m_task->countAcc_bulk($ms_nums, $ac_type);
        $data['count_acc'][] = [];
        $data['count_finding'][] = [];
        foreach ($data['count_acc_bulk'] as $cab)
        {
            $data['count_acc'][$cab['ms_num']] = $cab['count_acc'];
            $data['count_finding'][$cab['ms_num']] = $cab['count_nil'];
        }

        $data['table_sri_bulk'] = $this->m_task->getTableSRI_bulk($ms_nums, $ac_type);
        $data['table_sri'][][] = [];
        foreach ($data['table_sri_bulk'] as $tsb)
        {
            $data['table_sri'][$tsb['camp_no']][] = $tsb;
        }

        $data['table_delay_bulk'] = $this->m_task->getTableDelay_bulk($ms_nums, $ac_type);
        $data['table_delay'][][] = [];
        foreach ($data['table_delay_bulk'] as $tdb)
        {
            $data['table_delay'][$tdb['camp_no']][] = $tdb;
        }

        $data['table_removal_bulk'] = $this->m_task->getTableRemoval_bulk($ms_nums, $ac_type);
        $data['table_removal'][][] = [];
        foreach ($data['table_removal_bulk'] as $trb)
        {
            $data['table_removal'][$trb['CAMP']][] = $trb;
        }

        $data['rejected_finding_bulk'] = $this->m_task->rejectFinding_bulk($ms_nums, $ac_type);
        $data['rejected_finding'][] = [];
        foreach ($data['rejected_finding_bulk'] as $rfb)
        {
            $data['rejected_finding'][$rfb['ms_num']] = $rfb['num_rejected'];
        }

        $data['task_evaluation_bulk'] = $this->m_task->task_evaluation_bulk($ms_nums, $ac_type);
        $data['task_evaluation'][][] = [];
        foreach ($data['task_evaluation_bulk'] as $teb)
        {
            $data['task_evaluation'][$teb['ms_num']][] = $teb;
        }

        $data['finding_bulk'] = $this->m_task->getFinding_bulk($ms_nums, $ac_type);
        $data['finding'][][] = [];
        foreach ($data['finding_bulk'] as $fb)
        {
            $data['finding'][$fb['ms_num']][] = $fb;
        }

        $this->load->view('layout/v_pdf_summary', $data);
    }

    public function report_pdf_search()
    {
        $data['list_assignment'] = $this->m_dashboard->tampilassignment($this->input->post());
        $ac_type = $this->input->post('ac_type_post');
        // foreach ($data['list_assignment'] as $dla)
        // {
        //     $data['list_task'][] = $this->m_task->getTaskDataByMSNum($dla['ms_num'], $dla['ac_type']);
        //     $data['table_sri'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableSRI($dla['ms_num'], $dla['ac_type']);
        //     $data['table_delay'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableDelay($dla['ms_num'], $dla['ac_type']);
        //     $data['table_removal'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getTableRemoval($dla['ms_num'], $dla['ac_type']);
        //     $data['count_acc'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countAcc($dla['ms_num'], $dla['ac_type']);
        //     $data['count_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->countFinding($dla['ms_num'], $dla['ac_type']);
        //     $data['rejected_finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->rejectFinding($dla['ms_num'], $dla['ac_type']);
        //     $data['task_evaluation'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->task_evaluation($dla['ms_num'], $dla['ac_type']);
        //     $data['finding'][$dla['ms_num']][$dla['ac_type']] = $this->m_task->getFinding($dla['ms_num'], $dla['ac_type']);
        // }
        $ms_nums = '(';
        foreach ($data['list_assignment'] as $dla)
        {
            $ms_nums .= "'".$dla['ms_num']."',";
        }
        $ms_nums = substr($ms_nums, 0, -1);
        $ms_nums .= ')';
        // var_dump($ms_nums);die();

        $data['list_task'] = $this->m_task->getTaskDataByMSNum_bulk($ms_nums, $ac_type);

        $data['count_acc_bulk'] = $this->m_task->countAcc_bulk($ms_nums, $ac_type);
        $data['count_acc'][] = [];
        $data['count_finding'][] = [];
        foreach ($data['count_acc_bulk'] as $cab)
        {
            $data['count_acc'][$cab['ms_num']] = $cab['count_acc'];
            $data['count_finding'][$cab['ms_num']] = $cab['count_nil'];
        }

        $data['table_sri_bulk'] = $this->m_task->getTableSRI_bulk($ms_nums, $ac_type);
        $data['table_sri'][][] = [];
        foreach ($data['table_sri_bulk'] as $tsb)
        {
            $data['table_sri'][$tsb['camp_no']][] = $tsb;
        }

        $data['table_delay_bulk'] = $this->m_task->getTableDelay_bulk($ms_nums, $ac_type);
        $data['table_delay'][][] = [];
        foreach ($data['table_delay_bulk'] as $tdb)
        {
            $data['table_delay'][$tdb['camp_no']][] = $tdb;
        }

        $data['table_removal_bulk'] = $this->m_task->getTableRemoval_bulk($ms_nums, $ac_type);
        $data['table_removal'][][] = [];
        foreach ($data['table_removal_bulk'] as $trb)
        {
            $data['table_removal'][$trb['CAMP']][] = $trb;
        }

        $data['rejected_finding_bulk'] = $this->m_task->rejectFinding_bulk($ms_nums, $ac_type);
        $data['rejected_finding'][] = [];
        foreach ($data['rejected_finding_bulk'] as $rfb)
        {
            $data['rejected_finding'][$rfb['ms_num']] = $rfb['num_rejected'];
        }

        $data['task_evaluation_bulk'] = $this->m_task->task_evaluation_bulk($ms_nums, $ac_type);
        $data['task_evaluation'][][] = [];
        foreach ($data['task_evaluation_bulk'] as $teb)
        {
            $data['task_evaluation'][$teb['ms_num']][] = $teb;
        }

        $data['finding_bulk'] = $this->m_task->getFinding_bulk($ms_nums, $ac_type);
        $data['finding'][][] = [];
        foreach ($data['finding_bulk'] as $fb)
        {
            $data['finding'][$fb['ms_num']][] = $fb;
        }

        $this->load->view('layout/v_pdf_search', $data);
    }

    public function report_excel()
    {
        $post = $this->input->post();
        $data['list_assignment'] = $this->m_summary->tampilassignment($post['ac_type_post'], $post['date_min_post'], $post['date_max_post'], $post['ms_num_post'], $post['resp_post']);
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
                                    <th width="85%">
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

    // public function report_mpdf_summary(){
    //     // require_once('mikehaertl/phpwkhtmltopdf/src/Pdf.php');

    //     // $mpdf = new \Mpdf\Mpdf();

    //     $pdf->SetFont('Arial');
    //     $html = $this->load->view('layout/v_mpdf_summary',[], true);
    //     // $mpdf->SetHTMLHeader('<table>
    //     //                         <tr>0" border="0" />
    //     //                             </th>
    //     //                             <th>
    //     //                                 <img src="assets/img/logo.png" alt="test alt attribute" width="10
    //     //                             <th width="85%%">
    //     //                                 <h3>MP PERFORMANCE DATA EVALUATION</h3><br><h4>'.$ac_type.'</h4>
    //     //                             </th>
    //     //                         </tr>
    //     //                     </table>
    //     //                     <hr>', 'O', true);
    //     // $mpdf->SetHTMLFooter('<hr><div style="text-align: right;">{PAGENO} / {nb}</div>');
    //     $pdf = new WKPDF();
    //     $pdf->set_html($html);
    //     $pdf->render();
    //     $pdf->output(WKPDF::$PDF_EMBEDDED,'sample.pdf');
    //     // $mpdf->SetMargins(5, 5, 5);
    //     // $mpdf->AddPage('L');
    //     // $mpdf->WriteHTML($html);
    //     // $mpdf->Output();
    //     exit();


    // }

}