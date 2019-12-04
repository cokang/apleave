<?php
class AP_leave {
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('display_model');
    }
    public function get_leave_detail($leaveacc, $tleavetaken, $hajj='', $selected_year, $leave_type=''){
        $baru= $this->getleavefield();
		/* echo "<pre>";
		print_r($baru);exit(); */
  		$is_selected_leave = (count($leave_type)==1) ? true : false;
		  $selected_leave = ($is_selected_leave==true) ? $leave_type[0]->id : 0;
		$cfl_limit=10;
        $jumlah = 0;
  		$current_data = 0;
  		$dept = '';
  		$staffname = '';
  		$apsbno = '';
  		$start = '';
  		$limit = '';
  		$user_id = '';
        //echo $selected_year;
		//exit();
  		$year = $selected_year;
  		if( empty($leaveacc) ){
			//exit();
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
				//exit();
  			}
  		}
  		if( !empty($leaveacc) ){
			$col = $this->ci->display_model->leave_type();
  			$num=1;
  			foreach($leaveacc as $row):
			foreach ($baru as $nilai){
			$row->$nilai['taken']=0;
             if	(isset($nilai['Etaken'])){
			$row->$nilai['Etaken']=0;
			 }
			}
			//$row->FSbalance=0;
			$row->hajjstat=0;
  				$leave_type = $this->ci->display_model->leave_type();
               // echo "<pre>";
				//print_r($leave_type);
  	      		//if( empty($tleavetaken) ){
  				$tleavetaken = $this->ci->display_model->tleavetaken('', $row->user_id, $row->v_UserName, '', $row->year);
  				//}
			/* 	echo "<pre>";
                print_r($tleavetaken);
  				exit(); */
				foreach ($tleavetaken as $list){
  					$fromdate	= $list->leave_from;//($list->leave_from) ? $list->leave_from : $list->leave_to;
  					$todate		= ($list->leave_to) ? $list->leave_to : $list->leave_from;
  					//$row->noleave = $this->get_no_ofday($fromdate, $todate, $list->leave_type, $list->leave_duration, $list->v_hospitalcode, $year);
            $row->noleave = $this->get_no_ofday($fromdate, $todate, $list->leave_type, $list->leave_duration, $list->v_hospitalcode, $year,$list->user_id);
  					if($list->user_id == $row->user_id){
				   foreach ($baru as $key=> $isi){
		    if(($list->leave_type == $isi['id'])&&($leave_type[$key]->per_case_basis==0)){
			        $row->$isi['taken']+= $row->noleave;
					if(($isi['id']==1)||($isi['id']==3)){
					$jumlah += $row->$isi['taken'];
					}
			 }
			 elseif(($list->leave_type == $isi['id'])&&($leave_type[$key]->per_case_basis <> 0)){
					if ($row->noleave <= $leave_type[$key]->per_case_basis){
  						 $row->$isi['taken'] += $row->noleave;
						$jumlah += $row->$isi['taken'];
  				   }else{
  						 $row->$isi['taken'] += $leave_type[$key]->per_case_basis;
  						 $row->$isi['Etaken'] += ($row->noleave - $leave_type[$key]->per_case_basis);
						// echo $row->noleave ;exit();
					    //echo $leave_type[$key]->per_case_basis;exit();
						$jumlah += $row->$isi['Etaken'];
  						}
			         }
					 }
  					}
  				}
	    /*     echo "<pre>";
			print_r($baru);exit();	 */
		//echo $jumlah;exit();
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
  				$data['annualB'] = (isset($row->annual_leave) ? $row->entitled : 0) + (isset($row->carry_fwd_leave) ? ($row->carry_fwd_leave<=$cfl_limit?$row->carry_fwd_leave:$cfl_limit) : 0) - $row->ALtaken - (isset($row->ELtaken) ? $row->ELtaken : 0);//kat sini jugak
  				if ($data['annualB'] < 0){
  					$data['ALEtaken'] = abs($data['annualB']);
  					$data['ALbalance'] = 0;
  				}else{
  					$data['ALbalance'] = $data['annualB'];
  				}
  				$row->UPLbalance = $row->UPLtaken + (isset($row->ALEtaken) ? $row->ALEtaken : 0);
  				$row->EXLbalance = $row->EXLtaken;
                foreach ($baru as $key=>$nilai){
               if (isset($nilai['Bal'])){
               if ($nilai['Bal']=='HLbalance'){
			   $row->$nilai['Bal'] = ($data['hajjstat'] != '' ? $data['hajjstat'] : (isset($leave_type[$key]->entitle_days) ? $leave_type[$key]->entitle_days : 0) - $row->$nilai['taken']);
			   }elseif($nilai['Bal']=='ELbalance'){
				  $row->$nilai['Bal'] = (isset($leave_type[$key]->limit_days) ? $leave_type[$key]->limit_days : 0) - $row->$nilai['taken'];
			   }else{
			   $row->$nilai['Bal'] = (isset($leave_type[$key]->entitle_days) ? $leave_type[$key]->entitle_days : 0) - $row->$nilai['taken'];//kena cek balik
			        }
			   }
			     }
  				$row->ALbalance=$data['ALbalance'];
  				$row->SLbalance=$data['SLbalance'];
  				//get totaltaken & balanceleave
  				$row->totaltaken = 0;
  				$row->balanceleave = 0;
  				$row->balanceEleave = $row->ELtaken;
			//echo $selected_leave;exit();
  				if( $is_selected_leave ){
					$id=$selected_leave-1;
  					if( $selected_leave==1 || $selected_leave==3 ){
  						if ($data['annualB'] < 0){
  							$row->balanceleave = 0;
						}else{
  							$row->balanceleave = $data['annualB'];
  						}
                       //echo $jumlah; exit();
  						$row->totaltaken = $jumlah + (isset($row->SLEtaken) ? $row->SLEtaken : 0);
  					if(  $selected_leave==3 ){
  							$row->balanceEleave = (isset($leave_type[$id]->limit_days) ? $leave_type[$id]->limit_days : 0) - $row->$baru[$id]['taken'];
  							$row->totalELtaken = $row->$baru[$id]['taken'];
  							$row->balanceleave = $row->balanceEleave;
  						}
  					}elseif( $selected_leave==2 ){
  						$row->balanceleave = $row->SLbalance;
  						if ($row->balanceleave < 0){
  							$row->balanceleave = 0;
  						}
					$row->totaltaken = $row->SLtaken - (isset($row->SLEtaken) ? $row->SLEtaken : 0);
  					}elseif( $selected_leave >=3 ){
					  if (isset($leave_type[$id]->entitle_days)){
					    $row->balanceleave = (isset($leave_type[$id]->entitle_days) ? $leave_type[$id]->entitle_days : 0) - $row->$baru[$id]['taken'];
					   }
					    $row->totaltaken = $row->$baru[$id]['taken'];
					}
  					$row->ESLtaken = $row->EXLtaken;
  				}
  				if( $current_data==1 ){
  					$this->ci->load->model('insert_model');
  					$insert_data = array(
  						'user_id' => $row->user_id,
  						'year' => $selected_year,
  						'annual_leave' => $row->annual_leave,
  						'carry_fwd_leave' => $row->ALbalance<=$cfl_limit?$row->ALbalance:$cfl_limit,
  						'sick_leave' => $row->sick_leave,
  						'earned_leave' => $row->earned_leave,
  					);
  					$this->ci->insert_model->addempleaves($insert_data);
  					$row->year = $selected_year;
  					$row->carry_fwd_leave = $row->ALbalance;
  					//$row->ALbalance = $row->annual_leave + $row->carry_fwd_leave;
                    $row->ALbalance = (FLOOR(ROUND($row->annual_leave / 12 * (int)date("m"), 4))) + ($row->carry_fwd_leave<=$cfl_limit?$row->carry_fwd_leave:$cfl_limit);
  					$row->SLbalance = $row->sick_leave;
  					$row->UPLbalance = $row->UPLtaken + (isset($row->ALEtaken) ? $row->ALEtaken : 0);
  					$row->EXLbalance = $row->EXLtaken;
  				     foreach ($baru as $key=>$nilai){
               if (isset($nilai['Bal'])){
               if ($nilai['Bal']=='HLbalance'){
			   $row->$nilai['Bal'] = ($data['hajjstat'] != '' ? $data['hajjstat'] : (isset($leave_type[$key]->entitle_days) ? $leave_type[$key]->entitle_days : 0) - $row->$nilai['taken']);
			   }elseif($nilai['Bal']=='ELbalance'){
				  $row->$nilai['Bal'] = (isset($leave_type[$key]->limit_days) ? $leave_type[$key]->limit_days : 0) - $row->$nilai['taken'];
			   }else{
			   $row->$nilai['Bal'] = (isset($leave_type[$key]->entitle_days) ? $leave_type[$key]->entitle_days : 0) - $row->$nilai['taken'];
			        }
			   }
			     }
  				foreach ($baru as $nilai){
		     	$row->$nilai['taken']=0;
                if(isset($nilai['Etaken'])){
			    $row->$nilai['Etaken']=0;
			   }
			   }
  					$row->hajjstat=0;
  					$current_data = 0;
  				}
  			endforeach;
  				for ($i = 0; $i < count($leaveacc); $i++) {
  					$leaveacc[$i]->ALtaken = $leaveacc[$i]->ALtaken + $leaveacc[$i]->ELtaken; //ubah sini
  				}
  				$current_data = 0;
  			//$leaveacc[0]->ALtaken = $leaveacc[0]->ALtaken + $leaveacc[0]->ELtaken;
  		}
  		return $leaveacc;
  	}
	public function get_holiday_state($year){
    $data['state_list'] = $this->ci->display_model->statelist();
    foreach($data['state_list'] as $key => $row){
        $statel = 'holiday'.$row->state_code;
        $state2 = $row->state_code.'_hol';
        $data[$statel] = $this->ci->display_model->stateH($year,$row->state_code);
        if($data[$statel]){
          foreach ($data[$statel] as $key => $value) {
             $data[$state2][] = strtotime(date($value->date_holiday));
          }
        }else {
          $data[$state2][] = NULL;
        }
      }
/*
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
    */
		return $data;
	}
	public function get_no_ofday($fromdate, $todate, $leave_type, $leave_duration, $v_hospitalcode, $year,$userid=""){
	$flex_wrk = $this->ci->display_model->flex_wrk($userid);
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
		$test = 0;
		while ($begin <= $end) {
			if( $leave_duration=="Full Day" || $leave_duration==0 ){
				$no_days++;
			}elseif( $leave_duration=="Half Day" ){
				$no_days = $no_days + 0.5;
			}
			$weekend_count = $this->weekend_count();//leave need calculate weekend and public holiday
			//if( !in_array($leave_type, $weekend_count) ){
      if( (!in_array($leave_type, $weekend_count)) && ($flex_wrk != 1) ){
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
			}else{
				$weekends=0;
				//$weekends=0;
			}
			$begin += 86400; // +1 day
			//echo $no_days;
		};
		//print_r($weekend_count);
		//echo $no_days;
		$selected_day = $no_days - $weekends;
		return $selected_day;
	}
	public function weekend_count(){
		$weekend_count = array(4,5,7,13);
		return $weekend_count;
	}
