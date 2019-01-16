<style type="text/css">
	.table-scroll{
		width: 100%;
		/*overflow-x: scroll;*/
	}
	table#report_summary_listing, table#report_summary_listing tr, table#report_summary_listing tr th, table#report_summary_listing tr td{
		border-style: solid;
		border-width: 1px;
		text-align: center;
		border-top: 1px solid black;
		padding: 3px;
	}
	.text-center{
		text-align: center;
	}
</style>

<?php foreach( $leaveacc as $row):?>
	<?php if ($no == 1 OR $no%18 == 1){ ?>

	<div class="col-lg-12">
		<div style="display:inline-block; float:left; margin-left: 77px">
			<h6>SUMMARY DATA AS AT SEPT 2018</h6>
		</div>
	</div>
	<div class="row" >
		<div class="col-lg-12" >
			<div class="panel-body">
				<div class="table-scroll">
					<table id="report_summary_listing" class="table" style="font-size:7px;">
						<tbody>
							<tr>
								<th rowspan="3" class="danger">No</th>
								<th rowspan="3" class="danger">NO APSB</th>
								<th rowspan="3" class="danger">Nama</th>
								<th colspan="34" class="danger">JENIS CUTI</th>
							</tr>
							<tr>
								<th colspan="5" class="warning">ANNUAL LEAVE</th>
								<th class="clear"></th>
								<th colspan="3" class="warning">MEDICAL LEAVE</th>
								<th class="clear"></th>
								<th colspan="3" class="warning">EMERGENCY LEAVE</th>
								<th class="clear"></th>
								<th colspan="3">FAMILY SICK</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
								<th class="clear"></th>
								<th class="warning">2018</th>
							</tr>
							<tr>
								<th class="warning">Annual Entitlement</th>
								<th class="warning">Carry</th>
								<th class="warning">Taken</th>
								<th class="warning">Balance = (Eligible + Carry) - Taken</th>
								<th class="warning">Eligible</th>
								<th class="clear"></th>
								<th class="warning">Annual Entitlement</th>
								<th class="warning">Taken</th>
								<th class="warning">Balance</th>
								<th class="clear"></th>
								<th class="warning">Annual Entitlement</th>
								<th class="warning">Taken</th>
								<th class="warning">Balance</th>
								<th class="clear"></th>
								<th>Annual Entitlement</th>
								<th>Taken</th>
								<th>Balance</th>
								<th class="clear"></th>
								<th class="warning">Maternity Leave</th>
								<th class="clear"></th>
								<th class="warning">Paternity Leave</th>
								<th class="clear"></th>
								<th class="warning">Marriage Leave</th>
								<th class="clear"></th>
								<th class="warning">Unrecorded Leave</th>
								<th class="clear"></th>
								<th class="warning">Study Leave</th>
								<th class="clear"></th>
								<th class="warning">Transfer Leave</th>
								<th class="clear"></th>
								<th class="warning">Hajj Leave</th>
							</tr>
	<?php } ?>

							<tr>
								<td><?=$no;?></td>
								<td><?=$row->user_id;?></td>
								<td><?=$row->v_UserName;?></td>
								<td><?=isset($row->annual_leave) ? $row->annual_leave : 0 ;?></td>
								<td class="warning"><?=isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0 ;?></td>
								<td class="warning"><?=$row->ALtaken;?></td>
								<td><?=$row->ALbalance;?></td>
								<td><?=isset($row->annual_leave) ? $row->entitled  : 0 ;?></td>
								<td></td>
								<td><?=isset($row->sick_leave) ? $row->sick_leave : 0 ;?></td>
								<td><?=$row->SLtaken;?></td>
								<td><?=$row->SLbalance;?></td>
								<td></td>
								<td><?=isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0;?></td>
								<td><?=$row->ELtaken;?></td>
								<td><?=$row->ELbalance;?></td>
								<td></td>
								<td><?=isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;?></td>
								<td><?=$row->FStaken + $row->FSEtaken;?></td>
								<td><?=$row->FSbalance;?></td>
								<td></td>
								<td><?=$row->MLbalance;?></td>
								<td></td>
								<td><?=$row->PLbalance;?></td>
								<td></td>
								<td><?=$row->MRLbalance;?></td>
								<td></td>
								<td><?=$row->ULbalance;?></td>
								<td></td>
								<td><?=$row->STLbalance;?></td>
								<td></td>
								<td><?=$row->TLbalance;?></td>
								<td></td>
								<td><?=$row->HLbalance;?></td>
							</tr>

	<?php if ($no % 18 == 0) { ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-lg-12">
				<div style="display:inline-block; float:left; margin-left: 77px">
					<h6>DA TOLAK SEKALI STAFF YG DA REQUEST CUTI BULAN 12 THROUGH SISTEM</h6>
				</div>
			</div>
	
			<div class="StartNewPage" id="breakpage"><span id="pagebreak"></span></div>
	<?php } ?>
	<?php $no++ ?>
<?php endforeach; ?>
		</div>
	</div>
