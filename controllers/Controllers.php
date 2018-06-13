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
		///$url = $this->input->post('continue') ? $this->input->post('continue') : site_url('contentcontroller/select');
		//$config['upload_path'] = 'C:\inetpub\wwwroot\FEMSHospital_v3\uploadfile';
		//$config['upload_path'] = 'C:\xampp\htdocs\leave\sick_leave_img';
                $config['upload_path'] = '/var/www/vhosts/file.advancepact.com/httpdocs/sick_leave_img';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = 'auto';
		$config['max_height']  = 'auto';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		
		{
			$data['error'] = array($this->upload->display_errors());
			$this->load->view('Head');
			$this->load->view('top');
			$this->load->view('left');
			$this->load->view('Main',$data);
			$this->load->view('footer');
		}
		else
		{
			//echo $this->input->get('file_name');
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
				$this->load->model('display_model');
				$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
				$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
				$data['getgroupdet'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
				$data['alternate'] = $this->display_model->alternate($this->session->userdata('v_UserName'),$data['getgroupdet'][0]->v_GroupID);
				$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
				$data['leave_type'] = $this->display_model->leave_type();
				$data['probationchk'] = $this->display_model->probationchk($this->session->userdata('v_UserName'));
				//$this->load->model('insert_model');
				//$this->insert_model->sickleave_img($data['upload_data']);
				
				$this->load->view('Head');
				$this->load->view('top');
				$this->load->view('left',$data);
				$this->load->view('Main',$data);
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
		//$this->load->model('outside_model');
		//$data['outside'] = $this->outside_model->firsttest();
		//$data['outside'] = $this->outside_model->firsttestsql();
		//		print_r($data['outside']);
		//		echo "ajajajajajajjaja" . $data['outside'][0]->v_UserName . "<br>";
		//		echo "nilai data : " . $data['outside'][0]->v_UserName;
		//echo "ajajajajajajjaja" . $data['outside'][0]->v_Asset_name . "<br>";
		//echo "nilai data : " . $data['outside'][0]->v_Asset_name;
		
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main',$data);
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
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));
		$data['year'] = ($this->input->get('y') <> 0) ? $this->input->get('y') : date('Y');
		$data['group'] = $this->display_model->getgroupdet($this->session->userdata('v_UserName'));
		$data['dept_list'] = $this->display_model->dept_list();

		isset($_REQUEST['ch_bx']) ? $data['check'] = $_REQUEST['ch_bx'] : $data['check'] = 'Own';
		//isset($_REQUEST['excol_chk']) ? $data['excol'] = $_REQUEST['excol_chk'] : $data['excol'] = array();
		$this->input->get('excol1') != '' || $this->input->get('excol2') != '' ? $data['excolt'] = array($this->input->get('excol1'),$this->input->get('excol2')) : $data['excolt'] = array();
		
		if (isset($_REQUEST['excol_chk'])) {
			$data['excol'] = $_REQUEST['excol_chk'];
		}
		elseif ($this->input->get('excol1') != '' AND $this->input->get('excol2') != '') {
			$data['excol'] = array($this->input->get('excol1'),$this->input->get('excol2'));
		}
		elseif ($this->input->get('excol1') != '' AND $this->input->get('excol2') == '') {
			$data['excol'] = array($this->input->get('excol1'));
		}
		else{
			$data['excol'] = array();
		}
		//print_r($data['excol']);
		//exit();
		isset($_REQUEST['sel_year']) ? $data['fyear'] = $_REQUEST['sel_year'] : $data['fyear'] = $data['year'];
		isset($_REQUEST['dept']) && $_REQUEST['dept'] != '0' ? $data['dept_L'] = $_REQUEST['dept'] : $data['dept_L'] = 'All';
		isset($_REQUEST['staff_name']) ? $data['staffname'] = $_REQUEST['staff_name'] : $data['staffname'] = '';
		isset($_REQUEST['staff_no']) ? $data['apsbno'] = $_REQUEST['staff_no'] : $data['apsbno'] = '';

		$data['holidayJB'] = $this->display_model->holidayJB($data['fyear']);
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
			    $data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->display_model->holidayMKA($data['fyear']);
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
			    $data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['MKA_hol'][] = NULL;
		}
		$data['holidayNS'] = $this->display_model->holidayNS($data['fyear']);
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
			    $data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->display_model->holidaySEL($data['fyear']);
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
			    $data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['SEL_hol'][] = NULL;
		}

		if ($data['check'] == 'Own'){
		//$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$data['fyear']);
		//$data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);

			$data['limit'] = 4;
			isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
			$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

			$data['rec'] = $this->display_model->leaveacc_c($this->session->userdata('v_UserName'),$data['fyear']);
			if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
				$data['next'] = ++$data['page'];
			}
			$data['leaveacc'] = $this->display_model->leaveacclim($this->session->userdata('v_UserName'),$data['fyear'],$data['limit'],$data['start']);
			foreach ($data['leaveacc'] as $hajj){
				$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
				$data['hajj'][] = array('user_id' => $hajj->user_id,
									  'hajjdet' => $data['hajjdata']);
			}
			$data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);
			$data['leave_type'] = $this->display_model->leave_type();
		//print_r($data['leave_type']);
		//exit();
		}
		else{
		//isset($_REQUEST['dept']) && $_REQUEST['dept'] != '0' ? $data['dept_L'] = $_REQUEST['dept'] : $data['dept_L'] = 'All';
		//isset($_REQUEST['staff_name']) ? $data['staffname'] = $_REQUEST['staff_name'] : $data['staffname'] = '';
		//$data['leaveacc'] = $this->display_model->leaveaccallb($data['fyear']);
		//$data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);

		$data['limit'] = 4;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		if ($data['dept_L'] != 'All'){
			if ($data['staffname'] != '' && $data['apsbno'] == ''){ //1
				$data['rec'] = $this->display_model->leaveaccallds_c($data['dept_L'],$data['staffname'],$data['fyear']);
			}
			elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //5
				$data['rec'] = $this->display_model->leaveaccallda_c($data['dept_L'],$data['apsbno'],$data['fyear']);
			}
			elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //6
				$data['rec'] = $this->display_model->leaveaccalldsa_c($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
			}
			else{ //2
				$data['rec'] = $this->display_model->leaveaccalld_c($data['dept_L'],$data['fyear']);
			}
		}
		else{
			if ($data['staffname'] != '' && $data['apsbno'] == ''){ //3
				$data['rec'] = $this->display_model->leaveaccalls_c($data['staffname'],$data['fyear']);
			}
			elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //7
				$data['rec'] = $this->display_model->leaveaccalla_c($data['apsbno'],$data['fyear']);
			}
			elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //8
				$data['rec'] = $this->display_model->leaveaccallas_c($data['staffname'],$data['apsbno'],$data['fyear']);
			}
			else{ //4
				$data['rec'] = $this->display_model->leaveaccall_c($data['fyear']);
			}
		}

		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}

		if ($data['dept_L'] != 'All'){
			if ($data['staffname'] != '' && $data['apsbno'] == ''){ //d1
				$data['leaveacc'] = $this->display_model->leaveaccallds($data['dept_L'],$data['staffname'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenallds($data['dept_L'],$data['staffname'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			elseif ($data['staffname'] == '' && $data['apsbno'] != ''){ //d5
				$data['leaveacc'] = $this->display_model->leaveaccallda($data['dept_L'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenallda($data['dept_L'],$data['apsbno'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			elseif ($data['staffname'] != '' && $data['apsbno'] != ''){ //d6
				$data['leaveacc'] = $this->display_model->leaveaccalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			else{ //d2
				$data['leaveacc'] = $this->display_model->leaveaccalld($data['dept_L'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenalld($data['dept_L'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
		}
		else{
			if ($data['staffname'] != '' && $data['apsbno'] == ''){ //d3
				$data['leaveacc'] = $this->display_model->leaveaccalls($data['staffname'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenalls($data['staffname'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			elseif ($data['staffname'] == '' && $data['apsbno'] != ''){ //d7
				$data['leaveacc'] = $this->display_model->leaveaccalla($data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenalla($data['apsbno'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			elseif ($data['staffname'] != '' && $data['apsbno'] != ''){ //d8
				$data['leaveacc'] = $this->display_model->leaveaccallsa($data['staffname'],$data['apsbno'],$data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenallsa($data['staffname'],$data['apsbno'],$data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
			else{ //d4
				$data['leaveacc'] = $this->display_model->leaveaccall($data['fyear'],$data['limit'],$data['start']);
				foreach ($data['leaveacc'] as $hajj){
					$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
					$data['hajj'][] = array('user_id' => $hajj->user_id,
										  'hajjdet' => $data['hajjdata']);
				}
				$data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);
				$data['leave_type'] = $this->display_model->leave_type();
			}
		}

		}

		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_leave_account_view',$data);
		$this->load->view('footer');
	}
	public function autoprint(){
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

		$data['holidayJB'] = $this->display_model->holidayJB($data['fyear']);
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
			    $data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->display_model->holidayMKA($data['fyear']);
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
			    $data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['MKA_hol'][] = NULL;
		}
		$data['holidayNS'] = $this->display_model->holidayNS($data['fyear']);
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
			    $data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->display_model->holidaySEL($data['fyear']);
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
			    $data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['SEL_hol'][] = NULL;
		}
		
		if ($data['check'] == 'Own'){
		$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$data['fyear']);
		$data['tleavetaken'] = $this->display_model->tleavetaken($this->session->userdata('v_UserName'),$data['fyear']);
		$data['leave_type'] = $this->display_model->leave_type();
		foreach ($data['leaveacc'] as $hajj){
			$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
			$data['hajj'][] = array('user_id' => $hajj->user_id,
								  'hajjdet' => $data['hajjdata']);
		}
		}
		else{

			if ($data['dept_L'] != 'All'){
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //p1
					$data['leaveacc'] = $this->display_model->leaveaccalldsp($data['dept_L'],$data['staffname'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenallds($data['dept_L'],$data['staffname'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //p5
					$data['leaveacc'] = $this->display_model->leaveaccalldap($data['dept_L'],$data['apsbno'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenallda($data['dept_L'],$data['apsbno'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				elseif ($data['staffname'] != '' && $data['apsbno'] != '') { //p6
					$data['leaveacc'] = $this->display_model->leaveaccalldsap($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenalldsa($data['dept_L'],$data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				else{ //p2
					$data['leaveacc'] = $this->display_model->leaveaccalldp($data['dept_L'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenalld($data['dept_L'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
			}
			else{
				if ($data['staffname'] != '' && $data['apsbno'] == ''){ //p3
					$data['leaveacc'] = $this->display_model->leaveaccallsp($data['staffname'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenalls($data['staffname'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				elseif ($data['staffname'] == '' && $data['apsbno'] != '') { //p7
					$data['leaveacc'] = $this->display_model->leaveaccallap($data['apsbno'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenalla($data['apsbno'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				elseif ($data['staffname'] != '' && $data['apsbno'] != '') {
					$data['leaveacc'] = $this->display_model->leaveaccallsap($data['staffname'],$data['apsbno'],$data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenallsa($data['staffname'],$data['apsbno'],$data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
				else{ //p4
					$data['leaveacc'] = $this->display_model->leaveaccallp($data['fyear']);
					$data['tleavetaken'] = $this->display_model->tleavetakenall($data['fyear']);
					$data['leave_type'] = $this->display_model->leave_type();
					foreach ($data['leaveacc'] as $hajj){
						$data['hajjdata'] = $this->display_model->hajjdata($hajj->user_id);
						$data['hajj'][] = array('user_id' => $hajj->user_id,
											  'hajjdet' => $data['hajjdata']);
					}
				}
			}
		}
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
	public function add_leaves()
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
		$data['leaveacc'] = $this->display_model->leaveacc($data['username'],$data['year']);
		if (!($data['leaveacc'])){
			$data['prevyear'] = date("Y",strtotime(date("Y-m-d",strtotime($data['year'].'-01-01 -1 years'))));

			$data['employeedet'] = $this->display_model->employeedet($data['username']);
			$data['prleaveacc'] = $this->display_model->leaveacc($data['username'],$data['prevyear']);
			$data['tleavetaken'] = $this->display_model->tleavetaken($data['username'],$data['prevyear']);
			$data['leave_type'] = $this->display_model->leave_type();

			$data['holiday_list'] = $this->display_model->holiday_list($data['username'],$data['prevyear']);
			if ($data['holiday_list']){
				foreach ($data['holiday_list'] as $key => $value) {
				    $data['holidayarray'][] = strtotime(date($value->date_holiday));
				}
			}
			else{
				$data['holidayarray'][] = NULL;
			}

			$data['ALtaken'] = 0;
			$data['SLtaken'] = 0;
			$data['ELtaken'] = 0;
			$data['FStaken'] = 0;
			$data['FSEtaken'] = 0;
			$data['PLtaken'] = 0;
			$data['PLEtaken'] = 0;
			$data['MLtaken'] = 0;
			$data['MLEtaken'] = 0;
			$data['MRLtaken'] = 0;
			$data['MRLEtaken'] = 0;
			$data['ULtaken'] = 0;
			$data['ULEtaken'] = 0;
			$data['STLtaken'] = 0;
			$data['STLEtaken'] = 0;
			$data['TLtaken'] = 0;
			$data['TLEtaken'] = 0;
			$data['HLtaken'] = 0;
			$data['HLEtaken'] = 0;
			foreach ($data['tleavetaken'] as $row){

				$data['fromhdate'] = $row->leave_from;
				$data['tohdate'] = ($row->leave_to) ? $row->leave_to : $row->leave_from;

				$begin = strtotime($data['fromhdate']);
			    $end   = strtotime($data['tohdate']);
			    
			    $no_days  = 0;
		        $weekends = 0;
		        while ($begin <= $end) {
		            $no_days++; // no of days in the given interval
		            $what_day = date("N", $begin);
								//echo "$what_day".$what_day;
		            if($data['employeedet'][0]->v_hospitalcode == 'JB'){
		            	if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $data['holidayarray']))) { // 5 and 6 are weekend days
		                $weekends++;
		            	}
		            }
		            else{
		            	if ($what_day > 5 || (in_array($begin, $data['holidayarray']))) { // 6 and 7 are weekend days
		                $weekends++;
		            	}
		            }
		            $begin += 86400; // +1 day
		        }
		        $data['noleavetaken'] = $no_days - $weekends;
		        if ($row->leave_type == '1'){  //annual leave
		        	$data['ALtaken'] += $data['noleavetaken'];
		        }
		        elseif($row->leave_type == '2'){  //sick leave
		        	$data['SLtaken'] += $data['noleavetaken'];
		        }
		        elseif($row->leave_type == '3'){  //emergency leave
					$data['ELtaken'] += $data['noleavetaken'];
		        }
		        elseif($row->leave_type == '6'){  //family sick leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][5]->per_case_basis){
					$data['FStaken'] += $data['noleavetaken'];
					}
					else{
					$data['FStaken'] += $data['leave_type'][5]->per_case_basis;
					$data['FSEtaken'] += ($data['noleavetaken'] - $data['leave_type'][5]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '7'){  //maternity leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][6]->per_case_basis){
					$data['MLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['MLtaken'] += $data['leave_type'][6]->per_case_basis;
					$data['MLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][6]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '8'){  //paternity leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][7]->per_case_basis){
					$data['PLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['PLtaken'] += $data['leave_type'][7]->per_case_basis;
					$data['PLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][7]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '9'){  //marriage leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][8]->per_case_basis){
					$data['MRLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['MRLtaken'] += $data['leave_type'][8]->per_case_basis;
					$data['MRLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][8]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '10'){  //unrecorded leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][9]->per_case_basis){
					$data['ULtaken'] += $data['noleavetaken'];
					}
					else{
					$data['ULtaken'] += $data['leave_type'][9]->per_case_basis;
					$data['ULEtaken'] += ($data['noleavetaken'] - $data['leave_type'][9]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '11'){  //study leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][10]->per_case_basis){
					$data['STLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['STLtaken'] += $data['leave_type'][10]->per_case_basis;
					$data['STLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][10]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '12'){  //transfer leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][11]->per_case_basis){
					$data['TLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['TLtaken'] += $data['leave_type'][11]->per_case_basis;
					$data['TLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][11]->per_case_basis);
					}
		        }
		        elseif($row->leave_type == '13'){  //hajj leave
		        	if ($data['noleavetaken'] <= $data['leave_type'][12]->per_case_basis){
					$data['HLtaken'] += $data['noleavetaken'];
					}
					else{
					$data['HLtaken'] += $data['leave_type'][12]->per_case_basis;
					$data['HLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][12]->per_case_basis);
					}
		        }
			}
			
			$data['SLbalance'] = (isset($data['prleaveacc'][0]->sick_leave) ? $data['prleaveacc'][0]->sick_leave : 0) - $data['SLtaken'];
				if ($data['SLbalance'] < 0){
					$data['SLEtaken'] = abs($data['SLbalance']);
				}

			
			$data['annualB'] = (isset($data['prleaveacc'][0]->annual_leave) ? $data['prleaveacc'][0]->annual_leave : 0) + (isset($data['prleaveacc'][0]->carry_fwd_leave) ? $data['prleaveacc'][0]->carry_fwd_leave : 0) 
			 						- $data['ALtaken'] - $data['ELtaken'] - $data['FSEtaken'] - $data['PLEtaken'] - $data['MLEtaken']  - $data['MRLEtaken']  - $data['ULEtaken']  - $data['STLEtaken']  - $data['TLEtaken']
			 						- $data['HLEtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);

				if ($data['annualB'] < 0){
                    $data['ALEtaken'] = abs($data['annualB']);
                    $data['ALbalance'] = 0;
	            }
                else{
                  	$data['ALbalance'] = $data['annualB'];
                }
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

		$data['stafflist'] = $this->display_model->stafflistlim($data['limit'],$data['start']);
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
		isset($_REQUEST['date_calendar']) ? $data['datecal'] = date("d-m-Y",strtotime($_REQUEST['date_calendar'])) : $data['datecal'] = date("d-m-Y");

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

		$data['limit'] = 5;
		isset($_GET['p']) ? $data['page'] = $_GET['p'] : $data['page'] = 1;
		$data['start'] = ($data['page'] * $data['limit']) - $data['limit'];

		//$data['rec'] = $this->display_model->datecalendar_c($data['datecal']);
		$data['rec'] = $this->display_model->datecalendar_c(date("Y-m-d",strtotime($data['datecal'])));
		if($data['rec'][0]->jumlah > ($data['page'] * $data['limit']) ){
			$data['next'] = ++$data['page'];
		}
		$data['datecalendar'] = $this->display_model->datecalendar(date("Y-m-d",strtotime($data['datecal'])),$data['limit'],$data['start']);
		//print_r($data['datecalendar']);
		//exit();

		//echo $data['datecal'];
		//exit();
		$this->load->view('Head');
		$this->load->view('top');
		$this->load->view('left',$data);
		$this->load->view('Main_date_calender');
		$this->load->view('footer');
	}
		public function print_out()
	{
		$this->load->model('display_model');
		$data['headrow'] = $this->display_model->getheadrow($this->session->userdata('v_UserName'));
		$data['hrrow'] = $this->display_model->gethrrow($this->session->userdata('v_UserName'));

		$data['record'] = $this->display_model->printrec($this->input->get('id'));
		$data['userleave'] = $this->display_model->userleave($data['record'][0]->leave_type);
		$data['replacement'] = $this->display_model->staffreplacement($data['record'][0]->employee_replaced);

		//print_r($data['record']);
		//echo '<br><br>';
		//print_r($data['userleave']);
		//echo '<br><br>';
		//print_r($data['replacement']);
		//echo '<br><br>';

		//$data['leavedet'] = $this->display_model->leavedet($this->session->userdata('v_UserName'),$this->input->get('id'));
		if ($this->input->get('userid') == ''){
			$data['holiday_list'] = $this->display_model->holiday_list($this->session->userdata('v_UserName'),date('Y',strtotime($data['record'][0]->leave_from)));
		}
		else{
			$data['holiday_list'] = $this->display_model->holiday_list($this->input->get('userid'),date('Y',strtotime($data['record'][0]->leave_from)));	
		}
		//print_r($data['leavedet']);
		//echo '<br><br>';
		//print_r($data['holiday_list']);
		//echo '<br><br>';
		//exit();

		if ($data['holiday_list']){
			foreach ($data['holiday_list'] as $key => $value) {
			    $data['holidayarray'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['holidayarray'][] = NULL;
		}

		$data['holidayJB'] = $this->display_model->holidayJB(date('Y',strtotime($data['record'][0]->leave_from)));
		if($data['holidayJB']){
			foreach ($data['holidayJB'] as $key => $value) {
			    $data['JB_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['JB_hol'][] = NULL;
		}
		$data['holidayMKA'] = $this->display_model->holidayMKA(date('Y',strtotime($data['record'][0]->leave_from)));
		if($data['holidayMKA']){
			foreach ($data['holidayMKA'] as $key => $value) {
			    $data['MKA_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['MKA_hol'][] = NULL;
		}
		$data['holidayNS'] = $this->display_model->holidayNS(date('Y',strtotime($data['record'][0]->leave_from)));
		if($data['holidayNS']){
			foreach ($data['holidayNS'] as $key => $value) {
			    $data['NS_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['NS_hol'][] = NULL;
		}
		$data['holidaySEL'] = $this->display_model->holidaySEL(date('Y',strtotime($data['record'][0]->leave_from)));
		if($data['holidaySEL']){
			foreach ($data['holidaySEL'] as $key => $value) {
			    $data['SEL_hol'][] = strtotime(date($value->date_holiday));
			}
		}
		else{
			$data['SEL_hol'][] = NULL;
		}
		
		//$data['userleave'] = $this->display_model->userleave($data['record'][0]->leave_type);
		$data['leave_type'] = $this->display_model->leave_type();

		$data['fromdate'] = $data['record'][0]->leave_from;
		$data['todate'] = ($data['record'][0]->leave_to) ? $data['record'][0]->leave_to : $data['record'][0]->leave_from;

		//totalleavetaken
		$begin = strtotime($data['fromdate']);
	    $end   = strtotime($data['todate']);
	    
	    $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if($data['record'][0]->v_hospitalcode == 'JB'){
            	if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $data['holidayarray']))) { // 5 and 6 are weekend days
                $weekends++;
            	}
            }
            else{
            	if ($what_day > 5 || (in_array($begin, $data['holidayarray']))) { // 6 and 7 are weekend days
                $weekends++;
            	}
            }

            $begin += 86400; // +1 day
        }
        $data['noleave'] = $no_days - $weekends;
		//totalleavetaken

		//leavebalance
		$yearapplied = date('Y',strtotime($data['fromdate']));
		
		if ($this->input->get('userid') == ''){
			$data['leaveacc'] = $this->display_model->leaveacc($this->session->userdata('v_UserName'),$yearapplied);
			$data['tleavetaken'] = $this->display_model->tleavetakenprint($this->session->userdata('v_UserName'),$data['fromdate'],$yearapplied);
		}
		else{
			$data['leaveacc'] = $this->display_model->leaveacc($this->input->get('userid'),$yearapplied);
			$data['tleavetaken'] = $this->display_model->tleavetakenprint($this->input->get('userid'),$data['fromdate'],$yearapplied);	
		}

		//print_r($data['leaveacc']);
		//echo '<br><br>';
		//print_r($data['tleavetaken']);
		//exit();

		$data['ALtaken'] = 0;
		$data['SLtaken'] = 0;
		$data['ELtaken'] = 0;
		$data['UPLtaken'] = 0;
		$data['ESLtaken'] = 0;
		$data['FStaken'] = 0;
		$data['FSEtaken'] = 0;
		$data['PLtaken'] = 0;
		$data['PLEtaken'] = 0;
		$data['MLtaken'] = 0;
		$data['MLEtaken'] = 0;
		$data['MRLtaken'] = 0;
		$data['MRLEtaken'] = 0;
		$data['ULtaken'] = 0;
		$data['ULEtaken'] = 0;
		$data['STLtaken'] = 0;
		$data['STLEtaken'] = 0;
		$data['TLtaken'] = 0;
		$data['TLEtaken'] = 0;
		$data['HLtaken'] = 0;
		$data['HLEtaken'] = 0;
		foreach ($data['tleavetaken'] as $row){

			$data['fromhdate'] = $row->leave_from;
			$data['tohdate'] = ($row->leave_to) ? $row->leave_to : $row->leave_from;

			$begin = strtotime($data['fromhdate']);
		    $end   = strtotime($data['tohdate']);
		    
		    $no_days  = 0;
	        $weekends = 0;
	        while ($begin <= $end) {
	            $no_days++; // no of days in the given interval
	            $what_day = date("N", $begin);
							//echo "$what_day".$what_day;
	            if($data['record'][0]->v_hospitalcode == 'JB'){
	            	if (($what_day == 5) || ($what_day == 6) || (in_array($begin, $data['holidayarray']))) { // 5 and 6 are weekend days
	                $weekends++;
	            	}
	            }
	            else{
	            	if ($what_day > 5 || (in_array($begin, $data['holidayarray']))) { // 6 and 7 are weekend days
	                $weekends++;
	            	}
	            }
	            $begin += 86400; // +1 day
	        }
	        $data['noleavetaken'] = $no_days - $weekends;
	        if ($row->leave_type == '1'){  //annual leave
	        	$data['ALtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '2'){  //sick leave
	        	$data['SLtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '3'){  //emergency leave
				$data['ELtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '4'){  //unpaid leave
				$data['UPLtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '5'){  //extended sick leave
				$data['ESLtaken'] += $data['noleavetaken'];
	        }
	        elseif($row->leave_type == '6'){  //family sick leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][5]->per_case_basis){
				$data['FStaken'] += $data['noleavetaken'];
				}
				else{
				$data['FStaken'] += $data['leave_type'][5]->per_case_basis;
				$data['FSEtaken'] += ($data['noleavetaken'] - $data['leave_type'][5]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '7'){  //maternity leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][6]->per_case_basis){
				$data['MLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['MLtaken'] += $data['leave_type'][6]->per_case_basis;
				$data['MLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][6]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '8'){  //paternity leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][7]->per_case_basis){
				$data['PLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['PLtaken'] += $data['leave_type'][7]->per_case_basis;
				$data['PLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][7]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '9'){  //marriage leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][8]->per_case_basis){
				$data['MRLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['MRLtaken'] += $data['leave_type'][8]->per_case_basis;
				$data['MRLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][8]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '10'){  //unrecorded leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][9]->per_case_basis){
				$data['ULtaken'] += $data['noleavetaken'];
				}
				else{
				$data['ULtaken'] += $data['leave_type'][9]->per_case_basis;
				$data['ULEtaken'] += ($data['noleavetaken'] - $data['leave_type'][9]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '11'){  //study leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][10]->per_case_basis){
				$data['STLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['STLtaken'] += $data['leave_type'][10]->per_case_basis;
				$data['STLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][10]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '12'){  //transfer leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][11]->per_case_basis){
				$data['TLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['TLtaken'] += $data['leave_type'][11]->per_case_basis;
				$data['TLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][11]->per_case_basis);
				}
	        }
	        elseif($row->leave_type == '13'){  //hajj leave
	        	if ($data['noleavetaken'] <= $data['leave_type'][12]->per_case_basis){
				$data['HLtaken'] += $data['noleavetaken'];
				}
				else{
				$data['HLtaken'] += $data['leave_type'][12]->per_case_basis;
				$data['HLEtaken'] += ($data['noleavetaken'] - $data['leave_type'][12]->per_case_basis);
				}
	        }
		}
		//echo 'PL :'.$data['PLtaken'].'<br> PLE :'.$data['PLEtaken'];
		//exit();
		$data['SLbalance'] = (isset($data['leaveacc'][0]->sick_leave) ? $data['leaveacc'][0]->sick_leave : 0) - $data['SLtaken'];
			if ($data['SLbalance'] < 0){
				$data['SLEtaken'] = abs($data['SLbalance']);
				//$data['balanceleave'] = 0;
			}
		if ($data['record'][0]->leave_type == '1'){
		$data['annualB'] = (isset($data['leaveacc'][0]->annual_leave) ? $data['leaveacc'][0]->annual_leave : 0) + (isset($data['leaveacc'][0]->carry_fwd_leave) ? $data['leaveacc'][0]->carry_fwd_leave : 0) 
		 						- $data['ALtaken'] - $data['ELtaken'] - $data['FSEtaken'] - $data['PLEtaken'] - $data['MLEtaken']  - $data['MRLEtaken']  - $data['ULEtaken']  - $data['STLEtaken']  - $data['TLEtaken']
		 						- $data['HLEtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);

			if ($data['annualB'] < 0){
        	  $data['ALEtaken'] = abs($data['annualB']);
        	  $data['balanceleave'] = 0;
        	}
        	else{
        	  $data['balanceleave'] = $data['annualB'];
        	}

        	$data['totaltaken'] = $data['ALtaken'] + $data['ELtaken'] + $data['FSEtaken'] + $data['PLEtaken'] + $data['MLEtaken']  + $data['MRLEtaken']  + $data['ULEtaken']  + $data['STLEtaken']  + $data['TLEtaken']
        						  + $data['HLEtaken'] + (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);
		}
		elseif($data['record'][0]->leave_type == '2'){
		$data['balanceleave'] = $data['SLbalance'];
			if ($data['balanceleave'] < 0){
				//$data['SLEtaken'] = abs($data['SLbalance']);
				$data['balanceleave'] = 0;
			}
		$data['totaltaken'] = $data['SLtaken'] - (isset($data['SLEtaken']) ? $data['SLEtaken'] : 0);
		}
		elseif($data['record'][0]->leave_type == '3'){
		$data['balanceleave'] = (isset($data['userleave'][0]->limit_days) ? $data['userleave'][0]->limit_days : 0) - $data['ELtaken'];
		$data['totaltaken'] = $data['ELtaken'];
		}
		elseif($data['record'][0]->leave_type == '4'){
		$data['balanceleave'] = 0;
		$data['totaltaken'] = $data['UPLtaken'];
		}
		elseif($data['record'][0]->leave_type == '5'){
		$data['balanceleave'] = 0;
		$data['totaltaken'] = $data['ESLtaken'];
		}
		elseif($data['record'][0]->leave_type == '6'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['FStaken'];
		$data['totaltaken'] = $data['FStaken'];
		}
		elseif($data['record'][0]->leave_type == '7'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['MLtaken'];
		$data['totaltaken'] = $data['MLtaken'];
		}
		elseif($data['record'][0]->leave_type == '8'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['PLtaken'];
		$data['totaltaken'] = $data['PLtaken'];
		}
		elseif($data['record'][0]->leave_type == '9'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['MRLtaken'];
		$data['totaltaken'] = $data['MRLtaken'];
		}
		elseif($data['record'][0]->leave_type == '10'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['ULtaken'];
		$data['totaltaken'] = $data['ULtaken'];
		}
		elseif($data['record'][0]->leave_type == '11'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['STLtaken'];
		$data['totaltaken'] = $data['STLtaken'];
		}
		elseif($data['record'][0]->leave_type == '12'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['TLtaken'];
		$data['totaltaken'] = $data['TLtaken'];
		}
		elseif($data['record'][0]->leave_type == '13'){
		$data['balanceleave'] = (isset($data['userleave'][0]->entitle_days) ? $data['userleave'][0]->entitle_days : 0) - $data['HLtaken'];
		$data['totaltaken'] = $data['HLtaken'];
		}
		//leavebalance

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

	function cancel_applied($id){
		
	}
	
}