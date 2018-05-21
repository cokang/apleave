<?php

class add_leave_limit_ctrl extends CI_Controller{

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
	
	$this->load->model('insert_model');
	$this->insert_model->leave_limit_exist();
	redirect('Controllers/employee_listing');

	}
}
?>