<?php
   class update_model extends CI_Model{
function __construct() {
parent::__construct();
}
function updatestatus($insert_data,$userid,$regid){
	$this->db->where('user_id',$userid);
	$this->db->where('id',$regid);
	$this->db->update('employee_leave_req', $insert_data);
}
function u_addempleaves($insert_data,$userid,$year){
	$this->db->where('user_id',$userid);
	$this->db->where('year',$year);
	$this->db->update('employee_leave', $insert_data);
}
function u_addemployee($insert_data,$userid,$apsbno){
	$this->db->where('v_UserID',$userid);
	$this->db->where('apsb_no',$apsbno);
	$this->db->update('pmis2_sa_user', $insert_data);
}
/*
function u_addheademployee($head_data,$userid){
	$this->db->where('group_sup_id',$userid);
	$this->db->update('group', $head_data);
}
*/
function u_addheademployee($head_data,$userid,$emptype){

	$query = $this->db->get_where('group', array(//making selection
            'group_sup_id' => $userid,
        ));

 if ($query->num_rows() === 0 && $emptype=='Head') {
    $masukbaru = array('group_name'=>$head_data['group_name'],'group_sup_id'=>$userid,'report_to'=>$head_data['report_to']);
	$this->db->insert('group', $masukbaru);
     }else {
	$this->db->where('group_sup_id',$userid);
	$this->db->update('group', $head_data);
		   }
}
function u_addprobation($probation_stat,$userid){
	$this->db->where('userid',$userid);
	$this->db->update('staff_probation', $probation_stat);
}
function u_leave_limit($insert_data){
	$this->db->update_batch('leave_type', $insert_data, 'leave_name');
}
function upflex($updflex,$userid){

	$this->db->where('userid',$userid);
    $this->db->update('flex_working', $updflex);
/* 	 echo $this->db->last_query();
 exit(); */
}

function update_personal($insert_data){
	 $this->db->where('v_user_id',$this->session->userdata('v_UserName'));
	$this->db->update('pmis2_sa_details', $insert_data);
}
function update_anak($id,$insert_data){
	 $this->db->where('id',$id);
	$this->db->update('pmis2_sa_child', $insert_data);
}
function delete_anak($del){
	//print_r($del);exit();
	$del_data=array('v_Actionflag'=>'D');
	 $this->db->where_in('id',$del);
	$this->db->update('pmis2_sa_child', $del_data);
}
function update_emg($id,$insert_data){
	 $this->db->where('id',$id);
	$this->db->update('pmis2_sa_emgct', $insert_data);
}
function delete_emg($del){
	//print_r($del);exit();
	$del_data=array('v_Actionflag'=>'D');
	 $this->db->where_in('id',$del);
	$this->db->update('pmis2_sa_emgct', $del_data);
}
function update_fam($id,$insert_data){
	$this->db->where('id',$id);
   $this->db->update('pmis2_sa_family_link', $insert_data);
}
function delete_fam($del){
	$del_data=array('v_Actionflag'=>'D');
	$this->db->where_in('id', $del);
	$this->db->update('pmis2_sa_family_link', $del_data);

}
}
?>
