<?php

class add_leaves_ctrl extends CI_Controller{

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