<?php
class AP_leave {


    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('display_model');
    }

    public function get_leave_detail($leaveacc, $tleavetaken, $hajj='', $selected_year, $leave_type=''){

  		$is_selected_leave = (count($leave_type)==1) ? true : false;
  		$selected_leave = ($is_selected_leave==true) ? $leave_type[0]->id : 0;

  		$current_data = 0;
  		$dept = '';
  		$staffname = '';
  		$apsbno = '';
  		$start = '';
  		$limit = '';
  		$user_id = '';

  		$year = $selected_year;

  		if( empty($leaveacc) ){
  			$dept = ( isset($_REQUEST['dept']) && $_REQUEST['dept']!='0' ) ? $_REQUEST['dept'] : '';
  			if( isset($_REQUEST['staffname']) ){
  				$staffname = $_REQUEST['staffname'];
  			}elseif ( isset($_REQUEST['staff_name']) ){
  				$staffname = $_REQUEST['staff_name'];
  			}elseif( isset($_REQUEST['employee_name']) ){
  				$staffname = $_REQUEST['employee_name'];
  			}else{
  				$staffname = '';
  			}

  			$apsbno = ( isset($_REQUEST['staff_no']) ) ? $_REQUEST['staff_no'] : '';
  			$year = $selected_year-1;
  			$start = ( isset($_REQUEST['start']) ) ? $_REQUEST['start'] : '';
  			$limit = ( isset($_REQUEST['limit']) ) ? $_REQUEST['limit'] : '';
  			//$user_id = ( !isset($_REQUEST['staff_no']) && !isset($_REQUEST['staff_name']) && !isset($_REQUEST['staffname']) && (!isset($_REQUEST['dept']) || $_REQUEST['dept']!=0) ) ? $this->ci->session->userdata("v_UserName") : '';
        if( isset($_REQUEST['user_id']) ){//utk print out
  				$user_id = $_REQUEST['user_id'];
  			}else{
  				$user_id = ( !isset($_REQUEST['staff_no']) && !isset($_REQUEST['staff_name']) && !isset($_REQUEST['staffname']) && (!isset($_REQUEST['dept']) || $_REQUEST['dept']!=0) ) ? $this->ci->session->userdata("v_UserName") : '';
  			}

  			$leaveacc = $this->ci->display_model->leaveacc($dept, $user_id, $staffname, $apsbno,$year, $start, $limit);
  			$tleavetaken = $this->ci->display_model->tleavetaken($dept, $user_id, $staffname, $apsbno, $year);
  			if( !empty($leaveacc) ){
  				$current_data = 1;
  			}
  		}

  		if( !empty($leaveacc) ){
  			$num=1;
  			foreach($leaveacc as $row):

  				$row->UPLtaken=0;
  				$row->ALtaken=0;
  				$row->ELtaken=0;
  				$row->SLtaken=0;
  				$row->EXLtaken=0;
  				$row->FStaken=0;
  				$row->MLtaken=0;
  				$row->PLtaken=0;
  				$row->MRLtaken=0;
  				$row->ULtaken=0;
  				$row->STLtaken=0;
  				$row->TLtaken=0;
  				$row->HLtaken=0;
  				$row->FSbalance=0;

  				$row->FSEtaken=0;
  				$row->MLEtaken=0;
  				$row->PLEtaken=0;
  				$row->MRLEtaken=0;
  				$row->ULEtaken=0;
  				$row->STLEtaken=0;
  				$row->TLEtaken=0;
  				$row->HLEtaken=0;
  				$row->hajjstat=0;

  				$leave_type = $this->ci->display_model->leave_type();

  	      		//if( empty($tleavetaken) ){
  				$tleavetaken = $this->ci->display_model->tleavetaken('', $row->user_id, $row->v_UserName, '', $row->year);
  				//}

  				foreach ($tleavetaken as $list){
  					$fromdate	= $list->leave_from;//($list->leave_from) ? $list->leave_from : $list->leave_to;
  					$todate		= ($list->leave_to) ? $list->leave_to : $list->leave_from;

  					$row->noleave = $this->get_no_ofday($fromdate, $todate, $list->leave_type, $list->leave_duration, $list->v_hospitalcode, $year);

  					if($list->user_id == $row->user_id){

  						if ($list->leave_type == 1){  //annual leave
  							$row->ALtaken += $row->noleave;
  						}elseif($list->leave_type == 2){  //sick leave
  							$row->SLtaken += $row->noleave;
  						}elseif($list->leave_type == 3){  //emergency leave
  							$row->ELtaken += $row->noleave;
  						}elseif($list->leave_type == 4){  //unpaid leave
  							$row->UPLtaken += $row->noleave;
  						}elseif($list->leave_type == 5){  //unpaid leave
  							$row->EXLtaken += $row->noleave;
  						}elseif($list->leave_type == 6){  //family sick leave
  							if ($row->noleave <= $leave_type[5]->per_case_basis){
  								$row->FStaken += $row->noleave;
  							}else{
  								$row->FStaken += $leave_type[5]->per_case_basis;
  								$row->FSEtaken += ($row->noleave - $leave_type[5]->per_case_basis);
  							}
  						}elseif($list->leave_type == 7){  //maternity leave
  							if ($row->noleave <= $leave_type[6]->per_case_basis){
  								$row->MLtaken += $row->noleave;
  							}else{
  								$row->MLtaken += $leave_type[6]->per_case_basis;
  								$row->MLEtaken += ($row->noleave - $leave_type[6]->per_case_basis);
  							}
  						}elseif($list->leave_type == 8){  //paternity leave
  							if ($row->noleave <= $leave_type[7]->per_case_basis){
  								$row->PLtaken += $row->noleave;
  							}else{
  								$row->PLtaken += $leave_type[7]->per_case_basis;
  								$row->PLEtaken += ($row->noleave - $leave_type[7]->per_case_basis);
  							}
  						}elseif($list->leave_type == 9){  //marriage leave
  							if ($row->noleave <= $leave_type[8]->per_case_basis){
  								$row->MRLtaken += $row->noleave;
  							}else{
  								$row->MRLtaken += $leave_type[8]->per_case_basis;
  								$row->MRLEtaken += ($row->noleave - $leave_type[8]->per_case_basis);
  							}
  						}elseif($list->leave_type == 10){  //unrecorded leave
  							if ($row->noleave <= $leave_type[9]->per_case_basis){
  								$row->ULtaken += $row->noleave;
  							}else{
  								$row->ULtaken += $leave_type[9]->per_case_basis;
  								$row->ULEtaken += ($row->noleave - $leave_type[9]->per_case_basis);
  							}
  						}elseif($list->leave_type == 11){  //study leave
  							if ($row->noleave <= $leave_type[10]->per_case_basis){
  								$row->STLtaken += $row->noleave;
  							}else{
  								$row->STLtaken += $leave_type[10]->per_case_basis;
  								$row->STLEtaken += ($row->noleave - $leave_type[10]->per_case_basis);
  							}
  						}elseif($list->leave_type == 12){  //transfer leave
  							if ($row->noleave <= $leave_type[11]->per_case_basis){
  								$row->TLtaken += $row->noleave;
  							}else{
  								$row->TLtaken += $leave_type[11]->per_case_basis;
  								$row->TLEtaken += ($row->noleave - $leave_type[11]->per_case_basis);
  							}
  						}elseif($list->leave_type == 13){  //hajj leave
  							if ($row->noleave <= $leave_type[12]->per_case_basis){
  								$row->HLtaken += $row->noleave;
  							}else{
  								$row->HLtaken += $leave_type[12]->per_case_basis;
  								$row->HLEtaken += ($row->noleave - $leave_type[12]->per_case_basis);
  							}
  						}
  					}
  				}

  				$data['hajjstat']=0;
  				if($hajj!=''){
  					foreach ($hajj as $hajjlist){
  						if( !empty($hajjlist) ){
  							if ($row->user_id == $hajjlist['user_id']){
  								if ($hajjlist['hajjdet'] == 1){
  									$row->hajjstat = 'Taken';
  								}
  							}
  						}
  					}
  				}

  				$data['sickB'] = (isset($row->sick_leave) ? $row->sick_leave : 0) - $row->SLtaken;
  				if ($data['sickB'] < 0){
  					$data['SLEtaken'] = abs($data['sickB']);
  					$data['SLbalance'] = 0;
  				}else{
  					$data['SLbalance'] = $data['sickB'];
  				}
  				$data['annualB'] = (isset($row->annual_leave) ? $row->entitled : 0) + (isset($row->carry_fwd_leave) ? $row->carry_fwd_leave : 0) - $row->ALtaken - (isset($row->ELtaken) ? $row->ELtaken : 0);
  				if ($data['annualB'] < 0){
  					$data['ALEtaken'] = abs($data['annualB']);
  					$data['ALbalance'] = 0;
  				}else{
  					$data['ALbalance'] = $data['annualB'];
  				}
  				$row->UPLbalance = $row->UPLtaken + (isset($row->ALEtaken) ? $row->ALEtaken : 0);
  				$row->EXLbalance = $row->EXLtaken;
  				$row->ELbalance = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0) - $row->ELtaken;
  				$row->FSbalance = (isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0) - $row->FStaken;
  				$row->MLbalance = (isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0) - $row->MLtaken;
  				$row->PLbalance = (isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0) - $row->PLtaken;
  				$row->MRLbalance = (isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0) - $row->MRLtaken;
  				$row->ULbalance = (isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0) - $row->ULtaken;
  				$row->STLbalance = (isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0) - $row->STLtaken;
  				$row->TLbalance = (isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0) - $row->TLtaken;
  				$row->HLbalance = ($data['hajjstat'] != '' ? $data['hajjstat'] : (isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0) - $row->HLtaken);

  				$row->ALbalance=$data['ALbalance'];
  				$row->SLbalance=$data['SLbalance'];

  				//get totaltaken & balanceleave
  				$row->totaltaken = 0;
  				$row->balanceleave = 0;
  				$row->balanceEleave = $row->ELtaken;
  				if( $is_selected_leave ){
  					// $userleave = $this->ci->display_model->userleave($selected_leave);
  					if( $selected_leave==1 || $selected_leave==3 ){
  						if ($data['annualB'] < 0){
  							$row->balanceleave = 0;
  						}else{
  							$row->balanceleave = $data['annualB'];
  						}

  						$row->totaltaken = $row->ALtaken + $row->ELtaken + $row->FSEtaken + $row->PLEtaken + $row->MLEtaken  + $row->MRLEtaken  + $row->ULEtaken  + $row->STLEtaken  + $row->TLEtaken + $row->HLEtaken + (isset($row->SLEtaken) ? $row->SLEtaken : 0);

  						if(  $selected_leave==3 ){
  							$row->balanceEleave = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0) - $row->ELtaken;
  							$row->totalELtaken = $row->ELtaken;
  							$row->balanceleave = $row->balanceEleave;
  						}
  					}elseif( $selected_leave==2 ){
  						$row->balanceleave = $row->SLbalance;
  						if ($row->balanceleave < 0){
  							$row->balanceleave = 0;
  						}
  						$row->totaltaken = $row->SLtaken - (isset($row->SLEtaken) ? $row->SLEtaken : 0);
  					}elseif( $selected_leave==3 ){
  						$row->balanceleave = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0) - $row->ELtaken;
  						$row->totaltaken = $row->ELtaken;
  					}elseif( $selected_leave==4 ){
  						$row->totaltaken = $row->UPLtaken;
  					}elseif( $selected_leave==5 ){
  						$row->totaltaken = $row->EXLtaken;
  					}elseif( $selected_leave==6 ){
  						$row->balanceleave = (isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0) - $row->FStaken;
  						$row->totaltaken = $row->FStaken;
  					}elseif( $selected_leave==7 ){
  						$row->balanceleave = (isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0) - $row->MLtaken;
  						$row->totaltaken = $row->MLtaken;
  					}elseif( $selected_leave==8 ){//paternity
  						$row->balanceleave = (isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0) - $row->PLtaken;
  						$row->totaltaken = $row->PLtaken;
  					}elseif( $selected_leave==9 ){//marriage leave
  						$row->balanceleave = (isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0) - $row->MRLtaken;
  						$row->totaltaken = $row->MRLtaken;
  					}elseif( $selected_leave==10 ){//unrecorded leave
  						$row->balanceleave = (isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0) - $row->ULtaken;
  						$row->totaltaken = $row->ULtaken;
  					}elseif( $selected_leave==11 ){//exam leave
  						$row->balanceleave = (isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0) - $row->STLtaken;
  						$row->totaltaken = $row->STLtaken;
  					}elseif( $selected_leave==12 ){//transfer leave
  						$row->balanceleave = (isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0) - $row->TLtaken;
  						$row->totaltaken = $row->TLtaken;
  					}elseif( $selected_leave==13 ){// hajj leave
  						$row->totaltaken = $row->HLtaken;
  						$row->balanceleave = (isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0) - $row->HLtaken;
  					}
  					$row->ESLtaken = $row->EXLtaken;
  				}

  				if( $current_data==1 ){
  					$this->ci->load->model('insert_model');

  					$insert_data = array(
  						'user_id' => $row->user_id,
  						'year' => $selected_year,
  						'annual_leave' => $row->annual_leave,
  						'carry_fwd_leave' => $row->ALbalance,
  						'sick_leave' => $row->sick_leave,
  						'earned_leave' => $row->earned_leave,
  					);
  					$this->ci->insert_model->addempleaves($insert_data);

  					$row->year = $selected_year;
  					$row->carry_fwd_leave = $row->ALbalance;
  					$row->ALbalance = $row->annual_leave + $row->carry_fwd_leave;
  					$row->SLbalance = $row->sick_leave;
  					$row->UPLbalance = $row->UPLtaken + (isset($row->ALEtaken) ? $row->ALEtaken : 0);
  					$row->EXLbalance = $row->EXLtaken;
  					$row->ELbalance = (isset($leave_type[2]->limit_days) ? $leave_type[2]->limit_days : 0);
  					$row->FSbalance = (isset($leave_type[5]->entitle_days) ? $leave_type[5]->entitle_days : 0);
  					$row->MLbalance = (isset($leave_type[6]->entitle_days) ? $leave_type[6]->entitle_days : 0);
  					$row->PLbalance = (isset($leave_type[7]->entitle_days) ? $leave_type[7]->entitle_days : 0);
  					$row->MRLbalance = (isset($leave_type[8]->entitle_days) ? $leave_type[8]->entitle_days : 0);
  					$row->ULbalance = (isset($leave_type[9]->entitle_days) ? $leave_type[9]->entitle_days : 0);
  					$row->STLbalance = (isset($leave_type[10]->entitle_days) ? $leave_type[10]->entitle_days : 0);
  					$row->TLbalance = (isset($leave_type[11]->entitle_days) ? $leave_type[11]->entitle_days : 0);
  					$row->HLbalance = ($data['hajjstat'] != '' ? $data['hajjstat'] : (isset($leave_type[12]->entitle_days) ? $leave_type[12]->entitle_days : 0));

  					$row->UPLtaken=0;
  					$row->ALtaken=0;
  					$row->ELtaken=0;
  					$row->SLtaken=0;
  					$row->EXLtaken=0;
  					$row->FStaken=0;
  					$row->MLtaken=0;
  					$row->PLtaken=0;
  					$row->MRLtaken=0;
  					$row->ULtaken=0;
  					$row->STLtaken=0;
  					$row->TLtaken=0;
  					$row->HLtaken=0;

  					$row->FSEtaken=0;
  					$row->MLEtaken=0;
  					$row->PLEtaken=0;
  					$row->MRLEtaken=0;
  					$row->ULEtaken=0;
  					$row->STLEtaken=0;
  					$row->TLEtaken=0;
  					$row->HLEtaken=0;
  					$row->hajjstat=0;

  					$current_data = 0;
  				}
  			endforeach;

  				for ($i = 0; $i < count($leaveacc); $i++) {
  					$leaveacc[$i]->ALtaken = $leaveacc[$i]->ALtaken + $leaveacc[$i]->ELtaken;
  				}
  				$current_data = 0;

  			//$leaveacc[0]->ALtaken = $leaveacc[0]->ALtaken + $leaveacc[0]->ELtaken;
  		}

  		return $leaveacc;
  	}

	public function get_holiday_state($year){

		$data['holidayJB'] = $this->ci->display_model->holidayJB($year);
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
				$data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->ci->display_model->holidayMKA($year);
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
				$data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['MKA_hol'][] = NULL;
		}$data['holidayNS'] = $this->ci->display_model->holidayNS($year);
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
				$data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->ci->display_model->holidaySEL($year);
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
				$data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['SEL_hol'][] = NULL;
		}
		$data['holidayPHG'] = $this->ci->display_model->holidayPHG($year);
		if($data['holidayPHG']){
			foreach ($data['holidayPHG'] as $key => $value) {
				$data['PHG_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['PHG_hol'][] = NULL;
		}
		$data['holidayKL'] = $this->ci->display_model->holidayKL($year);
		if($data['holidayKL']){
			foreach ($data['holidayKL'] as $key => $value) {
				$data['KL_hol'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['KL_hol'][] = NULL;
		}
		return $data;
	}

	public function get_no_ofday($fromdate, $todate, $leave_type, $leave_duration, $v_hospitalcode, $year){
    $holiday_array = array();
		$begin = strtotime($fromdate);
		$end   = strtotime($todate);
		// echo $fromdate." > ".$todate."<br>";
    if( date("Y", $begin) < date("Y", $end) ){
      $holidayArr1 = $this->get_holiday_state( date("Y", $begin) );
      $holidayArr2 = $this->get_holiday_state( date("Y", $end) );

      $holiday_array1 = $this->holiday_array($holidayArr1, $v_hospitalcode);
      $holiday_array2 = $this->holiday_array($holidayArr2, $v_hospitalcode);

      $holiday_array = array_merge($holiday_array1, $holiday_array2);
    }elseif ( date("Y", $begin) == date("Y", $end) ) {
      $holidayArr = $this->get_holiday_state( date("Y", $begin ) );
      $holiday_array = $this->holiday_array($holidayArr, $v_hospitalcode);
    }

		$no_days  = 0;
		$weekends = 0;

		while ($begin <= $end) {
			if( $leave_duration=="Full Day" || $leave_duration==0 ){
				$no_days++;
			}elseif( $leave_duration=="Half Day" ){
				$no_days = $no_days + 0.5;
			}
			$weekend_count = $this->weekend_count();//leave need calculate weekend and public holiday
			if( !in_array($leave_type, $weekend_count) ){
				$what_day = date("N", $begin);
				if($v_hospitalcode == 'JB'){
					if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $holiday_array))) { // 5 and 6 are weekend days
						$weekends++;
					}
				}elseif($v_hospitalcode == NULL ){
					if ($what_day > 5 ) { // 6 and 7 are weekend days
						$weekends++;
					}
				}else{
					if ($what_day > 5 || (in_array($begin, $holiday_array))) { // 6 and 7 are weekend days
						$weekends++;
					}
				}
			}
			$begin += 86400; // +1 day
		};
		$selected_day = $no_days - $weekends;
		return $selected_day;
	}

	public function weekend_count(){
		$weekend_count = array(4,5,7,13,14);
		return $weekend_count;
	}




public function holiday_array($holidayArr, $v_hospitalcode){
  $holiday_array = array();
  if ($v_hospitalcode == 'JB'){
    $holiday_array = $holidayArr['JB_hol'];
  }elseif($v_hospitalcode == 'MKA'){
    $holiday_array = $holidayArr['MKA_hol'];
  }elseif($v_hospitalcode == 'NS'){
    $holiday_array = $holidayArr['NS_hol'];
  }elseif($v_hospitalcode == 'SEL'){
    $holiday_array = $holidayArr['SEL_hol'];
  }elseif($v_hospitalcode == 'PHG'){
    $holiday_array = $holidayArr['PHG_hol'];
  }elseif($v_hospitalcode == 'KL'){
    $holiday_array = $holidayArr['KL_hol'];
  }

  return $holiday_array;
}
}
?>
