<!-- <style>
	#div_rec_thresint {

	display:none;

	}
</style> -->
<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				MP Item Performance Data
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="">Dashboard</li>
				<li>Search MP Task</li>
				<li class="active">MP Item Performance Data</li>
			</ol>
		</section>
		<?php 
			$num = 1;
			//foreach($list_task as $row): 
		?>
		<!-- Main content -->
		<section class="content">
			<!-- <textarea><?php var_dump($list_task) ?></textarea> -->
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-md-12">
					<!-- Custom Tabs -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">MP Performance</a></li>
							<li><a href="#tab_2" data-toggle="tab">Findings</a></li>
							<li><a href="#tab_3" data-toggle="tab">History Log</a></li>
							<?php
							if(isset($task_process_detail->status) && $task_process_detail->status == 6)
							{
							?>
								<a style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.5em;" target="_blank" href="<?php echo base_url('index.php/report/report_pdf_performance/'.$list_task->ms_num.'/'.$list_task->ac_type); ?>" type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</a>
							<?php
							}
							?>
							<a href="" style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.7em;" type="button" class="btn btn-default pull-right">Change Responsible</a>
							<!-- <a style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em; margin-left: 0.5em; " href="" type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modal-edit-resp"><i class="fa fa-edit"></i> Edit Resp</a> -->
							<h3 style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.5em;" class="box-title"><?php
			                    if(!isset($task_process_detail->status) || $task_process_detail->status == 0 )
			                    {
			                      echo '<span class="label label-default pull-right">Unassigned</span>';
			                    }
			                    else if($task_process_detail->status == 1 || $task_process_detail->status == 4 )
			                    {
			                      echo '<span class="label label-primary pull-right">Assigned</span>';
			                    }
			                    else if($task_process_detail->status == 2)
			                    {
			                      echo '<span class="label label-warning pull-right">Evaluating</span>';
			                    }
			                    else if($task_process_detail->status == 3)
			                    {
			                      echo '<span class="label label-info pull-right">Evaluated</span>';
			                    }
			                    else if($task_process_detail->status == 5)
			                    {
			                      echo '<span class="label label-warning pull-right">Verifying</span>';
			                    }
			                    else if($task_process_detail->status == 6)
			                    {
			                      echo '<span class="label label-success pull-right">Verified</span>';
			                    }
			                  ?></h3>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<div class="box-body no-padding">
									<table class="table table-condensed">
										<tr>
											<th style="width:150px">MP Item Number: </th>
											<th style="width:500px"><?php echo $list_task->ms_num ?></th>
											<th style="width:100px">Task Code: </th>
											<th><?php echo $list_task->task_code ?></th>
											<th style="width:70px">Resp: </th>
											<th><?php echo $list_task->resp ?><a href="" style="margin-top:0.5em; margin-right:0.5em; margin-bottom: 0.5em;  margin-left:0.5em;"><i class="fa fa-pencil"></i></a></th>
										</tr>
										<tr>
											<td><b>MP Item Descr.: </b></td>
											<td><?php echo $list_task->task_title ?><br>
												<?php echo $list_task->descr ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Interval: </b></td>
											<td><?php echo $list_task->intval ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Sign Code: </b></td>
											<td><?php echo $list_task->camp_sg ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>References: </b></td>
											<td><?php echo $list_task->ref ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Eff Date: </b></td>
											<td><?php echo $list_task->effdate ?></td>
											<td><b>Category: </b></td>
											<td><?php echo $list_task->cat ?></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Zone: </b></td>
											<td><?php echo $list_task->zone ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Access: </b></td>
											<td><?php echo $list_task->access ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><b>Effectivity: </b></td>
											<td><?php echo $list_task->ac_eff ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</table>
									<hr>
									<!-- Scheduled Data -->
									<div class="row">
										<div class="col-md-12">
											<b>SCHEDULED ACCOMPLISHMENT DATA:</b>
										</div>
									</div>
									<div class="row">
										<div style="margin-left:0.5em" class="col-md-3"><b>No. Accomplishment: </b>
											<span class="label label-default"><?php echo $count_acc->count_acc ?></span>
										</div>
										<div class="col-md-3"><b>No. Finding: </b>
											<span class="label label-default"><?php echo $count_finding ?></span>
										</div>
										<div class="col-md-3"><b>No. Rejected Finding: </b>
											<span class="label label-default"><?php echo $rejected_finding->num_rejected ?></span>
										</div>
										<div class="col-md-2"><b>Finding Ratio: </b>
										<span class="label label-default">
										<?php
										if($count_acc->count_acc > 0)
										{
											echo round((($count_finding - $rejected_finding->num_rejected)/$count_acc->count_acc), 3);
										}
										else
										{
											echo 0;
										}
										?>
										</span>
										</div>
									</div>
									<hr>
									<!-- Unscheduled Data -->
									<div class="row">
										<div class="col-md-12">
											<b> UNSCHEDULED ACCOMPLISHMENT DATA: </b>
										</div>
									</div>
									<div class="row">
										<div style="margin-left:0.5em" class="col-md-4"><b>1. Any SRI related? </b></div>
										<?php if (count($table_sri) > 0)
										{
										?>
											<div class='col-md-1'>
												<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly checked disabled>
											</div>
											<div class='col-md-1'>
												<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
											</div>
											<table style='width:1255px; margin-left:2.5em;' class='table table-bordered'>
												<thead>
													<tr>
														<th>Sri No.</th>
														<th>Title</th>
														<th>Description</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach ($table_sri as $ts) 
												{
												?>
												<tr>
													<td><?php echo $ts['sri_no']; ?></td>
													<td><?php echo $ts['sri_title']; ?></td>
													<td><?php echo $ts['sri_desc']; ?></td>
												</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										<?php
										}
										else{
											echo "<div class='col-md-1'>
											<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
										</div>
										<div class='col-md-1'>
											<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled checked>
										</div>";
										}
										?>
									</div>
									<div class="row">
										<div style="margin-left:0.5em" class="col-md-4"><b>2. Any related delay to AOG, Accident, RTA, RTG?</b></div>
										<?php if (count($table_delay) > 0)
										{
										?>
											<div class='col-md-1'>
												<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly checked disabled>
											</div>
											<div class='col-md-1'>
												<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
											</div>
											<table style='width:1255px; margin-left:2.5em;' class='table table-bordered'>
												<thead>
													<tr>
														<th>ACReg</th>
														<th>Key Problem</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach ($table_delay as $td) 
												{
												?>
												<tr>
													<td><?php echo $td['ac_reg']; ?></td>
													<td><?php echo $td['key_problem']; ?></td>
												</tr>
												<?php
												}
												?>
												</tbody>
											</table>
										<?php
										}
										else{
											echo "<div class='col-md-1'>
											<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
										</div>
										<div class='col-md-1'>
											<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled checked>
										</div>";
										}
										?>
									</div>
									<div class="row">
										<div style="margin-left:0.5em" class="col-md-4"><b>3. Any unscheduled component removal? </b></div>
										<?php if (count($table_removal) > 0)
										{
										?>
											<div class='col-md-1'>
												<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly checked disabled>
											</div>
											<div class='col-md-1'>
												<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
											</div>
											<div class='box-body no-padding'>
												<table style='width:1255px; margin-left:2.5em;' class='table table-bordered'>
													<thead>
														<tr>
															<th>PARTNO</th>
															<th>PARTNAME</th>
															<th>ALERT LEVEL</th>
															<th>L12MRATE</th>
															<th>L6MRATE</th>
															<th>ALERT STATUS</th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($table_removal as $tr) 
														{
														?>
														<tr>
															<td><?php echo $tr['PartNo']; ?></td>
															<td><?php echo $tr['PartName']; ?></td>
															<td><?php echo $tr['AlertLevel']; ?></td>
															<td><?php echo $tr['L12MRate']; ?></td>
															<td><?php echo $tr['L6MRate']; ?></td>
															<td><?php echo $tr['L12MAlertStatus'].' '.$tr['L6MAlertStatus'] ; ?></td>
														</tr>
														<?php
														}
														?>
													</tbody>
												</table>
											</div>
										<?php
										}
										else{
											echo "<div class='col-md-1'>
											<b>Yes </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled>
										</div>
										<div class='col-md-1'>
											<b>No </b>&nbsp;<input type='checkbox' class='minimal' readonly disabled checked>
										</div>";
										}
										?>
									</div>
									<hr>
									<!-- Recommendation -->
									<form method="POST" action="<?php echo base_url("index.php/user/insert_eval"); ?>" id="eval_form">
									<input type="hidden" name="ms_num" value="<?php echo $list_task->ms_num; ?>">
									<input type="hidden" name="ac_type" value="<?php echo $list_task->ac_type; ?>">
									<input type="hidden" name="resp" value="<?php echo $list_task->resp; ?>">
									<?php
										if(isset($task_process_detail))
										{
									?>
											<input type="hidden" name="status" value="<?php echo $task_process_detail->status; ?>">		
									<?php
										}
									?>
									<div class="row">
										<div class="col-md-2"><b>Recommendation:</b></div>
										<div class="col-md-2">Remain <input onchange="rec_change()" type="radio" name="rec" value="1" 
										<?php
										if(isset($task_evaluation))
										{
											if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] == 1)
											{
												echo " checked";
											}
										}
										if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3)
										{
											echo " disabled";
										}
										?>
										></div>
										<div class="col-md-2">Extend <input onclick="rec_change()" type="radio" name="rec" value="2" 
										<?php
										if(isset($task_evaluation) && isset($task_process_detail))
										{
											if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] == 2)
											{
												echo " checked";
											}
										}
										if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3)
										{
											echo " disabled";
										}
										?>></div>
										<div class="col-md-2">Descalation <input onclick="rec_change()" type="radio" name="rec" value="3" 
										<?php
										if(isset($task_evaluation) && isset($task_process_detail))
										{
											if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] == 3)
											{
												echo " checked";
											}
										}
										if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3)
										{
											echo " disabled";
										}
										?>></div>
										<div class="col-md-2">Add Task <input onchange="rec_change()" type="radio" name="rec" value="4" 
										<?php
										if(isset($task_evaluation) && isset($task_process_detail))
										{
											if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] == 4)
											{
												echo " checked";
											}
										}
										if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3)
										{
											echo " disabled";
										}
										?>></div>
										<div class="col-md-2">Remove Task <input onchange="rec_change()" type="radio" name="rec" value="5" 
										<?php
										if(isset($task_evaluation) && isset($task_process_detail))
										{
											if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] == 5)
											{
												echo " checked";
											}
										}
										if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3)
										{
											echo " disabled";
										}
										?>></div>
									</div>
									<br>
									<div style="<?php 
									if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] != NULL && ($task_evaluation[0]['recommendation'] == 2 || $task_evaluation[0]['recommendation'] == 3))
									{
										echo "display:blocked";
									}
									else
									{
										echo "display:none";
									}
										?>" class="row" id="div_rec_thresint">
										<div class="col-md-1"><b>Recommended Threshold:</b></div>
										<div class="col-md-1">
										<?php
											if($task_evaluation != NULL && $task_evaluation[0]['rec_threshold'] != NULL)
											{
										?>
												<input name="rec_threshold" class="form-control" type="text" value="<?php echo $task_evaluation[0]['rec_threshold']; ?>" <?php if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3){ echo " disabled"; } ?>>
										<?php
											}
											else
											{
										?>
												<input name="rec_threshold" class="form-control" type="text">
										<?php
											}
										?>
										</div>
										<div class="col-md-1"><b>Recommended Interval:</b></div>
										<div class="col-md-1">
											<?php
												if($task_evaluation != NULL && $task_evaluation[0]['rec_interval'] != NULL)
												{
											?>
													<input name="rec_interval" class="form-control" type="text" value="<?php echo $task_evaluation[0]['rec_interval'];?>" <?php if(!isset($task_process_detail) || $task_process_detail->status != 2 || $this->session->userdata('role') != 3){ echo " disabled"; } ?>>
											<?php
												}
												else
												{
											?>
													<input name="rec_interval" class="form-control" type="text">
											<?php
												}
											?>
										</div>
									</div>
									</form>
									<hr>
									<div class="row">
										<div class="col-md-12"><b>Reason: </b>
											<?php
												if($this->session->userdata('role') == 3 && isset($task_process_detail) && $task_process_detail->status == 2)
												{
													?>
													<a href="" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-reason">Edit</a>
													<?php
												}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<p>
												<?php 
													if($task_evaluation != NULL)
													{
														echo $task_evaluation[0]['reason'];
													}
												?>
											</p>
										</div>
									</div>

									<!-- <div class="row">
										<div class="col-md-12">
											<br>
											<a href="" type="button" class="btn btn-success pull-right"><i class="fa fa-pencil"></i> Digital Sign</a>
										</div>
									</div> -->
									<hr>
									<div class="row">
										<div class="col-md-12"><b>Remarks: </b>
											<?php
												if($this->session->userdata('role') == 4 && isset($task_process_detail) && $task_process_detail->status == 5 )
												{
													?>
													<a href="" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-remarks">Edit</a>
													<?php
												}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<p>
												<?php 
													if($task_remarks != NULL)
													{
														echo $task_remarks[0]['remarks'];
													}
												?>
											</p>
										</div>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2">
								<table id="example1" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th>No.</th>
									<th>Reg</th>
									<th>Type</th>
									<th>Acc</th>
									<th style="width: 500px">Finding & Rectification</th>
									<th>Remarks</th>
									<th style="width:100px">Action</th> 
								</tr>
								</thead>
								<tbody>
								<?php 
				                  $num = 1;
				                  foreach($finding as $row): 
				                ?>
								<tr>
									<td><?php echo $num++ ?></td>
									<td><?php echo $row->ac_reg ?></td>
									<td><?php echo $row->maint_type ?></td>
									<td><?php echo $row->date_acc ?></td>
									<td><?php echo $row->finding ?><br><?php echo $row->operation ?></td>
									<td><?php echo $row->remark_finding ?></td>
									<td>
										<input type="hidden" id="finding<?php echo $num; ?>" value="<?php echo $row->id_ms_performance_all; ?>">
										<?php
											if($row->rejected)
											{
										?>
											Rejected
										<?php
											}
											else
											{
												if($this->session->userdata('role') == 3)
												{
										?>

											<button id='rejectfinding' onclick="rejectFinding(<?php echo $num; ?>)" type="button" data-toggle="tooltip" title="Reject" class="btn btn-danger"><i class="fa fa-close"></i></button>
											<!-- <div class="btn-group">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-finding"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-danger"><i class="fa fa-close"></i></button>
											</div> -->
										<?php
												}
											}
										?>
									</td>
								</tr>
								<?php endforeach ?>
								</tbody>
							</table>
							</div>
							<!-- /.tab-pane -->
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_3">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th width="10">No.</th>
										<th>Recommendation</th>
										<th>Reason</th>
										<th>Remarks</th>
										<th>Date</th>
										<th>GMF PIC</th> 
										<th>GA PIC</th> 
									</tr>
									</thead>
									<tbody>
									<?php
									for ($i=0; $i < count($history_log_remarks); $i++)
									{
									?>
										<tr>
											<td><?php echo $i + 1; ?></td>
											<td><?php echo $history_log_reason[$i]['recommendation']; ?></td>
											<td><?php echo $history_log_reason[$i]['reason']; ?></td>
											<td><?php echo $history_log_remarks[$i]['remarks']; ?></td>
											<td><?php echo $history_log_remarks[$i]['create_date']; ?></td>
											<td><?php echo $history_log_reason[$i]['name_gmf']; ?></td>
											<td><?php echo $history_log_remarks[$i]['name_ga']; ?></td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.tab-content -->
					</div>
					<!-- nav-tabs-custom -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	<?php //endforeach ?>

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
							<textarea class="form-control" rows="5" name="reason" form="eval_form"></textarea>
						</div> 
						<table class="table table-bordered table-striped">
							<thead>
							<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Reason</th>
							<th>Date</th>
							</tr>
							</thead>
                			<tbody>
							<?php
								$i = 0;
								foreach ($task_evaluation as $te)
								{
							?>
									<tr>
									<td><?php echo ++$i; ?></td>
									<td><?php echo $te['name']; ?></td>
									<td><?php echo $te['reason']; ?></td>
									<td><?php echo $te['create_date']; ?></td>
									</tr>
							<?php
								}
							?>
							</tbody>
              			</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" form="eval_form" class="btn btn-success pull-right"><i class="fa fa-pencil"></i> Digital Sign</button>
						<!-- <button type="button" class="btn btn-primary">Save</button> -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Modal Edit Remarks -->
		<div class="modal fade" id="modal-edit-remarks">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button> -->
						<h4 class="modal-title">Edit Remarks</h4>
					</div>
					<div class="modal-body">
						 <div class="form-group">
							<label for="comment">Remarks:</label>
							<textarea class="form-control" rows="5" name="remarks" form="rem_form"></textarea>
						</div> 
						<table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Reason</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
            	<?php
            		$i = 0;
            		foreach ($task_remarks as $tr)
            		{
            	?>
		                <tr>
		                  <td><?php echo ++$i; ?></td>
		                  <td><?php echo $tr['name']; ?></td>
		                  <td><?php echo $tr['remarks']; ?></td>
		                  <td><?php echo $tr['create_date']; ?></td>
		                </tr>
                <?php
                	}
                ?>
                </tbody>
              </table>
					</div>
					<div class="modal-footer">
						<form method="POST" action="<?php echo base_url("index.php/user/insert_rem"); ?>" id="rem_form">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<input type="hidden" name="ms_num" value="<?php echo $list_task->ms_num; ?>">
							<input type="hidden" name="ac_type" value="<?php echo $list_task->ac_type; ?>">
							<input type="hidden" name="resp" value="<?php echo $list_task->resp; ?>">
							<input type="hidden" name="status" value="<?php echo $task_process_detail->status; ?>">
							<input type="submit" name="submit_rem" value="Deny" class="btn btn-danger">
							<input type="submit" name="submit_rem" value="Verify" class="btn btn-primary">
						</form>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Modal Edit Resp -->
		<div class="modal fade" id="modal-edit-resp">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button> -->
						<h4 class="modal-title">Edit Responsible</h4>
					</div>
					<div class="modal-body">
						 <div class="form-group">
							<label for="comment">Responsible:</label>
							<input class="form-control" id="comment"></input>
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
						<button type="button" class="btn btn-danger">Deny</button>
						<button type="button" class="btn btn-success">Verify</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	</div>

	<script type="text/javascript">
		function rec_change()
		{
			swal({
			      title: "Change the recommendation ?",
			      icon: "warning",
			      buttons: true,
			    })
			    .then((isChange) => {
			      if (!isChange)
			      {  
			      	<?php
			      		if($task_evaluation != NULL && $task_evaluation[0]['recommendation'] != NULL)
			      		{
			      	?>
			      			var index = "<?php echo $task_evaluation[0]['recommendation'] - 1; ?>";
			      			$(":radio[name='rec']")[index].checked = true;
			      	<?php
			      		}
			      		else
			      		{
					?>
							var radioIdx = $(":radio[name='rec']").index($(":radio[name='rec']:checked")); 
							$(":radio[name='rec']")[radioIdx].checked = false;
	      			<?php
			      		}
			      	?>	
			      }
		      	  var radioButtons = $("#eval_form input:radio[name='rec']");
			 	  var selectedIndex = radioButtons.index(radioButtons.filter(':checked'));
				  if(selectedIndex == 1 || selectedIndex == 2)
				  {
			 		  document.getElementById("div_rec_thresint").style.display = "block";
				  }
				  else
				  {
					  document.getElementById("div_rec_thresint").style.display = "none"	
				  }
		      });
		}

		function rejectFinding($i){
		    var id = document.getElementById("finding"+$i).value;
		    swal({
		      title: "Are you sure you want to reject the finding?",
		      icon: "warning",
		      buttons: true,
		      dangerMode: true,
		    })

		    .then((isChange) => {
		      if (isChange)
		      {
		          $.ajax({
		            url: '<?php echo base_url("index.php/user/reject_finding"); ?>',
		            type: 'POST',
		            data: { id_ms_performance_all: id},
		            success: function(data){
		              swal("The finding has been rejected!", {
		                icon: "success",
		              }).then(function(){location.reload();}); 
		            }
		          });
	          } 
		    });
		  }

	</script>