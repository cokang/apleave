<?php

class leave_approval_ctrl extends CI_Controller{

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
		$status = $this->input->get('status');
		$userid = $this->input->get('name');
		$regid = $this->input->get('id');
		$reject_remark = "";
		if( isset($_GET["rejectedremark"]) ){
			$reject_remark = $this->input->get("rejectedremark");
		}

		$insert_data = array(
							'leave_status' => $status,
							'leave_approved_by' => $this->session->userdata('v_UserName'),
							'reject_remark'	=> $reject_remark,
							'date_approved' => date('Y-m-d')
						);
		$this->load->model('update_model');
		$this->update_model->updatestatus($insert_data,$userid,$regid);
		if( !isset($_GET["ref"]) ){
			redirect('Controllers/leave_approved');
		}else{
			echo true;
		}
	}
}
?>