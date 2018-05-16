<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class check_availability extends CI_Controller {
	public function index(){
		//$data['test'] = $this->input->get('type');
		$this->load->model('display_model');
		$data['probation'] = $this->display_model->probation($this->session->userdata('v_UserName'));
		$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$this->input->get('year'));
		$data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$this->input->get('year'));

		//$data['userleave'] = $this->display_model->userleave($data['leavedet'][0]->leave_type);
		$data['leave_type'] = $this->display_model->leave_type();

		$data['holiday_list'] = $this->display_model->holiday_list($this->session->userdata('v_UserName'),$this->input->get('year'));
		$data['hajjdata'] = $this->display_model->hajjdata($this->session->userdata('v_UserName'));

		if ($data['holiday_list']){
			foreach ($data['holiday_list'] as $key => $value) {
			    $data['holidayarray'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['holidayarray'][] = NULL;
		}

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
	            if($row->v_hospitalcode == 'JB'){
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

		$data['sickB'] = (isset($data['leaveacc'][0]->sick_leave) ? $data['leaveacc'][0]->sick_leave : 0) - $data['SLtaken'];
		if ($data['sickB'] < 0){
	        $data['SLEtaken'] = abs($data['sickB']);
	        $data['SLbalance'] = 0;
      	}
      	else{
    		$data['SLbalance'] = $data['sickB'];
      	}

      	$data['annualB'] = (isset($data['leaveacc'][0]->annual_leave) ? $data['leaveacc'][0]->annual_leave : 0) + (isset($data['leaveacc'][0]->carry_fwd_leave) ? $data['leaveacc'][0]->carry_fwd_leave : 0) 
	 						- $data['ALtaken'] - $data['ELtaken'] - $data['FSEtaken'] - $data['PLEtaken'] - $data['MLEtaken']  - $data['MRLEtaken']  - $data['ULEtaken']  - $data['STLEtaken']  - $data['TLEtaken']
	 						- $data['HLEtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);
	 	if ($data['annualB'] < 0){
            $data['ALEtaken'] = abs($data['annualB']);
            $data['ALbalance'] = 0;
      	}
      	else{
	        $data['ALbalance'] = $data['annualB'];
      	}
      	//$data['UPLbalance'] = $UPLtaken + (isset($ALEtaken) ? $ALEtaken : 0);
      	$data['ELbalance'] = (isset($data['leave_type'][2]->limit_days) ? $data['leave_type'][2]->limit_days : 0) - $data['ELtaken'];
      	$data['FSbalance'] = (isset($data['leave_type'][5]->entitle_days) ? $data['leave_type'][5]->entitle_days : 0) - $data['FStaken'];
      	$data['MLbalance'] = (isset($data['leave_type'][6]->entitle_days) ? $data['leave_type'][6]->entitle_days : 0) - $data['MLtaken'];
      	$data['PLbalance'] = (isset($data['leave_type'][7]->entitle_days) ? $data['leave_type'][7]->entitle_days : 0) - $data['PLtaken'];
      	$data['MRLbalance'] = (isset($data['leave_type'][8]->entitle_days) ? $data['leave_type'][8]->entitle_days : 0) - $data['MRLtaken'];
      	$data['ULbalance'] = (isset($data['leave_type'][9]->entitle_days) ? $data['leave_type'][9]->entitle_days : 0) - $data['ULtaken'];
      	$data['STLbalance'] = (isset($data['leave_type'][10]->entitle_days) ? $data['leave_type'][10]->entitle_days : 0) - $data['STLtaken'];
      	$data['TLbalance'] = (isset($data['leave_type'][11]->entitle_days) ? $data['leave_type'][11]->entitle_days : 0) - $data['TLtaken'];
      	$data['HLbalance'] = (isset($data['leave_type'][12]->entitle_days) ? $data['leave_type'][12]->entitle_days : 0) - $data['HLtaken'];
			


		/*$data['SLbalance'] = (isset($data['leaveacc'][0]->sick_leave) ? $data['leaveacc'][0]->sick_leave : 0) - $data['SLtaken'];
			if ($data['SLbalance'] < 0){
				$data['SLEtaken'] = abs($data['SLbalance']);
				//$data['balanceleave'] = 0;
			}
		if ($this->input->get('type') == '1'){
		$data['balanceleave'] = (isset($data['leaveacc'][0]->annual_leave) ? $data['leaveacc'][0]->annual_leave : 0) + (isset($data['leaveacc'][0]->carry_fwd_leave) ? $data['leaveacc'][0]->carry_fwd_leave : 0) 
		 						- $data['ALtaken'] - $data['ELtaken'] - $data['FSEtaken'] - $data['PLEtaken'] - $data['MLEtaken']  - $data['MRLEtaken']  - $data['ULEtaken']  - $data['STLEtaken']  - $data['TLEtaken']
		 						- $data['HLEtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);
		}
		elseif($this->input->get('type') == '2'){
		$data['balanceleave'] = $data['SLbalance'];
			if ($data['balanceleave'] < 0){
				//$data['SLEtaken'] = abs($data['SLbalance']);
				$data['balanceleave'] = 0;
			}
		}
		elseif($this->input->get('type') == '3'){
		$data['balanceleave'] = (isset($data['leave_type'][2]->limit_days) ? $data['leave_type'][2]->limit_days : 0) - $data['ELtaken'];
		}
		elseif($this->input->get('type') == '4'){
		$data['balanceleave'] = 0;
		}

		elseif($this->input->get('type') == '6'){
		$data['balanceleave'] = (isset($data['data['leave_type']'][5]->entitle_days) ? $data['leave_type'][5]->entitle_days : 0) - $data['FStaken'];
		}
		elseif($this->input->get('type') == '7'){
		$data['balanceleave'] = (isset($data['leave_type'][6]->entitle_days) ? $data['leave_type'][6]->entitle_days : 0) - $data['MLtaken'];
		}
		elseif($this->input->get('type') == '8'){
		$data['balanceleave'] = (isset($data['leave_type'][7]->entitle_days) ? $data['leave_type'][7]->entitle_days : 0) - $data['PLtaken'];
		}
		elseif($this->input->get('type') == '9'){
		$data['balanceleave'] = (isset($data['leave_type'][8]->entitle_days) ? $data['leave_type'][8]->entitle_days : 0) - $data['MRLtaken'];
		}
		elseif($this->input->get('type') == '10'){
		$data['balanceleave'] = (isset($data['leave_type'][9]->entitle_days) ? $data['leave_type'][9]->entitle_days : 0) - $data['ULtaken'];
		}
		elseif($this->input->get('type') == '11'){
		$data['balanceleave'] = (isset($data['leave_type'][10]->entitle_days) ? $data['leave_type'][10]->entitle_days : 0) - $data['STLtaken'];
		}
		elseif($this->input->get('type') == '12'){
		$data['balanceleave'] = (isset($data['leave_type'][11]->entitle_days) ? $data['leave_type'][11]->entitle_days : 0) - $data['TLtaken'];
		}
		elseif($this->input->get('type') == '13'){
		$data['balanceleave'] = (isset($data['leave_type'][12]->entitle_days) ? $data['leave_type'][12]->entitle_days : 0) - $data['HLtaken'];
		}*/

		echo json_encode($data);
		//exit();
	}
}