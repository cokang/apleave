<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="main-div">
<div align="right" style="font-family: Arial;font-size: 8px;">FORM/MSD/HR/08</div>
<table class="tblaq2">
			<tr>
			<th colspan="5" >HOME ADDRESS</th>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Permanent Address</td>
			<td colspan="4"><input type="text" id="address" name="address" style="width: 100%" class="form-control" value="<?= isset($personal[0]->v_add1) ? $personal[0]->v_add1 : '' ?>"></td>
			</tr>
			

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Post Code</td>
			<td><input type="text" id="poscode" name="poscode" value="<?= isset($personal[0]->v_add2) ? $personal[0]->v_add2 : '' ?>" style="width: 100%" class="form-control"></td>
			<td width="2%"></td>
			<!--<td width="15%">Town</td>
			<td><input type="text" id="town"  name="town"  style="width: 100%" class="form-control"></td>-->
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Postal Address</td>
			<td colspan="4"><input type="text" id="pos_address" name="pos_address" style="width: 100%" class="form-control" value="<?= isset($personal[0]->v_pos_add1) ? $personal[0]->v_pos_add1 : '' ?>"></td>
			</tr>
			

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Post Code</td>
			<td><input type="text" id="pos_poscode" name="pos_poscode" value="<?= isset($personal[0]->v_pos_add2) ? $personal[0]->v_pos_add2 : '' ?>" style="width: 100%" class="form-control"></td>
			<td width="2%"></td>
			<!--<td width="15%">Town</td>
			<td><input type="text" id="town"  name="town"  style="width: 100%" class="form-control"></td>-->
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Phone No</td>
			<td><input type="text" id="phone_no" name="phone_no" value="<?= isset($personal[0]->v_tel_1) ? $personal[0]->v_tel_1 : '' ?>"style="width: 100%" class="form-control"></td>
			<td width="2%"></td>
			<td width="15%">Phone No(Home)</td>
			<td><input type="text"  id="phone_no1" name="phone_no1" value="<?= isset($personal[0]->v_tel_2) ? $personal[0]->v_tel_2 : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

			<tr height="5">
			</tr>
			<tr>
			
			<td width="15%">Phone No(Company)</td>
			<td><input type="text"  id="phone_no2" name="phone_no2" value="<?= isset($personal[0]->v_tel_comp) ? $personal[0]->v_tel_comp : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

		</table>
		<table class="tblaq2" style="margin-top: 2%;">
			<tr>
			<th colspan="5">MARITAL STATUS</th>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td style="font-size: 15px" width="15%">Marital Status</td>
			<td colspan="3"><div id="bujang">
			<label class="radio-inline">
            <input type="radio" name="mstatus" value="Single" <?=isset($personal[0]->v_marital_st)&&($personal[0]->v_marital_st=='Single') ? 'checked' : ''; ?> >Single
           </label>
           <label class="radio-inline">
            <input type="radio" name="mstatus" value="Married" <?=isset($personal[0]->v_marital_st)&&($personal[0]->v_marital_st=='Married') ? 'checked' : ''; ?>>Married
            </label>
            <label class="radio-inline">
            <input type="radio" name="mstatus" value="Divorced" <?=isset($personal[0]->v_marital_st)&&($personal[0]->v_marital_st=='Divorced') ? 'checked' : ''; ?>>Divorced
            </label></div></td>
			<td></td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Spouse Name</td>
			<td colspan="4"><input type="text" name="nama_psgn" value="<?= isset($personal[0]->v_spouse_name) ? $personal[0]->v_spouse_name : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td style="font-size: 15px" width="15%">Nation</td>
			<td colspan="3">
			<div id="bangsa">
			<label class="radio-inline">
			<input type="radio" name="bstatus" value="Malay" <?=isset($personal[0]->v_race)&&($personal[0]->v_race=='Malay') ? 'checked' : ''; ?>>Malay
           </label>
           <label class="radio-inline">
            <input type="radio" name="bstatus" value="India" <?=isset($personal[0]->v_race)&&($personal[0]->v_race=='India') ? 'checked' : ''; ?>>India
            </label>
            <label class="radio-inline">
            <input type="radio" name="bstatus" value="Cina" <?=isset($personal[0]->v_race)&&($personal[0]->v_race=='Cina') ? 'checked' : ''; ?>>Cina
            </label> 
			<label class="radio-inline">
            <input type="radio" name="bstatus" value="Others" <?=isset($personal[0]->v_race)&&($personal[0]->v_race=='Others') ? 'checked' : ''; ?>>Others
            </label>
			</div>
		    </td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%">Religion</td>
			<td colspan="4"><input type="text" name="agama" value="<?= isset($personal[0]->v_religion) ? $personal[0]->v_religion : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td style="font-size: 15px" width="10%">Date of Marriage</td>
			<td><input name="date_kahwin" id="datepicker" type="text" class="form-control" value="<?= isset($personal[0]->v_marital_date) ? date('d-m-Y',strtotime($personal[0]->v_marital_date)) : '' ?>" autocomplete="off"></td>
			<td align="center" style="font-size: 15px:" width="10%">Nationality</td>
			<?php 
			$options = array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"IO" => "British Indian Ocean Territory",
