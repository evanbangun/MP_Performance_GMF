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
    <?php
        $i=0;
        foreach ($list_assignment as $la)
        {
    ?>
            <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $la['ms_num']; ?></td>
            <td><?php echo $la['task_code']; ?></td>
            <td><?php echo $la['ac_eff']; ?></td>
            <td><?php echo $la['descr']; ?></td>
            <td><?php echo $la['intval_threshold']; ?></td>
            <td><?php echo $la['rec_threshold']; ?></td>
            <td><?php echo $la['intval']; ?></td>
            <td><?php echo $la['rec_interval']; ?></td>
            <td><?php echo $la['camp_sg']; ?></td>
            <td><?php echo $la['ref_man']; ?></td>
            <td><?php echo $la['recommendation']; ?></td>
            <td><?php echo $la['name_gmf']; ?></td>
            <td><?php echo $la['name_garuda']; ?></td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>