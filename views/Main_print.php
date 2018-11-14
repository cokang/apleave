<div id="page-wrapper">
	<div class="row main-page bg-white"> 
		<!-- /.col-lg-12-->
		<div class="col-lg-12">
			<div class="panel-heading"> 
				<div class="col-lg-12">
					<div style="float:right;">FORM/MSD/HR/05</div>
				</div>
				<div class="col-lg-12">
					<img src="<?php echo base_url();?>images/logo.png" class="img-heading"/>
					<div class="title-heading"><b>BORANG PERMOHONAN CUTI</b> <i>(LEAVE APPLICATION FORM)</i></div>
				</div>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<!-- /.col-lg-12-->
				<div class="col-lg-12">
					<table class="table-custom" border="0">
						<tbody >
							<tr>
								<td colspan="7" class="table-color"><b>BAHAGIAN A </b>(Butiran Pemohon)<i>[<b>PART A</b>(Applicant Detail)]</i></td>
							</tr>
							<tr>
								<td class="td1"><b>Nama</b><br/><i>Name </i></td>
								<td class="td2" colspan="4">: <span class="text-pr"><?=isset($record[0]->v_UserName) ? ucwords($record[0]->v_UserName) : ''?></span><hr class='dotted'/></td>
								<td class="td3"><b>No. Pekerja</b><br/><i>Staff ID</i> </td>
								<td class="td4">: <span class="text-pr"><?=isset($record[0]->apsb_no) ? $record[0]->apsb_no : ''?></span><hr class=	'dotted'/></td>
							</tr>
							<tr>
								<td class="td1"><b>Jawatan</b><br/><i>Designation </i></td>
								<td class="td2" colspan="4">: <span class="text-pr"><?=isset($record[0]->design_emp) ? $record[0]->design_emp : ''?></span><hr class='dotted'/></td>
								<td class="td3"><b>Gred</b><br/><i>Grade</i> </td>
								<td class="td4">: <span class="text-pr"><?=isset($record[0]->grade) ? $record[0]->grade : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td1"><b>Kawasan</b><br/><i>Branch/Site </i></td>
								<td class="td2" colspan="4">: <span class="text-pr"><?=isset($record[0]->state) ? $record[0]->state : ''?></span><hr class='dotted'/></td>
								<td class="td3"><b>Hospital</b><br/><i>Hospital</i> </td>
								<td class="td4">: <span class="text-pr"><?=isset($record[0]->v_HospitalName) ? $record[0]->v_HospitalName : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td1"><b>Memohon Cuti Selama</b><br/><i>No. of Days </i></td>
								<td class="td5">: <span class="text-pr"><?=isset($noleave) ? $noleave : 0?></span><hr class='dotted'/></td>
								<td class="td6"><b>Hari</b><br/><i>Day/Days</i></td>
								<td class="td7"><b>Mulai</b><br/><i>Date From</i></td>
								<td class="td8">: <span class="text-pr"><?=isset($record[0]->leave_from) ? date("d-m-Y",strtotime($record[0]->leave_from)) : ''?></span><hr class='dotted'/></td>
								<td class="td3"><b>Hingga</b><br/><i>Until</i> </td>
								<td class="td4">: <span class="text-pr"><?=isset($record[0]->leave_to) ? date("d-m-Y",strtotime($record[0]->leave_to)) : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td1" colspan="2"><b>Sebab Bercuti (Selain Cuti Tahun)</b><br/><i>Reason (Except Annual Leave) </i></td>
								<td class="td8" colspan="5">: <span class="text-pr"><?=isset($record[0]->leave_remarks) ? $record[0]->leave_remarks : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td8 tdheight" colspan="2" align="center">
									<?=isset($record[0]->v_UserName) ? ucwords($record[0]->v_UserName) : ''?>
									<hr class='dotted'/>
									<span><b>Tandatangan Pekerja</b><br/><i>Staff Signature</i> </span>
								</td>
								<td colspan="3"></td>
								<td class="td8" colspan="5" align="center" style="padding-left:20px;"> 
									<span class="text-pr"><?=isset($record[0]->application_date) ? date("d-m-Y",strtotime($record[0]->application_date)) : ''?></span>
									<hr class='dotted'/><span><b>Tarikh</b><br/><i>Date</i> </span>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="0">
						<tbody >
							<tr>
								<td colspan="4" class="table-color"><b>BAHAGIAN B </b>(Butiran Pengganti)<i>[<b>PART B</b>(Replacement Detail)]</i></td>
							</tr>
							<tr>
								<td class="td1"><b>Nama</b><br/><i>Name </i></td>
								<td class="td8" colspan="3">: <span class="text-pr"><?=isset($replacement[0]->v_UserName) ? ucwords($replacement[0]->v_UserName) : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td1"><b>Jawatan</b><br/><i>Designation </i></td>
								<td class="td8" colspan="3">: <span class="text-pr"><?=isset($replacement[0]->design_emp) ? ucwords($replacement[0]->design_emp) : ''?></span><hr class='dotted'/></td>
							</tr>
							<tr>
								<td class="td1"><b>No. Telefon</b><br/><i>Mobile No. </i></td>
								<td class="td8" colspan="3">: <span class="text-pr"><?=isset($replacement[0]->phone_no) ? ucwords($replacement[0]->phone_no) : ''?></span><hr class='dotted hrwidth'/></td>
							</tr>
							<tr>
								<td class="td9" colspan="2" align="center">
									<?=isset($replacement[0]->v_UserName) ? ucwords($replacement[0]->v_UserName) : ''?>
									<hr class='dotted'/>
									<span><b>Tandatangan Pekerja</b><br/><i>Staff Signature</i> </span>
								</td>
								<td class="none"></td>
								<td class="td10" colspan="" align="center">
									<span class="text-pr"><?=isset($record[0]->application_date) ? date("d-m-Y",strtotime($record[0]->application_date)) : ''?></span>
									<hr class='dotted'/>
									<span><b>Tarikh</b><br/><i>Date</i> </span>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="0">
						<tbody >
							<tr>
								<td colspan="4" class="table-color"><b>BAHAGIAN C </b>(Untuk dipenuhi oleh Pembantu Pertadbiran)<i>[<b>PART C</b>(To be filled by Executive Administration)]</i></td>
							</tr>
							<tr>
								<td colspan="4"><b>Jenis Cuti yang Dipohon :</b> : (Tanda <img src="<?php echo base_url(); ?>images/tick2.png" class="img-tick"/> pada yang berkenaan)<i>[<b>Type of Leave Apply : </b>(Please tick <img src="<?php echo base_url(); ?>images/tick2.png" class="img-tick"/> in appropriate box)]</i></td>
							</tr>
							<tr>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 1 ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Cuti Tahunan</b><br/><i>Annual Leave </i></div></td>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Cuti Sakit</b><br/><i>Sick Leave </i></div></td>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 3 ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Cuti Kecemasan</b><br/><i>Emergency Leave </i></div></td>
								<td class="td11"><b>*Sila lampirkan dokumen sokongan</b><br/><i>Please attached supporting document </i></td>
							</tr>
							<tr>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 4 ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Cuti Tanpa Gaji</b><br/><i>Unpaid Leave </i></div></td>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Cuti Ihsan</b><br/><i>Compensate Leave </i></div></td>
								<td class="td12"><div class="box2"><span class="text-pr"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 3 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? '<img src="'.base_url().'images/tick2.png" class="img-tick tick-img"/>' : ''?></span></div><div class="textbox"><b>Lain-lain : (Sila nyatakan)</b><br/><i>(Please State) </i></div></td>
								<td class="td11">: <span class="text-pr"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 3 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? $userleave[0]->leave_name : ''?></span><hr class='dotted '/></td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="1" style="border:1px solid black;">
						<tbody >
							<tr>
								<td colspan="6" class="table-color" align="center"><b>STATUS BILANGAN CUTI </b><i>(LEAVE ENTITLEMENT)</i></td>
							</tr>
							<tr style="text-align:center;">
								<td class=""></td>
								<td class=""><b>Cuti Tahunan</b><br/><i>Annual Leave </i></td>
								<td class=""><b>Cuti Sakit</b><br/><i>Sick Leave </i></td>
								<td class=""><b>Cuti Ihsan</b><br/><i>Compensate Leave </i></td>
								<td class=""><b>Cuti Tanpa Gaji</b><br/><i>Unpaid Leave </i></td>
								<td style="text-align:left;" class="td1"><b>Lain-lain : <span class="spacehr" style=""><span class="text-pr"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? $userleave[0]->leave_name : '&nbsp;'?></span><hr class='dotted'/></span></b><span><i>Other :<span class="spacehr"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? $userleave[0]->leave_name : '&nbsp;'?><hr class='dotted'/></span></i><span></td>
								</tr>
								<tr>
								<td class="" ><b>Cuti yang dibawa dari tahun lepas</b><br/><i>Carry forward from previous year</i></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $record[0]->carry_fwd_leave : ''?></span></td>
								<td class=""></td>
								<td class=""></td>
								<td class=""></td>
								<td class=""></td>
							</tr>
							<tr>
								<td class="" ><b>Kelayakan cuti tahun semasa</b><br/><i>Current leave entitlement</i></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $record[0]->annual_leave : ''?></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? $record[0]->sick_leave : ''?></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? $userleave[0]->entitle_days : ''?></td>
								<td class=""></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? ($record[0]->leave_type == 3 ? $userleave[0]->limit_days : $userleave[0]->entitle_days) : ''?></span></td>
							</tr>
							<tr>
								<td class="" ><b>Bilangan cuti yang telah diambil</b><br/><i>Leave taken</i></td>
								<td class="">
									<span class="text-pr1">
										<!-- <?php $AL_leave_taken = isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $noleave : 0) : ''?>
										<?php $EL_leave_taken = isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? ($record[0]->leave_type == 3 ? $noleave : ($noleave > $userleave[0]->per_case_basis ? $userleave[0]->per_case_basis : $noleave) ) : 0) : '';?>
										<?php $leave_taken = $AL_leave_taken; //($record[0]->leave_type == 3) ? $AL_leave_taken + $EL_leave_taken : $AL_leave_taken; ?>
										<?=$leave_taken;?> -->
										<?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $noleave : 0) : ''?>
									</span>
								</td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $noleave : 0) : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? ($noleave > $userleave[0]->per_case_basis ? $userleave[0]->per_case_basis : $noleave) : 0) : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 4 ? $totaltaken - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $noleave : 0) : ''?></td>
								<td class="">
									<span class="text-pr1">
										<?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? ($record[0]->leave_type==3 ? $totalELtaken : $totaltaken) - (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? ($record[0]->leave_type == 3 ? $noleave : ($noleave > $userleave[0]->per_case_basis ? $userleave[0]->per_case_basis : $noleave) ) : 0) : ''?>
									</span>
								</td>
							</tr>
							<tr>
								<td class="" ><b>Bilangan cuti terakhir</b><br/><i>leave balance to-date</i></td>
								<td class="">
									<span class="text-pr1">
										<?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $balanceleave + $noleave : $balanceleave) : '' ?>
									</span>
								</td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $balanceleave + $noleave : $balanceleave) : '' ?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? $balanceleave + ($noleave > $userleave[0]->per_case_basis ? $userleave[0]->per_case_basis : $noleave) : $balanceleave) : '' ?></span></td>
								<td class=""></td>
								<td class=""><span class="text-pr1">
									<?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? (isset($record[0]->leave_status) && $record[0]->leave_status == 'Accepted' ? ($record[0]->leave_type==3 ? $balanceEleave : $balanceleave ) + ($record[0]->leave_type == 3 ? $noleave : ($noleave > $userleave[0]->per_case_basis ? $userleave[0]->per_case_basis : $noleave) ) : ($record[0]->leave_type==3 ? $balanceEleave : $balanceleave) ) : ''?></span></td>
							</tr>
							<tr>
								<td class="" ><b>Jumlah cuti yang dipohon</b><br/><i>Total of days apply</i></td>
								<td class=""><span class="text-pr1">
									<?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $noleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? $noleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? $noleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 4 ? $noleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2 && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? $noleave : ''?></span></td>
							</tr>
							<tr>
								<td class="" ><b>Baki cuti terkini</b><br/><i>Current leave balance</i></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type == 1 || $record[0]->leave_type == 3) ? $balanceleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 2 ? $balanceleave : ''?></span></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && $record[0]->leave_type == 6 ? $balanceleave : ''?></span></td>
								<td class=""></td>
								<td class=""><span class="text-pr1"><?=isset($record[0]->leave_type) && ($record[0]->leave_type != 1 && $record[0]->leave_type != 2  && $record[0]->leave_type != 4 && $record[0]->leave_type != 6) ? ($record[0]->leave_type==3 ? $balanceEleave : $balanceleave ) : ''?></span></td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="0">
						<tbody >
							<tr>
								<td class=""><b>Direkod Oleh</b> <i>(Recorded by)</i></td>
								<td class=""></td>
							</tr>
							<tr>
								<td class="td13 tdheight"><hr class='dotted'/></td>
								<td class=""></td>
							</tr>
							<tr>
								<td class=""><b>Nama</b> <i>(Name) : </i><span style="display:block;"><b>Tarikh</b> <i>(Date) : </i></span></td>
								<td class=""></td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="0">
						<tbody >
							<tr>
								<td colspan="4" class="table-color"><b>BAHAGIAN D - KELULUSAN </b>(Untuk dipenuhi oleh pengarah Urusan/Pengarah Eksekutif/Pengurusan kanan/Pengurusan Kawasan/Ketua)</br><i>[<b>PART D - FOR APPROVAL</b>(To be filled by Managing Director/Executive Director/Senior Manager/Manager/Head)]</i></td>
							</tr>
							<tr>
								<td colspan="4">
									<b>Saya memperakukan/tidak memperakukan<span class="spacehr2"> &nbsp;<hr class='dotted'/></span>hari cuti pekerja di atas, kerana kerja-kerja beliau boleh/tidak boleh  dilaksanakan oleh pekerja lain semasa beliau bercuti.(*potong mana tidak tidak berkenaan) </b><br/>
									<i>I hereby , acknowledge and approve/no approve for<span class="spacehr2">&nbsp;<hr class='dotted'/></span> days for the above staff leave application, as his/her duty can/cannot be replaced by others while he/she is on leave (*delete whichever is not applicable)</i>
								</td>
							</tr>
							<tr>
								<td class="td9" colspan="2" align="center">
									<?=isset($record[0]->leave_approved_by) ? $record[0]->leave_approved_by : ''?>
									<hr class='dotted'/><span><b>Tandatangan &amp; Cop</b><br/><i>Signature</i> </span>
								</td>
								<td class="none"></td>
								<td class="td10" colspan="" align="center">
									<?=isset($record[0]->date_approved) ? date("d-m-Y",strtotime($record[0]->date_approved)) : ''?>
									<hr class='dotted'/><span><b>Tarikh</b><br/><i>Date</i> </span>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table-custom" border="0">
						<tbody>
							<tr>
								<td colspan="4" class="table-color"><b>BAHAGIAN E </b>(Untuk dipenuhi oleh jabatan perkhimatan pengurusan)<i>[<b>PART E</b>(To be filled by Management Service Department)]</i></td>
							</tr>
							<tr>
								<td colspan="2" align="left"><span><b>Disemak Oleh</b><i>(Checked by)</i> </span></td>
								<td></td>
								<td align="left"><span><b>Disahkan Oleh</b><i>(Verified by)</i> </span></td>
							</tr>
							<tr>
								<td class="td9" colspan="2" align="left"><hr class='dotted'/><span><b>Nama</b> <i>(Name) : </i><span style="display:block;"><b>Tarikh</b> <i>(Date) : </i></span></i> </span></td>
								<td class="none"></td>
								<td class="td10" colspan="" align="left"><hr class='dotted'/><span><b>Nama</b> <i>(Name) : </i><span style="display:block;"><b>Tarikh</b> <i>(Date) : </i></span></span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- /.Form --> 
			</div>
			<!-- /.panel-body --> 
			<div class="col-lg-12 padbottom">
				<div style="float:right;">Revision 26 October 2016</div>
			</div>
		</div>
	<!-- /.col-lg-6 --> 
	</div>
	<!-- /.row --> 
</div>
<!-- /#page-wrapper --> 