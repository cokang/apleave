<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//date_default_timezone_set('Asia/Kuala_Lumpur');//or change to whatever timezone you want
class Controllers extends CI_Controller {

	private $is_logged_in;

	public function __construct(){
		parent::__construct();
		$is_logged_in = $this->session->userdata("is_logged_in");
		if( !$is_logged_in ){
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

	function do_upload(){
			  $this->load->model('display_model');
				$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
				$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
				$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
				$data['alternate'] = $this->display_model->alternate($this->session->userdata('v_UserName'),$data['getgroupdet'][0]->v_GroupID);
				$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
				$data['leave_type'] = $this->display_model->leave_type();
				$data['probationchk'] = $this->display_model->probationchk($this->session->userdata('v_UserName'));
				$data['applied_date'] = $this->display_model->applied_date($this->session->userdata('v_UserName'));
		///$url = $this->input->post('continue') ? $this->input->post('continue') : site_url('contentcontroller/select');
		//$config['upload_path'] = 'C:\inetpub\wwwroot\FEMSHospital_v3\uploadfile';
		$config['upload_path'] = 'C:\inetpub\wwwroot\apleave3\sick_leave_img';
		//$config['upload_path'] = "sick_leave_img/";
                //$config['upload_path'] = '/var/www/vhosts/file.advancepact.com/httpdocs/sick_leave_img';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = 'auto';
		$config['max_height']  = 'auto';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))

		{
			//echo "masuka";
			//exit();
			$data['error'] = array($this->upload->display_errors());
			$this->load->view('Head',$data);
			$this->load->view('top');
			$this->load->view('left');
			$this->load->view('Main');
			$this->load->view('footer');
		}
		else
		{
			//echo " klklkl".$this->input->get('file_name');
			//exit();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('leave_type','Leave Type','trim');
			$this->form_validation->set_rules('duration','Duration Type','trim');
			$this->form_validation->set_rules('Alternate','Alternate','trim');
			$this->form_validation->set_rules('from_leavedate','From Date','trim');
			$this->form_validation->set_rules('to_leavedate','To Date','trim');
			$this->form_validation->set_rules('reason','Reason','trim');
			$this->form_validation->set_rules('alt','Alternate','trim');

			if($this->form_validation->run()==TRUE)
				{
				$data['upload_data'] = $this->upload->data();
				$data['image'] = $data['upload_data']['file_name'];
				//echo " klklkl".$data['upload_data']['file_name'];
				//exit();
				//$this->load->model('insert_model');
				//$this->insert_model->sickleave_img($data['upload_data']);

				$this->load->view('Head',$data);
				$this->load->view('top');
				$this->load->view('left');
				$this->load->view('Main');
				$this->load->view('footer');
				}
		}


	}
	public function apply_leave()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['alternate'] = $this->display_model->alternate($this->session->userdata('v_UserName'),$data['getgroupdet'][0]->v_GroupID);
		$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
		$data['leave_type'] = $this->display_model->leave_type();
		$data['probationchk'] = $this->display_model->probationchk($this->session->userdata('v_UserName'));
		$data['applied_date'] = $this->display_model->applied_date($this->session->userdata('v_UserName'));
		//$this->load->model('outside_model');
		//$data['outside'] = $this->outside_model->firsttest();
		//$data['outside'] = $this->outside_model->firsttestsql();
		//		print_r($data['outside']);
		//		echo "ajajajajajajjaja" . $data['outside'][0]->v_UserName . "<br>";
		//		echo "nilai data : " . $data['outside'][0]->v_UserName;
		//echo "ajajajajajajjaja" . $data['outside'][0]->v_Asset_name . "<br>";
		//echo "nilai data : " . $data['outside'][0]->v_Asset_name;

