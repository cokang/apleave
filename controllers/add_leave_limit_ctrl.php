<?php

class add_leave_limit_ctrl extends CI_Controller{
	function index(){
	
	$this->load->model('insert_model');
	$this->insert_model->leave_limit_exist();
	redirect('Controllers/employee_listing');

	}
}
?>