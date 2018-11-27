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
$ev_ke = 0;
foreach ($task_evaluation as $te)
{
    $ev_ke++;
?>
    <div id="container">
        <div id="body">
        <table style="100%">
        <tr>
            <th width="20%" align="left">MP Number:</th>
            <th width="20%" align="left" style="font-weight:normal"><?php echo $list_task->ms_num; ?></th>
            <th width="20%" align="right"><b>Task Code:</b></th>
            <th width="20%" align="left" style="font-weight:normal"><?php echo $list_task->task_code; ?></th>
            <th width="20%" align="right"><b>Resp:</b></th>
            <th width="20%" align="left" style="font-weight:normal"><?php echo $list_task->resp; ?></th>
        </tr>
        <tr>
            <td><b>Description:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->descr; ?></td>
        </tr>
        <tr>
            <td><b>Interval:</b></td>
            <td colspan="2"><?php echo $list_task->intval; ?></td>
            <td align="left"><b>Threshold:</b></td>
            <td colspan="3"><?php echo $list_task->intval_threshold; ?></td>
        </tr>
        <tr>
            <td><b>Sign Code:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->camp_sg; ?></td>
        </tr>
        <tr>
            <td><b>References:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->ref; ?></td>
        </tr>
        <tr>
            <td><b>Eff Date:</b></td>
            <td colspan="2"><?php echo $list_task->effdate; ?></td>
            <td align="left"><b>Category:</b></td>
            <td colspan="3"><?php echo $list_task->cat; ?></td>
        </tr>
        <tr>
            <td><b>Zone:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->zone; ?></td>
        </tr>
        <tr>
            <td><b>Access:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->access; ?></td>
        </tr>
        <tr>
            <td><b>Effectivity:</b></td>
            <td align="left" colspan="6"><?php echo $list_task->ac_eff; ?></td>
        </tr>
    </table>
    <hr>
    <h4>SCHEDULED ACCOMPLISHMENT DATA:</h4>
    <table cellspacing="3">
        <tr>
            <td>No. Accomplishment:</td>
            <td><?php echo $count_acc->count_acc ?></td>
        </tr>
        <tr>
            <td>No. Finding:</td>
            <td><?php echo $count_finding ?></td>
        </tr>
        <tr>
            <td>No. Rejected Finding:</td>
            <td><?php echo $rejected_finding->num_rejected ?></td>
        </tr>
        <tr>
            <td>Finding Ratio:</td>
            <td><?php
                    if($count_acc->count_acc > 0)
                    {
                    echo round((($count_finding - $rejected_finding->num_rejected)/$count_acc->count_acc), 3);
                    }
                    else
                    {
                    echo 0;
                    }
                ?>
            </td>
        </tr>
    </table>
    <hr>
    <h4>UNSCHEDULED ACCOMPLISHMENT DATA:</h4>
    <table >
        <tr>
            <th colspan="5" align="left"><b>1. Any SRI related?</b></th>
            <?php
            if (count($table_sri) > 0)
            {
            ?>
                <th align="left" style="font-weight:normal">Yes</th> 
                <th style="font-weight:normal" class="checkbox">V</th>
                <th></th>
                <th align="left" style="font-weight:normal">No</th>
                <th class="checkbox"></th>
        </tr>
                <?php
                foreach ($table_sri as $ts) 
                {
                ?>
                    <tr>
                        <td colspan="7">SRI NO <?php echo $ts['sri_no']; ?> - <?php echo $ts['sri_title']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"><?php echo $ts['sri_desc']; ?></td>
                    </tr>
                <?php
                }
            }
            else
            {
            ?>
                <th align="left" style="font-weight:normal">Yes</th> 
                <th class="checkbox"></th>
                <th></th>
                <th align="left" style="font-weight:normal">No</th>
                <th style="font-weight:normal" class="checkbox">V</th>
        </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="5"><b>2. Any related delay to AOG, Accident, RTA, RTG?</b></td>
            <?php 
            if (count($table_delay) > 0)
            {
            ?>
                    <td style="font-weight:normal">Yes</td>
                    <td class="checkbox">V</td>
                    <td></td>
                    <td style="font-weight:normal">No</td>
                    <td class="checkbox"></td>      
        </tr>
            <?php
                foreach ($table_delay as $td) 
                {
            ?>
                <tr>
                    <td colspan="7"><?php echo $td['ac_reg']; ?> - <?php echo $td['key_problem']; ?></td>
                </tr>
            <?php
                }
            }
            else
            {
            ?>
                   <td style="font-weight:normal">Yes</td>
                    <td class="checkbox"></td>
                    <td></td>
                    <td style="font-weight:normal">No</td>
                    <td class="checkbox">V</td>      
        </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="5"><b>3. Any unscheduled component removal?</b></td>
            <?php
            if (count($table_removal) > 0)
            {
            ?>
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
                <!-- <td align="center">DATE</td> -->
                <td align="center">ALERTLEVEL</td>
                <td align="center">L12MRATE</td>
                <td align="center">L6MRATE</td>
                <td align="center">ALERTSTATUS</td>
            </tr>
                <?php
                foreach ($table_removal as $tr) 
                {
                ?>
                <tr>
                    <td><?php echo $tr['PartNo']; ?></td>
                    <td><?php echo $tr['PartName']; ?></td>
                    <!-- <td><?php echo $tr['PartName']; ?></td> -->
                    <td><?php echo $tr['AlertLevel']; ?></td>
                    <td><?php echo $tr['L12MRate']; ?></td>
                    <td><?php echo $tr['L6MRate']; ?></td>
                    <td><?php echo $tr['L12MAlertStatus'].' '.$tr['L6MAlertStatus'] ; ?></td>
                </tr>
                <?php
                }
            ?>
            </table>
            <?php
            }
            else
            {
            ?>
            <td style="font-weight:normal">Yes</td>
            <td class="checkbox"></td>
            <td></td>
            <td style="font-weight:normal">No</td>
            <td class="checkbox">V</td>
        </tr>
    </table>
            <?php
            }
            ?>
    <hr>
    <table>
        <tr>
            <th align="left" width="150"><b>RECOMMENDATION:</b></th>
            <th style="font-weight:normal">Remain</th>
            <th class="checkbox">
            <?php
                if($te['recommendation'] == 1)
                {
                    echo "V";
                }
            ?>
            </th>
            <th style="font-weight:normal">Extend</th>
            <th class="checkbox">
            <?php
                if($te['recommendation'] == 2)
                {
                    echo "V";
                }
            ?>
            </th>
            <th style="font-weight:normal">Descalation</th>
            <th class="checkbox">
            <?php
                if($te['recommendation'] == 3)
                {
                    echo "V";
                }
            ?>
            </th>
            <th style="font-weight:normal">Add Task</th>
            <th class="checkbox">
            <?php
                if($te['recommendation'] == 4)
                {
                    echo "V";
                }
            ?>
            </th>
            <th style="font-weight:normal">Remove Task</th>
            <th class="checkbox">
            <?php
                if($te['recommendation'] == 5)
                {
                    echo "V";
                }
            ?>
            </th>
        </tr>
    </table>
    <br>
    <?php
    if($te['recommendation'] == 2 || $te['recommendation'] == 3)
    {
    ?>
        <table>
            <tr>
                <th align="left">Rec. Interval:</th>
                <th width="35%" style="font-weight:normal"><?php echo $te['rec_interval']; ?></th>
                <th align="left">Rec. Threshold:</th>
                <th width="30%" style="font-weight:normal"><?php echo $te['rec_threshold']; ?></th>
            </tr>
        </table>
    <?php
    }
    ?>
    <br>
    <table>
        <tr>
            <td align="left"><b>REASON:</b></td>
            <td colspan="6" align="left"><?php echo $te['reason']; ?></td>
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
            <th align="center"><img src="<?php echo base_url(); ?>assets/img/signature/<?php echo $te['signature']; ?>" alt="test alt attribute" width="100" height="100" border="0" /></th>
        </tr>
        <tr>    
            <th colspan="4"></th>
            <th align="center"><b><?php echo $te['name']; ?></b></th>
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
        <?php
            $i = 0;
            foreach ($finding as $f)
            {
                if($ev_ke < $f['evaluasi_ke'])
                {
                    break;
                }
        ?>
                <tr>
                    <td align="center"><?php echo ++$i; ?></td>
                    <td align="center"><?php echo $f->ac_reg; ?></td>
                    <td align="center" colspan="2"><?php echo $f->maint_type; ?></td>
                    <td align="center"><?php echo $f->date_acc; ?></td>
                    <td align="center" colspan="4"><?php echo $f->operation; ?></td>
                    <td align="center"><?php echo $f->remark_finding; ?></td>
                </tr>
        <?php
            }
        ?>
    </table>
    <pagebreak>
<?php
}
?>
</body>
</html>