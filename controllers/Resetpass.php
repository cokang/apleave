<?php
   class resetpass extends CI_Controller {

      function __construct() {

         parent::__construct();
         $this->load->library('session');
         $this->load->helper('form');

			//echo "hjklkk : ".$this->input->get('ret');
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
         $this->load->view('Resetpass_form');
      }

			public function scheduleremail() {
				 echo "lalalalalallazzzzz";
         //$this->load->helper('form');
         //$this->load->view('email_form');
      }

      public function send_reset() {
         $to_email = $this->input->post('email');
         //echo "lalalalal : " . $to_email;
         //exit();
         if ($to_email != "") {
           //echo "dier masuk";
           //exit();
         $this->load->model('outside_model');
     		 $query = $this->outside_model->changpasswrdr($to_email,'abc123');
         if($query > 0) {
         $this->session->set_flashdata("reset_sent","Userid Resetted");
				 echo $to_email . " Resetted";
         $this->load->view('Resetpass_form');}
         else {
         $this->session->set_flashdata("reset_sent","Userid reset Failed");
				 echo $to_email . " reset failed";
         $this->load->view('Resetpass_form'); } } else {
           $this->session->set_flashdata("reset_sent","Please key in userid");
  				 echo $to_email . " reset failed no userid";
           $this->load->view('Resetpass_form');
         }
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
