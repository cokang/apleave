<style type="text/css">
	.table-scroll{
		width: 100%;
		overflow-x: scroll;
	}
	table#report_summary_listing, table#report_summary_listing tr, table#report_summary_listing tr th, table#report_summary_listing tr td{
		border-style: solid;
		border-width: 1px;
		text-align: center;
		border-top: 1px solid black;
	}
	.text-center{
		text-align: center;
	}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Report Summary</h1>
		</div>
	</div>




	<div class="row" >
		<div class="col-lg-12" >
			<div class="panel-body">
				<div class="col-lg-12">
					<h4 class="page-header">Leave account</h4>
				<?php //$num=1;foreach($leaveacc as $row): ?>
					<?php //if ($num == 1 OR $num%4 == 1){ ?>
				</div>

				<div class="col-lg-12">
					<div style="display:inline-block; width:17%; float:left;">
						<h6>Year Selected : <?= $fyear; ?></h6>
					</div>
					<form action="" method="post|get">
						<div style="display:inline-block; width:20%; float:left;">
							<h6 style="float: left;">Location : </h6>
							<select  onchange="submit()" name="location" style="margin-left: 3px; float: left; margin-top: 5px;">
								<option value="all">All</option>
								<?php 
								foreach ($statelist as $lval){
									$locselected = ($lval->state_code==$location) ? 'selected' : '';
									echo "<option value='".$lval->state_code."' ".$locselected.">".$lval->state."</option>";
								}
								?>
							</select>
						</div>
						<div style="display:inline-block; width:17%; float:left;">
							<h6 style="float: left;">Number Of Row : </h6>
							<select  onchange="submit()" name="rowlimit" style="margin-left: 3px; float: left; margin-top: 5px;">
								<?php
								$limitlist = array(5=>'5',10=>'10',20=>'20');
								foreach ($limitlist as $k => $v){
									$selected = ($k==$limit) ? 'selected' : '';
									echo "<option value='".$k."' ".$selected.">".$v."</option>";
								}
								?>
							</select>
						</div>
						<input type="text" style="display: none;" name="p" value="1">
					</form>
				</div>
				<div class="col-lg-12">
					<div class="table-scroll">
						<table id="report_summary_listing" class="table" style="font-size:10px;">
							<tbody>
					<?php //} ?>
								<tr>
									<th rowspan="3" class="danger">No</th>
									<th rowspan="3" class="danger">NO APSB</th>
									<th rowspan="3" class="danger">Nama</th>
									<th colspan="48" class="danger">JENIS CUTI</th>
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
									<th colspan="3" class="warning">Maternity Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Paternity Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Marriage Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Unrecorded Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Study Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Transfer Leave</th>
									<th class="clear"></th>
									<th colspan="3" class="warning">Hajj Leave</th>
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
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
									<th class="clear"></th>
									<th class="warning">Annual Entitlement</th>
									<th class="warning">Taken</th>
									<th class="warning">Balance</th>
								</tr>

								<?php foreach( $leaveacc as $row):?>

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
									<td><?=isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0;?></td>
									<td><?=$row->MLtaken + $row->MLEtaken;?></td>
									<td><?=$row->MLbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0;?></td>
									<td><?=$row->PLtaken + $row->PLEtaken;?></td>
									<td><?=$row->PLbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0;?></td>
									<td><?=$row->MRLtaken + $row->MRLEtaken;?></td>
									<td><?=$row->MRLbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0;?></td>
									<td><?=$row->ULtaken + $row->ULEtaken;?></td>
									<td><?=$row->ULbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0;?></td>
									<td><?=$row->STLtaken + $row->STLEtaken;?></td>
									<td><?=$row->STLbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0;?></td>
									<td><?=$row->TLtaken + $row->TLEtaken;?></td>
									<td><?=$row->TLbalance;?></td>
									<td></td>
									<td><?=isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0;?></td>
									<td><?=$row->HLtaken + $row->HLEtaken;?></td>
									<td><?=$row->HLbalance;?></td>
								</tr>

								<?php $no++;endforeach;?>
					<?php //if ($num % 4 == 0) { ?>
							</tbody>
						</table>
						<ul class="pagination">
						<!-- <?php if ($jumlah > $limit){
								if( $page > 1 ){ ?>
							<li class="paginate_button previous"><a href="?p=<?=$page - 1;?>">Prev</a></li>
								<?php }
							// for ($i=1;$i<=$page;$i++){
								if( $page < 3 ){
									if( $page == 2 ){?>
										<li class="paginate_button">&nbsp;<a href="?p=1">1</a></li>
									<?php }?>
									<li class="paginate_button active">&nbsp;<a href="?p=<?=$page;?>"><?=$page;?></a></li>
								<?php }else{?>
									<li class="paginate_button">&nbsp;<a href="?p=<?php echo $page-1;?>"><?=$page-1;?></a></li>
									<li class="paginate_button active">&nbsp;<a href="?p=<?=$page;?>"><?=$page;?></a></li>
									<li class="paginate_button">&nbsp;<a href="?p=<?php echo $page+1;?>"><?=$page+1;?></a></li>
								<?php }
							// }?>
							<li class="paginate_button previous"><a href="?p=<?=$page + 1;?>">Next</a></li>
						<?php } ?> -->

						<?php if ($jumlah >= $limit){
							if( $page > 3 ){ ?>
								<li class="paginate_button previous"><a href="?p=1&rowlimit=<?=$limit;?>&location=<?=$location;?>">First Page</a></li>
							<?php }
							if( $page > 1 ){ ?>
								<li class="paginate_button previous"><a href="?p=<?=$page-1;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>">Prev</a></li>
							<?php } 
							if( $page < 3 ){ 
								if( $page == 2 ){?>
									<li class="paginate_button">&nbsp;<a href="?p=1&rowlimit=<?=$limit;?>&location=<?=$location;?>">1</a></li>
								<?php }?>
								<li class="paginate_button active">&nbsp;<a href="?p=<?=$page;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page;?></a></li>
							<?php }elseif( $page >= 3 ){?>
								<li class="paginate_button">&nbsp;<a href="?p=<?=$page-1;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page-1;?></a></li>
								<li class="paginate_button active">&nbsp;<a href="?p=<?=$page;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page;?></a></li>
								<?php if( $no < $jumlah ){ ?>
								<li class="paginate_button">&nbsp;<a href="?p=<?=$page+1;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page+1;?></a></li>
								<?php } ?>
							<?php }else{ ?>
								<li class="paginate_button">&nbsp;<a href="?p=<?=$page-1;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page-1;?></a></li>
								<li class="paginate_button active">&nbsp;<a href="?p=<?=$page;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>"><?=$page;?></a></li>
							<?php } ?>
							<?php if( $no <= $jumlah ){ ?>
							<li class="paginate_button previous"><a href="?p=<?=$page+1;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>">Next</a></li>
							<?php if( $page < $last_page )?>
								<li class="paginate_button"><a href="?p=<?=$last_page;?>&rowlimit=<?=$limit;?>&location=<?=$location;?>">Last Page</a></li>
							<?php } ?>
						<?php } ?>
						</ul>
					</div>
				</div>
		
				<div class="StartNewPage" id="breakpage"><span id="pagebreak"></span></div>
					<?php //} ?>
					<?php //$num++ ?>
				<?php //endforeach; ?>
			</div>
		</div>
	</div>
</div>
