<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Assign Task 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Assign Task</li>
      </ol>
    </section>

    <!-- Main content -->
      <div class="box">
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
              <!-- <th>PIC</th> -->
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
                  <input type="hidden" id="msnum<?php echo $i; ?>" value="<?php echo $la['ms_num']; ?>">
                  <input type="hidden" id="actype<?php echo $i; ?>" value="<?php echo $la['ac_type']; ?>">
                  <td><a href="<?php echo base_url('index.php/task/task_performance/'.$la['ms_num'].'/'.$la['ac_type']); ?>"><?php echo $la['ms_num']; ?></a></td>
                  <td><?php echo $la['ac_type']; ?></td>
                  <td><?php echo $la['resp']; ?></td>
                  <td><?php echo $la['descr']; ?></td>
                  <td><?php echo $la['intval']; ?></td>
                  <td><?php echo $la['rvcd']; ?></td>
                  <td><?php echo $la['camp_sg']; ?></td>
                  <input type="hidden" id="status<?php echo $i; ?>" value="<?php echo $la['status']; ?>">
                  <?php
                    if($la['status'] == "" || $la['status'] == 0 )
                    {
                      echo '<td><span class="label label-default">Unassigned</span></td>';
                    }
                    else if($la['status'] == 1 || $la['status'] == 4)
                    {
                      echo '<td><span class="label label-primary">Assigned</span></td>';
                    }
                    else if($la['status'] == 2)
                    {
                      echo '<td><span class="label label-warning">Evaluating</span></td>';
                    }
                    else if($la['status'] == 3)
                    {
                      echo '<td><span class="label label-info">Evaluated</span></td>';
                    }
                    else if($la['status'] == 5)
                    {
                      echo '<td><span class="label label-warning">Verifying</span></td>';
                    }
                    else if($la['status'] == 6)
                    {
                      echo '<td><span class="label label-success">Verified</span></td>';
                    }
                  ?>
                  <!-- <td>
                    <?php
                    if($this->session->userdata('role') == 1)
                    {
                    ?>
                      <div class="form-group">
                      <?php
                        if($la['status'] == "" || $la['status'] == 0 )
                        {
                      ?>
                          <select onchange="changePIC(<?php echo $i; ?>)" id="changepic<?php echo $i; ?>" class="form-control">
                            <option value="">--Select PIC--</option>
                            <?php
                              foreach ($list_user as $lu)
                              {
                            ?>
                            <option value="<?php echo $lu['id_user']; ?>"><?php echo $lu['name']; ?> - <?php echo $lu['no_pegawai']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                      <?php
                        }
                        else if($la['status'] >= 1)
                        {
                      ?>
                          <input type="hidden" id="changepic<?php echo $i; ?>" value="<?php echo $la['id_user']; ?>">
                          <select class="form-control" disabled>
                            <?php
                              foreach ($list_user as $lu)
                              {
                            ?>
                            <option <?php if($lu['id_user'] == $la['id_user']){echo 'selected';}?>><?php echo $lu['name']; ?> - <?php echo $lu['no_pegawai']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                          <button onclick="reassign(<?php echo $i; ?>)">Re-assign</button>  
                      <?php
                        }
                      ?>
                      </div>
                    <?php
                    }
                    else if($this->session->userdata('role') == 2)
                    {
                    ?>
                      <div class="form-group">
                      <?php
                        if($la['status'] == 2 && $la['checked'] < 3 )
                        {
                      ?>
                          <select onchange="changePIC(<?php echo $i; ?>)" id="changepic<?php echo $i; ?>" class="form-control">
                            <option value="">--Select PIC--</option>
                            <?php
                              foreach ($list_user as $lu)
                              {
                            ?>
                            <option value="<?php echo $lu['id_user']; ?>"><?php echo $lu['name']; ?> - <?php echo $lu['no_pegawai']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                      <?php
                        }
                        else if($la['status'] >= 1)
                        {
                      ?>
                          <input type="hidden" id="changepic<?php echo $i; ?>" >
                          <select class="form-control" disabled>
                          <option><?php echo $la['name']; ?> - <?php echo $la['no_pegawai']; ?></option>
                          </select>
                          <?php
                            if($la['status'] == 2)
                            {
                          ?>
                              <button onclick="reassign(<?php echo $i; ?>)">Re-assign</button>
                          <?php
                            }
                          ?>
                      <?php
                        }
                      ?>
                      </div>
                    <?php
                    }
                    ?>
                  </td> -->
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
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">

      var save_method; //for save method string
      var table;

      $(document).ready(function() {
          //datatables
          table = $('#example1').DataTable({ 
              "paging"      : true,
              "lengthChange": true,
              "searching"   : true,
              "ordering"    : true,
              "info"        : true,
              "autoWidth"   : true,
              "processing"  : true, //Feature control the processing indicator.
              "serverSide"  : true, //Feature control DataTables' server-side processing mode.
              "order": [], //Initial no order.
              // Load data for the table's content from an Ajax source
              "ajax": {
                  "url": '<?php echo site_url('assignment/json'); ?>',
                  "type": "POST"
              },
              //Set column definition initialisation properties.
              "columns": [
                            {"data": "no", defaultContent: '' ,
                            "searchable": false},
                            {"data": "ms_num"},
                            {"data": "ac_type"},
                            {"data": "descr",
                             "searchable": false},
                            {"data": "task_code"},
                            {"data": "intval",
                             "searchable": false},
                            {"data": "rvcd"},
                            {"data": "camp_sg",
                             "searchable": false},
                            {"data": "status",
                             "searchable": false}
              ]
          });
          table.on( 'draw.dt', function () {
          var PageInfo = $('#example1').DataTable().page.info();
               table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                  cell.innerHTML = i + 1 + PageInfo.start;
              } );
          } );
      });
  </script> -->
  <!-- <script>
  function changePIC($i)
  {
    var user_id = document.getElementById("changepic"+$i).value;
    var ms_num = document.getElementById("msnum"+$i).value;
    var ac_type = document.getElementById("actype"+$i).value;
    var status = document.getElementById("status"+$i).value;
    var temp = document.getElementById("changepic"+$i).index + 1;
    if(user_id != "")
    {
      swal({
        title: "Are you sure you want to change the PIC?",
        icon: "warning",
        buttons: true,
      })
        .then((isChange) => {
        if (isChange){
          $.ajax({
            url: '<?php echo base_url("index.php/assignment/assignment"); ?>',
            type: 'POST',
            data: { user_id: user_id, ms_num: ms_num, ac_type: ac_type, status: status},
            success: function(data){
              swal("The PIC has been changed!", {
                icon: "success",
              }); 
              location.reload();
            }
          });
        }
        else
        {
          document.getElementById("changepic"+$i).selectedIndex = temp;
        }
      });
    }
  }

  function reassign($i)
  {
    var user_id = document.getElementById("changepic"+$i).value;
    var ms_num = document.getElementById("msnum"+$i).value;
    var ac_type = document.getElementById("actype"+$i).value;
    var status = 0;
    if(user_id != "")
    {
      swal({
        title: "Are you sure you want to re-assign the task?",
        icon: "warning",
        buttons: true,
      })
        .then((isChange) => {
        if (isChange){
          $.ajax({
            url: '<?php echo base_url("index.php/assignment/assignment"); ?>',
            type: 'POST',
            data: { user_id: user_id, ms_num: ms_num, ac_type: ac_type, status: status},
            success: function(data){
              swal("The task has been reassigned!", {
                icon: "success",
              }); 
              location.reload();
            }
          });
        }
      });
    }
  }
  </script> -->