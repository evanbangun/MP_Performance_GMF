 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="<?=base_url()?>assets/img/user2-160x160.jpg" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $this->session->userdata('name'); ?></h3>

                <p class="text-muted text-center"><?php echo $this->session->userdata('unit'); ?></p>
                <img class="profile-user-img img-responsive" src="<?=base_url()?>assets/img/signature/<?php echo $user->signature; ?>" alt="TIDAK ADA TANDA TANGAN">
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
          <div class="box box-primary" style="height:240px">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Signature</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-9" style="margin-right:0; padding-right:0">
                  <!-- Sales Chart Canvas -->
                  <canvas id="signature-pad" class="signature-pad" style="width: 520px; height: 175px"></canvas>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div style="margin-left:0; padding-left:0" class="col-md-3">
                    <!-- <div class="btn-group-vertical"> -->
                      <button type="button" class="btn btn-block btn-default" id="clear">Clear</button>
                      <button type="button" class="btn btn-block btn-default" id="undo">Undo</button>
                      <button type="button" class="btn btn-block btn-primary" id="save-png">Save</button>
                    <!-- </div> -->
                  <!-- /.progress-group -->
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
        <div class="row">
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="#">
              <div class="box-body">
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="password" class="form-control" id="old_password">
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" id="new_password">
                </div>
                <div class="form-group">
                  <label>Re-enter Password</label>
                  <input type="password" class="form-control" id="reenter_password">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" onclick="changePassword()" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
    </section>
    <!-- /.content -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
  var canvas = document.getElementById('signature-pad');

  // Adjust canvas coordinate space taking into account pixel ratio,
  // to make it look crisp on mobile devices.
  // This also causes canvas to be cleared.
  function resizeCanvas() {
      // When zoomed out to less than 100%, for some very strange reason,
      // some browsers report devicePixelRatio as less than 1
      // and only part of the canvas is cleared then.
      var ratio =  Math.max(window.devicePixelRatio || 1, 1);
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
  }

  window.onresize = resizeCanvas;
  resizeCanvas();

  var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
  });

  document.getElementById('save-png').addEventListener('click', function () {
  if (signaturePad.isEmpty()) {
    return alert("Please provide a signature first.");
  }
  else
  {
    var dataUrl = signaturePad.toDataURL();
    var imagen = dataUrl.replace(/^data:image\/(png|jpg);base64,/, "");
    $.ajax({
                    url: '<?php echo base_url("index.php/dashboard/save_signature"); ?>',
                    type: 'POST',
                    data: {
                        imageData: imagen,
                        image_name: '<?php echo $this->session->userdata("username"); ?>'
                    },
                })
                .done(function(msg) {
                    swal("Signature Saved", {
                      icon: "success",
                    }).then(function(){location.reload();}); 
                })
                .fail(function(msg) {
                    console.log("error: " + msg);
                });
  }
});

document.getElementById('clear').addEventListener('click', function () {
  signaturePad.clear();
});

document.getElementById('undo').addEventListener('click', function () {
  var data = signaturePad.toData();
  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

function changePassword(){
  var old_password = $("#old_password").val();
  var new_password = $("#new_password").val();
  var reenter_password = $("#reenter_password").val();
  var current_password = "<?php echo $this->session->userdata('password'); ?>";
  swal({
    title: "Are you sure you want to change the password?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
       if(new_password != reenter_password)
       {
          swal("Password gagal diubah", {
                icon: "warning",
              });
       }
       else
       {
         $.ajax({
                    url: '<?php echo base_url("index.php/dashboard/change_password"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        old_password: old_password,
                        new_password: new_password,
                        reenter_password: reenter_password
                    },
                    success: function(data) {
                      if(data['success']) { 
                        swal({
                          title: data['message'],
                          icon: "success",
                        }).then(function(){location.reload();});
                      }
                      else { 
                        swal({
                          title: data['message'],
                          icon: "error",
                        });
                      }
                    }
                }); 
       }
    }
  });
}
</script>