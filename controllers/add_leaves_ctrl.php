<?php

class add_leaves_ctrl extends CI_Controller{
	function index(){
	$userid = $this->input->get('employee_name');
	$year = $this->input->get('sel_year');
	//echo $userid.'<br>'.$year;
	//exit();
	$this->load->model('insert_model');
	$this->insert_model->empleave_exist('user_id',$userid,'year',$year);

	redirect('Controllers/employee_listing');

	}
}
?>