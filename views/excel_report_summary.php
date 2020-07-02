<?php
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=summary_report.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");

echo '
<style type="text/css">
	.warning{
		background-color: #fcf8e3;
	}
	.danger{
		background-color: #f2dede;
	}
	table, table tr, table tr th, table tr td{
		border-style: solid;
		border-width: 1px;
		text-align: center;
		border-top: 1px solid black;
		padding: 3px;
	}
	.clear{
		width: 1px;
	}
</style>
';

echo '<table border="1">';
//make the column headers what you want in whatever order you want
echo 'SUMMARY DATA LEAVE AS AT SEPT 2018';
echo '<table>
		<tr>
			<th rowspan="3" class="danger">No</th>
			<th rowspan="3" class="danger">NO APSB</th>
			<th rowspan="3" class="danger">Nama</th>
			<!--<th colspan="31" class="danger">JENIS CUTI</th>-->
			<!--<th colspan="21" class="danger">JENIS CUTI</th>-->
			<th colspan="44" class="danger">JENIS CUTI</th>
		</tr>
		<tr>
			<th colspan="5" class="warning">ANNUAL LEAVE</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Medical Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Emergency Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3">Family Sick Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Maternity Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Paternity Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Marriage Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Unrecorded Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Study Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Transfer Leave</th>
			<!--<th class="clear"></th>-->
			<th colspan="3" class="warning">Hajj Leave</th>
			<th colspan="3" class="warning">Extended Leave Sick	</th>
			<th colspan="3" class="warning">Unpaid Leave</th>
			<th colspan="3" class="warning">Hospitalisation Leave</th>
		</tr>
		<tr>
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Carry</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance = (Eligible + Carry) - Taken</th>
			<th class="warning">Eligible</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th>Annual Entitlement</th>
			<th>Taken</th>
			<th>Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
			<!--<th class="clear"></th>-->
			<th class="warning">Annual Entitlement</th>
			<th class="warning">Taken</th>
			<th class="warning">Balance</th>
		</tr>';
//loop the query data to the table in same order as the headers
		// echo "<pre>";var_export($leave_type);
$no=1;foreach ( $leaveacc as $row ){
	$EL_entitled = isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0;
	$FS_entitled = isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0;
	$AL_entitled = isset($row->annual_leave) ? $row->annual_leave : 0;
	$carry_forward = isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0;
	$AL_eligible = isset($row->annual_leave) ? $row->entitled  : 0;
	$SL_entitled = isset($row->sick_leave) ? $row->sick_leave : 0;
	// echo "EL_entitled=$EL_entitled<br>FS_entitled=$FS_entitled<br>AL_entitled=$AL_entitled<br>carry_forward=$carry_forward<br>AL_eligible=$AL_eligible<br>SL_entitled=$SL_entitled";
	echo '<tr>
			<td>'.$no.'</td>
			<td>'.$row->user_id.'</td>
			<td>'.$row->v_UserName.'</td>
			<td>'.$AL_entitled.'</td>
			<td class="warning">'.$carry_forward.'</td>
			<td class="warning">'.$row->ALtaken.'</td>
			<td>'.$row->ALbalance.'</td>
			<td>'.$AL_eligible.'</td>
			<!--<td></td>-->
			<td>'.$SL_entitled.'</td>
			<td>'.$row->SLtaken.'</td>
			<td>'.$row->SLbalance.'</td>
			<!--<td></td>-->
			<td>'.$EL_entitled.'</td>
			<td>'.$row->ELtaken.'</td>
			<td>'.$row->ELbalance.'</td>
			<!--<td></td>-->
			<td>'.$FS_entitled.'</td>
			<td>'.( $row->FStaken + $row->FSEtaken ).'</td>
			<td>'.$row->FSbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0 ).'</td>
			<td>'.( $row->MLtaken + $row->MLEtaken ).'</td>
			<td>'.$row->MLbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0 ).'</td>
			<td>'.( $row->PLtaken + $row->PLEtaken ).'</td>
			<td>'.$row->PLbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0 ).'</td>
			<td>'.( $row->MRLtaken + $row->MRLEtaken ).'</td>
			<td>'.$row->MRLbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0 ).'</td>
			<td>'.( $row->ULtaken + $row->ULEtaken ).'</td>
			<td>'.$row->ULbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0 ).'</td>
			<td>'.( $row->STLtaken + $row->STLEtaken ).'</td>
			<td>'.$row->STLbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0 ).'</td>
			<td>'.( $row->TLtaken + $row->TLEtaken ).'</td>
			<td>'.$row->TLbalance.'</td>
			<!--<td></td>-->
			<td>'.( isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0 ).'</td>
			<td>'.( $row->HLtaken + $row->HLEtaken ).'</td>
			<td>'.$row->HLbalance.'</td>
			<td>'.( isset($leave_type[4]->entitle_days) ? $leave_type[4]->entitle_days : 0 ).'</td>
			<td>'.( $row->EXLtaken ).'</td>
			<td>-</td>
			<td>'.( isset($leave_type[3]->entitle_days) ? $leave_type[3]->entitle_days : 0 ).'</td>
			<td>'.( $row->UPLtaken ).'</td>
			<td>-</td>
			<td>'.( isset($leave_type[13]->entitle_days) ? $leave_type[13]->entitle_days : 0 ).'</td>
			<td>'.( $row->HPLtaken + $row->HPLEtaken ).'</td>
			<td>'.$row->HPLbalance.'</td>
		</tr>';
		$no++;
}
echo '</table>';
?>