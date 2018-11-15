<?php
set_time_limit(0);

header( "Content-type: application/vnd.ms-excel" );
$date = new DateTime();
header('Content-Disposition: attachment; filename="'.date_format($date, 'Y-m-d H:i:s').'.xls"');
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>MP Number</th>
            <th>Task Code</th>
            <th>A/C. EFF./ ENG. EFF</th>
            <th>Description</th>
            <th>Current Threshold</th>
            <th>Recommended Threshold</th>
            <th>Current Interval</th>
            <th>Recommended Interval</th>
            <th>Sign Code</th>
            <th>References</th>
            <th>Recommendation</th>
            <th>GMF Review</th>
            <th>GA Review</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>0541080100</td>
            <td>ZGV</td>
            <td>9 NOTE</td>
            <td>EXTERNAL - ZONAL (GVI): MID-EXIT DOOR PERFORM AN EXTERNAL ZONAL INSPECTION (GVI) OF THE MID-EXIT DOOR. AIRPLANE NOTE: APPLICABLE ONLY TO AIRPLANES WITH ACTIVE LEFT MID-EXIT DOOR. ACCESS NOTE: DOOR IN OPEN POSITION.</td>
            <td></td>
            <td></td>
            <td>>>24 MO >>O/ 5500 FC</td>
            <td>ZGV</td>
            <td>>>MPD 52-846-01 >>MRB 52-846-01</td>
            <td>TASK CARD 52-846-01-01 TASK CARD 52-846-01-02</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>