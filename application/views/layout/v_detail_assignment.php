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
          <table id="assignment_detail" class="table table-bordered table-striped">
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
      // alert("Hello! I am an alert box!!");
      loadDataTable();
      
    });

    function loadDataTable(){
      $('#assignment_detail').dataTable({
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
        "ordering"      : true,
        "orderMulti"     : true,
        //"dom"               : 'Bfrtip',
        //"buttons"     : ['copy', 'csv', 'excel', 'pdf', 'print'],
        "fnRowCallback"   : function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
          // $(nRow).css('color', 'white');                
          // $('td', nRow).css('background-color', 'rgba(51, 110, 123,0.2)');
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url" : "<?php echo base_url('index.php/assignment/detail_assignment_ajax/'); ?>",
          "type"  : "POST",
          "data"  : {"ac_type" : "<?php echo $ac_type; ?>",
                     "resp" : "<?php echo $resp; ?>"}
        },
        // "language": {
        //   "processing": "<center><p><img src='<?php echo base_url('assets/img/loader.gif');?>' /> Please Wait</p></center>"
        // },
          //"processing": "Sedang loading data, harap tunggu . . ."
        //Set column definition initialisation properties.
        "columnDefs" : [
          { 
            "orderable" : false, //set not orderable
            "targets" : 0, //first column / numbering column
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