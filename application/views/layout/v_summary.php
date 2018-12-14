<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-file"></i> Summary 
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('index.php') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-file"></i> Summary</li>
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
            <?php echo form_open('summary'); ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>A/C Type</label>
                    <select name="ac_type" class="form-control select2" style="width: 100%;">
                      <?php
                        foreach ($list_actype as $lact)
                        {
                      ?>
                          <option value="<?php echo $lact['ac_type']; ?>"
                      <?php
                        if(isset($ac_type))
                        {
                          if($lact['ac_type'] == $ac_type)
                          {
                            echo "selected";
                          }
                        }
                      ?>
                      ><?php echo $lact['ac_type']; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>MP Number</label>
                    <input type="text" name="ms_num" class="form-control pull-right" value="<?php if(isset($ms_num)){ echo $ms_num;} ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>MP Responsibility</label>
                    <select name="resp" class="form-control select2" style="width: 100%;">
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
                <div class="col-md-5">
                  <!-- Date range -->
                  <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="reservation" class="form-control pull-right" id="reservation"
                      <?php
                        if(isset($list_assignment) && is_array($list_assignment))
                        {
                      ?>
                            value="<?php echo $reservation; ?>"
                      <?php  
                        }
                      ?>
                      readonly="true">
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                <!-- <div class="col-md-1">
                  <button style="margin-top:2.2em" type="button" class="btn btn-default btn-sm">
                      <span class="fa fa-trash"></span> 
                  </button>
                </div> -->
                <div class="col-md-2 pull-right" style="margin-top:1.7em">
                  <button type="submit" class="btn btn-block btn-primary">Search</button>
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
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Summary of MP Task</h3>
          <!-- <a style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em" href="" type="button" class="btn btn-success pull-right"><i class="fa fa-download"></i> Generate Excel</a> -->
          <?php
          if(isset($list_assignment) && is_array($list_assignment) && count($list_assignment))
          {
          ?>
          <form method="POST" target="_blank" action="report/report_summary">
            <input type="hidden" name="ac_type_post" value="<?php if(isset($ac_type)){ echo $ac_type; } ?>">
            <input type="hidden" name="ms_num_post" value="<?php if(isset($ms_num)){ echo $ms_num; } ?>">
            <input type="hidden" name="resp_post" value="<?php if(isset($resp)){ echo $resp; } ?>">
            <input type="hidden" name="date_max_post" value="<?php if(isset($date_max)){ echo $date_max; } ?>">
            <input type="hidden" name="date_min_post" value="<?php if(isset($date_min)){ echo $date_min; } ?>">
            <button type="submit" style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.5em;" class="btn btn-primary pull-right" ><i class="fa fa-download"></i> Generate PDF</button>
          </form>
          <form method="POST" target="_blank" action="report/report_excel">
            <input type="hidden" name="ac_type_post" value="<?php if(isset($ac_type)){ echo $ac_type; } ?>">
            <input type="hidden" name="ms_num_post" value="<?php if(isset($ms_num)){ echo $ms_num; } ?>">
            <input type="hidden" name="resp_post" value="<?php if(isset($resp)){ echo $resp; } ?>">
            <input type="hidden" name="date_max_post" value="<?php if(isset($date_max)){ echo $date_max; } ?>">
            <input type="hidden" name="date_min_post" value="<?php if(isset($date_min)){ echo $date_min; } ?>">
            <button type="submit" style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.5em;" class="btn btn-success pull-right"><i class="fa fa-download"></i> Generate Excel</button>
          </form>
          <?php
          }
          ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="summary_table" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="width:5px">No.</th>
              <th style="">MP Number</th>
              <th style="">Task Code</th>
              <th style="">A/C. EFF./ ENG. EFF</th>
              <th style="width: 500px">Description</th>
              <th style="">Current Threshold</th>
              <th style="">Recommended Threshold</th>
              <th style="">Current Interval</th>
              <th style="">Recommended Interval</th>
              <th style="width:100px">Sign Code</th>
              <th style="">Reference</th>
              <th style="">Recommendation</th>
              <th style="">GMF Review</th>
              <th style="">GA Review</th>
            </tr>
            </thead>
            <!-- <tbody>
            <?php
            if(isset($list_assignment) && is_array($list_assignment) && count($list_assignment))
            {  
              $i = 0;
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
            }
            ?>
            </tbody> -->
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      var ac_type = '<?php if(isset($ac_type)){ echo $ac_type; } ?>';
      var ms_num = '<?php if(isset($ms_num)){ echo $ms_num; } ?>';
      var resp = '<?php if(isset($resp)){ echo $resp; } ?>';
      var date_max = '<?php if(isset($date_max)){ echo $date_max; } ?>';
      var date_min = '<?php if(isset($date_min)){ echo $date_min; } ?>';
      loadDataTable(ac_type, ms_num, resp, date_max, date_min);
    });

    function loadDataTable(ac_type, ms_num, resp, date_max, date_min){
      $('#summary_table').dataTable({
        "scrollX"       : true,
        "bDestroy"      : true,
        "stateSave"     : false,
        "searching"       : true,
        "select"          : true,
        "bLengthChange"   : false,
        "scrollCollapse"  : false,
        "bPaginate"       : true,
        "bInfo"           : true,
        "bSort"           : false,
        "aLengthMenu"   : [[30, 50, 75, -1], [30, 50, 75, "All"]],
        "pageLength"    : 10,
        "processing"      : true, //Feature control the processing indicator.
        "serverSide"    : true, //Feature control DataTables' server-side processing mode.
        "order"       : [], //Initial no order.
        //"dom"               : 'Bfrtip',
        //"buttons"     : ['copy', 'csv', 'excel', 'pdf', 'print'],
        "fnRowCallback"   : function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          // $(nRow).css('color', 'white');                
          // $('td', nRow).css('background-color', 'rgba(51, 110, 123,0.2)');
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url" : "<?php echo base_url('index.php/summary/summary_ajax/'); ?>",
          "type"  : "POST",
          "data"  : {"ac_type" : ac_type,
                     "ms_num" : ms_num,
                     "resp" : resp,
                     "date_max" : date_max,
                     "date_min" : date_min}
        },
        "language": {
          "processing": "<center><img src='<?php echo base_url('assets/img/loading_icon.gif');?>' /></center>"
        },
          // "processing": "Sedang loading data, harap tunggu . . ."
        //Set column definition initialisation properties.
        "columnDefs" : [
          { 
            "orderable" : false, //set not orderable
            "targets" : 1, //first column / numbering column
          }//,
          //{ 
            //"targets": 2, // your case first column
            //"className": "text-center",
          //},
        ]
        /*,"rowCallback": function( row, data, index ) {
          if ( data[2] == "OK" ) {
            $("td:eq(2), row").css("background-color","green");
           
          }else{
            $("td:eq(-0), row").css("background-color","green");
          }
        },*/
      });
    }
  </script>
