<?php

class apply_leave_ctrl extends CI_Controller{

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
							'application_date' => date('Y-m-d H:i:s'),
						);
						//echo "masuk cni";
						//echo print_r($insert_data);
						//exit();
		$this->insert_model->leavereq($insert_data);

		//if ($this->input->post('leave_type') == '2' OR $this->input->post('leave_type') == '3'){
	 	$whatimg = array('2','3','5','6','7','8','9','11','13','14');
		if ((in_array($this->input->post('leave_type'), $whatimg))){
			$this->load->model('display_model');
			//$data['regid'] = $this->display_model->get_reqid($this->input->post('from_leavedate'),$this->session->userdata('v_UserName'));
			//$i=0;
			do {
				//echo ++$i."<br>";
				//$data['regid'] = $this->display_model->get_reqid(date("Y-m-d",strtotime($this->input->post('from_leavedate'))),$this->session->userdata('v_UserName'));
			  $data['regid'][0]->id		= $this->db->insert_id();
				$data['regid'][0]->user_id	= $this->session->userdata('v_UserName');
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
							//print_r($insertimg_data);
							//exit();
			$this->insert_model->sickleave_img($insertimg_data);
		}


		$this->load->model('display_model');
		$data['rptemail'] = $this->display_model->getrptemail($this->session->userdata('v_UserName'));
		if (!$data['rptemail']) {
			$bhg = $this->display_model->getbhguser($this->session->userdata('v_UserName'));
			$data['rptemail'] = $this->display_model->getrptemail2($bhg[0]->v_GroupID);
		}
		// echo "nilai email : " . $data['rptemail'][0]->v_email;
		// exit();
		// $this->session->userdata('v_userid');
		// $this->load->library('../controllers/email');
		// $this->email->send_mail_frmout($data['rptemail'][0]->v_email);

		redirect('Controllers/leave_listing');
	}



	public function check_dateAvailabality(){
		$this->load->model("display_model");
		$applied_date = $this->display_model->applied_date($this->session->userdata('v_UserName'));
		if( !empty($applied_date) ){
			// if( isset($_POST['appliedFrom']) ){
			// 	date("Y-m-d", strtotime($_POST['appliedFrom']));
			// 	foreach ($applied_date as $row) {
					$this->display_model->check_range( $_POST['appliedFrom'], $_POST['appliedTo'], $this->session->userdata('v_UserName'));
					//$this->check_range( $_POST['appliedFrom'], $_POST['appliedTo'], $this->session->userdata('v_UserName'));
			// 	}
			// }
		}else{
			return true;
		}
	}
/*
	public function check_range($fromdate,$todate,$userid){
		if($fromdate!=""){
			$fromdate 	= date("Y-m-d", strtotime($fromdate));
		}
		if($todate!=""){
			$todate		= date("Y-m-d", strtotime($todate));
		}
		$this->db->select('count(*) as has_applied');
		$this->db->where('leave_from',$fromdate);

		if( $fromdate!="" && $todate=="" ){
			$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		}
		if( $fromdate=="" && $todate!="" ){
			$this->db->where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
		}
		if( $fromdate!="" && $todate!="" ){
			$this->db->where("'".$fromdate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
			$this->db->or_where("'".$todate."' BETWEEN R.leave_from AND R.leave_to", NULL, FALSE);
			$this->db->or_where("R.leave_from BETWEEN '$fromdate' AND '$todate'", NULL, FALSE);
			$this->db->or_where("R.leave_to BETWEEN '$fromdate' AND '$todate'", NULL, FALSE);
		}

		$this->db->where('user_id',$userid);
		$this->db->from('employee_leave_req R');
		$this->db->join('pmis2_sa_user U','U.v_UserID = R.user_id');
		$query = $this->db->get()->row()->has_applied;
		// echo $this->db->last_query();
		// exit();
		// $query_result = $query->result();
		echo $query; // pakai utk return value js
		// return $query_result;
	}
*/

         public function send_mail_frmout($emailto) {
         $from_email = "nezam@advancepact.com";
         //$to_email = $this->input->post('email');
         $to_email = $emailto;

         //Load email library
         $this->load->library('email');

         $this->email->from($from_email, 'AP LEAVE System');
         $this->email->to($to_email);
         $this->email->subject('Leave Application Reminder');
         $this->email->message('A leave application is pending your approval  -> http://aphrms.advancepact.com/index.php/Controllers/leave_approved?tab=9');

         //Send mail
         $this->email->send();
      }
}
?>
