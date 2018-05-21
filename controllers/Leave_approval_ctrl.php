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

	$insert_data = array('leave_status' => $status,
						'leave_approved_by' => $this->session->userdata('v_UserName'),
						'date_approved' => date('Y-m-d'));
	$this->load->model('update_model');
	$this->update_model->updatestatus($insert_data,$userid,$regid);
	redirect('Controllers/leave_approved');
	}
}
?>