public function holiday_array($holidayArr, $v_hospitalcode){
  $holiday_array = array();
  $data['state_list'] = $this->ci->display_model->statelist();
	foreach($data['state_list'] as $key => $row){
		$state = $row->state_code.'_hol';
	 if ($v_hospitalcode == $row->state_code){
		 $holiday_array = $holidayArr[$state];
	 }
	}
  /*
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
  */
  return $holiday_array;
}
public function getcharacter($words){
if($words=='Exam Leave'){
$words = explode(" ", 'S T L');
}elseif($words=='Extended Sick Leave'){
$words = explode(" ", 'E X L');
}elseif($words=='Marriage Leave'){
$words = explode(" ", 'M R L');
}elseif($words=='Compassionate Leave'){
$words = explode(" ", 'F S');
}elseif($words=='Unpaid Leave'){
$words = explode(" ", 'U P L');
}elseif($words=='Hospitalisation Leave'){
$words = explode(" ", 'H P L');
}else{
$words = explode(" ", $words);
}
$acronym = "";
foreach ($words as $w) {
 $acronym .= $w[0];
}
return array('taken'=>$acronym.'taken','Etaken'=>$acronym.'Etaken','Bal'=>$acronym.'balance');
}
public function getleavefield(){
  $col = $this->ci->display_model->leave_type();
  $test=array();
   for ($x = 0; $x <= count($col); $x++) {
	if ($x<=(count($col)-1)){
	$value=$this->getcharacter($col[$x]->leave_name)['taken'];
	 $test[$x]['id']=$col[$x]->id;
	 $test[$x]['taken']=$value;
	 //$test[$x]['vtaken']=0;
	if($col[$x]->per_case_basis <> 0){
       $value2=$this->getcharacter($col[$x]->leave_name)['Etaken'];
	   $test[$x]['Etaken']=$value2;
	   }
	 	if(($col[$x]->entitle_days <> 0) || ($col[$x]->limit_days <> 0)){
       $value3=$this->getcharacter($col[$x]->leave_name)['Bal'];
	   $test[$x]['Bal']=$value3;
	   }
	 if($x==12){
	  $test[$x]['hajjstat']=0;
	 }
	 if($x==5){
	  $test[$x]['FSbalance']=0;
	 }
	}
	   }
   return $test;
}
public function semak_cuti($mula,$hospitalcode,$flex,$leave_type){
$x=date("N",$mula);
$test=null;
$weekend_count = $this->weekend_count();
if((!in_array($leave_type, $weekend_count))&&($flex != 1)){
if($hospitalcode == 'JB'){
if (($x == 5) || ($x == 6)) { // 5 and 6 are weekend days
	$test=null;
	}else{
    /* if(in_array(date("d",$mula),$cuti)){
	$test=null;
	}else{
	$test=date("d",$mula);
	} */
	$test=(int)date("d",$mula);
	  }
}elseif($hospitalcode == NULL ){
	if ($x > 5 ) { // 6 and 7 are weekend days
		$test=null;
	 }else{
/* 	if(in_array(date("d",$mula),$cuti)){
	$test=null;
	}else{
	$test=date("d",$mula);
	} */
	$test=(int)date("d",$mula);
	 }
}else{
 if ($x > 5) { // 6 and 7 are weekend days
	}else{
	/* if(in_array(date("d",$mula),$cuti)){
	$test=null;
	}else{
	$test=date("d",$mula);
	} */
	$test=(int)date("d",$mula);
	}
}
}else{
$test=(int)date("d",$mula);
}
return $test;
}
}
?>