		$this->load->view('Head',$data);
		$this->load->view('top');
		$this->load->view('left');
		$this->load->view('Main');
		$this->load->view('footer');
	}
	public function leave_listing()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		//$data['leavelist'] = $this->display_model->leavelisttt($this->session->userdata('v_UserName'));

		$data['limit'] = 8;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		$data['rec'] = $this->display_model->leavelist_c($this->session->userdata('v_UserName'));
		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}

		$data['leavelist'] = $this->display_model->leavelist($this->session->userdata('v_UserName'),$data['limit'],$data['start']);
		//print_r($data['leavelist']);
		//exit();
		//$data['stafflist'] = $this->display_model->stafflistlim($data['limit'],$data['start']);

		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_listing',$data);
		$this->load->view('footer');
	}
	public function leave_account_view()
	{
		$this->load->library('ap_leave');

		$year = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
		isset($_REQUEST['sel_year']) ? $fyear = $_REQUEST['sel_year'] : $fyear = $year;

		$this->load->model('display_model');
		$data = $this->ap_leave->get_holiday_state($year);
		$data['year'] = $year;
		$data['fyear']= $fyear;
		isset($_REQUEST['dept']) && $_REQUEST['dept'] != '0' ? $data['dept_L'] = $_REQUEST['dept'] : $data['dept_L'] = 'All';
		isset($_REQUEST['staff_name']) ? $data['staffname'] = $_REQUEST['staff_name'] : $data['staffname'] = '';
		isset($_REQUEST['staff_no']) ? $data['apsbno'] = $_REQUEST['staff_no'] : $data['apsbno'] = '';
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['group'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['dept_list'] = $this->display_model->dept_list();

		isset($_REQUEST['ch_bx']) ? $data['check'] = $_REQUEST['ch_bx'] : $data['check'] = 'Own';
		//isset($_REQUEST['excol_chk']) ? $data['excol'] = $_REQUEST['excol_chk'] : $data['excol'] = array();
		$this->input->get('excol1') != '' || $this->input->get('excol2') != '' ? $data['excolt'] = array($this->input->get('excol1'),$this->input->get('excol2')) : $data['excolt'] = array();

		if (isset($_REQUEST['excol_chk'])) {
			$data['excol'] = $_REQUEST['excol_chk'];
		}elseif ($this->input->get('excol1') != '' AND $this->input->get('excol2') != '') {
			$data['excol'] = array($this->input->get('excol1'),$this->input->get('excol2'));
		}elseif ($this->input->get('excol1') != '' AND $this->input->get('excol2') == '') {
			$data['excol'] = array($this->input->get('excol1'));
		}else{
			$data['excol'] = array();
		}
		//print_r($data['excol']);
		//exit();


		if ($data['check'] == 'Own'){
			//$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$data['fyear']);
			//$data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);

				$data['limit'] = 4;
				isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
				$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

				// $data['rec'] = $this->display_model->leaveacc_c($this->session->userdata('v_UserName'),$data['fyear']);//has change model function name to leaveacc___oldfunction
				$data['rec'] = $this->display_model->leaveacc_c($dept='',$this->session->userdata('v_UserName'),$apsbno='',$data['fyear']);//updated by buzz
				if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
					$data['next'] = ++$data['page'];
				}
				// $data['leaveacc'] = $this->display_model->leaveacclim($this->session->userdata('v_UserName'),$data['fyear'],$data['limit'],$data['start']);
				// $data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);
				$data['leaveacc'] = $this->display_model->leaveacc($dept='',$this->session->userdata('v_UserName'),$staffname='',$apsbno='',$data['fyear'],$data['start'],$data['limit']); //updated by buzz
				$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$this->session->userdata('v_UserName'),$staffname='',$apsbno='',$data['fyear']);
			//print_r($data['leave_type']);
			//exit();
		}else{
			//isset($_REQUEST['dept']) && $_REQUEST['dept'] != '0' ? $data['dept_L'] = $_REQUEST['dept'] : $data['dept_L'] = 'All';
			//isset($_REQUEST['staff_name']) ? $data['staffname'] = $_REQUEST['staff_name'] : $data['staffname'] = '';
			//$data['leaveacc'] = $this->display_model->leaveaccallb($data['fyear']);
			//$data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);

			$data['limit'] = 4;
			isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
			$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

			// ===== get total record =====
			if ($data['dept_L'] != 'All'){
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //1
					// $data['rec'] = $this->display_model->leaveaccallds_c($data['dept_L'],$data['staffname'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($data['dept_L'],$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //5
					// $data['rec'] = $this->display_model->leaveaccallda_c($data['dept_L'],$data['apsbno'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($data['dept_L'],$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //6
					// $data['rec'] = $this->display_model->leaveaccalldsa_c($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //2
					// $data['rec'] = $this->display_model->leaveaccalld_c($data['dept_L'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($data['dept_L'],$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}
			}else{
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //3
					// $data['rec'] = $this->display_model->leaveaccalls_c($data['staffname'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($dept='',$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //7
					// $data['rec'] = $this->display_model->leaveaccalla_c($data['apsbno'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($dept='',$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //8
					// $data['rec'] = $this->display_model->leaveaccallas_c($data['staffname'],$data['apsbno'],$data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($dept='',$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //4
					// $data['rec'] = $this->display_model->leaveaccall_c($data['fyear']);
					$data['rec'] = $this->display_model->leaveacc_c($dept='',$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}
			}
			// ===== ./get total record =====

			if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
				$data['next'] = ++$data['page'];
			}

			if ($data['dept_L'] != 'All'){
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //d1
					// $data['leaveacc'] = $this->display_model->leaveaccallds($data['dept_L'],$data['staffname'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallds($data['dept_L'],$data['staffname'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$data['staffname'],$apsbno='',$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != ''){ //d5
					// $data['leaveacc'] = $this->display_model->leaveaccallda($data['dept_L'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallda($data['dept_L'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$staffname='',$data['apsbno'],$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != ''){ //d6
					// $data['leaveacc'] = $this->display_model->leaveaccalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$data['staffname'],$data['apsbno'],$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //d2
					// $data['leaveacc'] = $this->display_model->leaveaccalld($data['dept_L'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalld($data['dept_L'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$staffname='',$apsbno='',$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}
			}else{
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //d3
					// $data['leaveacc'] = $this->display_model->leaveaccalls($data['staffname'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalls($data['staffname'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$data['staffname'],$apsbno='',$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != ''){ //d7
					// $data['leaveacc'] = $this->display_model->leaveaccalla($data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalla($data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$staffname='',$data['apsbno'],$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != ''){ //d8
					// $data['leaveacc'] = $this->display_model->leaveaccallsa($data['staffname'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallsa($data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$data['staffname'],$data['apsbno'],$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //d4
					// $data['leaveacc'] = $this->display_model->leaveaccall($data['fyear'],$data['limit'],$data['start']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$staffname='',$apsbno='',$data['fyear'],$data['start'],$data['limit']); //updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}
			}
		}
		$data['hajj'] = array();
		foreach ($data['leaveacc'] as $hajj){
			$data['hajjdata']	= $this->display_model->hajjdata($hajj->user_id);
			$data['hajj'][]		= array('user_id' => $hajj->user_id,  'hajjdet' => $data['hajjdata']);
		}
		$data['leave_type'] = $this->display_model->leave_type();
		$data['leaveacc'] = $this->ap_leave->get_leave_detail($data['leaveacc'], $data['tleavetaken'], $data['hajj'], $data['year'], $data['leave_type']);

		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_account_view',$data);
		$this->load->view('footer');
	}
	public function autoprint()//######################################################################################### leave detail
	{
		$this->load->library('ap_leave');

		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
		$data['group'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['dept_list'] = $this->display_model->dept_list();

		$data['check'] = $this->input->get('data');
		$data['fyear'] = $this->input->get('year');
		$data['dept_L'] = $this->input->get('dept');
		$data['staffname'] = $this->input->get('staff');
		$data['apsbno'] = $this->input->get('apsbno');
		$data['excol1'] = $this->input->get('excol1');
		$data['excol2'] = $this->input->get('excol2');

		$holidayArr = $this->ap_leave->get_holiday_state($data['fyear']);
		$data = array_merge($data,$holidayArr);

		$data['leave_type'] = $this->display_model->leave_type();

		if ($data['check'] == 'Own'){
			// $data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$data['fyear']);
			// $data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);
			$data['leaveacc'] = $this->display_model->leaveacc($dept='',$this->session->userdata('v_UserName'),$staffname='',$apsbno='',$data['fyear'],$start='',$limit='');//updated by buzz
			$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$this->session->userdata('v_UserName'),$staffname='',$apsbno='',$data['fyear']);

		}else{

			if ($data['dept_L'] != 'All'){

				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //p1
					// $data['leaveacc'] = $this->display_model->leaveaccalldsp($data['dept_L'],$data['staffname'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallds($data['dept_L'],$data['staffname'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$data['staffname'],$apsbno='',$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //p5
					// $data['leaveacc'] = $this->display_model->leaveaccalldap($data['dept_L'],$data['apsbno'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallda($data['dept_L'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$staffname='',$data['apsbno'],$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //p6
					// $data['leaveacc'] = $this->display_model->leaveaccalldsap($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$data['staffname'],$data['apsbno'],$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //p2
					// $data['leaveacc'] = $this->display_model->leaveaccalldp($data['dept_L'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalld($data['dept_L'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($data['dept_L'],$user_id='',$staffname='',$apsbno='',$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($data['dept_L'],$user_id='',$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}

			}else{

				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //p3
					// $data['leaveacc'] = $this->display_model->leaveaccallsp($data['staffname'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalls($data['staffname'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$data['staffname'],$apsbno='',$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$data['staffname'],$apsbno='',$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //p7
					// $data['leaveacc'] = $this->display_model->leaveaccallap($data['apsbno'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenalla($data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$staffname='',$data['apsbno'],$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$staffname='',$data['apsbno'],$data['fyear']);//updated by buzz
				}elseif ($data['staffname'] != '' && $data['apsbno'] != '') {
					// $data['leaveacc'] = $this->display_model->leaveaccallsap($data['staffname'],$data['apsbno'],$data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenallsa($data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$data['staffname'],$data['apsbno'],$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$data['staffname'],$data['apsbno'],$data['fyear']);//updated by buzz
				}else{ //p4
					// $data['leaveacc'] = $this->display_model->leaveaccallp($data['fyear']);
					// $data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);
					$data['leaveacc'] = $this->display_model->leaveacc($dept='',$user_id='',$staffname='',$apsbno='',$data['fyear'],$start='',$limit='');//updated by buzz
					$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$user_id='',$staffname='',$apsbno='',$data['fyear']);//updated by buzz
				}

			}
		}

		foreach ($data['leaveacc'] as $hajj){
			$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
			$data['hajj'][] = array('user_id' => $hajj->user_id, 'hajjdet' => $data['hajjdata']);
		}
		$data['leaveacc'] = $this->ap_leave->get_leave_detail($data['leaveacc'], $data['tleavetaken'], $data['hajj'], $data['year'], $data['leave_type']);

		$this->load->view('Head');
		$this->load->view('Main_autoprint',$data);
		$this->load->view('footer');
	}
	public function change_password()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_change_password');
		$this->load->view('footer');
	}
	public function add_employee()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['username'] = ($this->input->get('name')) ? $this->input->get('name') : '';
		$data['employeedet'] = $this->display_model->employeedet($data['username']);
		//print_r($data['employeedet']);
		//exit();
		$data['statelist'] = $this->display_model->statelist();
		$data['hosplist'] = $this->display_model->hosplist();
		$data['emptype'] = $this->display_model->emptype($data['username']);
		$data['probation'] = $this->display_model->probation($data['username']);
		if (($data['emptype']) && ($data['employeedet'])) {
			$data['employeetype'] = 'Head';
		}
		elseif(!($data['emptype']) && ($data['employeedet'])){
			$data['employeetype'] = 'Employee';
		}
		else{
			$data['employeetype'] = '';
		}

		$data['reportto'] = $this->display_model->reportto($data['username']);

		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_add_employee',$data);
		$this->load->view('footer');
	}

	public function add_leaves()//######################################################################################### leave detail
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['currentyear'] = date('Y');
		isset($_GET['employee_name']) ? $data['username'] = $_GET['employee_name'] : $data['username'] = '';
		isset($_GET['sel_year']) ? $data['year'] = $_GET['sel_year'] : $data['year'] = date("Y");
		//echo $data['username'].'<br>'.$data['year'];
		//exit();
		//$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date("Y");

		$data['stafflist'] = $this->display_model->stafflist();
		//$data['username'] = ($this->input->get('name')) ? $this->input->get('name') : '';
		// $data['leaveacc'] = $this->display_model->leaveacc($data['username'],$data['year']);
		$data['leaveacc'] = $this->display_model->leaveacc($dept='',$data['username'],$staffname='',$apsbno='',$data['year'],$start='',$limit='');
		if (!($data['leaveacc'])){
			$data['prevyear'] = date("Y",strtotime(date("Y-m-d",strtotime($data['year'].'-01-01 -1 years'))));

			$data['employeedet'] = $this->display_model->employeedet($data['username']);
			// $data['prleaveacc'] = $this->display_model->leaveacc($data['username'],$data['prevyear']);
			// $data['tleavetaken'] = $this->display_model->tleavetaken($data['username'],$data['prevyear']);
			$data['prleaveacc'] = $this->display_model->leaveacc($dept='',$data['username'],$staffname='',$apsbno='',$data['prevyear'],$start='',$limit='');
			$data['tleavetaken'] = $this->display_model->tleavetaken($dept='',$data['username'],$staffname='',$apsbno='',$data['prevyear']);
			$data['leave_type'] = $this->display_model->leave_type();

		}
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_add_leaves',$data);
		$this->load->view('footer');
	}
	public function employee_listing()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));

		$data['limit'] = 8;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		$data['rec'] = $this->display_model->stafflist_c();
		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}

		//$data['stafflist'] = $this->display_model->stafflistlim($data['limit'],$data['start']);
    $data['stafflist'] = $this->display_model->stafflistlim($this->input->get('sc'),$data['limit'],$data['start']);
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_employee_listing',$data);
		$this->load->view('footer');
	}
	public function leave_approved()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));

		$data['limit'] = 8;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		$data['rec'] = $this->display_model->leaveapp_c($data['getgroupdet'][0]->v_GroupID);

		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}

		$data['leaveapp'] = $this->display_model->leaveapp($data['getgroupdet'][0]->v_GroupID,$data['limit'],$data['start']);
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_approved',$data);
		$this->load->view('footer');
	}

	public function update_constants()
	{
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left');
		$this->load->view('Main_update_constants');
		$this->load->view('footer');
	}
	public function leave_Limit()
	{
		$this->load->model('display_model');

		$data['family_sick_leave']	= json_decode(json_encode($this->display_model->leave_type()),true)[5]['entitle_days'];
		$data["maternity_leave"]	= json_decode(json_encode($this->display_model->leave_type()),true)[6]['entitle_days'];
		$data["paternity_leave"]	= json_decode(json_encode($this->display_model->leave_type()),true)[7]['entitle_days'];
		$data["marriage_leave"]		= json_decode(json_encode($this->display_model->leave_type()),true)[8]['entitle_days'];
		$data["unrecorded_leave"]	= json_decode(json_encode($this->display_model->leave_type()),true)[9]['entitle_days'];
		$data["study_leave"]		= json_decode(json_encode($this->display_model->leave_type()),true)[10]['entitle_days'];
		$data["transfer_leave"]		= json_decode(json_encode($this->display_model->leave_type()),true)[11]['entitle_days'];
		$data["hajj_leave"]			= json_decode(json_encode($this->display_model->leave_type()),true)[12]['entitle_days'];

		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_Limit');
		$this->load->view('footer');
	}
	public function date_calender()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['applied_date'] = $this->display_model->applied_date($this->session->userdata('v_UserName'));
		isset($_REQUEST['date_calendar']) ? $data['datecal'] = date("d-m-Y",strtotime($_REQUEST['date_calendar'])) : $data['datecal'] = date("d-m-Y");
		isset($_REQUEST['date_calendar_to']) ? $data['datecalto'] = date("d-m-Y",strtotime($_REQUEST['date_calendar_to'])) : $data['datecalto'] = date("d-m-Y");

		$data['holidayJB'] = $this->display_model->holidayJB(date('Y',strtotime($data['datecal'])));
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
			    $data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->display_model->holidayMKA(date('Y',strtotime($data['datecal'])));
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
			    $data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['MKA_hol'][] = NULL;
		}
		$data['holidayNS'] = $this->display_model->holidayNS(date('Y',strtotime($data['datecal'])));
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
			    $data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->display_model->holidaySEL(date('Y',strtotime($data['datecal'])));
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
			    $data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['SEL_hol'][] = NULL;
		}
		$data['holidayPHG'] = $this->display_model->holidayPHG(date('Y',strtotime($data['datecal'])));
		if($data['holidayPHG']){
			foreach ($data['holidayPHG'] as $key => $value) {
			    $data['PHG_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['PHG_hol'][] = NULL;
		}
		$data['holidayKL'] = $this->display_model->holidayKL(date('Y',strtotime($data['datecal'])));
		if($data['holidayKL']){
			foreach ($data['holidayKL'] as $key => $value) {
			    $data['KL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['KL_hol'][] = NULL;
		}


		$data['limit'] = 5;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		//$data['rec'] = $this->display_model->datecalendar_c($data['datecal']);
		$data['rec'] = $this->display_model->datecalendar_c(date("Y-m-d",strtotime($data['datecal'])), date("Y-m-d",strtotime($data['datecalto'])));
		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}
		$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['datecalendar'] = $this->display_model->datecalendar(date("Y-m-d",strtotime($data['datecal'])),$data['limit'],$data['start'],date("Y-m-d",strtotime($data['datecalto'])), $data['getgroupdet'][0]->v_GroupID);
		//print_r($data['datecalendar']);
		//exit();

		//echo $data['datecal'];
		//exit();
		$this->load->view('Head',$data);
		$this->load->view('top');
		$this->load->view('left');
		$this->load->view('Main_date_calender');
		$this->load->view('footer');
	}

	public function print_out()//######################################################################################### leave detail
	{
		$this->load->library('ap_leave');

		$this->load->model('display_model');
		$data['headrow']	= $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow']		= $this->display_model->gethrrow($this->session->userdata('v_UserName'));

		$data['record']		= $this->display_model->printrec($this->input->get('id'),'');
		$data['userleave']	= $this->display_model->userleave($data['record'][0]->leave_type);
		$data['replacement']= $this->display_model->staffreplacement($data['record'][0]->employee_replaced);

		$data['EL_user']	= array();

		if( $data['record'][0]->leave_type==1 ){
			$data['EL_user'] = $this->display_model->userleave(3);
		}

		if ($this->input->get('userid') == ''){
			$data['holiday_list'] = $this->display_model->holiday_list($this->session->userdata('v_UserName'),date('Y',strtotime($data['record'][0]->leave_from)));
		}else{
			$data['holiday_list'] = $this->display_model->holiday_list($this->input->get('userid'),date('Y',strtotime($data['record'][0]->leave_from)));
		}

		if ($data['holiday_list']){
			foreach ($data['holiday_list'] as $key => $value) {
				$data['holidayarray'][] = strtotime(date($value->date_holiday));
			}
		}else{
			$data['holidayarray'][] = NULL;
		}

		$data['state_list'] = $this->display_model->statelist();
		foreach($data['state_list'] as $key => $row){
			$statel = 'holiday'.$row->state_code;
			$state2 = $row->state_code.'_hol';

			$data[$statel] = $this->display_model->stateH(date('Y',strtotime($data['record'][0]->leave_from)),$row->state_code);
			if($data[$statel]){
				foreach ($data[$statel] as $key => $value) {
					 $data[$state2][] = date('Y-m-d',strtotime(date($value->date_holiday)));
				}
			}else {
				$data[$state2][] = NULL;
			}
		}

		$data['fromdate'] = $data['record'][0]->leave_from;
		$data['todate'] = ($data['record'][0]->leave_to) ? $data['record'][0]->leave_to : $data['record'][0]->leave_from;

		$yearapplied = date('Y',strtotime($data['fromdate']));

		// if ($this->input->get('userid') == ''){
		// 	$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$yearapplied);
		// 	$data['tleavetaken'] = $this->display_model->tleavetakenprint($this->session->userdata('v_UserName'),$data['fromdate'],$yearapplied);
		// }else{
		// 	$data['leaveacc'] = $this->display_model->leaveacc($this->input->get('userid'),$yearapplied);
		// 	$data['tleavetaken'] = $this->display_model->tleavetakenprint($this->input->get('userid'),$data['fromdate'],$yearapplied);
		// }

		$data['leaveacc'] = $this->display_model->leaveacc($dept='',$data['record'][0]->user_id,$staffname='',$apsbno='',$yearapplied, $start='',$limit='');
		$data['tleavetaken'] = $this->display_model->tleavetakenprint($data['record'][0]->user_id,$data['fromdate'],$yearapplied);

		//leavebalance
		$list_leave_type = $this->display_model->leave_type();
		foreach ($list_leave_type as $col) {
			if($col->id==$data['record'][0]->leave_type){
				$leave_type[] = $col;
			}
		}

		$data['leaveacc'] = $this->ap_leave->get_leave_detail($data['leaveacc'], $data['tleavetaken'], $hajj='', $yearapplied, $leave_type);

		$data['noleave'] = $this->ap_leave->get_no_ofday($data['fromdate'], $data['todate'], $data['record'][0]->leave_type, $data['record'][0]->leave_duration, $data['record'][0]->v_hospitalcode, $yearapplied);

		// echo "<pre>";var_export($leavebalance);die;
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));

		// $data['record'] = array_merge($data['record'],$leavebalance);
		// $data['record'] = $leavebalance;		$data['noleave'] = $noleave;
		$data['totaltaken'] = $data['leaveacc'][0]->totaltaken;
		$data['totalELtaken'] = $data['leaveacc'][0]->ELtaken;
		$data['balanceleave'] = $data['leaveacc'][0]->balanceleave;
		$data['balanceEleave'] = $data['leaveacc'][0]->balanceEleave;
		//leavebalance
		// echo "noleave=".$data['noleave']." totaltaken=".$data['totaltaken'];die;
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_print',$data);
		$this->load->view('footer');
	}

	//bazli 3/5/18
	public function employee_guide()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('employee_guide');
		$this->load->view('footer');
	}

	//bazli add new function 13/6/18
	public function system_manual()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('system_manual');
		$this->load->view('footer');
	}



	public function administrative(){
		$this->load->model('display_model');
		$data['headrow']= $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow']	= $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['aarow']	= $this->display_model->getaarow($this->session->userdata('v_UserName'));


		$this->load->view('Head',$data);
		$this->load->view('top');
		$this->load->view('left');
		$this->load->view('main_administrative');
		$this->load->view('footer');
	}

	public function unprocess_listing(){
		$this->load->model('display_model');
		$data['headrow']= $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow']	= $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['aarow']	= $this->display_model->getaarow($this->session->userdata('v_UserName'));

		$data['limit']	= 8;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start']	= ($data['page'] * $data['limit']) - $data['limit'];

		$data['unprocess_listing']	= $this->display_model->unprocess_listing($this->input->get('sc'),$data['start'], $data['limit']);
		$data['jumlah']				= $this->display_model->unprocess_listing_c()[0]->jumlah;
		if($data['jumlah'] > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}

		$this->load->view('Head',$data);
		$this->load->view('top');
		$this->load->view('left');
		$this->load->view('process_listing');
		$this->load->view('footer');
	}

	public function process_listing(){
		$this->load->model('insert_model');
		$this->insert_model->update_process_leave_status();
	}

}
