<?php
class insert_model extends CI_Model{
function __construct() {
parent::__construct();
}
function leavereq($insert_data){
	$this->db->insert('employee_leave_req', $insert_data);
}
function sickleave_img($insertimg_data){
	$this->db->insert('sick_leave_img', $insertimg_data);
	//echo $this->db->last_query();
	//exit();
}
function addempleaves($insert_data){
	$this->db->where('year',$insert_data['year']);
	$this->db->where('user_id',$insert_data['user_id']);
	 $query = $this->db->get('employee_leave');
	 if ($query->num_rows()===0){
		$this->db->insert('employee_leave', $insert_data);
	 }
//$this->db->insert('employee_leave', $insert_data);
}
function empleave_exist($value1,$variable1,$value2,$variable2){
			$this->db->select($value1,$value2);
			$this->db->where($value1,$variable1);
			$this->db->where($value2,$variable2);

			$query = $this->db->get('employee_leave');

			if($query->num_rows()>0){

				$this->load->model('update_model');
				$insert_data = array(//'user_id' => $this->input->post('employee_name'),
									//'year' => $this->input->post('sel_year'),
									'annual_leave' => $this->input->post('n_casual'),
									'carry_fwd_leave' => $this->input->post('n_carryfoward'),
									'sick_leave' => $this->input->post('n_sick'),
									'earned_leave' => $this->input->post('n_earned'),
									'remarks' => $this->input->post('reason')
									);
				$this->update_model->u_addempleaves($insert_data,$variable1,$variable2);
				//print_r($insert_data);
				//exit();
				//echo $this->db->last_query();
				//exit();
			}
			else{
				$insert_data = array('user_id' => $this->input->get('employee_name'),
									'year' => $this->input->get('sel_year'),
									'annual_leave' => $this->input->post('n_casual'),
									'carry_fwd_leave' => $this->input->post('n_carryfoward'),
									'sick_leave' => $this->input->post('n_sick'),
									'earned_leave' => $this->input->post('n_earned'),
									'remarks' => $this->input->post('reason')
									);
				$this->insert_model->addempleaves($insert_data);
				//echo $this->db->last_query();
				//exit();
			}

}
function addemployee($insert_data){
	$this->db->insert('pmis2_sa_user', $insert_data);
}
function addheademployee($head_data){
	$this->db->insert('group', $head_data);
}
function addprobation($probation_stat){
	$this->db->insert('staff_probation', $probation_stat);
}

function employee_exist($value1,$variable1,$value2,$variable2,$emp_type){
			$this->db->select("$value1, $value2");
			$this->db->where($value1,$variable1);
			//$this->db->group_start();
			//$this->db->where('v_Actionflag');
			//$this->db->or_where('v_Actionflag !=','D');
			//$this->db->group_end();
			// $this->db->where($value2,$variable2);
			$query = $this->db->get('pmis2_sa_user');

			if( $query->num_rows()>0 && $query->row()->$value2==$variable2 ){

				$this->load->model('update_model');
				$af=($this->input->post('del_user')) ? $this->input->post('del_user') : 'I';
				$insert_data = array(
									 'grade' => $this->input->post('emp_grade'),
									 'design_emp' => $this->input->post('emp_desg'),
									 'v_GroupID' => $this->input->post('dept_code'),
									 'v_hospitalcode' => $this->input->post('state'),
									 'site_state' => $this->input->post('hosp_code'),
									 'v_email' => $this->input->post('emp_email'),
									 'phone_no' => $this->input->post('phone_no'),
									 'v_ActiveUser' => $this->input->post('emp_lvl'),
									 'd_datejoin' => $this->input->post('date_join'),
									 'd_dateleft' => $this->input->post('date_terminate'),
									 'v_Actionflag' => $af,
									);
				$this->update_model->u_addemployee($insert_data,$variable1,$variable2);

				$this->load->model('outside_model');
				$this->outside_model->changeflag($variable1,  $af);

				if ($emp_type == 'Head'){
						$head_data = array(
										   'group_name' => $this->input->post('dept_code'),
										   //'group_sup_id' => $this->input->post('emp_uname'),
										   'report_to' => $this->input->post('report_to')
										   );
						//$this->update_model->u_addheademployee($head_data,$variable1);
				}elseif($emp_type=='Employee'){
					$head_data = array(
											'group_name' => $this->input->post('dept_code'),
											'group_sup_id' => $this->input->post('emp_uname').'D',
											);
				}
						$this->update_model->u_addheademployee($head_data,$variable1,$emp_type);


				if ($this->input->post('probation_stat') != 'Y'){
					$this->db->select('userid');
					$this->db->where('userid',$variable1);
					$this->db->where('action_flag <>','D');

					$query = $this->db->get('staff_probation');

					if($query->num_rows()>0){
						$probation_stat = array(
											//'userid' => $this->input->post('emp_name'),
											'action_flag'  => 'D',
											);
						$this->update_model->u_addprobation($probation_stat,$variable1);
					}
				}
				else{
					$this->db->select('userid');
					$this->db->where('userid',$variable1);

					$query = $this->db->get('staff_probation');

					if($query->num_rows()<=0){
						$probation_stat = array(
												'userid' => $this->input->post('emp_uname'),
												'action_flag'  => $this->input->post('probation_stat'),
												);
						$this->insert_model->addprobation($probation_stat);
					}
					else{
						$probation_stat = array(
											//'userid' => $this->input->post('emp_name'),
											'action_flag'  => $this->input->post('probation_stat'),
											);
						$this->update_model->u_addprobation($probation_stat,$variable1);
					}
				}

				//flexwork
				if ($this->input->post('flex_work') != '1'){
					$this->db->select('userid');
					$this->db->where('userid',$variable1);
					$this->db->where('action_flag <>','D');

					$query = $this->db->get('flex_working');

					if($query->num_rows()>0){
						$flex_Work = array(
										'yn' => '0',
										'action_flag'  => 'U'
											);

						$this->update_model->upflex($flex_Work,$variable1);
					}
				}
				else{
					$this->db->select('userid');
					$this->db->where('userid',$variable1);

					$query = $this->db->get('flex_working');

					if($query->num_rows()<=0){
						$flex_Work = array(
												'yn' => $this->input->post('flex_work'),
												'userid' => $this->input->post('emp_uname'),
												'action_flag'  => 'I',
												);
						$this->insert_model->addflex($flex_Work);
					}
					else{
						$flex_Work = array(
										    'yn' => $this->input->post('flex_work'),
											'action_flag'  => 'U',
											);
						$this->update_model->upflex($flex_Work,$variable1);
					}
				}
				//print_r($insert_data);
				//exit();
				//echo $this->db->last_query();
				//exit();

			}
			else if( $query->num_rows()<1 ){
				$insert_data = array(
									 'v_UserID' => $this->input->post('emp_uname'),
									 'v_UserName' => $this->input->post('emp_name'),
									 'apsb_no' => $this->input->post('emp_apsb'),
									 'grade' => $this->input->post('emp_grade'),
									 'design_emp' => $this->input->post('emp_desg'),
									 'v_GroupID' => $this->input->post('dept_code'),
									 'v_hospitalcode' => $this->input->post('state'),
									 'site_state' => $this->input->post('hosp_code'),
									 'v_email' => $this->input->post('emp_email'),
									 'phone_no' => $this->input->post('phone_no'),
									 'v_ActiveUser' => $this->input->post('emp_lvl'),
									 'd_datejoin' => $this->input->post('date_join'),
									 'd_dateleft' => $this->input->post('date_terminate'),
									 'v_Actionflag' => 'I',
									 'v_password' => md5($this->input->post('emp_pass'))
									);
				$this->insert_model->addemployee($insert_data);

				if ($emp_type == 'Head'){
					$head_data = array(
									   'group_name' => $this->input->post('dept_code'),
									   'group_sup_id' => $this->input->post('emp_uname'),
									   'report_to' => $this->input->post('report_to')
									   );
					$this->insert_model->addheademployee($head_data);
				}
				if ($this->input->post('probation_stat') == 'Y'){
					$probation_stat = array(
											'userid' => $this->input->post('emp_uname'),
											'action_flag'  => $this->input->post('probation_stat'),
											);
					$this->insert_model->addprobation($probation_stat);
				}


				$this->load->model('outside_model');

				$insert_data2 = array(
									 'v_UserID' => $this->input->post('emp_uname'),
									 'v_UserName' => $this->input->post('emp_name'),
									 'v_password' => md5($this->input->post('emp_pass')),
									 'v_sec_dt'=> date("Y-m-d", strtotime('-5 month')),
									 'v_Actionflag' => 'I'
									);

				$this->outside_model->addemployee($insert_data2);
				//echo $this->db->last_query();
				//exit();
			}
			else{
				$this->session->set_flashdata("msg","Username Already Exists.");
				return false;
			}

}
function leave_limit($insert_data){
	$this->db->insert_batch('leave_type',$insert_data);
}
function leave_limit_exist(){
			$this->db->select('*');

			$query = $this->db->get('leave_type');

			if($query->num_rows()>0){
			$insert_data = array(
				array('leave_name' => 'Annual Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Sick Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Emergency Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Unpaid Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Extended Sick Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Family Sick Leave',
					  'entitle_days' => $this->input->post('family_sick_l')),
				array('leave_name' => 'Maternity Leave',
					  'entitle_days' => $this->input->post('maternity_l')),
				array('leave_name' => 'Paternity Leave',
					  'entitle_days' => $this->input->post('paternity_l')),
				array('leave_name' => 'Marriage Leave',
					  'entitle_days' => $this->input->post('marriage_l')),
				array('leave_name' => 'Unrecorded Leave',
					  'entitle_days' => $this->input->post('unrecorded_l')),
				array('leave_name' => 'Study Leave',
					  'entitle_days' => $this->input->post('study_l')),
				array('leave_name' => 'Transfer Leave',
					  'entitle_days' => $this->input->post('transfer_l')),
				array('leave_name' => 'Hajj Leave',
					  'entitle_days' => $this->input->post('hajj_l')),
			);
				$this->load->model('update_model');
				$this->update_model->u_leave_limit($insert_data);
				//print_r($insert_data);
				//exit();
				//echo $this->db->last_query();
				//exit();
			}
			else{
			$insert_data = array(
				array('leave_name' => 'Annual Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Sick Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Emergency Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Unpaid Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Extended Sick Leave',
					  'entitle_days' => 0),
				array('leave_name' => 'Family Sick Leave',
					  'entitle_days' => $this->input->post('family_sick_l')),
				array('leave_name' => 'Maternity Leave',
					  'entitle_days' => $this->input->post('maternity_l')),
				array('leave_name' => 'Paternity Leave',
					  'entitle_days' => $this->input->post('paternity_l')),
				array('leave_name' => 'Marriage Leave',
					  'entitle_days' => $this->input->post('marriage_l')),
				array('leave_name' => 'Unrecorded Leave',
					  'entitle_days' => $this->input->post('unrecorded_l')),
				array('leave_name' => 'Study Leave',
					  'entitle_days' => $this->input->post('study_l')),
				array('leave_name' => 'Transfer Leave',
					  'entitle_days' => $this->input->post('transfer_l')),
				array('leave_name' => 'Hajj Leave',
					  'entitle_days' => $this->input->post('hajj_l')),
			);
				$this->insert_model->leave_limit($insert_data);
				//echo $this->db->last_query();
				//exit();
			}

}

