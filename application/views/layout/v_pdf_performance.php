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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MP ITEM PERFORMANCE DATA EVALUATION', $list_task->ac_type);


// set header and footer fonts
$pdf->setHeaderFont(Array('helvetica', '', '12'));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5,30,5,true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

// create some HTML content
$subtable = '<table width="20px" height="1px" border="1"><tr><td></td></tr></table>';
$subtable_checked = '<table width="20px" height="1px" border="1"><tr><td> V</td></tr></table>';
$subtable_x = '<table width="20px" height="1px" border="1"><tr><td> X</td></tr></table>';
//$signature = '<img class="profile-user-img img-responsive" src="../../../assets/img/sign.jpg">';
// <h2 style="text-align:center">MP Performance</h2>

// <tr>
// <td colspan="7">SRI NO 23477 - NOSE WHEEL AXLE NUT MISSING -PK-GAL</td>
// </tr>
// <tr>
// <td colspan="7">DISCUSS WITH ATR REGARDING NLG WHEEL/TIRE INSTALLATION MANUA (AMM JIC: 12-37-32 RAI 10010 001). RECOMMENDATION
// TO ADD CLARITY TO THE MANUAL BY ATTACHING MILITIONAL FIGURE TO AVOID AMBIGUITY AND MISPERCEPTION OF THE MANUAL</td>
// </tr>
// <tr>B 
// <td colspan="7">PK-GAF - SERVICING LDG SHOCK STRUT</td>
// </tr>
// <table border="1">
// <tr>
//         <td align="center">PARTNO</td>
//         <td align="center">PARTNAME</td>
//         <td align="center">DATE</td>
//         <td align="center">ALERTLEVEL</td>
//         <td align="center">L12MRATE</td>
//         <td align="center">L6MRATE</td>
//         <td align="center">ALERTSTATUS</td>
//     </tr>
//     <tr>
//         <td align="center">20032-2</td>
//         <td align="center">AC GENERATOR</td>
//         <td align="center">2018-10-05</td>
//         <td align="center">0,876</td>
//         <td align="center">,082</td>
//         <td align="center">0,079</td>
//         <td align="center">- -</td>
//     </tr>
// </table>
$html = '
<table cellspacing="2" cellpadding="3">
    <tr>
        <th><b>MP Number:</b></th>
        <th>'.$list_task->ms_num.'</th>
        <th align="right"><b>Task Code:</b></th>
        <th>'.$list_task->task_code.'</th>
        <th align="right"><b>Resp:</b></th>
        <th>'.$list_task->resp.'</th>
    </tr>
    <tr>
        <td><b>Description:</b></td>
        <td align="left" colspan="5">'.$list_task->task_title.'<br>'.$list_task->descr.'</td>
    </tr>
    <tr>
        <td><b>Interval:</b></td>
        <td align="left" colspan="6">'.$list_task->intval.'</td>
    </tr>
    <tr>
        <td><b>Sign Code:</b></td>
        <td align="left" colspan="6">'.$list_task->camp_sg.'</td>
    </tr>
    <tr>
        <td><b>References:</b></td>
        <td align="left" colspan="6">'.$list_task->ref.'</td>
    </tr>
    <tr>
        <td><b>Eff Date:</b></td>
        <td colspan="2">'.$list_task->effdate.'</td>
        <td align="right"><b>Category:</b></td>
        <td colspan="3">'.$list_task->cat.'</td>
    </tr>
    <tr>
        <td><b>Zone:</b></td>
        <td align="left" colspan="6">'.$list_task->zone.'</td>
    </tr>
    <tr>
        <td><b>Access:</b></td>
        <td align="left" colspan="6">'.$list_task->access.'</td>
    </tr>
    <tr>
        <td><b>Effectivity:</b></td>
        <td align="left" colspan="6">'.$list_task->ac_eff.'</td>
    </tr>
</table>
<hr>
<h4>SCHEDULED ACCOMPLISHMENT DATA:</h4>
<table cellspacing="3">
    <tr>
        <td>No. Accomplishment:</td>
        <td>'.$count_acc->count_acc.'</td>
        <td></td>
    </tr>
    <tr>
        <td>No. Finding:</td>
        <td>'.$count_finding.'</td>
        <td></td>
    </tr>
    <tr>
        <td>No. Rejected Finding:</td>
        <td>'.$rejected_finding->num_rejected.'</td>
        <td></td>
    </tr>
    <tr>
        <td>Finding Ratio:</td>
        <td>0</td>
        <td></td>
    </tr>
</table>

<hr>
<h4>UNSCHEDULED ACCOMPLISHMENT DATA:</h4>
<table>
    <tr>
        <th colspan="5"><b>1. Any SRI related?</b></th>
        <th>Yes '.$subtable_checked.'</th>
        <th>No '.$subtable.'</th>
    </tr>
    <tr>
        <td colspan="5"><b>2. Any related delay to AOG, Accident, RTA, RTG?</b></td>
        <td>Yes '.$subtable_checked.'</td>
        <td>No '.$subtable.'</td>
    </tr>
    <tr>
        <td colspan="5"><b>3. Any unscheduled component removal?</b></td>
        <td>Yes '.$subtable_checked.'</td>
        <td>No '.$subtable.'</td>
    </tr>
</table>
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
        <td colspan="6" align="left">Test</td>
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
        <th align="center"><b>'.$this->session->userdata('name').'</b></th>
    </tr>
</table>
';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print some HTML Cells

// $html = '<span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span><br /><span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span>';

// $pdf->SetFillColor(255,255,0);

// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);
// $pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);

// reset pointer to the last page
$pdf->lastPage();

// Print all HTML colors

// add a page
$pdf->AddPage();

$html =$html = '
                <table border="1">
                    <tr>
                        <th align="center" width="30"><b>NO.</b></th>
                        <th align="center"><b>REG</b></th>
                        <th align="center" colspan="2"><b>TYPE</b></th>
                        <th align="center" width="100"><b>DATE ACC</b></th>
                        <th align="center"colspan="4"><b>FINDING & RECTIFICATION</b></th>
                        <th align="center" width="80"><b>REMARKS</b></th>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td align="center">PK-GAA</td>
                        <td align="center" colspan="2">2Y INSPECTION AND AD</td>
                        <td align="center">02.11.2015</td>
                        <td align="center" colspan="4">NIL</td>
                        <td align="center">Isi Remarks</td>
                </tr>
                </table>
               ';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+