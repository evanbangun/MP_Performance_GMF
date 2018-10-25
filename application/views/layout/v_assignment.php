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
              <th>Description</th>
              <th>TCode</th>
              <th>IntVal</th>
              <th>RVCD</th>
              <th>Camp SG</th>
              <th>Status</th>
              <th>PIC</th>
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
                  <td><?php echo $la['descr']; ?></td>
                  <td><?php echo $la['task_code']; ?></td>
                  <td><?php echo $la['intval']; ?></td>
                  <td><?php echo $la['rvcd']; ?></td>
                  <td><?php echo $la['camp_sg']; ?></td>
                  <input type="hidden" id="status<?php echo $i; ?>" value="<?php echo $la['status']; ?>">
                  <?php
                    if($la['status'] == "" || $la['status'] == 0 )
                    {
                      echo '<td><span class="label label-default">Unassigned</span></td>';
                    }
                    else if($la['status'] == 1)
                    {
                      echo '<td><span class="label label-warning">Evaluating</span></td>';
                    }
                    else if($la['status'] == 2)
                    {
                      echo '<td><span class="label label-success">Evaluated</span></td>';
                    }
                    else if($la['status'] == 3)
                    {
                      echo '<td><span class="label label-warning">Verifying</span></td>';
                    }
                    else if($la['status'] == 4)
                    {
                      echo '<td><span class="label label-success">Verified</span></td>';
                    }
                  ?>
                  <td>
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
                        else
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
                      <?php
                        } 
                        if($this->session->userdata('role') == 1 && $la['status'] >= 1 )
                        {
                      ?>
                          <button onclick="reassign(<?php echo $i; ?>)">Re-assign</button>        
                      <?php
                        }
                      ?>
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

  <script>
  // function changeStatus(){
  //   var x = document.getElementById("changestatus").value;
  //   swal({
  //     title: "Are you sure you want to change the status?",
  //     icon: "warning",
  //     buttons: true,
  //     dangerMode: true,
  //   })
  //   .then((isChange) => {
  //     if (isChange) {
  //       swal("The status has been changed!", {
  //         icon: "success",
  //       });
  //     } 
  //   });
  // }

  function changePIC($i)
  {
    var user_id = document.getElementById("changepic"+$i).value;
    var ms_num = document.getElementById("msnum"+$i).value;
    var ac_type = document.getElementById("actype"+$i).value;
    var status = document.getElementById("status"+$i).value;
    var temp = document.getElementById("changepic"+$i).index;
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
  </script>