	function update_process_leave_status(){
		$data = array(
					"v_UserName" => $this->session->v_UserName,
					"leavereq_id" => $this->input->post("leave_id"),
				);
		if( $this->input->post("status")==1 ){

			$this->db->select("COUNT(*) AS jumlah");
			$this->db->from("processed_leave");
			$this->db->where("leavereq_id", $this->input->post("leave_id"));
			$query = $this->db->get();
			$check_old_data = $query->row()->jumlah;

			if( $check_old_data > 0 ){
				$this->db->where("leavereq_id", $this->input->post("leave_id"));
				$this->db->set('date_processed', 'NOW()', FALSE);
				$this->db->set('v_actionflag', 'U');
				$res = $this->db->update("processed_leave", $data);
			}else{
				$this->db->set('date_processed', 'NOW()', FALSE);
				$this->db->set('v_actionflag', 'I');
				$res = $this->db->insert("processed_leave", $data);
			}
		}else{
			$this->db->where("leavereq_id", $this->input->post("leave_id"));
			$this->db->set('date_processed', 'NOW()', FALSE);
			$this->db->set('v_actionflag', 'D');
			$res = $this->db->update("processed_leave", $data);
			// $res = $this->db->where("leavereq_id", $this->input->post("leave_id"))->update("processed_leave", array("v_actionflag"=>"D"));
		}
	}
		function addflex($insert_data){
    $this->db->insert('flex_working', $insert_data);
}
function simpan_personal($insert_data,$update_data){
	$this->load->model('update_model');
	$this->db->where('v_user_id',$this->session->userdata('v_UserName'));
    $query = $this->db->get('pmis2_sa_details');
    if ($query->num_rows() > 0){
    $this->update_model->update_personal($update_data);
	return true;
	}
    else{
	$this->db->insert('pmis2_sa_details',$insert_data);
    return $this->db->insert_id();
    }

  }

 function simpan_anak($insert_data){
	$this->db->insert('pmis2_sa_child',$insert_data);
return true;
  }

 function simpan_emg($insert_data){
	$this->db->insert('pmis2_sa_emgct',$insert_data);
return true;
  }

  function simpan_fam($insert_data){
	$this->db->insert('pmis2_sa_family_link',$insert_data);
return true;
  }

  function save_buletin($insert_data){
	$this->db->insert('ebuletin',$insert_data);
	$id = $this->db->insert_id();
	return $id;
}
}
?>