"BN" => "Brunei Darussalam",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos (Keeling) Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo",
"CD" => "Congo, the Democratic Republic of the",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"CI" => "Cote D'Ivoire",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands (Malvinas)",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and Mcdonald Islands",
"VA" => "Holy See (Vatican City State)",
"HN" => "Honduras",
"HK" => "Hong Kong",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran, Islamic Republic of",
"IQ" => "Iraq",
"IE" => "Ireland",
"IL" => "Israel",
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KP" => "Korea, Democratic People's Republic of",
"KR" => "Korea, Republic of",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Lao People's Democratic Republic",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libyan Arab Jamahiriya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macao",
"MK" => "Macedonia, the Former Yugoslav Republic of",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"MX" => "Mexico",
"FM" => "Micronesia, Federated States of",
"MD" => "Moldova, Republic of",
"MC" => "Monaco",
"MN" => "Mongolia",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territory, Occupied",
"PA" => "Panama",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RE" => "Reunion",
"RO" => "Romania",
"RU" => "Russian Federation",
"RW" => "Rwanda",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"ST" => "Sao Tome and Principe",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syrian Arab Republic",
"TW" => "Taiwan, Province of China",
"TJ" => "Tajikistan",
"TZ" => "Tanzania, United Republic of",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UG" => "Uganda",
"UA" => "Ukraine",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"UM" => "United States Minor Outlying Islands",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VE" => "Venezuela",
"VN" => "Viet Nam",
"VG" => "Virgin Islands, British",
"VI" => "Virgin Islands, U.s.",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe"
);
            $shirts_on_sale = array('small', 'large');
			?>
			<td colspan="2"><!--<input type="text" id="bgsa" name="bgsa" style="width: 100%" value="<?= isset($personal[0]->v_nationality) ? $personal[0]->v_nationality : '' ?>" class="form-control">-->
			<?=form_dropdown('n_nality', $options, isset($personal[0]->v_nationality) ? $personal[0]->v_nationality : 'MY','class="form-control"');?>
			</td>
			</tr>

		</table>

		<table class="tblaq2" style="margin-top: 2%;">
			<tr>
			<th colspan="5">SPOUSE INFORMATION</th>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%"> No IC Spouse</td>
			<td colspan="4"><input type="text" name="icpsgn" value="<?= isset($personal[0]->v_spouse_ic) ? $personal[0]->v_spouse_ic : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%"> No Passport</td>
			<td colspan="4"><input type="text" name="ppsgn" value="<?= isset($personal[0]->v_spouse_ps) ? $personal[0]->v_spouse_ps : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

			<tr height="5">
			</tr>

			<tr>
			<td width="15%"> Jobs</td>
			<td colspan="4"><input type="text" name="jobpsgn" value="<?= isset($personal[0]->v_spouse_cr) ? $personal[0]->v_spouse_cr : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>
			<tr height="5">
			</tr>

			<tr>
			<td width="15%"> Employer</td>
			<td colspan="4"><input type="text" name="emppsgn" value="<?= isset($personal[0]->v_spouse_emp) ? $personal[0]->v_spouse_emp : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>
			<tr height="5">
			</tr>

			<tr>
			<td width="15%"> Phone No</td>
			<td colspan="4"><input type="text" name="phonpsgn" value="<?= isset($personal[0]->v_spouse_tel) ? $personal[0]->v_spouse_tel : '' ?>" style="width: 100%" class="form-control"></td>
			</tr>

		</table>

		
		<table class="tblaq2" style="margin-top: 2%;" id="tera3">
			<tr>
			<th colspan="10" >EMPLOYEE RELATION WITHIN THE COMPANY</th>
			</tr>

			<tr height="7">
			</tr>

			<tr class="tr1">
				<td>Name</td>
				<td>Position</td>
				<td>Department</td>
				<td>Location</td>
				<td>Relationship</td>
			</tr>
			<?php if ($p_fam) { ?>
			<?php foreach($p_fam as $row){ ?>
			<tr>
			    <td><input style="width: 100%;" type="text" name="nama_fam[<?=$row->id;?>]" value="<?=$row->v_fam_name;?>" ></td>
			    <td><input style="width: 100%;" type="text" name="pos_fam[<?=$row->id;?>]" value="<?=$row->v_fam_pos;?>" ></td>
			    <td><input style="width: 100%;" type="text" name="dep_fam[<?=$row->id;?>]"  value="<?=$row->v_fam_dept;?>"></td>
				<td><input style="width: 100%;" type="text" name="loc_fam[<?=$row->id;?>]"  value="<?=$row->v_fam_loc;?>" ></td>
				<td><input style="width: 100%;" type="text" name="rel_fam[<?=$row->id;?>]"  value="<?=$row->v_fam_relay;?>" ></td>
			    <td><input  type="checkbox" name="record3" value="<?=$row->id;?>"></td> 
              <?php echo form_hidden('id_c2[]',($row->id) ? $row->id : '');?>				
             			
          </tr>
			<?php } ?>
			 <?php echo form_hidden('del_c2','');?>	
			<?php }else{ ?>
			<tr>
			    <td><input style="width: 100%;" type="text" name="nama_fam[]"></td>
			    <td><input style="width: 100%;" type="text" name="pos_fam[]"></td>
			    <td><input style="width: 100%;" type="text" name="dep_fam[]"></td>
			    <td><input style="width: 100%;" type="text" name="loc_fam[]"></td>
				<td><input style="width: 100%;" type="text" name="rel_fam[]"></td>
			    <td><input  type="checkbox" name="record3"></td>  
          </tr>
			<?php } ?>
          </table>
          <div style="text-align: right; margin-top: 1%;"><button class="add-row3 btn btn-default">ADD ROW</button> &nbsp&nbsp<button class="delete-row3 btn btn-default">DELETE ROW</button></div>


		<table class="tblaq2" style="margin-top: 2%;" id="tera">
			<tr>
			<th colspan="10" >CHILD INFORMATION</th>
			</tr>

			<tr height="7">
			</tr>

			<tr class="tr1">
				<td>Name</td>
				<td>Marital Status</td>
				<td>OKU</td>
				<td>Status</td>
				<td>Education Level</td>
				<td>Local/Overseas</td>
				<td>Gender</td>
				<td>Date of Birth</td>
				<td>IC No</td>
				<td>Passport No</td>
			</tr>
			<?php $oku = array('No' => 'No', 
								'Yes'=> 'Yes'); 
				$martial = array('Single' => 'Single', 
								'Married' => 'Married',
								'Separate' => 'Separate');
				$loc = array('Local' => 'Local',
							 'Oversea'=> 'Oversea' );
				$gender = array('Male' => 'Male',
							 'Female'=> 'Female' );
				$status = array('Study' => 'Study',
							 'Working'=> 'Working' );
				$edu = array('School' => 'School',
							 'College'=> 'College',
							 'IPT'=>'IPT',
							 'IPTA'=>'IPTA' );
			?>
			<?php if ($p_child) { 
				$disable='';?>
			<?php foreach($p_child as $row){ 
				if($row->v_career=='Working'){
					$disable='disabled';
				}
				?>
			<tr>
			    <td><input style="width: 100%;" type="text" name="nama_son[<?=$row->id;?>]" value="<?=$row->v_ch_name;?>" ></td>
			    <!-- <td><input style="width: 100%;" type="text" name="sts_son[<?=$row->id;?>]" value="<?=$row->v_marital_st;?>" ></td> -->
				<td><?=form_dropdown('sts_son['.$row->id.']', $martial ,set_value('sts_son['.$row->id.']',isset($row->v_marital_st)?$row->v_marital_st:''), '   ');?></td>
				<td><?=form_dropdown('oku['.$row->id.']', $oku ,set_value('oku['.$row->id.']',isset($row->v_oku)?$row->v_oku:''), '   ');?></td>
			    <!-- <td><input style="width: 100%;" type="text" name="crc_son[<?=$row->id;?>]"  value="<?=$row->v_career;?>"></td> -->
				<!-- <td><input style="width: 100%;" type="text" name="school_son[<?=$row->id;?>]"  value="<?=$row->v_school;?>" ></td> -->
				<td><?=form_dropdown('crc_son['.$row->id.']', $status ,set_value('crc_son['.$row->id.']',isset($row->v_career)?$row->v_career:''), ' onchange="ifworking(this,'.$row->id.')"  ');?></td>
				<td><?=form_dropdown('school_son['.$row->id.']', $edu ,set_value('school_son['.$row->id.']',isset($row->v_school)?$row->v_school:''), $disable);?></td>
			    <!-- <td><input style="width: 100%;" type="text" name="country_son[<?=$row->id;?>]"  value="<?=$row->v_country;?>" ></td> -->
			    <td><?=form_dropdown('country_son['.$row->id.']', $loc ,set_value('country_son['.$row->id.']',isset($row->v_country)?$row->v_country:''), '   ');?></td>
				<!-- <td><input style="width: 100%;" type="text" name="gdr_son[<?=$row->id;?>]"  value="<?=$row->v_gender;?>" ></td> -->
				<td><?=form_dropdown('gdr_son['.$row->id.']', $gender ,set_value('gdr_son['.$row->id.']',isset($row->v_gender)?$row->v_gender:''), '   ');?></td>
				<td><input style="width: 100%;" type="text" name='bfdate[<?=$row->id;?>]' value="<?= isset($row->v_birth_dt) ? date('d-m-Y',strtotime($row->v_birth_dt)) : '' ?>" onclick="test(<?=$row->id;?>)"  id="datepilih<?=$row->id;?>" readonly autocomplete="off"></td>
			    <td><input style="width: 100%;" type="text" name="id_son[<?=$row->id;?>]" value="<?=$row->v_ch_id;?>"></td>  
			    <td><input style="width: 100%;" type="text" name="ps_son[<?=$row->id;?>]" value="<?=$row->v_ch_ps;?>"></td> 
			    <td><input  type="checkbox" name="record" value="<?=$row->id;?>"></td> 
              <?php echo form_hidden('id_c[]',($row->id) ? $row->id : '');?>				
             			
          </tr>
			<?php } ?>
			 <?php echo form_hidden('del_c','');?>	
			<?php }else{ ?>
			<tr>
			    <td><input style="width: 100%;" type="text" name="nama_son[0]"></td>
			    <!-- <td><input style="width: 100%;" type="text" name="sts_son[]"></td>
				<td><input style="width: 100%;" type="text" name="oku[]"></td> -->
				<td><?=form_dropdown('sts_son[0]', $martial ,'');?></td>
				<td><?=form_dropdown('oku[0]', $oku ,'');?></td>
			    <!-- <td><input style="width: 100%;" type="text" name="crc_son[]"></td>
				<td><input style="width: 100%;" type="text" name="school_son[]"></td> -->
				<td><?=form_dropdown('crc_son[0]', $status ,'','onchange="ifworking(this,0)"');?></td>
				<td><?=form_dropdown('school_son[0]', $edu ,'');?></td>
				<!-- <td><input style="width: 100%;" type="text" name="country_son[]"></td> -->
				<td><?=form_dropdown('country_son[0]', $loc ,'');?></td>
				<td><?=form_dropdown('gdr_son[0]', $gender ,'');?></td>
				<!-- <td><input style="width: 100%;" type="text" name="gdr_son[]"></td> -->
			    <td><input style="width: 100%;" type="text" name='bfdate[0]' onclick="test(0)"  id="datepilih0" readonly autocomplete="off"></td>
			    <td><input style="width: 100%;" type="text" name="id_son[0]"></td>  
			    <td><input style="width: 100%;" type="text" name="ps_son[0]"></td> 
			    <td><input  type="checkbox" name="record"></td>  
          </tr>
			<?php } ?>
          </table>
          <div style="text-align: right; margin-top: 1%;"><button class="add-row btn btn-default">ADD ROW</button> &nbsp&nbsp<button class="delete-row btn btn-default">DELETE ROW</button></div>

          <table class="tblaq2" style="margin-top: 2%;" id="tera2">
			<tr>
			<th colspan="4"> EMERGENCY INFORMATION</th>
			</tr>

			<tr height="7">
			</tr>


			<tr class="tr1">
				<td>Name</td>
				<td>Relation</td>
				<td>Phone Number</td>
			</tr>
			<?php if ($p_emgcy) { ?>
			<?php foreach($p_emgcy as $row){ ?>
		    <tr>
			    <td><input style="width: 100%;" type="text" name="emg_name[<?=$row->id;?>]" value="<?=$row->v_em_name;?>"></td>
			    <td><input style="width: 100%;" type="text" name="emg_rel[<?=$row->id;?>]" value="<?=$row->v_em_relay;?>"></td>
			    <td><input style="width: 100%;" type="text" name="emg_phne[<?=$row->id;?>]" value="<?=$row->v_em_tel;?>"></td>
			    <td><input type="checkbox" name="record2" value="<?=$row->id;?>"></td>  
 <?php echo form_hidden('id_c1[]',($row->id) ? $row->id : '');?>        
		</tr>
		   
			<?php } ?> 
			 <?php echo form_hidden('del_c1','');?>	
			<?php }else{ ?>
			<tr>
			    <td><input style="width: 100%;" type="text" name="emg_name[]"></td>
			    <td><input style="width: 100%;" type="text" name="emg_rel[]"></td>
			    <td><input style="width: 100%;" type="text" name="emg_phne[]"></td>
			    <td><input type="checkbox" name="record2"></td>  
          </tr>
			<?php } ?>
		</table>
		<div style="text-align: right; margin-top: 1%;">
			<button class="add-row2 btn btn-default">ADD ROW</button> &nbsp&nbsp<button class="delete-row2 btn btn-default">DELETE ROW</button>
		</div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
		var num=1;
		test(0);
		<?php foreach($p_child as $row) {?>
		test(<?=$row->id;?>);
		<?php } ?>
		
		// <td><select name='oku[]'><option value='No'>No</option><option value='Yes'>Yes</option></select></td>
        $(".add-row").click(function(){
			var id=num++;
            var markup = "<tr><td><input type='text' style='width: 100%;' id='add-tera"+id+"' name='nama_son["+id+"]'></td><td><select name='sts_son["+id+"]'><option value='Single'>Single</option><option value='Married'>Married</option><option value='Separate'>Separate</option></select></td><td><select name='oku["+id+"]'><option value='No'>No</option><option value='Yes'>Yes</option></select></td><td><select name='crc_son["+id+"]' onchange=ifworking(this,"+id+")><option value='Study'>Study</option><option value='Working'>Working</option></select></td><td><select name='school_son["+id+"]' ><option value='School'>School</option><option value='College'>College</option><option value='IPT'>IPT</option><option value='IPTA'>IPTA</option></select></td><td><select name='country_son["+id+"]'><option value='Local'>Local</option><option value='Oversea'>Oversea</option></select></td><td><select name='gdr_son["+id+"]'><option value='Male'>Male</option><option value='Female'>Female</option></select></td><td><input type='text' name='bfdate["+id+"]' autocomplete='off'  style='width: 100%;' id='datepilih"+id+"' readonly></td><td><input type='text' name='id_son["+id+"]' style='width: 100%;'></td><td><input type='text' style='width: 100%;' name='ps_son["+id+"]'></td><td><input  type='checkbox' name='record'></td></tr>";
            $("#tera tbody").append(markup);
			test(id);
			//alert(JSON.parse(arr));
			return false;
        });
        
       

        $(".add-row2").click(function(){
            var name = $("#name").val();
            var email = $("#email").val();
            var markup = "<tr><td><input type='text' style='width: 100%;' name='emg_name[]'></td><td><input type='text' style='width: 100%;' name='emg_rel[]'></td><td><input type='text' style='width: 100%;' name='emg_phne[]'></td><td><input  type='checkbox' name='record2'></tr>";
            $("#tera2 tbody").append(markup);
			return false;
        });

		$(".add-row3").click(function(){
            var markup = "<tr><td><input type='text' style='width: 100%;' name='nama_fam[]'></td><td><input type='text' style='width: 100%;'  name='pos_fam[]'></td><td><input type='text' style='width: 100%;'  name='dep_fam[]'></td><td><input type='text' style='width: 100%;' name='loc_fam[]'></td><td><input type='text' style='width: 100%;' name='rel_fam[]'></td><td><input  type='checkbox' name='record3'></td></tr>";
            $("#tera3 tbody").append(markup);
			return false;
        });

         // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
					  var number = $(this).val();
   $("input[name='del_c']").val(function() {
        return this.value +','+number;
    });
                    $(this).parents("tr").remove();
                }
            });
			return false;
        });

        $(".delete-row2").click(function(){
            $("table tbody").find('input[name="record2"]').each(function(){
				//alert($(this).val());
				//$("input[name='del_c']").val($(this).val());
            	if($(this).is(":checked")){
		var number1 = $(this).val();
   $("input[name='del_c1']").val(function() {
        return this.value +','+number1;
    });	
                    $(this).parents("tr").remove();
                }
            });
			return false;
        });

		$(".delete-row3").click(function(){
            $("table tbody").find('input[name="record3"]').each(function(){
				//alert($(this).val());
				//$("input[name='del_c']").val($(this).val());
            	if($(this).is(":checked")){
		var number1 = $(this).val();
   $("input[name='del_c2']").val(function() {
        return this.value +','+number1;
    });	
                    $(this).parents("tr").remove();
                }
            });
			return false;
        });

		
	
    });   

	  function test(angka){
		//pilih
		$("#datepilih"+angka).datepicker({ dateFormat: 'dd-mm-yy', changeYear: true,});
		
		   }
		   function ifworking(work,id){
			// var x = document.getElementById("mySelect").selectedIndex;
			// alert(document.getElementsByTagName("option")[x].value);
			if(work.value=='Working'){
				document.getElementsByName("school_son["+id+"]")[0].disabled= true;
			}
			else{
				document.getElementsByName("school_son["+id+"]")[0].disabled= false;
			}
		}
		
