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
function u_addheademployee($head_data,$userid){

	$query = $this->db->get_where('group', array(//making selection
            'group_sup_id' => $userid,
        ));

 if ($query->num_rows() === 0) {
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
}
?>
