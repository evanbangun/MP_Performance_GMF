<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Add User
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
                    ?>
                    <tr>
                        <td><?php echo $num++ ?></td>
                        <td>admin_gmf</td>
                        <td>Admin GMF</td>
                        <td>ADMGMF01</td>
                        <td>1</td>
                        <td>ADMGMF</td>
                        <td>A320</td>
                        <td>STR</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-user"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger" id="delete-user" onclick="deleteUser()"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
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
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>NoPeg</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control">
                                        <option>--Select Role--</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>AC Type</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Resp</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary pull-right" onclick="addUser()" id="add-user">Add</button>
                    </div>
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
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>NoPeg</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control">
                                        <option>--Select Role--</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>AC Type</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="form-group">
                                    <label>Resp</label>
                                    <input type="text" class="form-control" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary pull-right" onclick="editUser()" id="add-user">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <!-- /.content -->
</div>
<script>

function addUser(){
    swal(
        'Success!',
        'User [Name] successfully added!',
        'success'
    )
    .then((isChange) => {
        if (isChange)
        {
         location.reload();
        } 
    });
}
 
function editUser(){
    swal(
        'Success!',
        'User [Name] successfully edited!',
        'success'
    )
    .then((isChange) => {
        if (isChange)
        {
         location.reload();
        } 
    });
}

function deleteUser(){
    swal({
        title: "Are you sure you want to delete this user?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })

    .then((isChange) => {
        if (isChange)
        {
            
        swal("User has been deleted!", {
        icon: "success",
        }).then(function(){location.reload();}); 
            
        } 
    });
}
</script>