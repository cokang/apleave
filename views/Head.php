<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADVANCEPACT - Apply Leave</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/skin-orange.css" rel="stylesheet">

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
    <link href="<?php echo base_url(); ?>/css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery9.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery-ui.js"></script> 
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

        $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to" ).datepicker({ dateFormat: 'dd-mm-yy' });
        $( "#date_calendar" ).datepicker({ dateFormat: 'dd-mm-yy' });
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
        if($("#leave_type").val()=="2" ){
          if($picture == "No_image_available.jpg"){
            $("#file_name").css("border","red solid 1px");
            error=1;
          }
        }

        if($("#from").val()=="" || $("#from").val()=="From"){
          $("#from").css("border-color","red");
          error=1;
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
        }
        else{
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
          }
          else {
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
        var imgneeded = ['2','3','5','6','7','8','9','11','13'];
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
          }
          else{
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

          $.get("<?php echo base_url ('index.php/check_availability') ?>?year="+year+"&type="+duration,"",function(data){

          var json = JSON.parse(data);
          console.log(json);
          if (duration=="1") {
            if (json['probation'] <= 0){
              if(json['ALbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['ALbalance']+" Annual Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['ALbalance']<=0){
                $("#message_sp").removeClass();
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Annual Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            else{
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("info_message");
              $("#message_sp").html("Annual Leave is not eligible for probational staff.");
              $("#message_sp").slideDown("slow");

              $("#leave_type").val("4");
              $("#from").val("");
              $("#to").val("");
            }
          }
          if (duration=="2"){
            if(json['SLbalance']>0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("success_message");
              $("#message_sp").text("You have "+json['SLbalance']+" Sick Leave(s) remaining.");
              $("#message_sp").slideDown("slow");

              // $("#from").prop("disabled", false);  
            }
            else if(json['SLbalance']<=0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("error_message");
              $("#message_sp").text("You have no Sick Leave(s) remaining.");
              $("#message_sp").slideDown("slow");


              $("#leave_type").val(duration);
              $("#from").val("");
              $("#to").val("");
              $("#from").prop("disabled", true);
              $("#to").prop("disabled", true);
            }
          }
          if (duration=="3"){
            if(json['ELbalance']>0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("success_message");
              $("#message_sp").text("You have "+json['ELbalance']+" Emergency Leave(s) remaining.");
              $("#message_sp").slideDown("slow");

              // $("#from").prop("disabled", false);  
            }
            else if(json['ELbalance']<=0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("error_message");
              $("#message_sp").text("You have no Emergency Leave(s) remaining.");
              $("#message_sp").slideDown("slow");


              $("#leave_type").val("0");
              $("#from").val("");
              $("#to").val("");
              $("#from").prop("disabled", true);
              $("#to").prop("disabled", true);
            }
          }
          if (duration=="4"){
            /*if(json['ALbalance']<=0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("success_message");
              $("#message_sp").text("You have "+json['ELbalance']+" Emergency Leave(s) remaining.");
              $("#message_sp").slideDown("slow");

              // $("#from").prop("disabled", false);  
            }*/
              if(json['ALbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You need to finish your Annual Leave before you can apply Unpaid Leave.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("1");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="5") {
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("info_message");
              $("#message_sp").html("90 consecutive days will be paid a full salary. <br> Next 180 consecutive days will be paid half salary. <br> Next 180 consecutive days without pay.");
              $("#message_sp").slideDown("slow");
            }

            if (duration=="6"){
              if(json['FSbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").html("You have "+json['FSbalance']+" Family Sick Leave(s) remaining. <br> Limit per application is 2 days for each disaster, the rest will be deducted from Annual Leave.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['FSbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Family Sick Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="7"){
              if(json['MLbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['MLbalance']+" Maternity Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['MLbalance']<=0){
                $("#message_sp").removeClass();
                $("#message_sp").addClass("error_message");
                $("#message_sp").html("You have no Maternity Leave(s) remaining. <br> You can apply 30 days Unpaid Leave and letter of approval is required.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("4");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="8"){
              if(json['PLbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['PLbalance']+" Paternity Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['PLbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Paternity Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="9"){
              if(json['MRLbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['MRLbalance']+" Marriage Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['MRLbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Marriage Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="10"){
              if(json['ULbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['ULbalance']+" Unrecorded Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['ULbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Unrecorded Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="11"){
              if(json['STLbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['STLbalance']+" Study Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['STLbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Study Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="12"){
              if(json['TLbalance']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['TLbalance']+" Study Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
              }
              else if(json['TLbalance']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You have no Transfer Leave(s) remaining.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
            if (duration=="13"){
              if(json['hajjdata']<=0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("success_message");
                $("#message_sp").text("You have "+json['HLbalance']+" Hajj Leave(s) remaining.");
                $("#message_sp").slideDown("slow");

                // $("#from").prop("disabled", false);  
                }
                else if(json['hajjdata']>0){
                $("#message_sp").removeClass();  
                $("#message_sp").addClass("error_message");
                $("#message_sp").text("You can only apply once during the service.");
                $("#message_sp").slideDown("slow");


                $("#leave_type").val("0");
                $("#from").val("");
                $("#to").val("");
                $("#from").prop("disabled", true);
                $("#to").prop("disabled", true);
              }
            }
          });

        }
      }


      function check_days_available(){
        $.ajax({
          type: "POST",
          url: "http://serverfordemo.com/green_leave/ajax.php",
          data: "action=checkLeaveAvailability&lv_type="+$("#leave_type").val(),    
          dataType: "json",
          success: function(result){
            var no_days=no_of_days();
            no_days++;
            var avail=result['remaining']-no_days;
            if(avail<0){
              $("#message_sp").removeClass();  
              $("#message_sp").addClass("error_message");
              $("#message_sp").text(no_days+ " days is not available");
              $("#message_sp").slideDown("slow");

              $("#to").val("");
            }
          }
        });

        check_dateAvailabality();
      }

      function no_of_days() {
        var a = $("#from").datepicker('getDate').getTime(),
        b = $("#to").datepicker('getDate').getTime(),
        c = 24*60*60*1000,
        diffDays = Math.round(Math.abs((b - a)/(c)));

        console.log(diffDays); //show difference  
        return diffDays;
      }

      function fromChange(from){  
        if(from!="")
          $("#to").prop("disabled", false);
        else{
          $("#leave_type").val("0")
          $("#to").prop("disabled", false); 
        }

        check_dateAvailabality();
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
        $.post("<?php echo site_url();?>/Apply_leave_ctrl/check_dateAvailabality", {appliedFrom:from,appliedTo:to}, function(result){console.log(result);
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
            $("#message_sp").slideUp("slow");
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
        else{
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
        }
        else{   
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
        }
        else{
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
        }
        else{
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
        }
        else{
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
    <?php } ?>

  </head>

  <?php if ('Controllers/autoprint/' == $this->uri->slash_segment(1) .$this->uri->slash_segment(2)) {?>
  <body onload="window.print()">
  <?php }else{ ?>
  <body>
  <?php } ?>