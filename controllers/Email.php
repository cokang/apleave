<?php 
   class email extends CI_Controller { 
 
      function __construct() { 
			
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form');  
				 
			echo "hjklkk : ".$this->input->get('ret');
 //exit();
 if ($this->input->get('ret')!=99) {
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
			}
		
      public function index() { 
	
         $this->load->helper('form'); 
         $this->load->view('email_form'); 
      } 
			
			public function scheduleremail() { 
				 echo "lalalalalallazzzzz";
         //$this->load->helper('form'); 
         //$this->load->view('email_form'); 
      } 
  
      public function send_mail() { 
         $from_email = "your@example.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) {
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
				 echo "berjaya antar emel"; }
         else {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
				 echo "x berjaya antar emel"; 
         $this->load->view('email_form'); }
      } 
			
			public function send_mailz() { 
         $from_email = "your@example.com"; 
         $to_email = $this->input->get('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) {
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
				 echo "berjaya antar emel"; }
         else {
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
				 echo "x berjaya antar emel"; 
         $this->load->view('email_form'); }
      } 
			
   } 
?>