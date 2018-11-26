
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
					<?php $people = array("APSB592", "APSB1150", "APSB1419", "APSB426", "APSB823", "APSB1256", "APSB1417", "APSB658"); if (($group[0]->v_GroupID == 'HR') || (in_array($group[0]->v_UserID, $people))){ ?>
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
						<input type="text" name="staff_name"  value="" class="form-control">
					</div>
					<?php if ($check == 'All'){ ?>
					<div class="form-group" id="staff_no" style="display:block;">
					<?php } else { ?>
					<div class="form-group" id="staff_no" style="display:none;">
					<?php } ?>
						<label>APSB No.</label>
						<input type="text" name="staff_no"  value="" class="form-control">
					</div>
					<?php } ?>
					<label>Select Extra Columns</label>
					<!--|| in_array('Unpaid',$excolt)
					|| in_array('Extended_Sick',$excolt)
					|| in_array('Family_Sick',$excolt)
					|| in_array('Maternity',$excolt)
					|| in_array('Paternity',$excolt)
					|| in_array('Marriage',$excolt)
					|| in_array('Unrecorded',$excolt)
					|| in_array('Study',$excolt)
					|| in_array('Transfer',$excolt)
					|| in_array('Hajj',$excolt) -->
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
									$ALtaken = 0;
									$SLtaken = 0;
									$ELtaken = 0;
									$UPLtaken = 0;
									$EXLtaken = 0;
									$FStaken = 0;
									$FSEtaken = 0;
									$MLtaken = 0;
									$MLEtaken = 0;
									$PLtaken = 0;
									$PLEtaken = 0;
									$MRLtaken = 0;
									$MRLEtaken = 0;
									$ULtaken = 0;
									$ULEtaken = 0;
									$STLtaken = 0;
									$STLEtaken = 0;
									$TLtaken = 0;
									$TLEtaken = 0;
									$HLtaken = 0;
									$HLEtaken = 0;
									$hajjstat = '';
									$halfday = 0;
									foreach ($tleavetaken as $list){

										$fromdate	= $list->leave_from;//($list->leave_from) ? $list->leave_from : $list->leave_to;
										$todate		= ($list->leave_to) ? $list->leave_to : $list->leave_from;

										$begin = strtotime($fromdate);
										$end   = strtotime($todate);

										if ($list->v_hospitalcode == 'JB'){
											$holiday_array = $JB_hol;
										}
										elseif($list->v_hospitalcode == 'MKA'){
											$holiday_array = $MKA_hol;
										}
										elseif($list->v_hospitalcode == 'NS'){
											$holiday_array = $NS_hol;
										}
										elseif($list->v_hospitalcode == 'SEL'){
											$holiday_array = $SEL_hol;
										}
		                				elseif($list->v_hospitalcode == 'PHG'){
											$holiday_array = $PHG_hol;
										}
		                				elseif($list->v_hospitalcode == 'KL'){
											$holiday_array = $KL_hol;
										}

										$no_days  = 0;
										$weekends = 0;
										// $halfday += ($list->leave_duration=='Half Day') ? 0.5 : 0;

										while ($begin <= $end) {
											// $no_days++; // no of days in the given interval
											if( $list->leave_duration=="Full Day" ){
												$no_days++;
											}elseif( $list->leave_duration=="Half Day" ){
												$no_days = $no_days + 0.5;
											}
											$weekend_count = array(5,7,13,14);//leave need calculate weekend and public holiday
											if( !in_array($list->leave_type, $weekend_count) ){
												$what_day = date("N", $begin);
												//echo "$what_day".$what_day;
												if($list->v_hospitalcode == 'JB'){
												//echo "ni jb";
													if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $holiday_array))) { // 5 and 6 are weekend days
														$weekends++;
													}
												}
												elseif($list->v_hospitalcode == NULL ){
												//echo"kosong";
												    if ($what_day > 5 ) { // 6 and 7 are weekend days
														$weekends++;
													}
												}
												else{
												//echo"ayam";
													if ($what_day > 5 || (in_array($begin, $holiday_array))) { // 6 and 7 are weekend days
														$weekends++;
													}
												}
											}
											$begin += 86400; // +1 day
										};

										$noleave = $no_days - $weekends;
										// echo $weekends."<br>";
										if($list->user_id == $row->user_id){
											if ($list->leave_type == '1'){  //annual leave
												$ALtaken += $noleave;
											}
											elseif($list->leave_type == '2'){  //sick leave
												$SLtaken += $noleave;
											}
											elseif($list->leave_type == '3'){  //emergency leave
												$ELtaken += $noleave;
											}
											elseif($list->leave_type == '4'){  //unpaid leave
												$UPLtaken += $noleave;
											}
											elseif($list->leave_type == '5'){  //unpaid leave
												$EXLtaken += $noleave;
											}
											elseif($list->leave_type == '6'){  //family sick leave
												if ($noleave <= $leave_type[5]->per_case_basis){
													$FStaken += $noleave;
												}
												else{
													$FStaken += $leave_type[5]->per_case_basis;
													$FSEtaken += ($noleave - $leave_type[5]->per_case_basis);
												}
											}
											elseif($list->leave_type == '7'){  //maternity leave
												if ($noleave <= $leave_type[6]->per_case_basis){
													$MLtaken += $noleave;
												}
												else{
													$MLtaken += $leave_type[6]->per_case_basis;
													$MLEtaken += ($noleave - $leave_type[6]->per_case_basis);
												}
											}
											elseif($list->leave_type == '8'){  //paternity leave
												if ($noleave <= $leave_type[7]->per_case_basis){
													$PLtaken += $noleave;
												}
												else{
													$PLtaken += $leave_type[7]->per_case_basis;
													$PLEtaken += ($noleave - $leave_type[7]->per_case_basis);
												}
											}
											elseif($list->leave_type == '9'){  //marriage leave
												if ($noleave <= $leave_type[8]->per_case_basis){
													$MRLtaken += $noleave;
												}
												else{
													$MRLtaken += $leave_type[8]->per_case_basis;
													$MRLEtaken += ($noleave - $leave_type[8]->per_case_basis);
												}
											}
											elseif($list->leave_type == '10'){  //unrecorded leave
												if ($noleave <= $leave_type[9]->per_case_basis){
													$ULtaken += $noleave;
												}
												else{
													$ULtaken += $leave_type[9]->per_case_basis;
													$ULEtaken += ($noleave - $leave_type[9]->per_case_basis);
												}
											}
											elseif($list->leave_type == '11'){  //study leave
												if ($noleave <= $leave_type[10]->per_case_basis){
													$STLtaken += $noleave;
													// if( $list->leave_duration=="Half Day" ){
													// 	// $STLtaken = $STLtaken;// - 0.5;
													// 	$halfday = $halfday + 0.5;
													// }
												}
												else{
													$STLtaken += $leave_type[10]->per_case_basis;
													$STLEtaken += ($noleave - $leave_type[10]->per_case_basis);
												}
											}
											elseif($list->leave_type == '12'){  //transfer leave
												if ($noleave <= $leave_type[11]->per_case_basis){
													$TLtaken += $noleave;
												}
												else{
													$TLtaken += $leave_type[11]->per_case_basis;
													$TLEtaken += ($noleave - $leave_type[11]->per_case_basis);
												}
											}
											elseif($list->leave_type == '13'){  //hajj leave
												if ($noleave <= $leave_type[12]->per_case_basis){
													$HLtaken += $noleave;
												}
												else{
													$HLtaken += $leave_type[12]->per_case_basis;
													$HLEtaken += ($noleave - $leave_type[12]->per_case_basis);
												}
											}
										} //
									}

									// $halfday = $halfday / 0.5;
									// if( $halfday % 2 == 1 ){
									// 	$STLtaken = $STLtaken - 0.5;
									// }
									// echo $STLtaken;
									// echo "$STLtaken - $halfday";
									// $STLtaken = $STLtaken - $halfday;

									foreach ($hajj as $hajjlist){
										if ($row->user_id == $hajjlist['user_id']){
											if ($hajjlist['hajjdet'] == 1){
												$hajjstat = 'Taken';
											}
										}
									}

									$sickB = (isset($row->sick_leave) ? $row->sick_leave : 0) - $SLtaken;
									if ($sickB < 0){
										$SLEtaken = abs($sickB);
										$SLbalance = 0;
									}
									else{
										$SLbalance = $sickB;
									}
									//$annualB = (isset($row->annual_leave) ? $row->entitled : 0) + (isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0) - $ALtaken - $ELtaken - $FSEtaken - $MLEtaken - $PLEtaken - $MRLEtaken - $ULEtaken - $STLEtaken - $TLEtaken - $HLEtaken - (isset($SLEtaken) ? $SLEtaken : 0);
									$annualB = (isset($row->annual_leave) ? $row->entitled : 0) + (isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0) - $ALtaken;
										if ($annualB < 0){
											$ALEtaken = abs($annualB);
											$ALbalance = 0;
										}
										else{
											$ALbalance = $annualB;
										}
										$UPLbalance = $UPLtaken + (isset($ALEtaken) ? $ALEtaken : 0);
										$EXLbalance = $EXLtaken;
										$ELbalance = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0) - $ELtaken;
										$FSbalance = (isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0) - $FStaken;
										$MLbalance = (isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0) - $MLtaken;
										$PLbalance = (isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0) - $PLtaken;
										$MRLbalance = (isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0) - $MRLtaken;
										$ULbalance = (isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0) - $ULtaken;
										$STLbalance = (isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0) - $STLtaken;
										$TLbalance = (isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0) - $TLtaken;
										$HLbalance = ($hajjstat != '' ? $hajjstat : (isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0) - $HLtaken);

										if (isset($excol[0])) {
											if ($excol[0] == 'Unpaid'){
												//$eligable1 = 0;
												$taken1 = $UPLbalance;
												//$balance1 = 0;
											}
											elseif ($excol[0] == 'Extended_Sick'){
												//$eligable1 = 0;
												$taken1 = $EXLbalance;
												//$balance1 = 0;
											}
											elseif ($excol[0] == 'Family_Sick'){
												$eligable1 = isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;
												$taken1 = $FStaken + $FSEtaken;
												$balance1 = $FSbalance;
											}
											elseif ($excol[0] == 'Maternity'){
												$eligable1 = isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0;
												$taken1 = $MLtaken + $MLEtaken;
												$balance1 = $MLbalance;
											}
											elseif ($excol[0] == 'Paternity'){
												$eligable1 = isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0;
												$taken1 = $PLtaken + $PLEtaken;
												$balance1 = $PLbalance;
											}
											elseif ($excol[0] == 'Marriage'){
												$eligable1 = isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0;
												$taken1 = $MRLtaken + $MRLEtaken;
												$balance1 = $MRLbalance;
											}
											elseif ($excol[0] == 'Unrecorded'){
												$eligable1 = isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0;
												$taken1 = $ULtaken + $ULEtaken;
												$balance1 = $ULbalance;
											}
											elseif ($excol[0] == 'Exam_Leave'){
												$eligable1 = isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0;
												$taken1 = $STLtaken + $STLEtaken;
												$balance1 = $STLbalance;
											}
											elseif ($excol[0] == 'Transfer'){
												$eligable1 = isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0;
												$taken1 = $TLtaken + $TLEtaken;
												$balance1 = $TLbalance;
											}
											elseif ($excol[0] == 'Hajj'){
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
											}
											elseif ($excol[1] == 'Extended_Sick'){
												//$eligable2 = 0;
												$taken2 = $EXLbalance;
												//$balance2 = 0;
											}
											elseif ($excol[1] == 'Family_Sick'){
												$eligable2 = isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;
												$taken2 = $FStaken + $FSEtaken;
												$balance2 = $FSbalance;
											}
											elseif ($excol[1] == 'Maternity'){
												$eligable2 = isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0;
												$taken2 = $MLtaken + $MLEtaken;
												$balance2 = $MLbalance;
											}
											elseif ($excol[1] == 'Paternity'){
												$eligable2 = isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0;
												$taken2 = $PLtaken + $PLEtaken;
												$balance2 = $PLbalance;
											}
											elseif ($excol[1] == 'Marriage'){
												$eligable2 = isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0;
												$taken2 = $MRLtaken + $MRLEtaken;
												$balance2 = $MRLbalance;
											}
											elseif ($excol[1] == 'Unrecorded'){
												$eligable2 = isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0;
												$taken2 = $ULtaken + $ULEtaken;
												$balance2 = $ULbalance;
											}
											elseif ($excol[1] == 'Exam_Leave'){
												$eligable2 = isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0;
												$taken2 = $STLtaken + $STLEtaken;
												$balance2 = $STLbalance;
											}
											elseif ($excol[1] == 'Transfer'){
												$eligable2 = isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0;
												$taken2 = $TLtaken + $TLEtaken;
												$balance2 = $TLbalance;
											}
											elseif ($excol[1] == 'Hajj'){
												$eligable2 = isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0;
												$taken2 = $HLtaken + $HLEtaken;
												$balance2 = $HLbalance;
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
														<td class="col-lg-2">E - <?=isset($row->annual_leave) ? $row->entitled  : 0 ?></td>
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
																		<?php if ($hajjstat == '') { ?>
														<td class="col-lg-2">E - <?=$eligable2?></td>
																		<?php } else { ?>
														<td class="col-lg-2"><?=$hajjstat?></td>
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
														<td class="col-lg-2">T - <?=$ALtaken?></td>
														<td class="col-lg-2">T - <?=$SLtaken?></td>
														<td class="col-lg-2">T - <?=$ELtaken?></td>
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
																		<?php if ($hajjstat == '') { ?>
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
														<td class="col-lg-2">B - <?=$ALbalance?></td>
														<td class="col-lg-2">B - <?=$SLbalance?></td>
														<td class="col-lg-2">B - <?=$ELbalance?></td>
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
																		<?php if ($hajjstat == '') { ?>
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
