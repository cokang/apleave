<?php

class leave_application extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->is_logged_in = $this->session->userdata("is_logged_in");
		if( !$this->is_logged_in ){
			if( $_SERVER['REQUEST_METHOD']!="POST" ){
				$url = uri_string();
				if( $_SERVER['QUERY_STRING'] ){
					$url = $url."?".$_SERVER['QUERY_STRING'];
				}
				$redirect = array("url"=> $url);
				$this->session->set_userdata( $redirect );
			}
			redirect("/");
		}
	}

	function index(){
		$data['userid'] = $this->input->get('name');
		$data['regid'] = $this->input->get('id');

		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));

		$data['leavedet'] = $this->display_model->leavedet($data['userid'],$data['regid']);
		$data['holiday_list'] = $this->display_model->holiday_list($data['userid'],date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if ($data['holiday_list']){
			foreach ($data['holiday_list'] as $key => $value) {
			    $data['holidayarray'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['holidayarray'][] = NULL;
		}

		$data['holidayJB'] = $this->display_model->holidayJB(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
			    $data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->display_model->holidayMKA(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
			    $data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['MKA_hol'][] = NULL;
		}
		$data['holidayNS'] = $this->display_model->holidayNS(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
			    $data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->display_model->holidaySEL(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
			    $data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['SEL_hol'][] = NULL;
		}
		$data['holidayPHG'] = $this->display_model->holidayPHG(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidayPHG']){
			foreach ($data['holidayPHG'] as $key => $value) {
			    $data['PHG_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['PHG_hol'][] = NULL;
		}
		$data['holidayKL'] = $this->display_model->holidayKL(date('Y',strtotime($data['leavedet'][0]->leave_from)));
		if($data['holidayKL']){
			foreach ($data['holidayKL'] as $key => $value) {
			    $data['KL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['KL_hol'][] = NULL;
		}
		$data['userleave'] = $this->display_model->userleave($data['leavedet'][0]->leave_type);
		$data['leave_type'] = $this->display_model->leave_type();

		$data['fromdate'] = $data['leavedet'][0]->leave_from;
		$data['todate'] = ($data['leavedet'][0]->leave_to) ? $data['leavedet'][0]->leave_to : $data['leavedet'][0]->leave_from;

		//totalleavetaken
		$begin = strtotime($data['fromdate']);
	    $end   = strtotime($data['todate']);

	    $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if($data['leavedet'][0]->v_hospitalcode == 'JB'){
            	if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $data['holidayarray']))) { // 5 and 6 are weekend days
                $weekends++;
            	}
            }
            else{
            	if ($what_day > 5 || (in_array($begin, $data['holidayarray']))) { // 6 and 7 are weekend days
                $weekends++;
            	}
            }

            $begin += 86400; // +1 day
        }
        $data['noleave'] = $no_days - $weekends;
		//totalleavetaken

		//same date
		$data['limit'] = 2;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];
//echo "lalalalallala : ".$data['fromdate'];
		$begin2 = date("Y-m-d",strtotime($data['fromdate']));
		$end2 = date("Y-m-d",strtotime($data['todate']));
		//$data['rec'] = $this->display_model->samedateleave_c($data['fromdate'],$data['userid']);
		$data['rec'] = $this->display_model->samedateleave_c($begin,$end,$data['userid']);
		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}
		//$data['samedateleave'] = $this->display_model->samedateleave($data['fromdate'],$data['userid'],$data['limit'],$data['start']);
		//echo "lalalalallalazzz : ".$data['fromdate'];

		$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['samedateleave'] = $this->display_model->samedateleave($begin2,$end2,$data['userid'],$data['limit'],$data['start'], $data['getgroupdet'][0]->v_GroupID);
		//same date

		//leavebalance
		$yearapplied = date('Y',strtotime($data['fromdate']));
		$data['leaveacc'] = $this->display_model->leaveacc($data['userid'],$yearapplied);
		$data['tleavetaken'] = $this->display_model->tleavetaken($data['userid'],$yearapplied);

		$data['ALtaken'] = 0;
		$data['SLtaken'] = 0;
		$data['ELtaken'] = 0;
		$data['FStaken'] = 0;
		$data['FSEtaken'] = 0;
		$data['PLtaken'] = 0;
		$data['PLEtaken'] = 0;
		$data['MLtaken'] = 0;
		$data['MLEtaken'] = 0;
		$data['MRLtaken'] = 0;
		$data['MRLEtaken'] = 0;
		$data['ULtaken'] = 0;
		$data['ULEtaken'] = 0;
		$data['STLtaken'] = 0;
		$data['STLEtaken'] = 0;
		$data['TLtaken'] = 0;
		$data['TLEtaken'] = 0;
		$data['HLtaken'] = 0;
		$data['HLEtaken'] = 0;
		foreach ($data['tleavetaken'] as $row){

			$data['fromhdate'] = $row->leave_from;
			$data['tohdate'] = ($row->leave_to) ? $row->leave_to : $row->leave_from;

			$begin = strtotime($data['fromhdate']);
		    $end   = strtotime($data['tohdate']);

		    $no_days  = 0;
	        $weekends = 0;
	        while ($begin <= $end) {
	            $no_days++; // no of days in the given interval
	            $what_day = date("N", $begin);
							//echo "$what_day".$what_day;
	            if($data['leavedet'][0]->v_hospitalcode == 'JB'){
	            	if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $data['holidayarray']))) { // 5 and 6 are weekend days
	                $weekends++;
	            	}
	            }
	            else{
	            	if ($what_day > 5 || (in_array($begin, $data['holidayarray']))) { // 6 and 7 are weekend days
	                $weekends++;
	            	}
	            }
	            $begin += 86400; // +1 day
	        }
	        $data['noleavetaken'] = $no_days - $weekends;
	        if ($row->leave_type == '1'){  //annual leave
	        	$data['ALtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '2'){  //sick leave
	        	$data['SLtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '3'){  //emergency leave
				$data['ELtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '6'){  //family sick leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][5]->per_case_basis){
				$data['FStaken'] += $data['noleavetaken'];
				}
				else{
				$data['FStaken'] += $data['leave_type'][5]->per_case_basis;
				$data['FSEtaken'] += ($data['noleavetaken'] - $data['leave_type'][5]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '7'){  //maternity leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][6]->per_case_basis){
				$data['MLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['MLtaken'] += $data['leave_type'][6]->per_case_basis;
				$data['MLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][6]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '8'){  //paternity leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][7]->per_case_basis){
				$data['PLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['PLtaken'] += $data['leave_type'][7]->per_case_basis;
				$data['PLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][7]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '9'){  //marriage leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][8]->per_case_basis){
				$data['MRLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['MRLtaken'] += $data['leave_type'][8]->per_case_basis;
				$data['MRLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][8]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '10'){  //unrecorded leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][9]->per_case_basis){
				$data['ULtaken'] += $data['noleavetaken'];
				}
				else{
				$data['ULtaken'] += $data['leave_type'][9]->per_case_basis;
				$data['ULEtaken'] += ($data['noleavetaken'] - $data['leave_type'][9]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '11'){  //study leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][10]->per_case_basis){
				$data['STLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['STLtaken'] += $data['leave_type'][10]->per_case_basis;
				$data['STLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][10]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '12'){  //transfer leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][11]->per_case_basis){
				$data['TLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['TLtaken'] += $data['leave_type'][11]->per_case_basis;
				$data['TLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][11]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '13'){  //hajj leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][12]->per_case_basis){
				$data['HLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['HLtaken'] += $data['leave_type'][12]->per_case_basis;
				$data['HLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][12]->per_case_basis);
				}
	        }
		}
		//echo 'PL :'.$data['PLtaken'].'<br> PLE :'.$data['PLEtaken'];
		//exit();
		$data['SLbalance'] = (isset($data['leaveacc'][0]->sick_leave) ? $data['leaveacc'][0]->sick_leave : 0) - $data['SLtaken'];
			if ($data['SLbalance'] < 0){
				$data['SLEtaken'] = abs($data['SLbalance']);
				//$data['balanceleave'] = 0;
			}
		if ($data['leavedet'][0]->leave_type == '1'){
		$data['annualB'] = (isset($data['leaveacc'][0]->annual_leave) ? $data['leaveacc'][0]->annual_leave : 0) + (isset($data['leaveacc'][0]->carry_fwd_leave) ? $data['leaveacc'][0]->carry_fwd_leave : 0)
		 						- $data['ALtaken'] - $data['ELtaken'] - $data['FSEtaken'] - $data['PLEtaken'] - $data['MLEtaken']  - $data['MRLEtaken']  - $data['ULEtaken']  - $data['STLEtaken']  - $data['TLEtaken']
		 						- $data['HLEtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);

			if ($data['annualB'] < 0){
        	  $data['ALEtaken'] = abs($data['annualB']);
        	  $data['balanceleave'] = 0;
        	}
        	else{
        	  $data['balanceleave'] = $data['annualB'];
        	}
		}
		elseif($data['leavedet'][0]->leave_type == '2'){
		$data['balanceleave'] = $data['SLbalance'];
			if ($data['balanceleave'] < 0){
				//$data['SLEtaken'] = abs($data['SLbalance']);
				$data['balanceleave'] = 0;
			}
		}
		elseif($data['leavedet'][0]->leave_type == '3'){
		$data['balanceleave'] = (isset($data['userleave'][0]->limit_days) ? $data['userleave'][0]->limit_days : 0) - $data['ELtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '4'){
		$data['balanceleave'] = 0;
		}
		elseif($data['leavedet'][0]->leave_type == '5'){
		$data['balanceleave'] = 0;
		}
		elseif($data['leavedet'][0]->leave_type == '6'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['FStaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '7'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['MLtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '8'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['PLtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '9'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['MRLtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '10'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['ULtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '11'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['STLtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '12'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['TLtaken'];
		}
		elseif($data['leavedet'][0]->leave_type == '13'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['HLtaken'];
		}
		//leavebalance

//print_r($data);

		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_application',$data);
		$this->load->view('footer');
	}
}
?>
