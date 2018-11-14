<?php

class MYPDF extends TCPDF {
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../../assets/img/logo.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        // $this->Cell(0, 15, 'MP Item Performance Data Evaluation', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 006');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data

// set header and footer fonts
$pdf->setHeaderFont(Array('helvetica', '', '12'));

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5,10,5,true);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// add a page
//$pdf->AddPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// create some HTML content
$pdf->SetPrintHeader(false);
$pdf->AddPage('L', 'A4');
$pdf->SetFont('dejavusans', '', 5);

$html = '
<table border="1">
    <tr>
        <th align="center" width="20"><b>NO</b></th>
        <th align="center"><b>MP NUMBER</b></th>
        <th align="center" width="190"><b>DESCRIPTION</b></th>
        <th align="center" width="50"><b>TASK CODE</b></th>
        <th align="center" width="70"><b>A/C EFF./ ENG. EFF.</b></th>
        <th align="center" width="70"><b>CURRENT THRESHOLD</b></th>
        <th align="center"  width="70"><b>CURRENT INTERVAL</b></th>
        <th align="center"><b>RECOMMENDED THRESHOLD</b></th>
        <th align="center"><b>RECOMMENDED INTERVAL</b></th>
        <th align="center"><b>SIGN CODE</b></th>
        <th align="center"><b>REFERENCE</b></th>
        <th align="center"><b>GMF REVIEW</b></th>
        <th align="center"><b>GARUDA REVIEW</b></th>
    </tr>';
    $i = 0;
    foreach ($list_assignment as $la)
    {
        $html .= "<tr>
                  <td>".++$i."</td>
                  <td>".$la['ms_num']."</td>
                  <td>".$la['descr']."</td>
                  <td>".$la['task_code']."</td>
                  <td>".$la['ac_eff']."</td>
                  <td>".$la['intval_threshold']."</td>
                  <td>".$la['intval']."</td>
                  <td>".$la['rec_threshold']."</td>
                  <td>".$la['rec_interval']."</td>
                  <td>".$la['camp_sg']."</td>
                  <td>".$la['ref_man']."</td>
                  <td>".$la['id_gmf']."</td>
                  <td>".$la['id_garuda']."</td>
                </tr>";
    }

$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$subtable = '<table width="20px" height="1px" border="1"><tr><td></td></tr></table>';
$subtable_checked = '<table width="20px" height="1px" border="1"><tr><td> V</td></tr></table>';
$subtable_x = '<table width="20px" height="1px" border="1"><tr><td> X</td></tr></table>';

