<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <style>
        /* @page *{
            margin-top: 2.54cm;
            margin-bottom: 2.54cm;
            margin-left: 3.175cm;
            margin-right: 3.175cm;
        } */
        .checkbox {
            width:20px;
            height:20px;
            border: 1px solid #000;
            display: inline-block;
            }
    </style>
</head>
<body>
<?php

$subtable = '<table width="20px" height="1px" border="1"><tr><td></td></tr></table>';
$subtable_checked = '<table width="20px" height="1px" border="1"><tr><td> V</td></tr></table>';
$subtable_x = '<table width="20px" height="1px" border="1"><tr><td> X</td></tr></table>';

?>
<div id="container">
    <div id="body">
    <table style="100%">
    <tr>
        <th width="20%" align="left">MP Number:</th>
        <th width="20%" align="left" style="font-weight:normal">123456</th>
        <th width="20%" align="right"><b>Task Code:</b></th>
        <th width="20%" align="left" style="font-weight:normal">GVD</th>
        <th width="20%" align="right"><b>Resp:</b></th>
        <th width="20%" align="left" style="font-weight:normal">STR</th>
    </tr>
    <tr>
        <td><b>Description:</b></td>
        <td align="left" colspan="6"><br></td>
    </tr>
    <tr>
        <td><b>Interval:</b></td>
        <td colspan="2"></td>
        <td align="left"><b>Threshold:</b></td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td><b>Sign Code:</b></td>
        <td align="left" colspan="6"></td>
    </tr>
    <tr>
        <td><b>References:</b></td>
        <td align="left" colspan="6"></td>
    </tr>
    <tr>
        <td><b>Eff Date:</b></td>
        <td colspan="2"></td>
        <td align="left"><b>Category:</b></td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td><b>Zone:</b></td>
        <td align="left" colspan="6"></td>
    </tr>
    <tr>
        <td><b>Access:</b></td>
        <td align="left" colspan="6"></td>
    </tr>
    <tr>
        <td><b>Effectivity:</b></td>
        <td align="left" colspan="6"></td>
    </tr>
</table>
<hr>
<h4>SCHEDULED ACCOMPLISHMENT DATA:</h4>
<table cellspacing="3">
    <tr>
        <td>No. Accomplishment:</td>
        <td>1</td>
    </tr>
    <tr>
        <td>No. Finding:</td>
        <td>1</td>
    </tr>
    <tr>
        <td>No. Rejected Finding:</td>
        <td>0</td>
    </tr>
    <tr>
        <td>Finding Ratio:</td>
        <td>0</td>
    </tr>
</table>
<hr>
<h4>UNSCHEDULED ACCOMPLISHMENT DATA:</h4>
<table >
    <tr>
        <th colspan="5" align="left"><b>1. Any SRI related?</b></th>
        <th align="left" style="font-weight:normal">Yes</th> 
        <th style="font-weight:normal" class="checkbox">V</th>
        <th></th>
        <th align="left" style="font-weight:normal">No</th>
        <th class="checkbox"></th>
    </tr>
    <tr>
        <td colspan="7">SRI NO 23477 - NOSE WHEEL AXLE NUT MISSING -PK-GAL</td>
    </tr>
    <tr>
        <td colspan="7">DISCUSS WITH ATR REGARDING NLG WHEEL/TIRE INSTALLATION MANUA (AMM JIC: 12-37-32 RAI 10010 001). RECOMMENDATION  TO ADD CLARITY TO THE MANUAL BY ATTACHING MILITIONAL FIGURE TO AVOID AMBIGUITY AND MISPERCEPTION OF THE MANUAL
        </td>
    </tr>
    <tr>
        <td colspan="5"><b>2. Any related delay to AOG, Accident, RTA, RTG?</b></td>
        <td style="font-weight:normal">Yes</td>
        <td class="checkbox">V</td>
        <td></td>
        <td style="font-weight:normal">No</td>
        <td class="checkbox"></td>
    </tr>
    <tr>
        <td colspan="7">PK-GAF - SERVICING LDG SHOCK STRUT</td>
    </tr>
    <tr>
        <td colspan="5"><b>3. Any unscheduled component removal?</b></td>
        <td style="font-weight:normal">Yes</td>
        <td class="checkbox">V</td>
        <td></td>
        <td style="font-weight:normal">No</td>
        <td class="checkbox"></td>
    </tr>
</table>
<table border="1">
        <tr>
            <td align="center">PARTNO</td>
            <td align="center">PARTNAME</td>
            <td align="center">DATE</td>
            <td align="center">ALERTLEVEL</td>
            <td align="center">L12MRATE</td>
            <td align="center">L6MRATE</td>
            <td align="center">ALERTSTATUS</td>
        </tr>
        <tr>
            <td align="center">20032-2</td>
            <td align="center">AC GENERATOR</td>
            <td align="center">2018-10-05</td>
            <td align="center">0,876</td>
            <td align="center">,082</td>
            <td align="center">0,079</td>
            <td align="center">- -</td>
        </tr>
    </table>
<hr>
<table>
    <tr>
        <th align="left" width="150"><b>RECOMMENDATION:</b></th>
        <th style="font-weight:normal">Remain</th>
        <th class="checkbox"></th>
        <th style="font-weight:normal">Extend</th>
        <th class="checkbox"></th>
        <th style="font-weight:normal">Descalation</th>
        <th class="checkbox"></th>
        <th style="font-weight:normal">Add Task</th>
        <th class="checkbox">V</th>
        <th style="font-weight:normal">Remove Task</th>
        <th class="checkbox"></th>
    </tr>
</table>
<br>
<table>
    <tr>
        <th align="left">Rec. Interval:</th>
        <th width="35%" style="font-weight:normal">....</th>
        <th align="left">Rec. Threshold:</th>
        <th width="30%" style="font-weight:normal">....</th>
    </tr>
</table>
<br>
<table>
    <tr>
        <td align="left"><b>REASON:</b></td>
        <td colspan="6" align="left">Test</td>
    </tr>
</table>
<br>
<table align="right" cellspacing="3" cellpadding="4">
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
        <th align="center"><b>Nama</b></th>
    </tr>
</table>
    </div>
 
</div>
<pagebreak>
    <table border="1">
        <tr>
            <th width="5%">NO.</th>
            <th width="10%">REG</th>
            <th width="15%">TYPE</th>
            <th width="20%">DATE ACC</th>
            <th width="25%">FINDING & RECTIFICATION</th>
            <th width="25%">REMARKS</th>
        </tr>
        <tr>
            <td>1</td>
            <td>PK-GER</td>
            <td>.........</td>
            <td>........</td>
            <td>........</td>
            <td>...........</td>
        </tr>
    </table>
 
</body>
</html>