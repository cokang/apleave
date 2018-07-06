<?php
class display_model extends CI_Model
{
function __construct() {
parent::__construct();
}
	function leavelist_c($userid){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->where('user_id',$userid);
		$this->db->from('employee_leave_req');
		$this->db->order_by('leave_from','Desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leavelist($userid,$limit,$start){
		$this->db->select('*');
		$this->db->where('user_id',$userid);
		$this->db->from('employee_leave_req');
		$this->db->order_by('leave_from','Desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function get_reqid($datepick,$userid){
		$this->db->select('id,user_id,leave_from');
		$this->db->where('user_id',$userid);
		$this->db->where('leave_from',$datepick);
		$this->db->from('employee_leave_req');
		$this->db->limit(1);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function getgroupdet($userid){
		$this->db->select('v_UserID,v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveapp_c($group){
		$this->db->select('COUNT(*) AS jumlah,U.v_GroupID');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->join('group G','G.group_sup_id = U.v_UserID','left');
		$this->db->where('U.v_UserID <>',$this->session->userdata('v_UserName'));
		//$this->db->where('U.v_GroupID',$group);
		$this->db->or_where('G.report_to',$this->session->userdata('v_UserName'));
		$this->db->order_by('R.leave_from','Desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}	
	function leaveapp($group,$limit,$start){
		$this->db->select('R.*,U.v_GroupID,U.v_UserName');
		//$this->db->select('R.*,U.v_GroupID');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->join('group G','G.group_sup_id = U.v_UserID','left');
		$this->db->where('U.v_UserID <>',$this->session->userdata('v_UserName'));
		//$this->db->where('U.v_GroupID',$group);
		$this->db->or_where('G.report_to',$this->session->userdata('v_UserName'));
		//$this->db->order_by('R.leave_from','Desc');
		$this->db->order_by('R.application_date','desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leavedet($userid,$regid){
		$this->db->select('R.*,U.v_hospitalcode,im.file_name');
		$this->db->from('employee_leave_req R');
		$this->db->join('sick_leave_img im','R.user_id = im.user_id AND R.id = im.leavereq_id','left');
		$this->db->join('pmis2_sa_user U','R.user_id = v_UserID');
		$this->db->where('R.user_id',$userid);
		$this->db->where('R.id',$regid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function samedateleave_c($fromdate,$todate,$userid){
		$this->db->select('COUNT(*) AS jumlah');
		//$this->db->where('leave_from',$fromdate);
		$this->db->where("'".$fromdate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		$this->db->or_where("'".$todate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$query = $this->db->get();
		echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function samedateleave($fromdate,$todate,$userid,$limit,$start){
		$this->db->select('R.*,U.v_UserName,U.v_hospitalcode');
		//$this->db->where('leave_from',$fromdate);
		$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		$this->db->or_where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflist_c(){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('pmis2_sa_user');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflistlim($limit,$start){
		$this->db->select('v_UserID,v_UserName,v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflist(){
		$this->db->select('v_UserID,v_UserName,v_GroupID');
		$this->db->from('pmis2_sa_user');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacc($userid,$year){
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacc_c($userid,$year){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacclim($userid,$year,$limit,$start){
		//$this->db->select('L.*,U.v_UserName');
		$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetaken($userid,$year){
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('user_id',$userid);
		$this->db->where('YEAR(leave_from)',$year);
		$this->db->where('leave_status','Approved');
		//$this->db->where('leave_status','Accepted');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	/*function leaveaccallb($year){
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}*/
	
	function leaveaccall_c($year){ //4
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalld_c($dept,$year){ //2
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallds_c($dept,$staff,$year){ //1
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalls_c($staff,$year){ //3
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallda_c($dept,$apsbno,$year){ //5
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldsa_c($dept,$staff,$apsbno,$year){ //6
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalla_c($apsbno,$year){ //7
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallas_c($staff,$apsbno,$year){ //8
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccall($year,$limit,$start){ //d4
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallp($year){ //p4
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalld($dept,$year,$limit,$start){ //d2
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldp($dept,$year){ //p2
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallds($dept,$staff,$year,$limit,$start){ //d1
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldsp($dept,$staff,$year){ //p1
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalls($staff,$year,$limit,$start){ //d3
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallsp($staff,$year){ //p3
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallda($dept,$apsbno,$year,$limit,$start){ //d5
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldap($dept,$apsbno,$year){ //p5
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldsa($dept,$staff,$apsbno,$year,$limit,$start){ //d6
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldsap($dept,$staff,$apsbno,$year){ //p6
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalla($apsbno,$year,$limit,$start){ //d7
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallap($apsbno,$year){ //p7
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallsa($staff,$apsbno,$year,$limit,$start){ //d8
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallsap($staff,$apsbno,$year){ //p8
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenall($year){ //d42
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('YEAR(leave_from)',$year);
		$this->db->where('leave_status','Accepted');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalld($dept,$year){ //d22
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallds($dept,$staff,$year){ //d12
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.v_UserName',$staff);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalls($staff,$year){ //d32
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.v_UserName',$staff);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallda($dept,$apsbno,$year){ //d52
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.apsb_no',$apsbno);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalldsa($dept,$staff,$apsbno,$year){ //d62
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalla($apsbno,$year){ //d72
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.apsb_no',$apsbno);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallsa($staff,$apsbno,$year){ //d82
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		$this->db->where('R.leave_status','Accepted');
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->like('U.v_UserName',$staff);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function employeedet($userid){
		$this->db->select('*');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function emptype($userid){
		$this->db->select('*');
		$this->db->from('group');
		$this->db->where('group_sup_id',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function reportto($userid){
		$this->db->select('G.*,U.v_UserName');
		$this->db->from('group G');
		$this->db->join('pmis2_sa_user U','G.group_sup_id = U.v_UserID');
		$this->db->where('group_sup_id <>',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function statelist(){
		$this->db->select('*');
		$this->db->from('state_list');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function hosplist(){
		$this->db->select('*');
		$this->db->from('pmis2_sa_hospital');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function getheadrow($userid){
		$this->db->select('*');
		$this->db->from('group');
		$this->db->where('group_sup_id',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->num_rows();
		return $query_result;
	}
	function gethrrow($userid){
		$this->db->select('*');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid);
		//$this->db->where('v_GroupID','HR');
		$this->db->where('v_Remarks','HR');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->num_rows();
		return $query_result;
	}
	function alternate($userid,$group){
		$this->db->select('v_UserID,v_UserName,v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_GroupID',$group);
		$this->db->where('v_UserID <>',$userid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function dept_list(){
		$this->db->select('v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->group_by('v_GroupID');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holiday_list($userid,$year){
		$this->db->select('H.date_holiday');
		$this->db->from('holiday_list H');
		$this->db->join('pmis2_sa_user U','U.v_hospitalcode = H.state');
		$this->db->where('U.v_UserID',$userid);
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holidayJB($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','JB');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holidayMKA($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','MKA');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holidayNS($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','NS');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holidaySEL($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','SEL');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leave_type(){
		$this->db->select('*');
		$this->db->from('leave_type');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function userleave($leaveid){
		$this->db->select('*');
		$this->db->from('leave_type');
		$this->db->where('id',$leaveid);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function hajjdata($userid){
		$this->db->select('*');
		$this->db->from('employee_leave_req');
		$this->db->where('user_id',$userid);
		$this->db->where('leave_type','13');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->num_rows();
		return $query_result;
	}
	function probation($userid){
		$this->db->select('*');
		$this->db->from('staff_probation');
		$this->db->where('userid',$userid);
		$this->db->where('action_flag <>','D');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->num_rows();
		return $query_result;
	}
	function datecalendar_c($fromdate){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->where("'".$fromdate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		//$this->db->where('leave_from',$fromdate);
		//$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function datecalendar($fromdate,$limit,$start){
		$this->db->select('R.*,U.v_UserName,U.v_hospitalcode,T.leave_name');
		//$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$this->db->join('leave_type T','T.id = R.leave_type');	
		$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		//$this->db->where('leave_from',$fromdate);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function printrec($id){
		$this->db->select('l.*,u.v_UserName,u.apsb_no,u.v_GroupID,u.v_hospitalcode,u.design_emp,u.grade,s.state,e.annual_leave,e.carry_fwd_leave,e.sick_leave,e.earned_leave,h.v_HospitalName');
		$this->db->from('employee_leave_req l');
		$this->db->join('pmis2_sa_user u','l.user_id = u.v_UserID');
		$this->db->join('state_list s','u.v_hospitalcode = s.state_code');
		$this->db->join('employee_leave e','l.user_id = e.user_id AND e.year = YEAR(leave_from)','left');
		$this->db->join('pmis2_sa_hospital h','u.site_state = h.v_HospitalCode','left');
		$this->db->where('l.id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function staffreplacement($repstaff){
		$this->db->select('v_UserID,v_UserName,apsb_no,design_emp,v_email,v_GroupID,v_hospitalcode,phone_no');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$repstaff);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}

	function tleavetakenprint($userid,$fromdate,$year){
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('user_id',$userid);
		$this->db->where('leave_from <= ',$fromdate);
		$this->db->where('YEAR(leave_from)',$year);
		$this->db->where('leave_status','Accepted');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}

	function probationchk($userid){
		$this->db->select('*');
		$this->db->from('staff_probation');
		$this->db->where('userid',$userid);
		$this->db->where('action_flag','Y');
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	
	function getrptemail($userid){
		$this->db->select('a.v_email, a.v_UserName');
		$this->db->from('pmis2_sa_user a');
		$this->db->join('group b','a.v_UserID = b.report_to');
		//$this->db->where('b.group_sup_id ',$this->session->userdata('v_UserName')); 
		$this->db->where('b.group_sup_id ',$userid); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	
	function getrptemail2($userid){
		$this->db->select('a.v_email, a.v_UserName');
		$this->db->from('pmis2_sa_user a');
		$this->db->join('group b','a.v_UserID = b.group_sup_id ');
		//$this->db->where('b.group_sup_id ',$this->session->userdata('v_UserName')); 
		$this->db->where('b.group_name ',$userid); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	
	function getbhguser($userid){
		$this->db->select('v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid); 
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	
}
?>