<?php

class apply_leave_ctrl extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->is_logged_in = $this->session->userdata("is_logged_in");
		if( !$this->is_logged_in ){
			redirect("/");
		}
	}
	
	function index(){
	$this->load->model('insert_model');
	$insert_data = array(
                         'leave_type' => $this->input->post('leave_type'),
						 'leave_duration'=>$this->input->post('duration'),
                         'leave_from' => ($this->input->post('from_leavedate')) ? date("Y-m-d",strtotime($this->input->post('from_leavedate'))) : NULL,
                         'leave_to' => ($this->input->post('to_leavedate')) ? date("Y-m-d",strtotime($this->input->post('to_leavedate'))) : NULL,
						 'leave_remarks' => $this->input->post('reason'),
						 'employee_replaced' => $this->input->post('alt'),
						 //'leave_status'=>$this->input->post('n_user_department'),
						 //'leave_approved_by'=>$this->input->post('n_location'),
						 //'date_approved' => $this->input->post('n_phone_number'),
                     	 'user_id' => $this->session->userdata('v_UserName'),
                     	 'application_date' => date('Y-m-d'),
	);
	$this->insert_model->leavereq($insert_data);

	if ($this->input->post('leave_type') == '2' OR $this->input->post('leave_type') == '3'){
		$this->load->model('display_model');
		//$data['regid'] = $this->display_model->get_reqid($this->input->post('from_leavedate'),$this->session->userdata('v_UserName'));
		//$i=0;
		do {
			//echo ++$i."<br>";
    		$data['regid'] = $this->display_model->get_reqid(date("Y-m-d",strtotime($this->input->post('from_leavedate'))),$this->session->userdata('v_UserName'));
		} while (!$data['regid']);
		//print_r($data['regid']);
		//exit();
		$insertimg_data = array(
                         'file_name' => ($this->input->post('file_name')) ? $this->input->post('file_name') : NULL,
						 'file_type'=>($this->input->post('file_type')) ? $this->input->post('file_type') : NULL,
                         'file_path' => ($this->input->post('file_path')) ? $this->input->post('file_path') : NULL,
                         'full_path' => ($this->input->post('full_path')) ? $this->input->post('full_path') : NULL,
						 'raw_name' => ($this->input->post('raw_name')) ? $this->input->post('raw_name') : NULL,
						 'orig_name' => ($this->input->post('orig_name')) ? $this->input->post('orig_name') : NULL,
						 'client_name'=>($this->input->post('client_name')) ? $this->input->post('client_name') : NULL,
						 'file_ext'=>($this->input->post('file_ext')) ? $this->input->post('file_ext') : NULL,
						 'file_size' => ($this->input->post('file_size')) ? $this->input->post('file_size') : NULL,
                     	 'is_image' => ($this->session->userdata('is_image')) ? $this->input->post('is_image') : NULL,
                     	 'image_width' => ($this->input->post('image_width')) ? $this->input->post('image_width') : NULL,
						 'image_height'=>($this->input->post('image_height')) ? $this->input->post('image_height') : NULL,
                         'image_type' => ($this->input->post('image_type')) ? $this->input->post('image_type') : NULL,
                         'image_size_str' => ($this->input->post('image_size_str')) ? $this->input->post('image_size_str') : NULL,
						 'user_id' => $data['regid'][0]->user_id,
						 'leavereq_id' => $data['regid'][0]->id,
		);
		$this->insert_model->sickleave_img($insertimg_data);
		
	}

	
	$this->load->model('display_model');
	$data['rptemail'] = $this->display_model->getrptemail($this->session->userdata('v_UserName'));
	if (!$data['rptemail']) {
		 $bhg = $this->display_model->getbhguser($this->session->userdata('v_UserName'));
		 $data['rptemail'] = $this->display_model->getrptemail2($bhg[0]->v_GroupID);
	}
	echo "nilai email : " . $data['rptemail'][0]->v_email;
	exit();
	$this->session->userdata('v_userid');
	$this->load->library('../controllers/email');
	$this->email->send_mail_frmout($data['rptemail'][0]->v_email);
	
	redirect('Controllers/leave_listing');
	}
}
?>