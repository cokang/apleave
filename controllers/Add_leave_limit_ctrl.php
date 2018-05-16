<?php

class add_leave_limit_ctrl extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->is_logged_in = $this->session->userdata("is_logged_in");
		if( !$this->is_logged_in ){
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