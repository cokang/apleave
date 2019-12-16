
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Leave Balance</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<!-- /.row -->
	<div class="col-lg-6 printnone">
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="POST" action="">
					<div class="form-group"><span class="error_message" id="message_sp" style="display:none;"> </span>
						<label>Select Year</label>
						<select name="sel_year" class="form-control">
							<?php for($y=2015;$year>=$y;$year--){ ?>
							<option value='<?= $year ?>'<?php echo set_select('sel_year',$year) ?> ><?= $year ?></option>
							<?php } ?>
						</select>
					</div>
					<?php $people = array("APSB592", "APSB1150", "APSB1419", "APSB426", "APSB823", "APSB1256", "APSB1417", "APSB658"); if (($group[0]->v_GroupID == 'HR') || (in_array($group[0]->v_UserID, $people)) || $hrrow=='AA' || $hrrow=='HR'){ ?>
					<div class="form-group">
						<input type="radio" name="ch_bx" value="All"<?php echo set_radio('ch_bx', 'All'); ?><?= $check == 'All' ? 'checked' : '' ?> onchange="return check_sort(this.value)"> All
						<input type="radio" name="ch_bx" value="Own"<?php echo set_radio('ch_bx', 'Own'); ?><?= $check == 'Own' ? 'checked' : '' ?> onchange="return check_sort(this.value)"> Own
					</div>
					<?php if ($check == 'All'){ ?>
					<div class="form-group" id="sel_dept" style="display:block;">
					<?php } else { ?>
					<div class="form-group" id="sel_dept" style="display:none;">
					<?php } ?>
						<label>Select Department</label>
					<?php
					$dept[0] = 'Select';
					foreach ($dept_list as $row){
						$dept[$row->v_GroupID] = $row->v_GroupID;
					}
					?>
					<?php echo form_dropdown('dept', $dept, set_value('dept') ,  'class="form-control"');?>
						<!--<select name="sel_dept" class="form-control" >
							<option value='Department'>Department</option>
						</select>-->
					</div>
					<?php if ($check == 'All'){ ?>
					<div class="form-group" id="staff_name" style="display:block;">
					<?php } else { ?>
					<div class="form-group" id="staff_name" style="display:none;">
					<?php } ?>
						<label>Name</label>
						<input type="text" name="staff_name"  value="<?=set_value('staff_name')?>" class="form-control">
					</div>
					<?php if ($check == 'All'){ ?>
					<div class="form-group" id="staff_no" style="display:block;">
					<?php } else { ?>
					<div class="form-group" id="staff_no" style="display:none;">
					<?php } ?>
						<label>APSB No.</label>
						<input type="text" name="staff_no" value="<?=set_value('staff_no')?>" class="form-control">
					</div>
					<?php } ?>
					<label>Select Extra Columns</label>
					<div class="form-group">
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch1' value="Unpaid"<?php echo set_checkbox('excol_chk[]', 'Unpaid'); ?><?= in_array('Unpaid',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Unpaid </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch2' value="Extended_Sick"<?php echo set_checkbox('excol_chk[]', 'Extended_Sick'); ?><?= in_array('Extended_Sick',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Extended Sick </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch3' value="Family_Sick"<?php echo set_checkbox('excol_chk[]', 'Family_Sick'); ?><?= in_array('Family_Sick',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Compassionate</span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch4' value="Maternity"<?php echo set_checkbox('excol_chk[]', 'Maternity'); ?><?= in_array('Maternity',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Maternity</span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch5' value="Paternity"<?php echo set_checkbox('excol_chk[]', 'Paternity'); ?><?= in_array('Paternity',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Paternity </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch6' value="Marriage"<?php echo set_checkbox('excol_chk[]', 'Marriage'); ?><?= in_array('Marriage',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Marriage </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch7' value="Unrecorded"<?php echo set_checkbox('excol_chk[]', 'Unrecorded'); ?><?= in_array('Unrecorded',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Unrecorded </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch8' value="Exam_Leave"<?php echo set_checkbox('excol_chk[]', 'Exam_Leave'); ?><?= in_array('Exam_Leave',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Exam Leave </span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch9' value="Transfer"<?php echo set_checkbox('excol_chk[]', 'Transfer'); ?><?= in_array('Transfer',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Transfer</span>
						<span style="display:inline-block; width:120px;"><input type="checkbox" name="excol_chk[]" id='ch10' value="Hajj"<?php echo set_checkbox('excol_chk[]', 'Hajj'); ?><?= in_array('Hajj',$excol) ? 'checked' : '' ?> onchange="return testchk(this.id)"> Hajj</span>
					</div>

					<input type="submit" name="submit_year" value="Get Details" class="btn btn-default"/>
					<button onclick="autoprint('<?=$check?>','<?=$dept_L?>','<?=$staffname?>','<?=$fyear?>','<?=$apsbno?>','<?=isset($excol[0])?$excol[0]:''?>','<?=isset($excol[1])?$excol[1]:''?>')" class="btn btn-default">Print</button>
				</form>
			</div>
		</div>
	</div>
	<!-- /.row -->

	<!-- /.row -->
	<div class="row">

		<!-- /.col-lg-6 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading accleave-panel1-tabheading1 <?=date('m') == 1 ? '' : 'hidden'?>"><?='*Leave carried are estimates only until to be confirmed on the month February';?></div>
				<div class="panel-heading <?=date('m') == 1 ? 'accleave-panel2-tabheading2' : 'accleave-panel2-tabheading2-fullwidth'?>"><b> E - Eligible(Prorated)   &nbsp;&nbsp;&nbsp;&nbsp; C - Carry   &nbsp;&nbsp;&nbsp;&nbsp;T - Taken &nbsp;&nbsp;&nbsp;&nbsp;B - Balance</b></div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<div id="subscribers_list">

							<table class="table">
								<thead>
									<tr>
										<td><strong>#</strong></td>
										<td><strong>Employee Name</strong></td>
										<td>
											<table cellpadding="5" cellspacing="5" border="0" style="width:100%">
												<tr>
													<td colspan="5" align="center"><strong>Leave Type</strong></td>
												</tr>
												<tr>
													<th class="col-lg-2">Annual</th>
													<th class="col-lg-2">Sick</th>
													<th class="col-lg-2">Emergency</th>
													<?php if ($excol) { ?>
														<?php if (isset($excol[0])) { ?>
													<th class="col-lg-2"><?=isset($excol[0]) ? str_replace("_"," ",$excol[0]) : '' ?></th>
														<?php } ?>
														<?php if (isset($excol[1])) { ?>
													<th class="col-lg-2"><?=isset($excol[1]) ? str_replace("_"," ",$excol[1]) : '' ?></th>
														<?php } ?>
													<?php } ?>
												</tr>
											</table>
										</td>
									</tr>
								</thead>
								<?php $num=1;foreach($leaveacc as $row): ?>
								<?php
										if (isset($excol[0])) {
											if ($excol[0] == 'Unpaid'){
												//$eligable1 = 0;
												$taken1 = $row->UPLbalance;
												//$balance1 = 0;
											}elseif ($excol[0] == 'Extended_Sick'){
												//$eligable1 = 0;
												$taken1 = $row->EXLbalance;
												//$balance1 = 0;
											}elseif ($excol[0] == 'Family_Sick'){
												$eligable1 = isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;
												$taken1 = $row->FStaken + $row->FSEtaken;
												$balance1 = $row->FSbalance;
											}elseif ($excol[0] == 'Maternity'){
												$eligable1 = isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0;
												$taken1 = $row->MLtaken + $row->MLEtaken;
												$balance1 = $row->MLbalance;
											}elseif ($excol[0] == 'Paternity'){
												$eligable1 = isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0;
												$taken1 = $row->PLtaken + $row->PLEtaken;
												$balance1 = $row->PLbalance;
											}elseif ($excol[0] == 'Marriage'){
												$eligable1 = isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0;
												$taken1 = $row->MRLtaken + $row->MRLEtaken;
												$balance1 = $row->MRLbalance;
											}elseif ($excol[0] == 'Unrecorded'){
												$eligable1 = isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0;
												$taken1 = $row->ULtaken + $row->ULEtaken;
												$balance1 = $row->ULbalance;
											}elseif ($excol[0] == 'Exam_Leave'){
												$eligable1 = isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0;
												$taken1 = $row->STLtaken + $row->STLEtaken;
												$balance1 = $row->STLbalance;
											}elseif ($excol[0] == 'Transfer'){
												$eligable1 = isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0;
												$taken1 = $row->TLtaken + $row->TLEtaken;
												$balance1 = $row->TLbalance;
											}elseif ($excol[0] == 'Hajj'){
												$eligable1 = isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0;
												$taken1 = $HLtaken + $HLEtaken;
												$balance1 = $HLbalance;
											}
										}
										if (isset($excol[1])) {
											if ($excol[1] == 'Unpaid'){
												//$eligable2 = 0;
												$taken2 = $UPLbalance;
												//$balance2 = 0;
											}elseif ($excol[1] == 'Extended_Sick'){
												//$eligable2 = 0;
												$taken2 = $row->EXLbalance;
												//$balance2 = 0;
											}elseif ($excol[1] == 'Family_Sick'){
												$eligable2 = isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;
												$taken2 = $row->FStaken + $row->FSEtaken;
												$balance2 = $row->FSbalance;
											}elseif ($excol[1] == 'Maternity'){
												$eligable2 = isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0;
												$taken2 = $row->MLtaken + $row->MLEtaken;
												$balance2 = $row->MLbalance;
											}elseif ($excol[1] == 'Paternity'){
												$eligable2 = isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0;
												$taken2 = $row->PLtaken + $row->PLEtaken;
												$balance2 = $row->PLbalance;
											}elseif ($excol[1] == 'Marriage'){
												$eligable2 = isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0;
												$taken2 = $row->MRLtaken + $row->MRLEtaken;
												$balance2 = $row->MRLbalance;
											}elseif ($excol[1] == 'Unrecorded'){
												$eligable2 = isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0;
												$taken2 = $row->ULtaken + $row->ULEtaken;
												$balance2 = $row->ULbalance;
											}elseif ($excol[1] == 'Exam_Leave'){
												$eligable2 = isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0;
												$taken2 = $row->STLtaken + $row->STLEtaken;
												$balance2 = $row->STLbalance;
											}elseif ($excol[1] == 'Transfer'){
												$eligable2 = isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0;
												$taken2 = $row->TLtaken + $row->TLEtaken;
												$balance2 = $row->TLbalance;
											}elseif ($excol[1] == 'Hajj'){
												$eligable2 = isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0;
												$taken2 = $row->HLtaken + $row->HLEtaken;
												$balance2 = $row->HLbalance;
											}
										}

										?>
									<tbody>
										<tr class="warning">
											<td><?=($start+1)?></td>
											<td><?=isset($row->v_UserName) ? $row->v_UserName : '' ?><br><b>Entitlement - <?=isset($row->annual_leave) ? $row->annual_leave : 0 ?> </b></td>
											<td>
												<table style="width:100%" cellpadding="5" cellspacing="5" border="0">
													<tr>
														<td class="col-lg-2">E - <?=isset($row->annual_leave) ? $row->annual_leave  : 0 ?></td>
													       <b></b>
														<td class="col-lg-2">E - <?=isset($row->sick_leave) ? $row->sick_leave : 0 ?></td>
														<td class="col-lg-2">E - <?=isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0?></td>
														<?php if ($excol) { ?>
															<?php if (isset($excol[0])) { ?>
																<?php if ($excol[0] != 'Unpaid' AND $excol[0] != 'Hajj' AND $excol[0] != 'Extended_Sick') { ?>
														<td class="col-lg-2">E - <?=$eligable1?></td>
																<?php } else { ?>
																	<?php if ($excol[0] == 'Unpaid' OR $excol[0] == 'Extended_Sick') { ?>
														<td class="col-lg-2">T - <?=$taken1?></td>
																	<?php } ?>
																	<?php if ($excol[0] == 'Hajj') { ?>
																		<?php if ($hajjstat == '') { ?>
														<td class="col-lg-2">E - <?=$eligable1?></td>
																		<?php } else { ?>
														<td class="col-lg-2"><?=$hajjstat?></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
															<?php if (isset($excol[1])) { ?>
																<?php if ($excol[1] != 'Unpaid' AND $excol[1] != 'Hajj' AND $excol[1] != 'Extended_Sick') { ?>
														<td class="col-lg-2">E - <?=$eligable2?></td>
																<?php } else { ?>
																	<?php if ($excol[1] == 'Unpaid' OR $excol[1] == 'Extended_Sick') { ?>
														<td class="col-lg-2">T - <?=$taken2?></td>
																	<?php } ?>
																	<?php if ($excol[1] == 'Hajj') { ?>
																		<?php if ($row->hajjstat == '') { ?>
														<td class="col-lg-2">E - <?=$eligable2?></td>
																		<?php } else { ?>
														<td class="col-lg-2"><?=$row->hajjstat?></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													</tr>
													<tr>
														<td class="col-lg-2">C - <?=isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0 ?></td>
														<td class="col-lg-2"> </td>
														<td class="col-lg-2"></td>
														<?php if ($excol) { ?>
															<?php if (isset($excol[0])) { ?>
														<td class="col-lg-2"></td>
															<?php } ?>
															<?php if (isset($excol[1])) { ?>
														<td class="col-lg-2"></td>
															<?php } ?>
														<?php } ?>
													</tr>
													<tr>
														<td class="col-lg-2">T - <?=$row->ALtaken;?></td>
														<td class="col-lg-2">T - <?=$row->SLtaken;?></td>
														<td class="col-lg-2">T - <?=$row->ELtaken;?></td>
														<?php if ($excol) { ?>
															<?php if (isset($excol[0])) { ?>
																<?php if ($excol[0] != 'Unpaid' AND $excol[0] != 'Hajj' AND $excol[0] != 'Extended_Sick') { ?>
														<td class="col-lg-2">T - <?=$taken1?></td>
																<?php } else { ?>
																	<?php if ($excol[0] == 'Unpaid' OR $excol[0] == 'Extended_Sick') { ?>
														<td class="col-lg-2"></td>
																	<?php } ?>
																	<?php if ($excol[0] == 'Hajj') { ?>
																		<?php if ($hajjstat == '') { ?>
														<td class="col-lg-2">T - <?=$taken1?></td>
																		<?php } else { ?>
														<td class="col-lg-2"></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
															<?php if (isset($excol[1])) { ?>
																<?php if ($excol[1] != 'Unpaid' AND $excol[1] != 'Hajj' AND $excol[1] != 'Extended_Sick') { ?>
														<td class="col-lg-2">T - <?=$taken2?></td>
																<?php } else { ?>
																	<?php if ($excol[1] == 'Unpaid' OR $excol[1] == 'Extended_Sick') { ?>
														<td class="col-lg-2"></td>
																	<?php } ?>
																	<?php if ($excol[1] == 'Hajj') { ?>
																		<?php if ($row->hajjstat == '') { ?>
														<td class="col-lg-2">T - <?=$taken1?></td>
																		<?php } else { ?>
														<td class="col-lg-2"></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													</tr>
													<tr>
														<td class="col-lg-2">B - <?=$row->ALbalance?></td>
														<td class="col-lg-2">B - <?=$row->SLbalance?></td>
														<td class="col-lg-2">B - <?=$row->ELbalance?></td>
														<?php if ($excol) { ?>
															<?php if (isset($excol[0])) { ?>
																<?php if ($excol[0] != 'Unpaid' AND $excol[0] != 'Hajj' AND $excol[0] != 'Extended_Sick') { ?>
														<td class="col-lg-2">B - <?=$balance1?></td>
																<?php } else { ?>
																	<?php if ($excol[0] == 'Unpaid' OR $excol[0] == 'Extended_Sick') { ?>
														<td class="col-lg-2"></td>
																	<?php } ?>
																	<?php if ($excol[0] == 'Hajj') { ?>
																		<?php if ($hajjstat == '') { ?>
														<td class="col-lg-2">B - <?=$balance1?></td>
																		<?php } else { ?>
														<td class="col-lg-2"></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
															<?php if (isset($excol[1])) { ?>
																<?php if ($excol[1] != 'Unpaid' AND $excol[1] != 'Hajj' AND $excol[1] != 'Extended_Sick') { ?>
														<td class="col-lg-2">B - <?=$balance2?></td>
																<?php } else { ?>
																	<?php if ($excol[1] == 'Unpaid' OR $excol[1] == 'Extended_Sick') { ?>
														<td class="col-lg-2"></td>
																	<?php } ?>
																	<?php if ($excol[1] == 'Hajj') { ?>
																		<?php if ($row->hajjstat == '') { ?>
														<td class="col-lg-2">B - <?=$balance2?></td>
																		<?php } else { ?>
														<td class="col-lg-2"></td>
																		<?php } ?>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													</tr>
												</table>
											</td>
										</tr>
										<?php $start++ ?>
									</tbody>
									<?php endforeach; ?>
								</table>
								<?php echo form_hidden('excol',($excol)?$excol:$excolt) ?>
								<div class="printnone">
									<ul class="pagination">
										<?php if ($rec[0]->jumlah > $limit){ ?>
											<?php for ($i=1;$i<=$page;$i++){ ?>
										<li class="paginate_button">&nbsp;<a href="?p=<?php echo $i?>&ch_bx=<?php echo $check?>&sel_year=<?php echo $fyear?>&dept=<?php echo $dept_L?>&staff_name=<?php echo $staffname?>&staff_no=<?php echo $apsbno?>&excol1=<?=isset($excol[0]) ? $excol[0] : '' ?>&excol2=<?=isset($excol[1]) ? $excol[1] : '' ?>"><?=$i?></a></li>
											<?php } ?>
										<li class="paginate_button previous"><a href="?p=<?php echo $page?>&ch_bx=<?php echo $check?>&sel_year=<?php echo $fyear?>&dept=<?php echo $dept_L?>&staff_name=<?php echo $staffname?>&staff_no=<?php echo $apsbno?>&excol1=<?=isset($excol[0]) ? $excol[0] : '' ?>&excol2=<?=isset($excol[1]) ? $excol[1] : '' ?>">Next</a></li>
										<?php } ?>
										<!--(isset($excolt[0]) ? $excolt[0] : '')
										(isset($excolt[1]) ? $excolt[1] : '')
										(isset($excolt[0]) ? $excolt[0] : '')
										(isset($excolt[1]) ? $excolt[1] : '')-->
									</ul>
								</div>
							</div>
							<!-- /.table-responsive -->
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-6 -->

			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

<style type="text/css">

	@media (min-width: 1024px){
		.accleave-panel2-tabheading2{
			width:50%;
			text-align:right;
			display:inline-block;
			float:right;
			line-height: 15px;
			height:45px;
			font-size: 13px;
			}

		.accleave-panel2-tabheading2-fullwidth{
			width:100%;
			text-align:right;
			display:inline-block;
			float:right;
			line-height: 15px;
			height:45px;
			font-size: 13px;
		}

		.accleave-panel1-tabheading1{
			text-align:left;
			display:inline-block;
			color:red;
			font-size:12px;
			height:45px;
			line-height: 15px;
			width:50%;
		}
	}

	@media (min-width:375px) and (max-width: 1023px){
		.accleave-panel2-tabheading2{
			width: 100%;
			text-align:right;
			display:inline-block;
			float:right;
			height:42px;
			font-size: 13px;
		}

		.accleave-panel1-tabheading1{
			text-align:left;
			display:inline-block;
			color:red;
			font-size:12px;
			height:42px;
			width:100%;
		}
	}



</style>
