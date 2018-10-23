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
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">MP Number</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">MP Responsibility</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                </div>
                <div class="col-md-2">
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
                </div>
                <div class="col-md-2" style="margin-top:1.7em">
                  <button type="button" class="btn btn-block btn-primary">Filter</button>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"><b>2 Maintenance Program Task Found</b></h3>
              <button type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</button>
            </div>
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
                  <th>RVCD</th>
                  <th>Camp SG</th>
                  <th>Referensi</th>
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
                  <td><?php echo $row['descr'] ?></td>
                  <td><?php echo $row['task_code'] ?></td>
                  <td><?php echo $row['intval'] ?></td>
                  <td><?php echo $row['resp'] ?></td>
                  <td><?php echo $row['rvcd'] ?></td>
                  <td><?php echo $row['camp_sg'] ?></td>
                  <td><?php echo $row['ref'] ?></td>
                  <td><span class="label label-success">Verified</span></td>
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