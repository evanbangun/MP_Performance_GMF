 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile</li>
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

                <h3 class="profile-username text-center">Nama Pegawai</h3>

                <p class="text-muted text-center">TXX - Description</p>
                <img class="profile-user-img img-responsive" src="<?=base_url()?>assets/img/sign.png" alt="User profile picture">
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
          <div class="box box-primary" style="height:294px">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Signature</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-9" style="margin-right:0; padding-right:0">
                  <!-- Sales Chart Canvas -->
                  <canvas id="signature-pad" class="signature-pad" style="width: 520px; height: 220px"></canvas>
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
    </section>
    <!-- /.content -->

    <!-- Modal Edit Reason -->
    <div class="modal fade" id="modal-edit-reason">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title">Edit Reason</h4>
          </div>
          <div class="modal-body">
             <div class="form-group">
              <label for="comment">Reason:</label>
              <textarea class="form-control" rows="5" id="comment"></textarea>
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal Edit Finding -->
    <div class="modal fade" id="modal-edit-finding">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button> -->
            <h4 class="modal-title">Add/Modify Remarks</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-3"><b>REG: </b>PK-GIC</div>
              <div class="col-md-5"><b>Type: </b>C01-CHECK+A16 CHECK</div>
              <div class="col-md-4"><b>Acc: </b>08-08-2018</div>
            </div>
             <div class="form-group">
              <label for="comment">Reason:</label>
              <textarea class="form-control" rows="5" id="comment"></textarea>
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
  
  var data = signaturePad.toDataURL('image/png');
  console.log(data);
  window.open(data);
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

</script>