<div class="row" style="margin-top:-90px">
	<div class="col-lg-12">
<?php $num=1;foreach($leaveacc as $row): ?>
	<?php if ($num == 1 OR $num%4 == 1){ ?>
		<h4 class="page-header">Leave account</h4>
	</div>
</div>

<div class="col-lg-12" style="margin-top:-20px;margin-bottom:-20px">
	<div style="display:inline-block; width:80%; float:left;">
		<h6>Year Selected : <?= $fyear ?> <br /> Data Selected : <?= $check?> <br /> Department : <?=$dept_L?></h6>
	</div>
	<div style="display:inline-block; float:left;"><h6> E - Eligible<br /> C - Carry<br />T - Taken<br />B - Balance</h6></div>
</div>


<div class="row" >
	<div class="col-lg-12" >
		<div class="panel-body">
			<div class="table-responsive">
				<div id="subscribers_list">
					<table class="table" style="font-size:10px;">
						<tbody>
	<?php } ?>
							<tr class="warning">
								<td style="width:10px;"><?=$num?></td>
								<td><?=isset($row->v_UserName) ? $row->v_UserName : '' ?></td>
							</tr>
							<tr class="warning">
								<td colspan="2">
									<table cellpadding="5" cellspacing="5" border="1" style="text-align:center; width:100%">
										<?php //echo "<pre>";var_export($leave_type[0]->entitle_days);//die;?>
										<tr class="warning tblfont">
											<th>Annual</th>
											<th>Sick</th>
											<th>Emergency</th>
											<th>Unpaid</th>
											<th>Extended Sick</th>
											<th>Family Sick</th>
											<th>Maternity</th>
											<th>Paternity</th>
											<th>Marriage</th>
											<th>Unrecorded</th>
											<th>Study</th>
											<th>Transfer</th>
											<th>Hajj</th>
										</tr>
										<tr>
											<td>E - <?=isset($row->annual_leave) ? $row->annual_leave : 0 ?></td>
											<td>E - <?=isset($row->sick_leave) ? $row->sick_leave : 0 ?></td>
											<td>E - <?=isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0?></td>
											<td>T - <?=$row->UPLbalance?></td>
											<td>T - <?=$row->EXLbalance?></td>
											<td>E - <?=isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0?></td>
											<td>E - <?=isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0?></td>
										</tr>
										<tr>
											<td>C - <?=isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0 ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>T - <?=$row->ALtaken?></td>
											<td>T - <?=$row->SLtaken?></td>
											<td>T - <?=$row->ELtaken?></td>
											<td></td>
											<td></td>
											<td>T - <?=$row->FStaken + $row->FSEtaken?></td>
											<td>T - <?=$row->MLtaken + $row->MLEtaken?></td>
											<td>T - <?=$row->PLtaken + $row->PLEtaken?></td>
											<td>T - <?=$row->MRLtaken + $row->MRLEtaken?></td>
											<td>T - <?=$row->ULtaken + $row->ULEtaken?></td>
											<td>T - <?=$row->STLtaken + $row->STLEtaken?></td>
											<td>T - <?=$row->TLtaken + $row->TLEtaken?></td>
											<td>T - <?=$row->HLtaken + $row->HLEtaken?></td>
										</tr>
										<tr>
											<td>B - <?=$row->ALbalance?></td>
											<td>B - <?=$row->SLbalance?></td>
											<td>B - <?=$row->ELbalance?></td>
											<td></td>
											<td></td>
											<td>B - <?=$row->FSbalance?></td>
											<td>B - <?=$row->MLbalance?></td>
											<td>B - <?=$row->PLbalance?></td>
											<td>B - <?=$row->MRLbalance?></td>
											<td>B - <?=$row->ULbalance?></td>
											<td>B - <?=$row->STLbalance?></td>
											<td>B - <?=$row->TLbalance?></td>
											<td>B - <?=$row->HLbalance?></td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
	<?php if ($num % 4 == 0) { ?>
					</table>
				</div>
			</div>
		</div>
	
		<div class="StartNewPage" id="breakpage"><span id="pagebreak"></span></div>
	<?php } ?>
	<?php $num++ ?>
<?php endforeach; ?>
	</div>
</div>
