<?php
class outside_model extends CI_Model
{
function __construct() {
parent::__construct();

}
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
	
	function validate()
	{
		$DBo = $this->load->database('ibu', TRUE);
		$DBo->where('v_userid', $this->input->post('name'));
		$DBo->where('v_password',md5($this->input->post('password')));
		$query = $DBo->get('pmis2_sa_user');
		$DBo->close();
		if( $query->num_rows ==1)
		{
			return TRUE;
		}
	}	
	
}
?>