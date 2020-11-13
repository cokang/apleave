<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/login_image.png" type="image/x-icon" />
	<title>ADVANCEPACT - Apply Leave</title>

	<!-- Core CSS - Include with every page -->
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/skin-orange.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>js/jquery1.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.custom.js"></script>
	<link  href="<?php echo base_url(); ?>js/jquery.fancybox.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>js/jquery.fancybox.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> 

	<!-- Page-Level Plugin CSS - Forms -->
	<?php if ('Controllers/print_out/'== $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) { ?>
		<link href="<?php echo base_url(); ?>css/print.css" rel="stylesheet">
	<?php } ?>

	<style type="text/css" media="print">
		html {  border:0px solid red; margin:0; }
		body {
			border:0px solid red;
			font-size:normal;
			margin:0px;
		}
		@page { margin:0.5cm 0.5cm 0.5cm 0.5cm; }
		div.page {  position:absolute;
			height: 100%;
			margin:2% 0%;
			writing-mode:  tb-rl;
		}
		div.printnone{display: none;}
		div.printshow{display:block !important;}
		div.StartNewPage { page-break-before: always  }
		@media (max-width:767px) {
			.table-responsive{margin-bottom:0px;overflow-y:none;border:0px;overflow-x:none;}
		}
	</style>
	<script type='application/javascript'>
		function myFunction() {
			print()
		}
	</script>
	<!-- SB Admin CSS - Include with every page -->
	<link href="<?php echo base_url(); ?>css/sb-admin.css" rel="stylesheet">

	<?php if ( ('Controllers/apply_leave/'== $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) or ('Controllers/do_upload/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) or ('Controllers/date_calender/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2))){?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
		.info_message {
			border:1px solid #E2F34B;
			border-left:3px solid #E2F34B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
	</style>
	<?php
	$i=0;
	$leave_from = array();
	$leave_to   = array();
	foreach($applied_date as $row){
		// array_push($leave_from, $row['leave_from']);
		// array_push($leave_to, $row['leave_to']);
		$leave_from[$i] = date("d-m-Y", strtotime($row['leave_from']));
		$leave_to[$i] = date("d-m-Y", strtotime($row['leave_to']));
		$i++;
	}
	$leave_from = implode(",", array_values($leave_from));
	$leave_to = implode(",", array_values($leave_to));
	?>
	<!-- Page-Level Demo Scripts - Forms - Use for reference -->
	<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery9.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*var unavailableDates = ["23-9-2015", "14-12-2015", "15-12-2015"];

			function unavailable(date) {
				dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
				if ($.inArray(dmy, unavailableDates) == -1) {
					return [true, ""];
				} else {
					return [false, "", "Unavailable"];
				}
			}

			$(function() {
				$("#from").datepicker({
					dateFormat: 'dd-mm-yy',
					beforeShowDay: unavailable
				});
			});*/

			//$( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });

			// $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
			// $( "#to" ).datepicker({ dateFormat: 'dd-mm-yy' });
			$("#from").datepicker({
				dateFormat: 'dd-mm-yy',
				minDate: 0,
				beforeShow: function() {
					$(this).datepicker('option', 'maxDate', $('#to').val());
				}
			});
			$('#to').datepicker({
				dateFormat: 'dd-mm-yy',
				// defaultDate: "+1w",
				beforeShow: function() {
					$(this).datepicker('option', 'minDate', $('#from').val());
					if ($('#from').val() === '') $(this).datepicker('option', 'minDate', 0);
				}
			});
			$( "#date_calendar" ).datepicker({ dateFormat: 'dd-mm-yy' });
			$( "#date_calendar_to" ).datepicker({ dateFormat: 'dd-mm-yy' });

			$("#duration").on("change", function(){
				// $('#from').datepicker('option', 'beforeShowDay', function(date) { var day = date.getDay(); return [(day != 0 && day!=6), '']; });
				if( $(this).val()=="Half Day" ){
					$("#from").css("border-color","#D9D8D4");
					$("#to").attr("disabled", "disabled");
				}else{
					$("#to").attr("disabled", false);
				}
			});

			$("#from").datepicker().on("change", function(){
				checkDateTo();
			});
		});

		function validate_form(){
			var $picture = $('#file_name').attr('value');
			//alert($picture);
			$("#from").css("border-color","#D9D8D4");
			$("#to").css("border-color","#D9D8D4");
			$("#reason").css("border-color","#D9D8D4");
			$("#leave_type").css("border-color","#D9D8D4");

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
				err_msg="Mobile number should not be more than 10 digits<br>";
				error=1;
			}*/
			if($("#leave_type").val()=="2" || $("#leave_type").val()=="4" ){
				if($picture == "No_image_available.jpg"){
					$("#file_name").css("border","red solid 1px");
					error=1;
				}
			}
			if( $("#leave_type").val()=="11" && $("#duration").val()=="Half Day" ){
				if($("#from").val()=="" || $("#from").val()=="From"){
					$("#from").css("border-color","red");
					error=1;
				}
			}else{
				if($("#from").val()=="" || $("#from").val()=="From"){
					$("#from").css("border-color","red");
					error=1;
				}
			}

			if($("#duration").val()=="Full Day"){
				if($("#to").val()=="" || $("#to").val()=="To"){
					$("#to").css("border-color","red");
					error=1;
				}
			}

			if($("#leave_type").val()=="0" ){
				$("#leave_type").css("border-color","red");
				error=1;
			}

			if(error==1){
				if(err_msg!="")
					alert(err_msg);
					return false;
			}else{
				var com_flag=0;
				if($("#duration").val()=="Full Day"){
					var startdate = $("#from").datepicker('getDate').getTime();
					var enddate = $("#to").datepicker('getDate').getTime();
					if(enddate<startdate)
						com_flag=1;
				}

				if(com_flag==1){
					$("#message_sp").removeClass();
					$("#message_sp").addClass("error_message");
					$("#message_sp").text("Ending date must be greater than starting date");
					$("#message_sp").slideDown("slow");


					$("#from").val("");
					$("#to").val("");
					return false;
				}else {
					$.ajax({
						type: "POST",
						url: "http://serverfordemo.com/green_leave/ajax.php",
						data: "action=insertLeaveDetails&from="+$("#from").val()+"&to="+$("#to").val()+"&reason="+$("#reason").val()+"&lv_type="+$("#leave_type").val()+"&duration="+$("#duration").val(),
						dataType: "json",
						success: function(result) {
							alert("Request sent successfully.");
							location.reload();
						}
					});
					return true;
				}
				//return true;
			}
		}

		function check_leave_availability(duration,year,probation){

			if( duration==11 ){
				$("#duration").append("<option value='Half Day'>Half Day</option>");
			}else{
				$("#duration option[value='Half Day']").remove();
			}
			var imgneeded = ['2','3','4','5','6','7','8','9','11','13','14'];//masukattattachmentsini
			$("#from").prop("disabled", false);
			$("#to").prop("disabled", false);

			function getNext3WorkingDays(){
				var d = new Date();
				var day = d.getDay();
				if(day>=0 && day<=2) return 4;
				else if(day!=6) return 6;
				else return 5;
			}

			$(function() {
				$( "#from" ).datepicker("destroy");
				if($("#leave_type").val() == "1" && probation != 1){
					$( "#from" ).datepicker({
						dateFormat: 'dd-mm-yy',
						minDate: '+'+getNext3WorkingDays()+'D' });
				}else{
					$( "#from" ).datepicker({ dateFormat: 'dd-mm-yy' });
				}
			});

			if($("#from").val("")!="" || $("#to").val("")!=""){
				$("#from").val("");
				$("#to").val("");
			}
			// if(duration=="2" || duration=="3"){
			if( imgneeded.includes(duration)==true ){
				$("#sick_leave_img").slideDown();
			}else {
				$("#sick_leave_img").slideUp();
			}
			if($("#leave_type").val()!="0"){

				var json = get_leave_balance(duration);
				var leave_balance = 1;
				var leave_type = 0;
				var ALbalance = get_leave_balance(1)[1];
				if( duration == "3" ){
					if( ALbalance < json[leave_balance] ){
						json[leave_balance] = ALbalance;
					}
				}
				if ( duration != '4' && duration!='5' ){
					if( json[leave_balance]>0 ){
						$("#message_sp").removeClass();
						$("#message_sp").addClass("success_message");
						if(duration=="6"){
							$("#message_sp").html("You have "+json[leave_balance]+" Compassionate Leave(s) remaining. <br> Limit per application is 2 days for each disaster or event, the rest will be deducted from Annual Leave or Unpaid Leave.");
						}else if( duration=="12" ){
							$("#message_sp").text("By event, as approved by the Company.");
						}else{
							$("#message_sp").text("You have "+json[leave_balance]+" "+json[leave_type]+" Leave(s) remaining.");
						}
						$("#message_sp").slideDown("slow");

						// $("#from").prop("disabled", false);
					}else if(json[leave_balance]<=0){
						$("#message_sp").removeClass();
						$("#message_sp").addClass("error_message");
						if( duration=="13" ){
							$("#message_sp").text("You can only apply once during the service.");
						}else{
							$("#message_sp").text("You have no "+json[leave_type]+" Leave(s) remaining. You have to apply Unpaid Leave.");
						}
						$("#message_sp").slideDown("slow");


						if(duration=="7"){
							$("#leave_type").val("4");
						}else if( duration.includes(["8","9","10","11","12","13"]) ){
							$("#leave_type").val("0");
						}else{
							$("#leave_type").val(duration);
						}
						$("#from").val("");
						$("#to").val("");
						$("#from").prop("disabled", true);
						$("#to").prop("disabled", true);
					}
				}else if (duration=="1") {
					if (json['probation'] <= 0){
						if(json[leave_balance]>0){
							$("#message_sp").removeClass();
							$("#message_sp").addClass("success_message");
							// $("#message_sp").text("You have "+json['ALbalance']+" Annual Leave(s) remaining.");
							$("#message_sp").text("You have "+json[leave_balance]+" Annual Leave(s) remaining.");
							$("#message_sp").slideDown("slow");

							// $("#from").prop("disabled", false);
						}else if(json[leave_balance]<=0){
							$("#message_sp").removeClass();
							$("#message_sp").addClass("error_message");
							$("#message_sp").text("You have no "+json[leave_type]+" Leave(s) remaining. You have to apply Unpaid Leave.");
							$("#message_sp").slideDown("slow");


							$("#leave_type").val("0");
							$("#from").val("");
							$("#to").val("");
							$("#from").prop("disabled", true);
							$("#to").prop("disabled", true);
						}
					}else{
						$("#message_sp").removeClass();
						$("#message_sp").addClass("info_message");
						$("#message_sp").html("Annual Leave is not eligible for probational staff.");
						$("#message_sp").slideDown("slow");

						$("#leave_type").val("4");
						$("#from").val("");
						$("#to").val("");
					}
				}else if (duration=="4"){
					$("#message_sp").removeClass();
					$("#message_sp").addClass("info_message");
					$("#message_sp").html("Please inform your superior & get approval before you apply unpaid leave");
					$("#message_sp").slideDown("slow");
					/*if(json['ALbalance']<=0){
					$("#message_sp").removeClass();
					$("#message_sp").addClass("success_message");
					$("#message_sp").text("You have "+json['ELbalance']+" Emergency Leave(s) remaining.");
					$("#message_sp").slideDown("slow");

					// $("#from").prop("disabled", false);
					}*/
					// alert(json['ALbalance']);
					/*
					if(json[leave_balance]>0){
						$("#message_sp").removeClass();
						$("#message_sp").addClass("error_message");
						$("#message_sp").text("Please inform your superior & get approval before you apply unpaid leave");
						$("#message_sp").slideDown("slow");


						$("#leave_type").val("1");
						$("#from").val("");
						$("#to").val("");
						$("#from").prop("disabled", true);
						$("#to").prop("disabled", true);
					}
					*/
				}else if (duration=="5") {
					$("#message_sp").removeClass();
					$("#message_sp").addClass("info_message");
					$("#message_sp").html("90 consecutive days will be paid a full salary. <br> Next 180 consecutive days will be paid half salary. <br> Next 180 consecutive days without pay.");
					$("#message_sp").slideDown("slow");
				}
			}
		}


		function check_days_available(){

			if($("#to").datepicker('getDate') === null)
         return;

			var duration = $("#leave_type").val();
			var json = get_leave_balance(duration);
			var leave_balance = 1;
			var leave_type = 0;
			var ALbalance = get_leave_balance(1)[1];
			if( duration == "3" ){
				if( ALbalance < json[leave_balance] ){
					json[leave_balance] = ALbalance;
				}
			}
			var s = "";
			if( no_of_days() > 2 ){
				s = "s";
			}
			var excludeLeave = ['4','5'];
			if( json!=undefined || !excludeLeave.includes(duration) ){
				if( json[leave_balance] > 0 ){
					if( duration!=6 ){
						if( no_of_days() > json[leave_balance] ){
							$("#message_sp").removeClass();
							$("#message_sp").addClass("error_message");
							// $("#message_sp").text("You have "+json['ALbalance']+" Annual Leave(s) remaining.");
							if( duration!=12 ){
								$("#message_sp").text("You apply "+no_of_days()+" day"+s+", but you have "+json[leave_balance]+" "+json[leave_type]+" Leave(s) remaining.");
							}else{
								//transfer leave
								$("#message_sp").text("By event, as approved by the Company, you have "+json[leave_balance]+" "+json[leave_type]+" Leave(s) remaining, but you apply "+no_of_days()+" day"+s);
							}
							$("#message_sp").slideDown("slow");
							if( $("#message_sp").attr("is_more")!=undefined ){
								$("#message_sp").attr("is_more","1");
							}
							$("#to").val("");
						}else{
							if( $("#message_sp").attr("is_more")!=undefined ){
								$("#message_sp").removeAttr("is_more");
							}
							$("#message_sp").slideUp("slow");
						}
					}else{
						//Compassionate leave
						if( no_of_days() <= 2 ){
							if( no_of_days() > json[leave_balance] ){
								$("#message_sp").removeClass();
								$("#message_sp").addClass("error_message");
								$("#message_sp").html("You Apply "+no_of_days()+" day"+s+", but you have "+json[leave_balance]+" "+json[leave_type]+" Leave(s) remaining. <br> Limit per application is 2 days for each disaster or event, the rest will be deducted from Annual Leave or Unpaid Leave.");
								$("#message_sp").slideDown("slow");
								if( $("#message_sp").attr("is_more")!=undefined ){
									$("#message_sp").attr("is_more","1");
								}
								$("#to").val("");
							}else{
								if( $("#message_sp").attr("is_more")!=undefined ){
									$("#message_sp").removeAttr("is_more");
								}
								$("#message_sp").slideUp("slow");
							}
						}else{
							$("#message_sp").removeClass();
							$("#message_sp").addClass("error_message");
							$("#message_sp").html("You Apply "+no_of_days()+" day"+s+", but limit per application is 2 days for each disaster or event, the rest will be deducted from Annual Leave or Unpaid Leave.");
							$("#message_sp").slideDown("slow");
							if( $("#message_sp").attr("is_more")!=undefined ){
								$("#message_sp").attr("is_more","1");
							}
							$("#to").val("");
						}
					}
				}
			}

			check_dateAvailabality();
		}



		function no_of_days() {
			var weekend_count = ['4','5','7','13','14'];//leave need calculate weekend and ph

			if( weekend_count.includes($("#leave_type").val()) ){
				var a = $("#from").datepicker('getDate').getTime(),
				b 	= $("#to").datepicker('getDate').getTime(),
				c = 24*60*60*1000,
				diffDays = Math.round(Math.abs((b - a)/(c))) + 1;

				// console.log(diffDays); //show difference
				// alert('kire weekend sekali ade '+diffDays+'hari');
				return diffDays;
			}else{
				var hosp_code = "<?=$this->session->userdata('hosp_code')?>";
				// tolak weekend sekali -by buzz
				if( hosp_code=='JB' ){
					for(var c=0,e=0,d=new Date($("#from").datepicker('getDate')),a=(new Date($("#to").datepicker('getDate'))-d)/864E5;0<=a;a--)	{
						var b=new Date(d);
						b.setDate(b.getDate()+a);
						if( ![5,6].includes(Math.ceil(b.getDay())) ){
							c++;
						}
					}
				}else{
					for(var c=0,e=0,d=new Date($("#from").datepicker('getDate')),a=(new Date($("#to").datepicker('getDate'))-d)/864E5;0<=a;a--)	{
						var b=new Date(d);
						b.setDate(b.getDate()+a);
						1==Math.ceil(b.getDay()%6/6)?c++:e++
					}
				}
				// alert('xkire weekend skali ade '+c+'hari');
				return c;
				// ./tolak weekend sekali -by buzz
			}
		}

		function fromChange(from){
			if(from!=""){
				$("#to").prop("disabled", false);

				if( $("#leave_type").val()=='11' && $("#duration").val()=="Half Day" ){
					$("#to").off();
					$("#to").prop("readonly", "readonly").val($("#from").val());
				}
			}
			else{
				$("#leave_type").val("0")
				$("#to").prop("disabled", false);
			}

			check_dateAvailabality();
		}


		function tryler()
		{
			//alert("masuk");
			var annualB;

			$.ajax({
     async: false,
     type: 'GET',
     url: "<?php echo base_url ('index.php/check_availability') ?>?year=2018&type=1",
     success: function(data) {
			 var json = JSON.parse(data);
			 // console.log(json);
			 //var annualB = (json['entitled']!=undefined ? Number(json['entitled']) : 0) + (json['carry_fwd_leave']!=undefined ? Number(json['carry_fwd_leave']) : 0) - json['ALtaken'] - json['ELtaken'] - json['FSEtaken'] - json['MLEtaken'] - json['PLEtaken'] - json['MRLEtaken'] - json['ULEtaken'] - json['STLEtaken'] - json['TLEtaken'] - json['HLEtaken'] - (json['SLEtaken']!=undefined ? json['SLEtaken'] : 0);
			 annualB = (json['entitled']!=undefined ? Number(json['entitled']) : 0) + (json['carry_fwd_leave']!=undefined ? Number(json['carry_fwd_leave']) : 0) - json['ALtaken'];
//alert("x bape kuar : "+annualB);
			 // alert("("+json['entitled']+"!=undefined ? "+json['entitled']+" : 0) + ("+json['carry_fwd_leave']+"!=undefined ? "+json['carry_fwd_leave']+" : 0) - "+json['ALtaken']+" - "+json['ELtaken']+" - "+json['FSEtaken']+" - "+json['MLEtaken']+" - "+json['PLEtaken']+" - "+json['MRLEtaken']+" - "+json['ULEtaken']+" - "+json['STLEtaken']+" - "+json['TLEtaken']+" - "+json['HLEtaken']+" - ("+json['SLEtaken']+"!=undefined ? "+json['SLEtaken']+" : 0)");

			 if (annualB < 0){
				 var ALbalance = 0;
			 }
			 else{
				 var ALbalance = annualB;
			 }
     }
	 		});
			return annualB;
			}

		function check_dateAvailabality(){
			var from  = $("#from").val();
			var to    = $("#to").val();
			/*var hasApplied_from = "<?php echo $leave_from?>";
			hasApplied_fromArr  = hasApplied_from.split(",");
			var hasApplied_to   = "<?php echo $leave_to?>";
			hasApplied_toArr    = hasApplied_to.split(",");

			// if( ( from!="" && hasApplied_fromArr.includes(from) ) || to!="" && hasApplied_toArr.includes(to) ){
			//    $("#message_sp").removeClass();
			//    $("#message_sp").addClass("error_message");
			//    $("#message_sp").text("You have applied leave on this date. Please check your leave requests.");
			//    $("#message_sp").slideDown("slow");
			// }else{
			//    $("#message_sp").slideUp("slow");
			// }
			if( hasApplied_from.length > 0 && hasApplied_to.length > 0 ){
				if( from!="" ){

				}
			}else{
				return true;
			}*/
			$.post("<?php echo site_url();?>/Apply_leave_ctrl/check_dateAvailabality", {appliedFrom:from,appliedTo:to}, function(result){
				// console.log(result);

				var res = 0;
				if( result>0 ){
					res = 0;
					$("#message_sp").removeClass();
					$("#message_sp").addClass("error_message");
					$("#message_sp").text("You have applied leave on this date. Please check your leave requests.");
					$("#message_sp").slideDown("slow");

					$("#from").val("");
					$("#to").val("");
				}else{
					res = 1;
					if( $("#message_sp").attr("is_more")!=undefined ){
						$("#message_sp").slideUp("slow");
					}
				}
			});

		}

		/*function check_duration(duration){
			if(duration=="Half Day"){
				$("#from").prop("disabled", false);
				$("#to").prop("disabled", true);
				$("#to_date").slideUp();
			}else {
				$("#from").prop("disabled", false);
				$("#to").prop("disabled", false);
				$("#to_date").slideDown();
			}
		}*/

		function getFile(){
			//alert('test');
			document.getElementById("upfile").click();
		}
		function sub(obj){
			var file = obj.value;
			//alert(file);
			var fileName = file.split("\\");
			//alert(fileName[fileName.length-1]);
			document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
			//document.getElementById("myForm").action = "form_action.asp";
			document.myForm.action = "<?php echo base_url(); ?>index.php/Controllers/do_upload"
			document.myForm.submit();
			//alert(document.myForm.action.submit());
			event.preventDefault();
		}

		function checkDateTo(){
			if( $("#to").val()!="" ){
				if( $("#to").val()<$("#from").val() ){
					$("#to").val("");
				}
			}
		}

				function get_leave_balance(leave_type=''){
					var url = "<?php echo base_url ('index.php/check_availability') ?>?year=<?=isset($year) ? $year : '';?>&type=<?=isset($probationchk) ? count($probationchk) : '';?>";
					// var duration = $("#leave_type").val();
					var res = $.ajax({
						async: false,
						url: '<?php echo base_url ('index.php/check_availability') ?>',
						type: 'GET',
						data: { year: "<?=isset($year) ? $year : '';?>", type : "<?=isset($probationchk) ? count($probationchk) : '';?>"} ,
						dataType: 'json',
						success : function (json){}
					});
					var json = res.responseText;
					json = JSON.parse(json);
					var leave_balance = [];
					var annualB = (json['entitled']!=undefined ? Number(json['entitled']) : 0) + (json['carry_fwd_leave']!=undefined ? Number(json['carry_fwd_leave']) : 0) - json['ALtaken'];
					if (annualB < 0){
						var ALbalance = 0;
					}else if( leave_type==1 ){
						var ALbalance = json.ALbalance;
					}
					else{
						var ALbalance = annualB;
					}
					json[1]	= ['Annual',ALbalance];
					json[2]	= ['Sick',json['SLbalance']];
					json[3]	= ['Emergency',json['ELbalance']];
					if(leave_type==4){
						json[4] = ['Annual', ALbalance];
					}
					if(leave_type==5){
						json[5] = [];
					}
					json[6]	= ['Compassionate',(json['FSbalance']) ? json['FSbalance'] : 0];
					json[7]	= ['Maternity',(json['MLbalance']) ? json['MLbalance'] : 0];
					json[8]	= ['Paternity',(json['PLbalance']) ? json['PLbalance'] :0];
					json[9]	= ['Marriage',(json['MRLbalance']) ? json['MRLbalance'] : 0];
					json[10]= ['Unrecorded',(json['ULbalance']) ? json['ULbalance'] : 0];
					json[11]= ['Study',(json['STLbalance']) ? json['STLbalance'] : 0];
					json[12]= ['Transfer',(json['TLbalance']) ? json['TLbalance'] : 0];
					json[13]= ['Hajj',(json['HLbalance']) ? json['HLbalance'] : 0];
					json[14]= ['Hospitalisation',(json['HPLbalance']) ? json['HPLbalance'] : 0];

					if(leave_type){
						if(json['probation']!=undefined){
							json[leave_type]['probation']=json['probation'];
						}
						json = json[leave_type];
					}
					return json;
				}
	</script>
	<style>
		div.ui-datepicker {
			font-size:13px;
		}
	</style>

	<?php  } elseif ( ('Controllers/leave_listing/'== $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) or ('Controllers/leave_approved/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2))){?>
	<script>
		function showDialog(id,task,limit,start,group)
		{
			if(task=='listing'){
				$.get("<?php echo base_url ('index.php/ajaxsick') ?>?limit="+limit+"&start="+start,"",function(data){

					var json = JSON.parse(data);
					for (post in json) {
						for(var prop in json[post]){
							if (id == json[post][prop].id){
								//console.log(json[post][prop].id);
								//alert(json[post][prop].leave_remarks);
								if( json[post][prop].leave_status!="Declined" ){
									$("#myDialogText").text(json[post][prop].leave_remarks);
								}else{
									$("#myDialogText").text(json[post][prop].reject_remark);
								}
								$( "#dialog" ).dialog({
									width: 400,
									height: 300,
									title: "Reason",
								});
							}
						}
					}
				});
			}else{
				$.get("<?php echo base_url ('index.php/ajaxsick/approval') ?>?group="+group+"&limit="+limit+"&start="+start,"",function(data){

					var json = JSON.parse(data);
					for (post in json) {
						for(var prop in json[post]){
							if (id == json[post][prop].id){
								//console.log(json[post][prop].id);
								//alert(json[post][prop].leave_remarks);

								$("#myDialogText").text(json[post][prop].leave_remarks);
								$( "#dialog" ).dialog({
									width: 400,
									height: 300,
									title: "Reason",
								});
							}
						}
					}
				});
			}
		}

		function tabs_navigation(evt, cityName) {
		  var i, tabcontent, tablinks;
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
		    tabcontent[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablinks");
		  for (i = 0; i < tablinks.length; i++) {
		    tablinks[i].className = tablinks[i].className.replace(" active", "");
		  }
		  document.getElementById(cityName).style.display = "block";
		  evt.currentTarget.className += " active";
		}
		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();


	</script>

	<?php } elseif ( 'Controllers/leave_listing/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)){?>
	<script>
		function deleteEntry(id)
		{
			if(confirm("Do you want to delete this entry ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=delete_entry&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Entry Deleted");
						location.reload();
					}
				});
			}
			return false;
		}

		function approve(id)
		{
			if(confirm("Do you want to approve this request ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=approve&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Leave Approved");
						location.reload();
					}
				});
			}
			return false;
		}


		function reject(id)
		{
			if(confirm("Do you want to reject this request ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=reject&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Rejected");
						location.reload();
					}
				});
			}
			return false;
		}

	</script>
	<style>
		.search_div {
			background-color:#F2F2F2;
			float: left;
			height: auto;
			margin-bottom: 5px;
			margin-top: 20px;
			padding:5px;
			width: 980px;
			font-style:italic;
		}
		#ui-datepicker-div {
			font-size:12px;
		}
	</style>

	<?php } elseif ( 'Controllers/leave_account_view/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)){?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
	</style>
	<script type="text/javascript">

		function testchk(ch){
			var NewCount = 0;

			if (document.getElementById('ch1').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch2').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch3').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch4').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch5').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch6').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch7').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch8').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch9').checked){
				NewCount = NewCount + 1;
			}
			if (document.getElementById('ch10').checked){
				NewCount = NewCount + 1;
			}

			if (NewCount == 3)
			{
				$("#message_sp").removeClass();
				$("#message_sp").addClass("error_message");
				$("#message_sp").text("You can only pick two extra columns");
				$("#message_sp").slideDown("slow");

				document.getElementById(ch).checked = false;

				return false;
			}
		}

		function check_sort(sort){
			if(sort=="All"){
				//alert(sort);
				//$("#from").prop("disabled", false);
				//$("#reportto").prop("disabled", false);
				$("#sel_dept").slideDown();
				$("#staff_name").slideDown();
				$("#staff_no").slideDown();
			}else {
				//$("#from").prop("disabled", false);
				//$("#to").prop("disabled", false);
				$("#sel_dept").slideUp();
				$("#staff_name").slideUp();
				$("#staff_no").slideUp();
			}

		}
		function autoprint(check,dept,staff,year,apsbno,excol1,excol2)
		{
			winProp = 'width=1000,height=600,left=' + ((screen.width - 1000) / 2) +',top=' + ((screen.height - 1000) / 2) + ',menubar=no, directories=no, location=no, scrollbars=yes, statusbar=no, toolbar=no, resizable=no';
			Win = window.open('autoprint?data='+check+'&dept='+dept+'&staff='+staff+'&year='+year+'&apsbno='+apsbno+'&excol1='+excol1+'&excol2='+excol2, 'tc_r_number', winProp);
			Win.window.focus();
		}
	</script>
	<script>
		function showDialog(id)
		{
			$.ajax({
				type: "POST",
				url: "http://serverfordemo.com/green_leave/ajax.php",
				data: "action=popup_details&id="+id,
				dataType: "json",
				success: function(result) {
					$("#reason").html(result['reason']);
				}
			});
			$("#dialog").dialog(
			{
				width: 400,
				height: 300,
				open: function(event, ui){
				}
			});
			return false;
		}
		function deleteEntry(id)
		{
			if(confirm("Do you want to delete this entry ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=delete_entry&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Entry Deleted");
						location.reload();
					}
				});
			}
			return false;
		}
		function approve(id)
		{
			if(confirm("Do you want to approve this request ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=approve&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Leave Approved");
						location.reload();
					}
				});
			}
			return false;
		}
	</script>
	<style>
		.search_div {
			background-color:#F2F2F2;
			float: left;
			height: auto;
			margin-bottom: 5px;
			margin-top: 20px;
			padding:5px;
			width: 980px;
			font-style:italic;
		}
		#ui-datepicker-div {
			font-size:12px;
		}
	</style>

	<?php } elseif ( 'Controllers/change_password/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)){?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 100%;
			padding:10px 15px;
		}
	</style>
	<script type="text/javascript">

		function validate_form(){

			$("#pass").css("border-color","#D9D8D4");
			$("#confirm_pass").css("border-color","#D9D8D4");

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
				err_msg="Mobile number should not be more than 10 digits<br>";
				error=1;
			}*/

			if($("#pass").val()=="" ){
				$("#pass").css("border-color","red");
				error=1;
			}

			if($("#confirm_pass").val()==""){
			$("#confirm_pass").css("border-color","red");
				error=1;
			}

			if($("#confirm_pass").val()!=$("#pass").val()){
				$("#message_sp").removeClass();
				$("#message_sp").addClass("error_message");
				$("#message_sp").text("Password Mismatch");
				$("#message_sp").slideDown("slow");
				error=1;
			}

			if(error==1){
				if(err_msg!="")
					alert(err_msg);
				return false;
			}else{
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=changePassword&pass="+$("#pass").val(),
					dataType: "json",
					success: function(result) {
						alert("Password Changed successfully.");
						location.reload();
					}
				});

				return true;
			}

		}

	</script>
	<style>
		div.ui-datepicker {
			font-size:13px;
		}
	</style>

	<?php } elseif ('Controllers/add_employee/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
	</style>
	<script type="text/javascript">

		function check_emptype(emptype){
			if(emptype=="Employee"){
				//$("#from").prop("disabled", false);
				$("#reportto").prop("disabled", false);
				$("#report_to").slideUp();
			}else {
				//$("#from").prop("disabled", false);
				//$("#to").prop("disabled", false);
				$("#report_to").slideDown();
			}
		}

		function validate_form(){

			$("#emp_apsb").css("border-color","#D9D8D4");
			$("#emp_grade").css("border-color","#D9D8D4");
			$("#emp_name").css("border-color","#D9D8D4");
			$("#emp_type").css("border-color","#D9D8D4");
			$("#emp_desg").css("border-color","#D9D8D4");
			$("#emp_email").css("border-color","#D9D8D4");
			$("#emp_uname").css("border-color","#D9D8D4");
			$("#emp_pass").css("border-color","#D9D8D4");
			$("#reportto").css("border-color","#D9D8D4");
			$("#dept_code").css("border-color","#D9D8D4");
			$("#statelist").css("border-color","#D9D8D4");
			//$("#hosp_code").css("border-color","#D9D8D4");
			$("#phone_no").css("border-color","#D9D8D4");
			$("#phone_no").parent().find("small").empty();

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
			err_msg="Mobile number should not be more than 10 digits<br>";
			error=1;
			}*/

			if($("#dept_code").val()==""){
				$("#dept_code").css("border-color","red");
				error=1;
			}
			if($("#emp_apsb").val()==""){
				$("#emp_apsb").css("border-color","red");
			error=1;
		}
		if($("#emp_grade").val()==""){
			$("#emp_grade").css("border-color","red");
			error=1;
		}
		if($("#emp_name").val()==""){
			$("#emp_name").css("border-color","red");
			error=1;
		}
		if($("#emp_desg").val()==""){
			$("#emp_desg").css("border-color","red");
			error=1;
		}
		//if($("#hosp_code").val()=="0"){
			//  $("#hosp_code").css("border-color","red");
			//  error=1;
		//}
		if($("#phone_no").val()==""){
			$("#phone_no").css("border-color","red");
			error=1;
		}

		if( $("#phone_no").val()!="" ){
			if( isNaN($("#phone_no").val()) ){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Cannot Be String.</small>");
				error=1;
			}else if($("#phone_no").val().charAt(0) != 0 && $("#phone_no").val().charAt(1)){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Must Start With 01....</small>");
				error=1;
			}else if($("#phone_no").val()!="" && $("#phone_no").val().length < 10){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Not Completed.</small>");
				error=1;
			}
		}

		if($("#emp_type").val()=="0"){
			$("#emp_type").css("border-color","red");
			error=1;
		}

		if($("#emp_email").val()==""){
			$("#emp_email").css("border-color","red");
			error=1;
		}

		if($("#emp_uname").val()==""){
			$("#emp_uname").css("border-color","red");
			error=1;
		}

		if($("#emp_pass").val()==""){
			$("#emp_pass").css("border-color","red");
			error=1;
		}

		if($("#emp_type").val()=="Head"){
			if($("#reportto").val()=="0"){
				$("#reportto").css("border-color","red");
				error=1;
			}
		}

		if($("#statelist").val()=="0"){
			$("#statelist").css("border-color","red");
			error=1;
		}


		if(error==1){
			if(err_msg!="")
				alert(err_msg);
				return false;
			}else{
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=add_employee&name="+$("#emp_name").val()+"&email="+$("#emp_email").val()+"&type="+$("#emp_type").val()+"&uname="+$("#emp_uname").val()+"&code="+$("#emp_code").val()+"&pass="+$("#emp_pass").val()+"&report_to="+$("#report_to").val(),
					dataType: "json",
					success: function(result) {
						alert("Employee Added successfully");
						location.reload();
					}
				});
				return true;
			}
		}

		function usernameFromApsbNo(username){
			$('.usernameFromApsbNo').val(username);
		}

		$(function(){
  $('#emp_apsb').bind('input', function(){
    $(this).val(function(_, v){
     return v.replace(/\s+/g, '');
    });
  });
});
	</script>
	<style>
		div.ui-datepicker{
			font-size:13px;
		}

	</style>

	<?php } elseif (('Controllers/update_constants/'== $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) or ('Controllers/add_leaves/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2))) {?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
	</style>

	<script type="text/javascript">

		function validate_form(){
			$("#employee_name").css("border-color","#D9D8D4");
			$("#n_casual").css("border-color","#D9D8D4");
			$("#n_sick").css("border-color","#D9D8D4");
			$("#n_earned").css("border-color","#D9D8D4");

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
				err_msg="Mobile number should not be more than 10 digits<br>";
				error=1;
			}*/


			if($("#employee_name").val()=="0"){
				$("#employee_name").css("border-color","red");
				error=1;
			}

			if($("#n_casual").val()==""){
				$("#n_casual").css("border-color","red");
				error=1;
			}

			if($("#n_sick").val()==""){
				$("#n_sick").css("border-color","red");
				error=1;
			}

			if($("#n_earned").val()==""){
				$("#n_earned").css("border-color","red");
				error=1;
			}

			if(error==1){
				if(err_msg!="")
					alert(err_msg);
					return false;
			}else{
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=add_leaves&name="+$("#employee_name").val()+"&l_casual="+$("#n_casual").val()+"&l_sick="+$("#n_sick").val()+"&l_earned="+$("#n_earned").val(),
					dataType: "json",
					success: function(result) {
						alert("Leave Added successfully");
						location.reload();
					}
				});
				return myform.action='<?php echo base_url();?>index.php/add_leaves_ctrl?employee_name='+$("#employee_name").val()+'&sel_year='+$("#sel_year").val();
			}
		}

	</script>

	<style>
		div.ui-datepicker {
			font-size:13px;
		}
	</style>

	<?php } elseif ('Controllers/employee_listing/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<script>
		function showDialog(id)
		{
			$.ajax({
				type: "POST",
				url: "http://serverfordemo.com/green_leave/ajax.php",
				data: "action=popup_details&id="+id,
				dataType: "json",
				success: function(result) {
					$("#reason").html(result['reason']);
				}
			});
			$("#dialog").dialog({
				width: 400,
				height: 300,
				open: function(event, ui){
				}
			});
			return false;
		}
		function deleteEntry(id)
		{
			if(confirm("Do you want to delete this entry ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=delete_entry&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Entry Deleted");
						location.reload();
					}
				});
			}
			return false;
		}
		function approve(id)
		{
			if(confirm("Do you want to approve this request ? ")==true){
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=approve&id="+id,
					dataType: "json",
					success: function(result) {
						alert("Leave Approved");
						location.reload();
					}
				});
			}
			return false;
		}
		}

	</script>
	<style>
		.search_div {
			background-color:#F2F2F2;
			float: left;
			height: auto;
			margin-bottom: 5px;
			margin-top: 20px;
			padding:5px;
			width: 980px;
			font-style:italic;
		}
		#ui-datepicker-div {
			font-size:12px;
		}
	</style>

	<?php } elseif ('Controllers/leave_Limit/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
	</style>

	<script type="text/javascript">

		function validate_form(){
			$("#family_sick_l").css("border-color","#D9D8D4");
			$("#maternity_l").css("border-color","#D9D8D4");
			$("#paternity_l").css("border-color","#D9D8D4");
			$("#marriage_l").css("border-color","#D9D8D4");
			$("#unrecorded_l").css("border-color","#D9D8D4");
			$("#study_l").css("border-color","#D9D8D4");
			$("#transfer_l").css("border-color","#D9D8D4");
			$("#hajj_l").css("border-color","#D9D8D4");

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
				err_msg="Mobile number should not be more than 10 digits<br>";
				error=1;
			}*/


			if($("#family_sick_l").val()==""){
				$("#family_sick_l").css("border-color","red");
				error=1;
			}

			if($("#maternity_l").val()==""){
				$("#maternity_l").css("border-color","red");
				error=1;
			}

			if($("#paternity_l").val()==""){
				$("#paternity_l").css("border-color","red");
				error=1;
			}

			if($("#marriage_l").val()==""){
				$("#marriage_l").css("border-color","red");
				error=1;
			}

			if($("#unrecorded_l").val()==""){
				$("#unrecorded_l").css("border-color","red");
				error=1;
			}

			if($("#study_l").val()==""){
				$("#study_l").css("border-color","red");
				error=1;
			}

			if($("#transfer_l").val()==""){
				$("#transfer_l").css("border-color","red");
				error=1;
			}

			if($("#hajj_l").val()==""){
				$("#hajj_l").css("border-color","red");
				error=1;
			}

			if(error==1){
				if(err_msg!="")
					alert(err_msg);
					return false;
			}else{
				$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=add_leaves&name="+$("#employee_name").val()+"&l_casual="+$("#n_casual").val()+"&l_sick="+$("#n_sick").val()+"&l_earned="+$("#n_earned").val(),
					dataType: "json",
					success: function(result) {
						alert("Leave Added successfully");
						location.reload();
					}
				});

				return true;
			}
		}

	</script>

	<style>
		div.ui-datepicker {
			font-size:13px;
		}
	</style>

	<?php } elseif ('Controllers/leave_application/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<link href='<?php echo base_url(); ?>css/jquery.lighter.css' rel='stylesheet' type='text/css'>
	<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>
	<script type="text/javascript">
		// Generated by CoffeeScript 1.9.3

		/*
		jQuery Lighter
		Copyright 2015 Kevin Sylvestre
		1.3.4
		*/

		(function() {
			"use strict";
			var $, Animation, Lighter, Slide,
			bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

			$ = jQuery;

			Animation = (function() {
				function Animation() {}

				Animation.transitions = {
					"webkitTransition": "webkitTransitionEnd",
					"mozTransition": "mozTransitionEnd",
					"oTransition": "oTransitionEnd",
					"transition": "transitionend"
				};

				Animation.transition = function($el) {
					var el, i, len, ref, result, type;
					for (i = 0, len = $el.length; i < len; i++) {
						el = $el[i];
						ref = this.transitions;
						for (type in ref) {
							result = ref[type];
							if (el.style[type] != null) {
								return result;
							}
						}
					}
				};

				Animation.execute = function($el, callback) {
					var transition;
					transition = this.transition($el);
					if (transition != null) {
						return $el.one(transition, callback);
					} else {
						return callback();
					}
				};

				return Animation;

			})();

			Slide = (function() {
				function Slide(url) {
					this.url = url;
				}

				Slide.prototype.type = function() {
					switch (false) {
						case !this.url.match(/\.(webp|jpeg|jpg|jpe|gif|png|bmp)$/i):
						return 'image';
					default:
						return 'unknown';
					}
				};

				Slide.prototype.preload = function(callback) {
					var image;
					image = new Image();
					image.src = this.url;
					return image.onload = (function(_this) {
						return function() {
							_this.dimensions = {
								width: image.width,
								height: image.height
							};
							return callback(_this);
						};
					})(this);
				};

				Slide.prototype.$content = function() {
					return $("<img />").attr({
						src: this.url
					});
				};
				return Slide;
			})();

			Lighter = (function() {
				Lighter.namespace = "lighter";

				Lighter.prototype.defaults = {
					loading: '#{Lighter.namespace}-loading',
					fetched: '#{Lighter.namespace}-fetched',
					padding: 40,
					dimensions: {
						width: 480,
						height: 480
					},
					template: "<div class='" + Lighter.namespace + " " + Lighter.namespace + "-fade'>\n  <div class='" + Lighter.namespace + "-container'>\n    <span class='" + Lighter.namespace + "-content'></span>\n    <a class='" + Lighter.namespace + "-close'>&times;</a>\n    <a class='" + Lighter.namespace + "-prev'>&lsaquo;</a>\n    <a class='" + Lighter.namespace + "-next'>&rsaquo;</a>\n  </div>\n  <div class='" + Lighter.namespace + "-spinner'>\n    <div class='" + Lighter.namespace + "-dot'></div>\n    <div class='" + Lighter.namespace + "-dot'></div>\n    <div class='" + Lighter.namespace + "-dot'></div>\n  </div>\n  <div class='" + Lighter.namespace + "-overlay'></div>\n</div>"
				};

				Lighter.lighter = function($target, options) {
					var data;
					if (options == null) {
						options = {};
					}
						data = $target.data('_lighter');
					if (!data) {
						$target.data('_lighter', data = new Lighter($target, options));
					}
					return data;
				};

				Lighter.prototype.$ = function(selector) {
					return this.$el.find(selector);
				};

				function Lighter($target, settings) {
					if (settings == null) {
						settings = {};
					}
					this.show = bind(this.show, this);
					this.hide = bind(this.hide, this);
					this.observe = bind(this.observe, this);
					this.keyup = bind(this.keyup, this);
					this.size = bind(this.size, this);
					this.align = bind(this.align, this);
					this.process = bind(this.process, this);
					this.resize = bind(this.resize, this);
					this.type = bind(this.type, this);
					this.prev = bind(this.prev, this);
					this.next = bind(this.next, this);
					this.close = bind(this.close, this);
					this.$ = bind(this.$, this);
					this.$target = $target;
					this.settings = $.extend({}, this.defaults, settings);
					this.$el = $(this.settings.template);
					this.$overlay = this.$("." + Lighter.namespace + "-overlay");
					this.$content = this.$("." + Lighter.namespace + "-content");
					this.$container = this.$("." + Lighter.namespace + "-container");
					this.$close = this.$("." + Lighter.namespace + "-close");
					this.$prev = this.$("." + Lighter.namespace + "-prev");
					this.$next = this.$("." + Lighter.namespace + "-next");
					this.$body = this.$("." + Lighter.namespace + "-body");
					this.dimensions = this.settings.dimensions;
					this.process();
				}

				Lighter.prototype.close = function(event) {
					if (event != null) {
						event.preventDefault();
					}
					if (event != null) {
						event.stopPropagation();
					}
					return this.hide();
				};

				Lighter.prototype.next = function(event) {
					if (event != null) {
						event.preventDefault();
					}
					return event != null ? event.stopPropagation() : void 0;
				};

				Lighter.prototype.prev = function() {
					if (typeof event !== "undefined" && event !== null) {
						event.preventDefault();
					}
					return typeof event !== "undefined" && event !== null ? event.stopPropagation() : void 0;
				};

				Lighter.prototype.type = function(href) {
					if (href == null) {
						href = this.href();
					}
					return this.settings.type || (this.href().match(/\.(webp|jpeg|jpg|jpe|gif|png|bmp)$/i) ? "image" : void 0);
				};

				Lighter.prototype.resize = function(dimensions) {
					this.dimensions = dimensions;
					return this.align();
				};

				Lighter.prototype.process = function() {
					var fetched, loading;
					fetched = (function(_this) {
						return function() {
							return _this.$el.removeClass(Lighter.namespace + "-loading").addClass(Lighter.namespace + "-fetched");
						};
					})(this);
					loading = (function(_this) {
						return function() {
							return _this.$el.removeClass(Lighter.namespace + "-fetched").addClass(Lighter.namespace + "-loading");
						};
					})(this);
					this.slide = new Slide(this.$target.attr("href"));
					loading();
					return this.slide.preload((function(_this) {
						return function(slide) {
							_this.resize(slide.dimensions);
							_this.$content.html(_this.slide.$content());
							return fetched();
						};
					})(this));
				};

				Lighter.prototype.align = function() {
					var size;
					size = this.size();
					return this.$container.css({
						width: size.width,
						height: size.height,
						margin: "-" + (size.height / 2) + "px -" + (size.width / 2) + "px"
					});
				};

				Lighter.prototype.size = function() {
					var ratio;
					ratio = Math.max(this.dimensions.height / ($(window).height() - this.settings.padding), this.dimensions.width / ($(window).width() - this.settings.padding));
					return {
						width: ratio > 1.0 ? Math.round(this.dimensions.width / ratio) : this.dimensions.width,
						height: ratio > 1.0 ? Math.round(this.dimensions.height / ratio) : this.dimensions.height
					};
				};

				Lighter.prototype.keyup = function(event) {
					if (event.target.form != null) {
						return;
					}
					if (event.which === 27) {
						this.close();
					}
					if (event.which === 37) {
						this.prev();
					}
					if (event.which === 39) {
						return this.next();
					}
				};

				Lighter.prototype.observe = function(method) {
					if (method == null) {
						method = 'on';
					}
					$(window)[method]("resize", this.align);
					$(document)[method]("keyup", this.keyup);
					this.$overlay[method]("click", this.close);
					this.$close[method]("click", this.close);
					this.$next[method]("click", this.next);
					return this.$prev[method]("click", this.prev);
				};

				Lighter.prototype.hide = function() {
					var alpha, omega;
					alpha = (function(_this) {
						return function() {
							return _this.observe('off');
						};
					})(this);
					omega = (function(_this) {
						return function() {
							return _this.$el.remove();
						};
					})(this);
					alpha();
					this.$el.position();
					this.$el.addClass(Lighter.namespace + "-fade");
					return Animation.execute(this.$el, omega);
				};

				Lighter.prototype.show = function() {
					var alpha, omega;
					omega = (function(_this) {
						return function() {
							return _this.observe('on');
						};
					})(this);
					alpha = (function(_this) {
						return function() {
							return $(document.body).append(_this.$el);
						};
					})(this);
					alpha();
					this.$el.position();
					this.$el.removeClass(Lighter.namespace + "-fade");
					return Animation.execute(this.$el, omega);
				};

				return Lighter;

			})();

			$.fn.extend({
				lighter: function(option) {
					if (option == null) {
						option = {};
					}
					return this.each(function() {
						var $this, action, options;
						$this = $(this);
						options = $.extend({}, $.fn.lighter.defaults, typeof option === "object" && option);
						action = typeof option === "string" ? option : option.action;
						if (action == null) {
							action = "show";
						}
						return Lighter.lighter($this, options)[action]();
					});
				}
			});

			$(document).on("click", "[data-lighter]", function(event) {
				event.preventDefault();
				event.stopPropagation();
				return $(this).lighter();
			});

		}).call(this);
	</script>
	<?php } elseif ('Controllers/unprocess_listing/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style type="text/css">
		.inline-block{
			display: inline-block;
		}
		.left{
			float: left;
		}
	</style>
	<script type="text/javascript">
		function process_leave(leave_id,e){
			var status = 0;
			if( $(e).is(":checked") ){
				var status = 1;
			}
			$.post("<?php echo base_url ('index.php/Controllers/process_listing') ?>", {leave_id: leave_id, status: status}, function(result){console.log(result);});
		}
	</script>
	<?php } elseif ('Controllers/administrative/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style type="text/css">
		.inline-block{
			display: inline-block;
		}
		.left{
			float: left;
		}
		.box{
			padding: 19px;
		}
	</style>
	<?php } elseif ('Controllers/others/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style type="text/css">
		.inline-block{
			display: inline-block;
		}
		.left{
			float: left;
		}
		.box{
			padding: 19px;
		}
		.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: white;
  padding: 10px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  /* border: 1px solid black; */
  text-align: center;
  /* font-size: 30px; */
}

