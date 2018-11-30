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
                <th>Type</th>
                <th>Resp</th>
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
              ?>
                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $la['ac_type']; ?></td>
                    <td><?php echo $la['resp']; ?></td>
                    <td><a href="<?php echo base_url('index.php/assignment/detail_assignment/'.$la['ac_type'].'/'.$la['resp']); ?>"><button>Detail</button></a>
                    <?php
                    if($this->session->userdata('role') == 1)
                    {
                      if($la['count_data'] == $la['unassigned'])
                      {
                    ?>
                        <!-- <a href="<?php echo base_url('index.php/assignment/assignment_eval/'.$la['ac_type'].'/'.$la['resp'])?>"><button>Assign</button></a> -->
                        <button onclick="assign_eval(`<?php echo $la['ac_type']; ?>`, `<?php echo $la['resp']; ?>`)">Assign</button>
                    <?php
                      }
                      else if ($la['count_data'] == $la['finished'])
                      {
                    ?>
                        <!-- <a href="<?php echo base_url('index.php/assignment/assignment_eval/'.$la['ac_type'].'/'.$la['resp'])?>"><button>Re-Assign</button></a> -->
                        <button onclick="assign_eval(`<?php echo $la['ac_type']; ?>`, `<?php echo $la['resp']; ?>`)">Re-Assign</button>
                    <?php
                      }
                      else
                      {
                        echo '<button disabled>ASSIGNED</button>';
                      }
                    }
                    else if($this->session->userdata('role') == 2)
                    {
                      if(!is_null($la['progressed']))
                      {
                    ?>
                        <button disabled>Assigned</button>
                    <?php
                      }
                      else if($la['count_data'] == $la['evaluated'])
                      {
                    ?>
                        <!-- <a href="<?php echo base_url('index.php/assignment/assignment_verif/'.$la['ac_type'].'/'.$la['resp'])?>"><button>Assign</button></a> -->
                        <button onclick="assign_verif(`<?php echo $la['ac_type']; ?>`, `<?php echo $la['resp']; ?>`)">Assign</button>
                    <?php
                      }
                    }
                    ?>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    
    <script>
    // function changePIC($i)
    // {
    //   var user_id = document.getElementById("changepic"+$i).value;
    //   var ms_num = document.getElementById("msnum"+$i).value;
    //   var ac_type = document.getElementById("actype"+$i).value;
    //   var status = document.getElementById("status"+$i).value;
    //   var temp = document.getElementById("changepic"+$i).index + 1;
    //   if(user_id != "")
    //   {
    //     swal({
    //       title: "Are you sure you want to change the PIC?",
    //       icon: "warning",
    //       buttons: true,
    //     })
    //       .then((isChange) => {
    //       if (isChange){
    //         $.ajax({
    //           url: '<?php echo base_url("index.php/assignment/assignment"); ?>',
    //           type: 'POST',
    //           data: { user_id: user_id, ms_num: ms_num, ac_type: ac_type, status: status},
    //           success: function(data){
    //             swal("The PIC has been changed!", {
    //               icon: "success",
    //             }); 
    //             location.reload();
    //           }
    //         });
    //       }
    //       else
    //       {
    //         document.getElementById("changepic"+$i).selectedIndex = temp;
    //       }
    //     });
    //   }
    // }

    // function assign_eval($ac_type, $resp)
    // {
    //   var ac_type = $ac_type;
    //   var resp = $resp;
    //   $.ajax({
    //             url: '<?php echo base_url("index.php/assignment/assignment_eval") ?>',
    //             type: 'POST',
    //             data: { ac_type_post: ac_type,
    //                     resp_post: resp},
    //             success: function(data){
    //               swal("Tasks has been assigned", {
    //                 icon: "success",
    //               }).then(function(){location.reload();}); 
    //             }
    //           });
    // }

    function assign_eval($ac_type, $resp)
    {
      var ac_type = $ac_type;
      var resp = $resp;
      swal({
        title: 'Assign Tasks',
        text: ac_type +' / '+ resp,
        type: 'info',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve, reject) {
            $.ajax({
                url: '<?php echo base_url("index.php/assignment/assignment_eval") ?>',
                type: 'POST',
                data: { ac_type_post: ac_type,
                        resp_post: resp},
                success: function(data){
                  swal("Tasks has been assigned", {
                    icon: "success",
                  }).then(function(){location.reload();}); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    swal({
                      title: 'Status: ' + textStatus,
                      text: 'Error: ' + errorThrown,
                      type: 'error',
                    });
                } 
              });
          });
        },
      })
    }

    function assign_verif($ac_type, $resp)
    {
      var ac_type = $ac_type;
      var resp = $resp;
      swal({
        title: 'Assign Tasks',
        text: ac_type +' / '+ resp,
        type: 'info',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve, reject) {
            $.ajax({
                url: '<?php echo base_url("index.php/assignment/assignment_verif") ?>',
                type: 'POST',
                data: { ac_type_post: ac_type,
                        resp_post: resp},
                success: function(data){
                  swal("Tasks has been assigned", {
                    icon: "success",
                  }).then(function(){location.reload();}); 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    swal({
                      title: 'Status: ' + textStatus,
                      text: 'Error: ' + errorThrown,
                      type: 'error',
                    });
                } 
              });
          });
        },
      })
    }
    </script>