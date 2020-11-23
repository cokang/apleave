<?php

class add_employee_ctrl extends CI_Controller{

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
		$userid = $this->input->post('emp_uname');
		$emp_type = $this->input->post('emp_type');
		$emp_apsb = $this->input->post('emp_apsb');
		$this->load->model('insert_model');
		if( $this->insert_model->employee_exist('v_UserID',$userid,'apsb_no',$emp_apsb,$emp_type) ){
			redirect('Controllers/employee_listing');
		}else{
			$this->load->helper('url');
			redirect_back();
		}
	}


	function save_personal(){
		//echo $this->input->post('date_kahwin');
		//exit();
			$this->load->model('insert_model');
			$this->load->model('update_model');

		$insert_data=array('v_user_id'=>$this->session->userdata('v_UserName'),
											 'v_add1'=>$this->input->post('address'),
											 'v_add2'=>$this->input->post('poscode'),
											 'v_tel_1'=>$this->input->post('phone_no'),
											 'v_tel_2'=>$this->input->post('phone_no1'),
											 'v_marital_st'=>$this->input->post('mstatus'),
											 'v_spouse_name'=>$this->input->post('nama_psgn'),
											 'v_race'=>$this->input->post('bstatus'),
											 'v_religion'=>$this->input->post('agama'),
											 'v_marital_date'=>($this->input->post('date_kahwin')) ? date('y-m-d',strtotime($this->input->post('date_kahwin'))) : null,
											 'v_nationality'=>$this->input->post('n_nality'),
											 'v_spouse_ic'=>$this->input->post('icpsgn'),
											 'v_spouse_ps'=>$this->input->post('ppsgn'),
											 'v_spouse_cr'=>$this->input->post('jobpsgn'),
											 'v_spouse_emp'=>$this->input->post('emppsgn'),
											 'v_spouse_tel'=>$this->input->post('phonpsgn'),
											 'D_timestamp' => date('Y-m-d H:i:s'),
											 'v_pos_add1'=>$this->input->post('pos_address'),
											 'v_pos_add2'=>$this->input->post('pos_poscode'),
											 'v_tel_comp'=>$this->input->post('phone_no2')
							 );

			$update_data=array('v_add1'=>$this->input->post('address'),
											 'v_add2'=>$this->input->post('poscode'),
											 'v_tel_1'=>$this->input->post('phone_no'),
											 'v_tel_2'=>$this->input->post('phone_no1'),
											 'v_marital_st'=>$this->input->post('mstatus'),
											 'v_spouse_name'=>$this->input->post('nama_psgn'),
											 'v_race'=>$this->input->post('bstatus'),
											 'v_religion'=>$this->input->post('agama'),
											 'v_marital_date'=>date('y-m-d',strtotime($this->input->post('date_kahwin'))),
											 'v_nationality'=>$this->input->post('n_nality'),
											 'v_spouse_ic'=>$this->input->post('icpsgn'),
											 'v_spouse_ps'=>$this->input->post('ppsgn'),
											 'v_spouse_cr'=>$this->input->post('jobpsgn'),
											 'v_spouse_emp'=>$this->input->post('emppsgn'),
											 'v_spouse_tel'=>$this->input->post('phonpsgn'),
											 'D_timestamp' => date('Y-m-d H:i:s'),
											 'v_pos_add1'=>$this->input->post('pos_address'),
											 'v_pos_add2'=>$this->input->post('pos_poscode'),
											 'v_tel_comp'=>$this->input->post('phone_no2')
							 );

			$ins=$this->insert_model->simpan_personal($insert_data,$update_data);
			if($ins){
			//echo $this->input->post('del_c');exit();
			$delc=explode(",",$this->input->post('del_c'));
			$delc1=explode(",",$this->input->post('del_c1'));
			$delc2=explode(",",$this->input->post('del_c2'));

			if($delc){
			$this->update_model->delete_anak($delc);
			}
			if($delc1){
			$this->update_model->delete_emg($delc1);
			}
			if($delc2){
			$this->update_model->delete_fam($delc2);
			}
			//echo "<pre>";
			//print_r($delc);exit();
		 //$id=($this->input->post('id')) ? $this->input->post('id') : $this->db->insert_id();
		 		 $id=($this->input->post('id')) ? $this->input->post('id') : $ins;
		if($this->input->post('id_c')){
		foreach($this->input->post('id_c') as $key){
		$child_data=array(
		'v_ch_name'=>$this->input->post('nama_son')[$key],
		'v_marital_st'=>$this->input->post('sts_son')[$key],
		'v_oku'=>$this->input->post('oku')[$key],
		'v_career'=>$this->input->post('crc_son')[$key],
		'v_gender'=>$this->input->post('gdr_son')[$key],
		'v_school'=>$this->input->post('school_son')[$key],
		'v_country'=>$this->input->post('country_son')[$key],
		'v_birth_dt'=>($this->input->post('bfdate')[$key]) ? date('y-m-d',strtotime($this->input->post('bfdate')[$key])) : null,
		'v_ch_id'=>$this->input->post('id_son')[$key],
		'v_ch_ps'=>$this->input->post('ps_son')[$key]
		);
		$this->update_model->update_anak($key,$child_data);
		}
		}
		foreach($this->input->post('nama_son') as $key=>$nilai){
		if(!in_array($key,$this->input->post('id_c'))){
		$child_data=array(
		'v_row_id'=>$id,
		'v_ch_name'=>$nilai,
		'v_marital_st'=>$this->input->post('sts_son')[$key],
		'v_oku'=>$this->input->post('oku')[$key],
		'v_career'=>$this->input->post('crc_son')[$key],
		'v_gender'=>$this->input->post('gdr_son')[$key],
		'v_school'=>$this->input->post('school_son')[$key],
		'v_country'=>$this->input->post('country_son')[$key],
		'v_birth_dt'=>($this->input->post('bfdate')[$key]) ? date('y-m-d',strtotime($this->input->post('bfdate')[$key])) : null,
		'v_ch_id'=>$this->input->post('id_son')[$key],
		'v_ch_ps'=>$this->input->post('ps_son')[$key]
		);
		if($nilai <> ''){
		$this->insert_model->simpan_anak($child_data);
		}
			}
		}


			if($this->input->post('id_c1')){
		foreach($this->input->post('id_c1') as $key1){
		$emg_data=array(
				'v_em_name'=>$this->input->post('emg_name')[$key1],
				'v_em_relay'=>$this->input->post('emg_rel')[$key1],
				'v_em_tel'=>$this->input->post('emg_phne')[$key1]
		);
		$this->update_model->update_emg($key1,$emg_data);
		}
		 }
		foreach($this->input->post('emg_name') as $key1=>$nilai1){
		if(!in_array($key1,$this->input->post('id_c1'))){
		$emg_data=array(
		'v_row_id'=>$id,
				'v_em_name'=>$nilai1,
				'v_em_relay'=>$this->input->post('emg_rel')[$key1],
				'v_em_tel'=>$this->input->post('emg_phne')[$key1]
		);
		if($nilai1 <> ''){
		$this->insert_model->simpan_emg($emg_data);
		}
			 }
		}



		if($this->input->post('id_c2')){
			foreach($this->input->post('id_c2')as $key2){
				$famLink_data=array(
					'v_fam_name'=>$this->input->post('nama_fam')[$key2],
					'v_fam_pos'=>$this->input->post('pos_fam')[$key2],
					'v_fam_dept'=>$this->input->post('dep_fam')[$key2],
					'v_fam_loc'=>$this->input->post('loc_fam')[$key2],
					'v_fam_relay'=>$this->input->post('rel_fam')[$key2],
				);

				$this->update_model->update_fam($key2,$famLink_data);
			}
		}

		foreach($this->input->post('nama_fam') as $key2=>$nilai2){
			if(!in_array($key2,$this->input->post('id_c2'))){
				$famLink_data=array(
					'v_fam_id'=>$id,
					'v_fam_name'=>$nilai2,
					'v_fam_pos'=>$this->input->post('pos_fam')[$key2],
					'v_fam_dept'=>$this->input->post('dep_fam')[$key2],
					'v_fam_loc'=>$this->input->post('loc_fam')[$key2],
					'v_fam_relay'=>$this->input->post('rel_fam')[$key2],
				);
				if($nilai2 <> ''){
					$this->insert_model->simpan_fam($famLink_data);
				}
			}
		}
		

		redirect('Controllers/employee_profile?tab=3');
		}else{
			$this->load->helper('url');
			redirect_back();
		}
	}

}
?>
