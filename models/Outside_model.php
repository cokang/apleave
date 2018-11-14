<?php
class outside_model extends CI_Model
{
function __construct() {
parent::__construct();

}
/*
	function firsttest(){
		$DBo = $this->load->database('mainn', TRUE);
		$DBo->select('v_UserName');
		$DBo->where('v_userid','fmgr');
		$DBo->from('pmis2_sa_user');
		$query = $DBo->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		$DBo->close();
		return $query_result;
	}

	function firsttestsql(){
		$DBo = $this->load->database('mssql', TRUE);
		$DBo->select('v_Asset_name');
		$DBo->where('V_Asset_no','BEANE02-0001');
		$DBo->from('pmis2_EGM_AssetRegistration');
		$query = $DBo->get();
		//echo $this->db->last_query();
		//exit();
		$query_result = $query->result();
		$DBo->close();
		return $query_result;
	}
	*/
	function validate()
	{
		$DBo = $this->load->database('ibu', TRUE);
		$DBo->where('v_userid', $this->input->post('name'));
		$DBo->where('v_password',md5($this->input->post('password')));
		$query = $DBo->get('pmis2_sa_user');
		$DBo->close();
		if( $query->num_rows() ==1)
		{
			return TRUE;
		}
	}

	function matchpass(){
	  $DBo = $this->load->database('ibu', TRUE);
		$DBo->where('v_userid', $this->session->userdata('v_UserName'));
		$DBo->where('v_password',md5($this->session->userdata('v_password')));
		$query = $DBo->get('pmis2_sa_user');
		$DBo->close();
		if( $query->num_rows() ==1)
		{
			return TRUE;
		}
	}

	function changpasswrd($username, $npassword)
	{
	$DBo = $this->load->database('ibu', TRUE);
	$DBo->set('v_password',md5($npassword));
	$DBo->set('v_sec_dt', 'now()',false);
	$DBo->where('v_UserID', $username);
	$DBo->update('pmis2_sa_user');
	//echo $DBo->last_query();
	//exit();
  	return $DBo->affected_rows() > 0;
		$DBo->close();

  	}

	function changpasswrdr($username, $npassword)
		{
		$DBo = $this->load->database('ibu', TRUE);
		$DBo->set('v_password',md5($npassword));
		$DBo->set('v_sec_dt', 'DATE_ADD(NOW(), INTERVAL -5 MONTH)',false);
		$DBo->where('v_UserID', $username);
		$DBo->update('pmis2_sa_user');
		//echo $DBo->last_query();
		//exit();
	  	return $DBo->affected_rows() > 0;
			$DBo->close();

	  	}

	function addemployee($insert_data){
	$DBo = $this->load->database('ibu', TRUE);
	$DBo->insert('pmis2_sa_user', $insert_data);
	}

	function validate4($userid)
	{
		$DBo = $this->load->database('ibu', TRUE);
		$DBo->select('datediff(now(), IFNULL(a.v_sec_dt,now())) AS dayer, b.valid_period',false) ;
		$DBo->where('v_userid', $userid);
		$DBo->join('pmis2_sa_passvalidity b','a.v_hospitalcode = b.hosp');
		$query = $DBo->get('pmis2_sa_user a');

		//echo $DBo->last_query();

		//exit();

		return $query->result();

	}

}
?>
