<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <i class="fa fa-plus"></i>&nbsp;Add User
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Dashboard</li>
        <li class="active">Add User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="box">
            <div class="box-header">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-add-user"><i class="fa fa-plus"></i> Add User</button>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5px">No.</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>NoPeg</th>
                    <th>Role</th>
                    <th>Unit</th>
                    <th>AC Type</th>
                    <th>Resp</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $num = 1;
                    foreach ($user as $u) 
                    {
                    ?>
                        <tr>
                            <td><?php echo $num++ ?></td>
                            <td><?php echo $u['username'] ?></td>
                            <td><?php echo $u['name'] ?></td>
                            <td><?php echo $u['no_pegawai'] ?></td>
                            <td><?php echo $u['role_word'] ?></td>
                            <td><?php echo $u['unit']; ?></td>
                            <td><?php echo $u['ac_type']; ?></td>
                            <td><?php echo $u['resp']; ?></td>
                            <td>
                            <?php 
                            if($u['role'] == $this->session->userdata('role') || $u['role'] == $this->session->userdata('role') + 2)
                            {
                            ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick="modaleditUser(<?php echo $u['id_user']; ?>)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" id="delete-user" onclick="deleteUser(<?php echo $u['id_user']; ?>)"><i class="fa fa-trash"></i></button>
                                </div>
                            <?php
                            }
                            ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="modal fade" id="modal-add-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url("index.php/crud_user/add_user"); ?>" id="add_user">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" required="required">
                                </div>
                                <div class="form-group">
                                    <label>NoPeg</label>
                                    <input type="text" class="form-control" name="no_pegawai" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" onchange="roleAdd()" id="role-add" name="role" required="required">
                                        <option value="">--Select Role--</option>
                                        <?php
                                            if($this->session->userdata('role') == 1)
                                            {
                                        ?>
                                                <option value="1">Admin GMF</option>
                                                <option value="3">User GMF</option>
                                        <?php
                                            }
                                            else if($this->session->userdata('role') == 2)
                                            {
                                        ?>
                                                <option value="2">Admin Garuda</option>
                                                <option value="4">User Garuda</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" name="unit" required="required">
                                </div>
                                <div id="actype" class="form-group">
                                    <label>A/C Type</label>
                                    <select name="ac_type" class="form-control select2" style="width: 100%;">
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
                                <div id="resp" class="form-group">
                                    <label>Resp</label>
                                    <select name="resp" class="form-control select2" style="width: 100%;">
                                      <?php
                                        foreach ($list_resp as $lr)
                                        {
                                      ?>
                                          <option value="<?php echo $lr['resp']; ?>"><?php echo $lr['resp']; ?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary pull-right"  id="add-user" value="Add">
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-edit-user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Edit User</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url("index.php/crud_user/edit_user"); ?>" id="edit_user">
                            <div class="box-body">
                                <input type="hidden" id="id_user_edit" name="id_user">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username_edit" name="username" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password_edit" name="password" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name_edit" name="name" required="required">
                                </div>
                                <div class="form-group">
                                    <label>NoPeg</label>
                                    <input type="text" class="form-control" id="no_pegawai_edit" name="no_pegawai" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" onchange="roleEdit()" id="role_edit" name="role" required="required">
                                        <option value="">--Select Role--</option>
                                        <?php
                                            if($this->session->userdata('role') == 1)
                                            {
                                        ?>
                                                <option value="1">Admin GMF</option>
                                                <option value="3">User GMF</option>
                                        <?php
                                            }
                                            else if($this->session->userdata('role') == 2)
                                            {
                                        ?>
                                                <option value="2">Admin Garuda</option>
                                                <option value="4">User Garuda</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" id="unit_edit" name="unit" required="required">
                                </div>
                                <div class="form-group" id="div_actype_edit">
                                    <label>A/C Type</label>
                                    <select id="ac_type_edit" name="ac_type" class="form-control select2" style="width: 100%;">
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
                                <div class="form-group" id="div_resp_edit">
                                    <label>Resp</label>
                                    <select id="resp_edit" name="resp" class="form-control select2" style="width: 100%;">
                                      <?php
                                        foreach ($list_resp as $lr)
                                        {
                                      ?>
                                          <option value="<?php echo $lr['resp']; ?>"><?php echo $lr['resp']; ?></option>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary pull-right" id="edit-user" value="Update">
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
</div>
<script>

function modaleditUser($id){
    var id = $id;
    $.ajax({
            url: '<?php echo base_url("index.php/crud_user/get_user_by_id"); ?>',
            type: 'POST',
            data: { id_user: id},
            dataType:"json",
            success:function(data){  
                     $('#id_user_edit').val(data.id_user); 
                     $('#username_edit').val(data.username);  
                     $('#name_edit').val(data.name);  
                     $('#no_pegawai_edit').val(data.no_pegawai);  
                     $('#role_edit').val(data.role);  
                     $('#unit_edit').val(data.unit);  
                     $('#ac_type_edit').val(data.ac_type);  
                     $('#resp_edit').val(data.resp);  
                     $('#modal-edit-user').modal('show');  
                }  
          });
}

function deleteUser($id){
    var id = $id;
    swal({
        title: "Are you sure you want to delete this user?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isChange) => {
        if (isChange)
        {
            $.ajax({
            url: '<?php echo base_url("index.php/crud_user/delete_user_by_id"); ?>',
            type: 'POST',
            data: { id_user: id},
            success:function(data){
                    swal("User has been deleted!", {
                    icon: "success",
                    }).then(function(){location.reload();});   
                }  
          });    
        } 
    });
}

function roleAdd() {
    // console.log('Test');
//   $("#role-add").change(function() {
    var val = $("#role-add").val();
    if(val === "1" || val === "2") {
        $("#actype").hide();
        $("#resp").hide();
    }
    else {
        $("#actype").show();
        $("#resp").show();
    }
  };

function roleEdit() {
    // console.log('Test');
//   $("#role-add").change(function() {
    var val = $("#role_edit").val();
    if(val === "1" || val === "2") {
        $("#div_actype_edit").hide();
        $("#div_resp_edit").hide();
    }
    else {
        $("#div_actype_edit").show();
        $("#div_resp_edit").show();
    }
  };

</script>