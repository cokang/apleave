<body onload="document.getElementById('defaultOpen').click();">
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">EMPLOYEE PROFILE</h1>
		</div>
		<!-- /.col-lg-12 --> 
	</div>
<style>
body {font-family: Arial;}

/* Style the tab */

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  background-color: white;
}
</style>

<div class="tab">
  <button id="defaultOpen" style="width: 20%;" class="tablinks active" onclick="openTab(event, 'Personal')" >Personal</button>
</div>
<?php echo form_open('add_employee_ctrl/save_personal') ?>
<div id="Personal" class="tabcontent">
  <?php include 'content_personal.php';?>
</div>
<div width="100%" align="center" style="padding-top:10px;padding-bottom:10px;">
<input name="submit" type="submit" class="btn btn-default" id="button" value=" Submit " onclick="return validate_form(this.form);">
</div>
<?php echo form_hidden('id',isset($personal[0]->id) ? $personal[0]->id : '');?>
<?php echo form_close();?>
 <script>
      function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
      }
      document.getElementById("defaultOpen").click();
    </script>
<!-- /#page-wrapper --> 