</script>

<style type="text/css">
@media (min-width: 1024px){
    table.tblaq tr.row td{
  	font-size: 15px;
  	font-weight: bold;
  	font-family: Arial;
  }
  table.tblaq2{
   
  	font-family: Arial;	
  	text-align: left;
  	width: 100%;
    
  	} 
  	table.tblaq2 th {
  	font-size: 18px;
  	font-family: Arial;	
  	text-align: left;
  	background-color: #d2ece8;
  	font-weight: bold;
  	padding-left: 1%;
  }

  table.tblaq2 .tr1 td {
  	font-size: 15px;
  	font-family: Arial;
  	background-color: white;
  	border: 1px solid black;
  	font-weight: bold;
  	text-align: center;
  }
  table.tblaq2 th tr td {
  	font-size: 15px;
  	font-family: Arial;	
  	text-align: left;
  	padding: 10%;
  }
  
  .garismerah{
	border-style:solid;
	border-color: red;
  }

  .main-div{
  	margin-left: 5%; 
  	margin-right: 5%; 
  	margin-top: 1%; 
  	margin-bottom: 5%; 
  }
  }

  @media (min-width:44px) and (max-width: 1023px){
  	table.tblaq tr.row td{
  	font-size: 15px;
  	font-weight: bold;
  	font-family: Arial;
  }
  table.tblaq2{
   
  	font-family: Arial;	
  	text-align: left;
  	width: 100%;
    
  	} 
  	table.tblaq2 th {
  	font-size: 12px;
  	font-family: Arial;	
  	text-align: left;
  	background-color: #d2ece8;
  	font-weight: bold;
  	padding-left: 1%;
  }

  table.tblaq2 .tr1 td {
  	font-size: 15px;
  	font-family: Arial;
  	background-color: white;
  	border: 1px solid black;
  	font-weight: bold;
  	text-align: center;
  }
  table.tblaq2 th tr td {
  	font-size: 15px;
  	font-family: Arial;	
  	text-align: left;
  	padding: 10%;
  }
  
  .garismerah{
	border-style:solid;
	border-color: red;
  }
  .main-div{
  	margin-left: 5%; 
  	margin-right: 5%; 
  	margin-top: 1%; 
  	margin-bottom: 5%; 
  }
    
  }



</style>
</head>