.scrolloverflow {
	max-height: 320px;
	overflow: hidden; 
	overflow-y:scroll;
}
	</style>
	<?php }elseif( 'Controllers/report_summary/' == $this->uri->slash_segment(1) . $this->uri->slash_segment(2) ){ ?>

	<script type="text/javascript">

		function print_report_summary(dept,staff,year,apsbno,print_type)
		{
			// winProp = 'width=600,height=1000,left=' + ((screen.width - 1000) / 2) +',top=' + ((screen.height - 1000) / 2) + ',menubar=no, directories=no, location=no, scrollbars=yes, statusbar=no, toolbar=no, resizable=no';
			winProp = 'width=1000,height=600,left=' + ((screen.width - 1000) / 2) +',top=' + ((screen.height - 1000) / 2) + ',menubar=no, directories=no, location=no, scrollbars=yes, statusbar=no, toolbar=no, resizable=no';
			Win = window.open('report_summary?year='+year+'&apsbno='+apsbno+'&print_type='+print_type+'&rowlimit=&no=1&location=<?php echo $location;?>', winProp);
			Win.window.focus();
		}
	</script>

	<?php } elseif ('Controllers/employee_profile/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
	<style>
		.error_message {
			border:1px solid #F35C4B;
			border-left:3px solid #F35C4B;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
		.error_message span {
			/*background: #F35C4B;*/clear:both;
			font-weight:bold;
			padding:0;
			color:#666;
			float: left;
			font-size:12px;
		}
		.success_message {
			border:1px solid #0F9;
			border-left:3px solid #0F9;
			color: #000;
			display: block;
			float:left;
			margin:0 0 20px 0;
			text-align: left;
			background:#f5f5f5;
			width: 900px;
			padding:10px 15px;
		}
	</style>
		<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery9.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
	<script type="text/javascript">
	$( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy',
 changeYear: true,	});

  } );
		function validate_form(form){

			$("#address").css("border-color","#D9D8D4");

			//$("#hosp_code").css("border-color","#D9D8D4");
			//$("#phone_no").css("border-color","#D9D8D4");
			//$("#phone_no").parent().find("small").empty();

			var error=0;
			var err_msg="";

			/*if($('#mobile').val().length>10){
			err_msg="Mobile number should not be more than 10 digits<br>";
			error=1;
			}*/

			if($("#address").val()==""){
				$("#address").css("border-color","red");
				error=1;
			}

		if($("#phone_no").val()==""){
			$("#phone_no").css("border-color","red");
			error=1;
		}
		if($("#poscode").val()==""){
			$("#poscode").css("border-color","red");
			error=1;
		}
		if($("#bgsa").val()==""){
			$("#bgsa").css("border-color","red");
			error=1;
		}

		if ( ( form.mstatus[0].checked == false ) && ( form.mstatus[1].checked == false )&& ( form.mstatus[2].checked == false )  )
       {
       $('#bujang').addClass('garismerah');
    	error=1;
       }else{
		$('#bujang').removeClass('garismerah');
	   }
	   	if ( ( form.bstatus[0].checked == false ) && ( form.bstatus[1].checked == false )&& ( form.bstatus[2].checked == false )&& ( form.bstatus[3].checked == false )  )
       {
       $('#bangsa').addClass('garismerah');
    	error=1;
       }else{
		 $('#bangsa').removeClass('garismerah');
	   }


		if( $("#phone_no").val()!="" ){
			if( isNaN($("#phone_no").val()) ){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Cannot Be String.</small>");
				error=1;
			}else if($("#phone_no").val().charAt(0) != 0 && $("#phone_no").val().charAt(1)){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Must Start With 01....</small>");
				error=1;
			}else if($("#phone_no").val()!="" && $("#phone_no").val().length < 10){
				$("#phone_no").css("border-color","red");
				$("#phone_no").after("<small style='color:red'>Phone Number Not Completed.</small>");
				error=1;
			}
		}





		if(error==1){
			if(err_msg!="")
				alert(err_msg);
				return false;
			}else{
				//alert('ok');
			/* 	$.ajax({
					type: "POST",
					url: "http://serverfordemo.com/green_leave/ajax.php",
					data: "action=add_employee&name="+$("#emp_name").val()+"&email="+$("#emp_email").val()+"&type="+$("#emp_type").val()+"&uname="+$("#emp_uname").val()+"&code="+$("#emp_code").val()+"&pass="+$("#emp_pass").val()+"&report_to="+$("#report_to").val(),
					dataType: "json",
					success: function(result) {
						alert("Employee Personal Added successfully");
						location.reload();
					}
				}); */
				location.reload();
			}
		}
	</script>
	<style>
		div.ui-datepicker {
			font-size:13px;
		}
	</style>

	<?php } ?>

	</head>

<?php if ('Controllers/autoprint/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
<body onload="window.print()">
<?php }elseif( 'Controllers/report_summary/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2) && $this->input->get("print_type")=='pdf' ){ ?>
<body onload="window.print()">
<?php }else{ ?>
<body>
<?php } ?>
