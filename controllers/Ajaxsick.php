<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajaxsick extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->is_logged_in = $this->session->userdata("is_logged_in");
		if( !$this->is_logged_in ){
			redirect("/");
		}
	}
	public function index(){
		$limit = $this->input->get('limit');
		$start = $this->input->get('start');
		$this->load->model('display_model');
		$data['leavelist'] = $this->display_model->leavelist($this->session->userdata('v_UserName'),$limit,$start);
		echo json_encode($data);
		//exit();
	}
	public function approval(){
		$group = $this->input->get('group');
		$limit = $this->input->get('limit');
		$start = $this->input->get('start');
		$this->load->model('display_model');
		$data['leaveapp'] = $this->display_model->leaveapp($group,$limit,$start);
		echo json_encode($data);
		//exit();
	}
}