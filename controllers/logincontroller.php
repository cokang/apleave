<?php 

class LoginController extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->load->helper(array('form','html','url','html'));
		$this->load->model('loginModel');
		
	}
	
	 public function index(){
            $this->load->view('Login');
	}
	
	
	function logout()
 	{
 		
  	$this->session->sess_destroy();
  	$this->index();
	}
	
	function validate_credentials()
	{
		$this->load->model('loginModel');
		//$query = $this->loginModel->validate();
		$queryu = $this->loginModel->validateu();
		$this->load->model('outside_model');
		$query = $this->outside_model->validate();
		$this->load->model('loginModel');
		if($query && $queryu)
		{
		
			$data = array
				('v_UserName'=>$this->input->post('name'),
				'v_password' =>$this->input->post('password'),
				 //'username'=>$session_data['i.file_name'],
				'hosp_code'=>'IIUM',
				'is_logged_in'=>TRUE,);
			$this->session->set_userdata($data);
		//print_r($data);
		//exit();
		
			$url =site_url('Controllers/apply_leave');
			redirect($url, 'refresh');
		}
		else
		{
			
			$this->index();
		}
	
	}
	
	function signup()
		{
			
			$this->load->view('signup_form');
			
		}
	function chgPassword()       
    {
		$this->load->model('loginModel');
		$query1 = $this->loginModel->matchpass();
			if($query1){
		$query = $this->loginModel->changpasswrd($this->session->userdata('v_UserName'),$this->input->post('npassword'));
    	//$this->session->set_flashdata('message','<span class="label label-info">Password changed!</span>');
    	echo "<script type='text/javascript'>alert('Password is updated!')</script>";
    	redirect('LoginController','refresh') ;
			}
			else {
				echo "<script type='text/javascript'>alert('Username or Password are not match!')</script>";
				
				redirect('LoginController','refresh') ;
				//$this->index();
			}	
	}

	function create_member()
	{
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name','Name','trim|required');
		$this->form_validation->set_rules('last_name','Last Name','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password2','Password Confirmation','trim|required|matches[password]');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->signup();	
		}
		
		else
		{
		$this->load->model('loginModel');
		if($query = $this->loginModel->create_member())
		{
			
			
			$this->load->view('signup_successful');
		}
		else
		{
			
			$this->load->view('signup_form');
			
		}
		}
	}
	
}
?>