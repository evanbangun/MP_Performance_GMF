<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> MP Tasks
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">MP Tasks</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>MP Number</th>
              <th>Type</th>
              <th>Description</th>
              <th>TCode</th>
              <th>IntVal</th>
              <th>Resp</th>
              <th>RCVD</th>
              <th>Camp SG</th>
              <th>Referensi</th>
              <th>Status</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($list_assignment) && is_array($list_assignment) && count($list_assignment))
            {  
              $i = 0;
              foreach ($list_assignment as $la)
              {
                $eva_ver = explode("&", $la['eva_ver']);
            ?>
                <tr>
                  <td><?php echo ++$i ?></td>
                  <?php
                  if(in_array($this->session->userdata('id_user'), $eva_ver))
                  {
                  ?>
                    <td><a href="<?php echo base_url('index.php/task/task_performance/'.$la['ms_num'].'/'.$la['ac_type']); ?>"><?php echo $la['ms_num']; ?></a></td>
                  <?php  
                  }
                  else
                  {
                  ?>
                    <td><?php echo $la['ms_num']; ?></td>
                  <?php
                  }
                  ?>
                  <td><?php echo $la['ac_type']; ?></td>  
                  <td><?php echo $la['descr']; ?></td>
                  <td><?php echo $la['task_code']; ?></td>
                  <td><?php echo $la['intval']; ?></td>
                  <td><?php echo $la['resp']; ?></td>
                  <td><?php echo $la['rvcd']; ?></td>
                  <td><?php echo $la['camp_sg']; ?></td>
                  <td><?php echo $la['ref']; ?></td>
                  <?php
                    if($la['status'] == 1)
                    {
                  ?>
                      <td><span class="label label-primary">Assigned</span></td>
                  <?php
                      if($this->session->userdata('role') == 3)
                      {
                  ?>
                        <td><a href="<?php echo base_url('index.php/user/assign_task/'.$la['ms_num'].'/'.$la['ac_type'].'/'.$la['resp'])?>"><button>Evaluate</button></a></td>
                  <?php
                      }
                      else
                      {
                    ?>
                        <td>Awaiting Evaluation</td>
                    <?php
                      }
                    }
                    else if($la['status'] == 2)
                    {
                      echo '<td><span class="label label-warning">Evaluating</span></td>
                            <td></td>';
                    }
                    else if($la['status'] == 3)
                    {
                      echo '<td><span class="label label-info">Evaluated</span></td>
                            <td></td>';
                    }
                    else if($la['status'] == 4)
                    {
                    ?>
                      <td><span class="label label-primary">Assigned</span></td>
                    <?php
                      if($this->session->userdata('role') == 4)
                      {
                    ?>
                        <td><a href="<?php echo base_url('index.php/user/assign_task/'.$la['ms_num'].'/'.$la['ac_type'].'/'.$la['resp'])?>"><button>Verify</button></a></td>
                    <?php
                      }
                      else
                      {
                    ?>
                        <td>Awaiting Verification</td>
                    <?php
                      }
                    }
                    else if($la['status'] == 5)
                    {
                      echo '<td><span class="label label-warning">Verifying</span></td>
                            <td></td>';
                    }
                    else if($la['status'] == 6)
                    {
                      echo '<td><span class="label label-success">Verified</span></td>
                            <td></td>';
                    }
                  ?>
                </tr>
            <?php
              }
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>