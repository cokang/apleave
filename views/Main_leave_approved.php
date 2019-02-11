<?php if( $this->input->get("a")=="taken_action" ){?>
<?php $action_pending = "";$taken_action="active";?>
<?php }else{ ?>
<?php $action_pending = "active";$taken_action="";?>
<?php } ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Leave Approval</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<!-- /.row -->
	<div class="row">

		<!-- /.col-lg-6 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="padding: 0px 0px 0px 0px; border-bottom: 0px solid transparent;">
					<div class="tab">
						<button class="tablinks <?=$action_pending;?>" onclick="tabs_navigation(event, 'pending')">Pending</button>
						<button class="tablinks <?=$taken_action;?>" onclick="tabs_navigation(event, 'taken_action')">Taken Action</button>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div id="pending" class="tabcontent <?=$action_pending;?>">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Leave Type</th>
										<th>From</th>
										<th>To</th>
										<th>Reason</th>
										<th>Action</th>
										<th></th>
									</tr>
								</thead>

								<?php $num=1;foreach($leaveapp as $row): ?>
									<?php if( $row->leave_status=="" ){?>
								<tbody>
									<tr class="">
										<td><?=($start+1)?></td>
										<td><a href="<?php echo base_url(); ?>index.php/leave_application?user_id=<?=$row->user_id?>&id=<?=$row->id?>"><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></a></td>
										<td><?=isset($row->leave_type) ? $row->leave_name : '' ?></td>
										<td><?=isset($row->leave_from) ? $row->leave_from : '' ?></td>
										<td><?=isset($row->leave_to) ? $row->leave_to : '' ?></td>
										<td><a href="#" onclick="return showDialog('<?= $row->id ?>','approval','<?= $limit ?>','<?= $start ?>','<?=$row->v_GroupID?>')">View Reason</a><div id="dialog" style="display:none;"><div id="myDialogText"></div></td>
										<td><?= isset($row->leave_status) ? $row->leave_status : 'Pending' ?></td>
										<td><?= $row->leave_status == 'Accepted' ? anchor ('leave_approval_ctrl?name='.$row->user_id.'&id='.$row->id.'&status=Cancelled','Cancel') : '' ?></td>
									</tr>
									<?php $start++ ?>
								</tbody>
									<?php } ?>
								<?php endforeach; ?>
							</table>
							<ul class="pagination">
								<?php if ($rec[0]->jumlah > $limit){ ?>
									<?php if ($this->input->get('p') != ''){ ?>
										<li><a href="?p=1&a=pending"> <i class="fa fa-chevron-circle-left" style="color:green"></i> First Page </a></li>
										<li><a href="?p=<?=($this->input->get('p') > 1 ? $this->input->get('p')-1 : 1)?>&a=pending">Prev</a></li>
									<?php } ?>
									<li><a href=""><?=($this->input->get('p') ? $this->input->get('p') : 1)?></a></li>
									<li class="paginate_button previous"><a href="?p=<?php echo $page?>&a=pending">Next</a></li>
									<li><a href="?p=<?php echo ceil($rec[0]->jumlah/$limit);?>&a=pending"> Last Page <i class="fa fa-chevron-circle-right" style="color:red;"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div id="taken_action" class="tabcontent <?=$taken_action;?>">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Leave Type</th>
										<th>From</th>
										<th>To</th>
										<th>Reason</th>
										<th>Action</th>
										<th></th>
									</tr>
								</thead>

								<?php $num=1;foreach($leaveapp as $row): ?>
									<?php if( $row->leave_status!="" ){?>
								<tbody>
									<tr class="">
										<td><?=($start+1)?></td>
										<td><a href="<?php echo base_url(); ?>index.php/leave_application?user_id=<?=$row->user_id?>&id=<?=$row->id?>"><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></a></td>
										<td><?=isset($row->leave_type) ? $row->leave_name : '' ?></td>
										<td><?=isset($row->leave_from) ? $row->leave_from : '' ?></td>
										<td><?=isset($row->leave_to) ? $row->leave_to : '' ?></td>
										<td><a href="#" onclick="return showDialog('<?= $row->id ?>','approval','<?= $limit ?>','<?= $start ?>','<?=$row->v_GroupID?>')">View Reason</a><div id="dialog" style="display:none;"><div id="myDialogText"></div></td>
										<td><?= isset($row->leave_status) ? $row->leave_status : 'Pending' ?></td>
										<td><?= $row->leave_status == 'Accepted' ? anchor ('leave_approval_ctrl?name='.$row->user_id.'&id='.$row->id.'&status=Cancelled','Cancel') : '' ?></td>
									</tr>
									<?php $start++ ?>
								</tbody>
									<?php } ?>
								<?php endforeach; ?>
							</table>
							<ul class="pagination">
								<?php if ($rec[0]->jumlah > $limit){ ?>
									<?php if ($this->input->get('p') != ''){ ?>
										<li><a href="?p=1&a=taken_action"> <i class="fa fa-chevron-circle-left" style="color:green"></i> First Page </a></li>
										<li><a href="?p=<?=($this->input->get('p') > 1 ? $this->input->get('p')-1 : 1)?>&a=taken_action">Prev</a></li>
									<?php } ?>
									<li><a href=""><?=($this->input->get('p') ? $this->input->get('p') : 1)?></a></li>
									<li class="paginate_button previous"><a href="?p=<?php echo $page?>&a=taken_action">Next</a></li>
									<li><a href="?p=<?php echo ceil($rec[0]->jumlah/$limit);?>&a=taken_action"> Last Page <i class="fa fa-chevron-circle-right" style="color:red;"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-7 -->

	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
