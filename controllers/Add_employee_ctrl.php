<?php

class add_employee_ctrl extends CI_Controller{

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
		$userid = $this->input->post('emp_uname');
		$emp_type = $this->input->post('emp_type');
		$emp_apsb = $this->input->post('emp_apsb');
		$this->load->model('insert_model');
		if( $this->insert_model->employee_exist('v_UserID',$userid,'apsb_no',$emp_apsb,$emp_type) ){
			redirect('Controllers/employee_listing');
		}else{
			$this->load->helper('url');
			redirect_back();
		}
	}
}
?>