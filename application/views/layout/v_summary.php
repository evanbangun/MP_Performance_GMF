<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> Summary 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Summary</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Filter by:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Type</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option>B777</option>
                      <option>B737</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <!-- Date range -->
                  <div class="form-group">
                    <label></label>
                    <div style="margin-top:0.4em" class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right yearpicker" placeholder="From">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <div class="col-md-3">
                  <!-- Date range -->
                  <div class="form-group">
                    <label></label>
                    <div style="margin-top:0.4em" class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right yearpicker" placeholder="To">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <div class="col-md-2" style="margin-top:1.7em">
                  <a href="pages/mp-performance/search-mp-performance.html" type="button" class="btn btn-block btn-primary">Search</a>
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
        <div class="box-header with-border">
          <h3 class="box-title">Summary of MP Task</h3>
          <!-- <a style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em" href="" type="button" class="btn btn-success pull-right"><i class="fa fa-download"></i> Generate Excel</a> -->
          <a style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em" href="" type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>MP Number</th>
              <th>Description</th>
              <th>Sign Code</th>
              <th>Reference</th>
              <th>GMF Review</th>
              <th>Garuda Review</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(isset($list_assignment) && is_array($list_assignment) && count($list_assignment))
            {  
              $i = 0;
              foreach ($list_assignment as $la)
              {
            ?>
                <tr>
                  <td><?php echo ++$i ?></td>
                  <td><?php echo $la['ms_num']; ?></td>
                  <td><?php echo $la['descr']; ?></td>
                  <td>mpd 32-800-00</td>
                  <td><?php echo $la['task_code']; ?></td>
                  <td>Maulana M</td>
                  <td>Handono</td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>Task Code</b></td>
                  <td>GVI</td>
                  <td><b>A/C. EFF./ ENG. EFF</b></td>
                  <td>All</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>Current Threshold</b></td>
                  <td>Note</td>
                  <td><b>Current Interval</b></td>
                  <td>Note</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>Recommended Threshold</b></td>
                  <td>Note</td>
                  <td><b>Recommended Interval</b></td>
                  <td>Note</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td><b>Recommendation</b></td>
                  <td>Remain Interval/Extend Interval/Descalation Interval</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>     
                <tr>
                  <td height="30" colspan="14">
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    </div>
                  </div>
                  </td>
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