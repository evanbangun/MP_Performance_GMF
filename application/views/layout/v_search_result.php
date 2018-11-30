<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Search MP Task
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Dashboard</li>
        <li class="active">Search MP Task</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Filter by:</h3>
            </div>
            <!-- /.box-header -->
            <?php echo form_open('dashboard/filter_search/'); ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">A/C Type</label>
                    <select name="ac_type_post" class="form-control select2" style="width: 100%;">
                      <?php
                        foreach ($list_actype as $lact)
                        {
                      ?>
                          <option value="<?php echo $lact['ac_type']; ?>"<?php if(isset($ac_type) && $ac_type == $lact['ac_type']){ echo "selected"; } ?>><?php echo $lact['ac_type']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">MP Number</label>
                    <input name="ms_num_post" type="text" class="form-control"
                    <?php 
                      if(isset($ms_num))
                      {
                        echo "value=".$ms_num;
                      }
                    ?>>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Responsible</label>
                    <select name="resp_post" class="form-control select2" style="width: 100%;">
                    	  <option value=""></option>
                      <?php
                        foreach ($list_resp as $lresp)
                        {
                      ?>
                          <option value="<?php echo $lresp['resp']; ?>"<?php if(isset($resp) && $resp == $lresp['resp']){ echo "selected"; } ?>><?php echo $lresp['resp']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="reservation" class="form-control pull-right" id="reservation" value="<?php if(isset($reservation)) { echo $reservation; } ?>">
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">ATA</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">SUB-ATA</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                </div> -->
                <input type="hidden" name="date_min_post" value="<?php if(isset($date_min_post)) { echo $date_min_post; } ?>">
                <input type="hidden" name="date_max_post" value="<?php if(isset($date_min_post)) { echo $date_max_post; } ?>">
                <input type="hidden" name="ac_type_post" value="<?php echo $ac_type; ?>">
                <div class="col-md-2" style="margin-top:1.7em">
                  <button type="submit" class="btn btn-block btn-primary">Filter</button>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <?php echo form_close(); ?>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b><?php echo count($result); ?> Maintenance Program Task Found</b></h3>
            <form method="POST" action="<?php echo base_url('index.php/report/report_pdf_search') ?>" target="_blank">
              <input type="hidden" name="date_min_post" value="<?php if(isset($date_min_post)) { echo $date_min_post; } ?>">
              <input type="hidden" name="date_max_post" value="<?php if(isset($date_min_post)) { echo $date_max_post; } ?>">
              <input type="hidden" name="ac_type_post" value="<?php echo $ac_type; ?>">
              <input name="ms_num_post" type="hidden" <?php if(isset($resp)){ echo " value=".$ms_num; } ?>>
              <input name="resp_post" type="hidden" <?php if(isset($resp)){ echo " value=".$resp; } ?>>
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-download"></i>Generate PDF</button>
            </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>MP Number</th>
                  <th>Type</th>
                  <th>Resp</th>
                  <th>Description</th>
                  <th>IntVal</th>
                  <th>RVCD</th>
                  <th>Camp SG</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $num = 1;
                  foreach($result as $row): 
                ?>
                <tr>
                  <td><?php echo $num++ ?></td>
                  <td><a href="<?php echo base_url('index.php/task/task_performance/'.$row['ms_num'].'/'.$row['ac_type']); ?>"><?php echo $row['ms_num'] ?></a></td>
                  <td><?php echo $row['ac_type'] ?></td>
                  <td><?php echo $row['resp'] ?></td>
                  <td><?php echo $row['descr'] ?></td>
                  <td><?php echo $row['intval'] ?></td>
                  <td><?php echo $row['rvcd'] ?></td>
                  <td><?php echo $row['camp_sg'] ?></td>
                  <td>
                    <?php
                    if($row['status'] == 0)
                    {
                        echo '<span class="label label-default">Unassigned</span>'; 
                    }
                    else if($row['status'] == 1)
                    {
                        echo '<span class="label label-primary">Assigned</span>'; 
                    }
                    else if($row['status'] == 2)
                    {
                        echo '<span class="label label-warning">Evaluating</span>'; 
                    }
                    else if($row['status'] == 3)
                    {
                        echo '<span class="label label-info">Evaluating</span>'; 
                    }
                    else if($row['status'] == 4)
                    {
                        echo '<span class="label label-primary">Assigned</span>'; 
                    }
                    else if($row['status'] == 5)
                    {
                        echo '<span class="label label-warning">Verifying</span>'; 
                    }
                    else if($row['status'] == 6)
                    {
                        echo '<span class="label label-success">Verified</span>';
                    }
                    ?>
                  </td>
                </tr>
                <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>