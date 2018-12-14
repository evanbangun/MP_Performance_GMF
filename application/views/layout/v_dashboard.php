<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-dashboard"></i> Dashboard 
      <!-- <div class="btn-group">
        <button type="button" class="btn btn-default">All</button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">All</a></li>
          <li><a href="#">User</a></li>
        </ul>
      </div> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('index.php') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $data_dashboard->unassigned; ?></h3>

              <p>MP Task</p>
            </div>
            <div class="icon">
              <i class="ion ion-plane"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $data_dashboard->evaluated; ?><sup style="font-size: 20px"></sup></h3>

              <p>Evaluated</p>
            </div>
            <div class="icon">
              <i class="ion ion-checkmark"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $data_dashboard->verified; ?></h3>

              <p>Verified</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-checkmark-outline"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $data_dashboard->assigned_gmf + $data_dashboard->assigned_garuda + $data_dashboard->evaluating + $data_dashboard->verifying; ?></h3>

              <p>Uncompleted</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-alarm-clock"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Search MP Task</h3>
            </div>
            <!-- /.box-header -->
            <?php echo form_open('dashboard/filter_search/'); ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Type</label>
                    <select name="ac_type_post" class="form-control select2" style="width: 100%;">
                      <?php
                        foreach ($list_actype as $lact)
                        {
                      ?>
                          <option value="<?php echo $lact['ac_type']; ?>"><?php echo $lact['ac_type']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-md-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">A/C Reg</label>
                    <input type="email" class="form-control" id="exampleInputEmail1">
                  </div>
                </div> -->
                <!-- <div class="col-md-6">
                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="reservation" class="form-control pull-right" id="reservation">
                    </div>
                  </div>
                </div> -->
                <div class="col-md-2" style="margin-top:1.7em">
                  <input type="submit" class="btn btn-block btn-primary" value="Search">
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <?php echo form_close(); ?>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