foreach ($list_task as $lt) 
{
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetMargins(5,30,5,true);
    $pdf->SetPrintHeader(true);
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MP ITEM PERFORMANCE DATA EVALUATION', $lt->ac_type);
    
    $pdf->SetFont('dejavusans', '', 10);

    $html = '
    <table cellspacing="2" cellpadding="3">
        <tr>
            <th><b>MP Number:</b></th>
            <th>'.$lt->ms_num.'</th>
            <th align="right"><b>Task Code:</b></th>
            <th>'.$lt->task_code.'</th>
            <th align="right"><b>Resp:</b></th>
            <th>'.$lt->resp.'</th>
        </tr>
        <tr>
            <td><b>Description:</b></td>
            <td align="left" colspan="5">'.$lt->task_title.'<br>'.$lt->descr.'</td>
        </tr>
        <tr>
            <td><b>Interval:</b></td>
            <td colspan="2">'.$lt->intval.'</td>
            <td><b>Threshold:</b></td>
            <td colspan="3">Isi Threshold</td>
        </tr>
        <tr>
            <td><b>Rec. Interval:</b></td>
            <td colspan="2">Isinya</td>
            <td><b>Rec. Threshold:</b></td>
            <td colspan="3">Isinya</td>
        </tr>
        <tr>
            <td><b>Sign Code:</b></td>
            <td align="left" colspan="6">'.$lt->camp_sg.'</td>
        </tr>
        <tr>
            <td><b>References:</b></td>
            <td align="left" colspan="6">'.$lt->ref.'</td>
        </tr>
        <tr>
            <td><b>Eff Date:</b></td>
            <td colspan="2">'.$lt->effdate.'</td>
            <td align="right"><b>Category:</b></td>
            <td colspan="3">'.$lt->cat.'</td>
        </tr>
        <tr>
            <td><b>Zone:</b></td>
            <td align="left" colspan="6">'.$lt->zone.'</td>
        </tr>
        <tr>
            <td><b>Access:</b></td>
            <td align="left" colspan="6">'.$lt->access.'</td>
        </tr>
        <tr>
            <td><b>Effectivity:</b></td>
            <td align="left" colspan="6">'.$lt->ac_eff.'</td>
        </tr>
    </table>
    <hr>
    <h4>SCHEDULED ACCOMPLISHMENT DATA:</h4>
    <table cellspacing="3">
        <tr>
            <td>No. Accomplishment:</td>
            <td>'.$count_acc[$lt->ms_num][$lt->ac_type]->count_acc.'</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Finding:</td>
            <td>'.$count_finding[$lt->ms_num][$lt->ac_type].'</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Rejected Finding:</td>
            <td>'.$rejected_finding[$lt->ms_num][$lt->ac_type]->num_rejected.'</td>
            <td></td>
        </tr>
        <tr>
            <td>Finding Ratio:</td>
            <td>';

    if($count_acc[$lt->ms_num][$lt->ac_type]->count_acc > 0)
    {
        $html .= round((($count_finding[$lt->ms_num][$lt->ac_type] - $rejected_finding[$lt->ms_num][$lt->ac_type]->num_rejected)/$count_acc[$lt->ms_num][$lt->ac_type]->count_acc), 3);
    }
    else
    {
        $html .= 0;
    }

    $html .='</td>
            <td></td>
        </tr>
    </table>

    <hr>
    <h4>UNSCHEDULED ACCOMPLISHMENT DATA:</h4>
    <table>
        <tr>
            <th colspan="5"><b>1. Any SRI related?</b></th>';

    if (count($table_sri[$lt->ms_num][$lt->ac_type]) > 0)
    {
        $html .= '<th>Yes '.$subtable_checked.'</th>
                  <th>No '.$subtable.'</th>';
    }
    else
    {
        $html .= '<th>Yes '.$subtable.'</th>
                  <th>No '.$subtable_checked.'</th>';
    }

    $html .='</tr>
        <tr>
            <td colspan="5"><b>2. Any related delay to AOG, Accident, RTA, RTG?</b></td>';

    if (count($table_delay[$lt->ms_num][$lt->ac_type]) > 0)
    {
        $html .= '<th>Yes '.$subtable_checked.'</th>
                  <th>No '.$subtable.'</th>';
    }
    else
    {
        $html .= '<th>Yes '.$subtable.'</th>
                  <th>No '.$subtable_checked.'</th>';
    }

    $html .='</tr>
        <tr>
            <td colspan="5"><b>3. Any unscheduled component removal?</b></td>';

    if (count($table_removal[$lt->ms_num][$lt->ac_type]) > 0)
    {
        $html .= '<th>Yes '.$subtable_checked.'</th>
                  <th>No '.$subtable.'</th>';
    }
    else
    {
        $html .= '<th>Yes '.$subtable.'</th>
                  <th>No '.$subtable_checked.'</th>';
    }

    $html .='</tr>
    </table>';

    if(!empty($task_evaluation[$lt->ms_num][$lt->ac_type]))
    {
        $ev_ke = -1;
        foreach ($task_evaluation[$lt->ms_num][$lt->ac_type] as $te)
        {
            $ev_ke++;
            $temp = $html;
            $temp .='
            <hr>
            <table cellspacing="3" cellpadding="4">
                <tr>
                    <th align="left" width="150"><b>RECOMMENDATION:</b></th>';
            if($te['recommendation'] == 1)
            {
                $temp .= '<th width="80">Remain '.$subtable_checked.'</th>';
            }
            else
            {
                $temp .= '<th width="80">Remain '.$subtable.'</th>';
            }
            if($te['recommendation'] == 2)
            {
                $temp .= '<th>Extend '.$subtable_checked.'</th>';
            }
            else
            {
                $temp .= '<th>Extend '.$subtable.'</th>';
            }
            if($te['recommendation'] == 3)
            {
                $temp .= '<th>Descalation '.$subtable_checked.'</th>';
            }
            else
            {
                $temp .= '<th>Descalation '.$subtable.'</th>';
            }
            if($te['recommendation'] == 4)
            {
                $temp .= '<th>Add Task '.$subtable_checked.'</th>';
            }
            else
            {
                $temp .= '<th>Add Task '.$subtable.'</th>';
            }
            if($te['recommendation'] == 5)
            {
                $temp .= '<th>Remove Task '.$subtable_checked.'</th>';
            }
            else
            {
                $temp .= '<th>Remove Task '.$subtable.'</th>';
            }
        $temp .='</tr>
            </table>
            <table cellspacing="3" cellpadding="4">
                <tr>
                    <td align="left"><b>REASON:</b></td>
                    <td colspan="6" align="left">'.$te['reason'].'</td>
                </tr>
            </table>
            <table cellspacing="3" cellpadding="4">
                <tr>
                    <th colspan="4"></th>
                    <th align="center"><b>EVALUATED BY:</b></th>
                </tr>
                <tr>
                    <th colspan="4"></th>
                    <th align="center"><img src="assets/img/sign.png" alt="test alt attribute" width="100" height="100" border="0" /></th>
                </tr>
                <tr>    
                    <th colspan="4"></th>
                    <th align="center"><b>'.$te['name'].'</b></th>
                </tr>
            </table>
            ';


            $pdf->AddPage('P', 'A4');
            // output the HTML content
            $pdf->writeHTML($temp, true, false, true, false, '');

            // reset pointer to the last page
            $pdf->lastPage();

            $temp = '<table border="1">
                        <tr>
                            <th align="center" width="30"><b>NO.</b></th>
                            <th align="center"><b>REG</b></th>
                            <th align="center" colspan="2"><b>TYPE</b></th>
                            <th align="center" width="100"><b>DATE ACC</b></th>
                            <th align="center"colspan="4"><b>FINDING & RECTIFICATION</b></th>
                            <th align="center" width="80"><b>REMARKS</b></th>
                        </tr>';
            $i = 0;
            foreach ($finding as $f)
            {
                if($ev_ke < $f['evaluasi_ke'])
                {
                    break;
                }
                $temp .='<tr>
                            <td align="center">'.++$i.'</td>
                            <td align="center">'.$f->ac_reg.'</td>
                            <td align="center" colspan="2">'.$f->maint_type.'</td>
                            <td align="center">'.$f->date_acc.'</td>
                            <td align="center" colspan="4">'.$f->operation.'</td>
                            <td align="center">'.$f->remark_finding.'</td>
                        </tr>
                        </table>';
            }

            $pdf->AddPage('P', 'A4');

            // output the HTML content
            $pdf->writeHTML($temp, true, false, true, false, '');
        }
    }
    else
    {
        $temp = $html;
        $temp .='
        <hr>
        <table cellspacing="3" cellpadding="4">
            <tr>
                <th align="left" width="150"><b>RECOMMENDATION:</b></th>
                <th width="80">Remain '.$subtable.'</th>
                <th>Extend '.$subtable.'</th>
                <th>Descalation '.$subtable.'</th>
                <th>Add Task '.$subtable.'</th>
                <th>Remove Task '.$subtable.'</th>
            </tr>
        </table>
        <table cellspacing="3" cellpadding="4">
            <tr>
                <td align="left"><b>REASON:</b></td>
                <td colspan="6" align="left"></td>
            </tr>
        </table>
        <table cellspacing="3" cellpadding="4">
            <tr>
                <th colspan="4"></th>
                <th align="center"><b>EVALUATED BY:</b></th>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th align="center"><img src="assets/img/sign.png" alt="test alt attribute" width="100" height="100" border="0" /></th>
            </tr>
            <tr>    
                <th colspan="4"></th>
                <th align="center"><b></b></th>
            </tr>
        </table>
        ';

        $pdf->AddPage('P', 'A4');

        // output the HTML content
        $pdf->writeHTML($temp, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        $temp = '<table border="1">
                    <tr>
                        <th align="center" width="30"><b>NO.</b></th>
                        <th align="center"><b>REG</b></th>
                        <th align="center" colspan="2"><b>TYPE</b></th>
                        <th align="center" width="100"><b>DATE ACC</b></th>
                        <th align="center"colspan="4"><b>FINDING & RECTIFICATION</b></th>
                        <th align="center" width="80"><b>REMARKS</b></th>
                    </tr>
                 </table>';
        
        $pdf->AddPage('P', 'A4');

        // output the HTML content
        $pdf->writeHTML($temp, true, false, true, false, '');
    }
}

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+