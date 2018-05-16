<?php

class add_employee_ctrl extends CI_Controller{
	function index(){
	$userid = $this->input->post('emp_uname');
	$emp_type = $this->input->post('emp_type');
	$emp_apsb = $this->input->post('emp_apsb');
	$this->load->model('insert_model');
	$this->insert_model->employee_exist('v_UserID',$userid,'apsb_no',$emp_apsb,$emp_type);

	redirect('Controllers/employee_listing');
	}
}
?>