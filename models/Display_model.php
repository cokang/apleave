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
		$this->db->select('r.*,u.v_UserName, l.leave_name');
		$this->db->where('user_id',$userid);
		$this->db->group_start();
		$this->db->where('u.v_Actionflag');
		$this->db->or_where('u.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->from('employee_leave_req r');
		$this->db->join('pmis2_sa_user u','r.user_id = u.v_UserID','left');
		$this->db->join('leave_type l','l.id = r.leave_type','left');
		$this->db->order_by('leave_from','Desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->order_by('R.leave_from','Desc');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}

	function leaveapp($group,$limit,$start){
		$this->db->select('R.*,U.v_GroupID,U.v_UserName,L.leave_name');
		//$this->db->select('R.*,U.v_GroupID');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->join('group G','G.group_sup_id = U.v_UserID','left');
		$this->db->join('leave_type L','L.id = R.leave_type','left');
		//$this->db->where('U.v_GroupID',$group);
		//$this->db->or_where('G.report_to',$this->session->userdata('v_UserName'));
		$this->db->where("(U.v_GroupID = '".$group. "' OR G.report_to = '".$this->session->userdata('v_UserName')."')");
		$this->db->where('U.v_UserID <>',$this->session->userdata('v_UserName'));
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->order_by('R.leave_from','Desc');
		$this->db->order_by('R.leave_status IS NULL','desc',false);
		$this->db->order_by('R.application_date','desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}

	function leavedet($userid,$regid){
		//echo "klklklkll:";
		$this->db->select('R.*,U.v_hospitalcode,im.file_name,UR.v_UserName as employee_replaced,U.v_UserName, U.apsb_no');
		$this->db->from('employee_leave_req R');
		$this->db->join('sick_leave_img im','R.user_id = im.user_id AND R.id = im.leavereq_id','left');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->join('pmis2_sa_user UR','R.employee_replaced = UR.v_UserID','left');
		$this->db->where('R.user_id',$userid);
		$this->db->where('R.id',$regid);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}

	function samedateleave_c($fromdate,$todate,$userid){
		$fromdate	= date("Y-m-d", $fromdate);
		$todate		= date("Y-m-d", $todate);

		$this->db->select('COUNT(*) AS jumlah');
		//$this->db->where('leave_from',$fromdate);
		$this->db->where("'".$fromdate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		$this->db->or_where("'".$todate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function samedateleave($fromdate,$todate,$userid,$limit,$start,$group=''){
		//$this->db->select('R.*,U.v_UserName,U.v_hospitalcode');
		$this->db->select('R.*,U.v_UserName,U.v_hospitalcode, LT.leave_name');
		//$this->db->where('leave_from',$fromdate);
		$this->db->group_start();
		$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		$this->db->or_where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		$this->db->group_end();
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$this->db->join('leave_type LT', 'R.leave_type = LT.id');
		$this->db->join('group G','G.group_sup_id = U.v_UserID','left');
		$this->db->where("(U.v_GroupID = '".$group. "' OR G.report_to = '".$this->session->userdata('v_UserName')."')");
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->where('user_id <>',$userid);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflist_c(){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('pmis2_sa_user');
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflistlim($staff,$limit,$start){
		$this->db->select('v_UserID,v_UserName,v_GroupID');
		$this->db->from('pmis2_sa_user');

		//$searcharray = array(
    //            'apsb_no' => $staff,
    //            'v_UserName' => $staff,
    //        );
    //    $this->db->or_like($searcharray);

		if($staff!=""){
			$this->db->group_start();
			$this->db->like("apsb_no", $staff);
			$this->db->or_like("v_UserName", $staff);
			$this->db->group_end();
		}

		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		 //echo $this->db->last_query();
	    // exit();
		$query_result = $query->result();
		return $query_result;
	}
	function stafflist(){
		$this->db->select('v_UserID,v_UserName,v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacc($userid,$year){
		//$this->db->select('L.*,U.v_UserName,U.v_UserName,ROUND(IFNULL(`L`.`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,U.v_UserName,FLOOR(IFNULL(`L`.`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacc_c($userid,$year){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveacclim($userid,$year,$limit,$start){
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('L.user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetaken($userid,$year){
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('user_id',$userid);
		//$this->db->where('YEAR(leave_from)',$year);
		$this->db->where("CASE
							WHEN leave_from!='' THEN YEAR(leave_from) = '2018'
							ELSE YEAR(leave_to) = '2018' AND leave_duration = 'Half Day'
						END");
		$this->db->where('leave_status','Approved');
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->where('L.year',$year);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalld_c($dept,$year){ //2
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccall($year,$limit,$start){ //d4
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallp($year){ //p4
		$this->db->select('L.*,U.v_UserName');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('user_id',$userid);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalld($dept,$year,$limit,$start){ //d2
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallds($dept,$staff,$year,$limit,$start){ //d1
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalls($staff,$year,$limit,$start){ //d3
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallda($dept,$apsbno,$year,$limit,$start){ //d5
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalldsa($dept,$staff,$apsbno,$year,$limit,$start){ //d6
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccalla($apsbno,$year,$limit,$start){ //d7
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function leaveaccallsa($staff,$apsbno,$year,$limit,$start){ //d8
		//$this->db->select('L.*,U.v_UserName');
		//$this->db->select('L.*,U.v_UserName,ROUND(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->select('L.*,U.v_UserName,FLOOR(IFNULL(`annual_leave`,0) / 12 * MONTH(CURRENT_DATE()))as entitled');
		$this->db->from('employee_leave L');
		$this->db->join('pmis2_sa_user U','L.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->like('U.v_UserName',$staff);
		$this->db->where('L.year',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->limit($limit,$start);
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenall($year){ //d42
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('YEAR(leave_from)',$year);
		//$this->db->where('leave_status','Accepted');
		$this->db->where('leave_status','Approved');
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalld($dept,$year){ //d22
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallds($dept,$staff,$year){ //d12
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.v_UserName',$staff);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalls($staff,$year){ //d32
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.v_UserName',$staff);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallda($dept,$apsbno,$year){ //d52
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalldsa($dept,$staff,$apsbno,$year){ //d62
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.v_UserName',$staff);
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenalla($apsbno,$year){ //d72
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function tleavetakenallsa($staff,$apsbno,$year){ //d82
		$this->db->select('R.*,U.v_hospitalcode');
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','R.user_id = U.v_UserID');
		//$this->db->where('U.v_GroupID',$dept);
		$this->db->where('YEAR(R.leave_from)',$year);
		//$this->db->where('R.leave_status','Accepted');
		$this->db->where('R.leave_status','Approved');
		$this->db->like('U.apsb_no',$apsbno);
		$this->db->like('U.v_UserName',$staff);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function employeedet($userid){
		$this->db->select('*');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid);
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->select('v_Remarks');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$userid);
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		//$this->db->where('v_GroupID','HR');
		//$this->db->where('v_Remarks','HR');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		//$query_result = $query->num_rows();
		return $query->row()->v_Remarks;
		//return $query_result;
	}
	function alternate($userid,$group){
		$this->db->select('a.v_UserID,a.v_UserName,a.v_GroupID');
		$this->db->from('pmis2_sa_user a');
		$this->db->join('group b','a.v_UserID = b.group_sup_id','left outer');
		$this->db->group_start();
		$this->db->where('a.v_Actionflag');
		$this->db->or_where('a.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->where('a.v_GroupID',$group);
		$this->db->where('a.v_UserID <>',$userid);
		$this->db->or_where('b.report_to =',$userid);
		$query = $this->db->get();
		//  echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function dept_list(){
		$this->db->select('v_GroupID');
		$this->db->from('pmis2_sa_user');
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->group_by('v_GroupID');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function holiday_list($userid,$year){
		$this->db->select('H.date_holiday');
		$this->db->from('holiday_list H');
		$this->db->join('pmis2_sa_user U','U.v_hospitalcode = H.state');
		$this->db->where('U.v_UserID',$userid);
		$this->db->where('YEAR(date_holiday)',$year);
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
	function holidayPHG($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','PHG');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		/* echo "pahang";
		exit(); */
		$query_result = $query->result();
		return $query_result;
	}
	function holidayKL($year){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state','KL');
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		/* echo "pahang";
		exit(); */
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
	function datecalendar_c($fromdate,$todate){
		$this->db->select('COUNT(*) AS jumlah');
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$this->db->where("'".$fromdate."' BETWEEN leave_from AND leave_to", NULL, FALSE);
		$this->db->or_where("R.leave_from BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
		$this->db->or_where("R.leave_to BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
		// $this->db->where('R.leave_from >=',$fromdate);
		// $this->db->where('R.leave_to <=',$todate);
		//$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	/*
	function datecalendar($fromdate,$limit,$start,$todate,$group=''){
		$this->db->select('R.*,U.v_UserName,U.v_hospitalcode,T.leave_name');
		//$this->db->where('user_id <>',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$this->db->join('leave_type T','T.id = R.leave_type');
		$this->db->join('group G','G.group_sup_id = U.v_UserID','left');
		$this->db->where("(U.v_GroupID = '".$group. "' OR G.report_to = '".$this->session->userdata('v_UserName')."')");
		$this->db->group_start();
		$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		$this->db->or_where("R.leave_from BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
		$this->db->or_where("R.leave_to BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
		$this->db->group_end();
		//$this->db->where('R.leave_from >=',$fromdate);
		//$this->db->where('R.leave_to <=',$todate);
		$this->db->limit($limit,$start);
		// $this->db->limit($limit);
		$query = $this->db->get();
		 echo "<pre>".$this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	*/

		function datecalendar($fromdate,$limit,$start,$todate,$group=''){
			$login_as	= $this->gethrrow($this->session->userdata('v_UserName'));
			$site_state	= $this->get_site($this->session->userdata('v_UserName'));
			$head		= $this->getheadrow($this->session->userdata('v_UserName'));
			$report_to	= $this->getreporttorow($this->session->userdata('v_UserName'));

			$this->db->select('R.*,U.v_UserName,U.v_hospitalcode,T.leave_name');
			//$this->db->where('user_id <>',$userid);
			$this->db->from('employee_leave_req R');
			$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
			$this->db->join('leave_type T','T.id = R.leave_type');
			// $this->db->join('group G','G.group_sup_id = U.v_UserID','left');/*noted:kenape yg ori ni join pakai group_sup_id=user_id?*/
			$this->db->join('group G','G.group_name = U.v_GroupID','left');

			$this->db->group_start();
			$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
			$this->db->or_where("R.leave_from BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
			$this->db->or_where("R.leave_to BETWEEN '".$fromdate."' AND '".$todate."'", NULL, FALSE);
			$this->db->group_end();

			if( !in_array($login_as, array("AA","HR")) ){
				if( $head || $report_to ){
					if( $report_to ){
						$this->db->group_start();
						$this->db->where("G.report_to", $this->session->userdata("v_UserName"));
						$this->db->or_where("U.v_GroupID", $group);
						$this->db->group_end();
					}else{
						$this->db->where("U.v_GroupID", $group);
					}
				}/*else{
					// $this->db->where("(U.v_GroupID = '".$group. "' OR G.report_to = '".$this->session->userdata('v_UserName')."')");
					$this->db->where("U.v_GroupID", $group);
					$this->db->or_where("G.report_to", $this->session->userdata('v_UserName'));
				}*/
			}
			if( $login_as=="AA" ){
				$this->db->where("U.site_state", $site_state);
				// $this->db->or_where("U.v_GroupID", $group);
			}
			$this->db->group_start();
			$this->db->where('U.v_Actionflag');
			$this->db->or_where('U.v_Actionflag !=','D');
			$this->db->group_end();

			/*$this->db->where('R.leave_from >=',$fromdate);
			$this->db->where('R.leave_to <=',$todate);*/
			$this->db->limit($limit,$start);
			// $this->db->limit($limit);
			$query = $this->db->get();
			// echo $this->db->last_query();
			// exit();
			$query_result = $query->result();
			return $query_result;
		}

	function printrec($id){
		$this->db->select('l.*, u.v_UserName, u.apsb_no, u.v_GroupID, u.v_hospitalcode ,u.design_emp, u.grade, s.state, e.annual_leave, e.carry_fwd_leave, e.sick_leave, e.earned_leave, h.v_HospitalName');
		$this->db->from('employee_leave_req l');
		$this->db->join('pmis2_sa_user u','l.user_id = u.v_UserID');
		$this->db->join('state_list s','u.v_hospitalcode = s.state_code');
		$this->db->join('employee_leave e','l.user_id = e.user_id AND e.year = YEAR(leave_from)','left');
		$this->db->join('pmis2_sa_hospital h','u.site_state = h.v_HospitalCode','left');
		$this->db->where('l.id',$id);
		$this->db->group_start();
		$this->db->where('u.v_Actionflag');
		$this->db->or_where('u.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}
	function staffreplacement($repstaff){
		$this->db->select('v_UserID,v_UserName,apsb_no,design_emp,v_email,v_GroupID,v_hospitalcode,phone_no');
		$this->db->from('pmis2_sa_user');
		$this->db->where('v_UserID',$repstaff);
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		//$this->db->where('leave_status','Accepted');
		$this->db->where('leave_status','Approved');
		$this->db->group_start();
		$this->db->where('U.v_Actionflag');
		$this->db->or_where('U.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
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
		$this->db->group_start();
		$this->db->where('a.v_Actionflag');
		$this->db->or_where('a.v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result();
		return $query_result;
	}

	function getrptemail2($userid){
		$this->db->select('a.v_email, a.v_UserName');
		$this->db->from('pmis2_sa_user a');
		$this->db->join('group b','a.v_UserID = b.group_sup_id ');
		//$this->db->where('b.group_sup_id ',$this->session->userdata('v_UserName'));
		$this->db->where('b.group_name ',$userid);
		$this->db->group_start();
		$this->db->where('a.v_Actionflag');
		$this->db->or_where('a.v_Actionflag !=','D');
		$this->db->group_end();
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
		$this->db->group_start();
		$this->db->where('v_Actionflag');
		$this->db->or_where('v_Actionflag !=','D');
		$this->db->group_end();
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}

	function applied_date($userid){
		$this->db->select('leave_from,leave_to');
		$this->db->from('employee_leave_req');
		$this->db->where('user_id',$userid);
		// $this->db->where_in("leave_status", array("Pending", "Cancelled"));//where leave_status cancel/rejected/null
		// $this->db->or_where("leave_status", NULL);
		$this->db->where("(`leave_status` IN('Pending', 'Cancelled') OR `leave_status` IS NULL)");
		$this->db->where('leave_status','Declined');
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
		$query_result = $query->result_array();
		return $query_result;
	}


	function check_range($fromdate,$todate,$userid){
			if($fromdate!=""){
				$fromdate 	= date("Y-m-d", strtotime($fromdate));
			}
			if($todate!=""){
				$todate		= date("Y-m-d", strtotime($todate));
			}
			$this->db->select('count(*) as has_applied');
			// $this->db->where('leave_from',$fromdate);

			if( $fromdate!="" && $todate=="" ){
				$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
			}
			if( $fromdate=="" && $todate!="" ){
				$this->db->where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
			}
			if( $fromdate!="" && $todate!="" ){
				// ori
				// $this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
				// $this->db->or_where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
				// $this->db->or_where("R.leave_from BETWEEN '$fromdate' AND '$todate'", NULL, FALSE);
				// $this->db->or_where("R.leave_to BETWEEN '$fromdate' AND '$todate'", NULL, FALSE);

				$this->db->where("('".$fromdate."' BETWEEN R.leave_from AND R.leave_to OR '".$todate."' BETWEEN R.leave_from AND R.leave_to OR R.leave_from BETWEEN '$fromdate' AND '$todate' OR R.leave_to BETWEEN '$fromdate' AND '$todate')", NULL, FALSE);
			}

			$this->db->where('user_id',$userid);
			$this->db->where("R.leave_status", "Approved");
			$this->db->group_start();
			$this->db->where('U.v_Actionflag');
			$this->db->or_where('U.v_Actionflag !=','D');
			$this->db->group_end();
			// $this->db->where("R.leave_status IS NOT NULL", NULL, FALSE);
			$this->db->from('employee_leave_req R');
			$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
			$query = $this->db->get()->row()->has_applied;
			// echo $this->db->last_query();
			// exit();
			// $query_result = $query->result();
			// echo $query; // pakai utk return value js
			// return $query_result;
		}



		function getaarow($userid){
			$this->db->select('*');
			$this->db->from('pmis2_sa_user');
			$this->db->where('v_UserID',$userid);
			//$this->db->where('v_GroupID','HR');
			$this->db->where('v_Remarks','AA');
			$this->db->group_start();
			$this->db->where('v_Actionflag');
			$this->db->or_where('v_Actionflag !=','D');
			$this->db->group_end();
			$query = $this->db->get();
			// echo $this->db->last_query();
			// exit();
			$query_result = $query->num_rows();
			return $query_result;
		}

		function unprocess_listing($staff, $start, $limit){
			$this->db->select("lr.id as leave_id, u.v_UserName, lr.leave_from, u.v_GroupID");
			$this->db->from("employee_leave_req lr");
			$this->db->join("pmis2_sa_user u", "lr.user_id=u.v_UserID", "inner");
			$this->db->join("processed_leave pl", "pl.leavereq_id=lr.id", "left");
			$this->db->group_start();
			$this->db->where('u.v_Actionflag');
			$this->db->or_where('u.v_Actionflag !=','D');
			$this->db->group_end();
			$this->db->where("lr.leave_type", "4");//unrecoded_leave
			$this->db->where("lr.leave_status", "Approved");
			$this->db->where("(pl.leavereq_id IS Null OR pl.v_actionflag='D')");
			// $this->db->or_where("pl.status", "C");
			if( $staff!="" ){
				$this->db->where("(u.apsb_no LIKE '%$staff%' ESCAPE '!' OR u.v_UserName LIKE '%$staff%' ESCAPE '!')");
				// $this->db->or_like("u.v_UserName", $staff);
			}
			$this->db->limit($limit,$start);
			$result = $this->db->get();
			// echo $this->db->last_query();die;
			return $result->result();
		}

		function unprocess_listing_c(){
			$this->db->select("count(*) as jumlah");
			$this->db->from("employee_leave_req lr");
			$this->db->join("pmis2_sa_user u", "lr.user_id=u.v_UserID", "inner");
			$this->db->join("processed_leave pl", "pl.leavereq_id=lr.id", "left");
			$this->db->group_start();
			$this->db->where('u.v_Actionflag');
			$this->db->or_where('u.v_Actionflag !=','D');
			$this->db->group_end();
			$this->db->where("lr.leave_type", "4");//unrecoded_leave
			$this->db->where("lr.leave_status", "Approved");
			$this->db->where("(pl.leavereq_id IS Null OR pl.v_actionflag='D')");
			$result = $this->db->get();
			// echo $this->db->last_query();exit();
			return $result->result();
		}


		function get_site($v_UserName){
			$this->db->select('site_state');
			$this->db->from('pmis2_sa_user');
			$this->db->where('v_UserID',$v_UserName);
			$this->db->group_start();
			$this->db->where('v_Actionflag');
			$this->db->or_where('v_Actionflag !=','D');
			$this->db->group_end();
			$query = $this->db->get();
			// echo $this->db->last_query();exit();
			return $query->row()->site_state;
		}


		function getreporttorow($userid){
			$this->db->select('*');
			$this->db->from('group');
			$this->db->where('report_to',$userid);
			$query = $this->db->get();
			//echo $this->db->last_query();
			//exit();
			$query_result = $query->num_rows();
			return $query_result;
		}

		function stateH($year,$state){
		$this->db->select('date_holiday');
		$this->db->from('holiday_list');
		$this->db->where('state',$state);
		$this->db->where('YEAR(date_holiday)',$year);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		return $query_result;
	}


}
?>
