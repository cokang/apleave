   
<?php if( $this->input->get('upload')==1){ ?>
<html>
<body >
</body>
</html>
<script type="text/javascript">
 function closeWindow() {
    setTimeout(function() {
	opener.location.reload();
    window.close();
    });
    }

    window.onload = closeWindow();
</script>
<?php }else{ ?>
<table  border="1" style="text-align:left; width:100%; height:100%;">
	<tr>
		<th style="text-align:left;">New Buletin</th>
	</tr>
	
	<tr>
		<td>File attachment must be less then 8MB  </td>
	</tr>
	<tr>
		<th style="text-align:left;"><?=ucwords($this->input->get('tag'))?> Details</th>
	</tr>
	<?php if ($this->input->get('act') != 'update' && $this->input->get('act') != 'delete'){ ?>
	<form enctype="multipart/form-data" action="" method="post" id="form">
	<?php } else { ?>
	<form  action="update_delete_comm?id=<?php echo $this->input->get('id')?>&act=<?=$this->input->get('act')?>&tag=<?=$this->input->get('tag')?>" method="post" id="form" name="form">
	<?php } ?>
	<tr>
	
		<td>Attachment Name : <input type="text" value="<?=isset($attachmentdet[0]->Doc_name) ? $attachmentdet[0]->Doc_name : ''?>" name="att_name" id="att_name"> </td>
	
	</tr>
	<tr>
	
		<td>  <strong>Edition :</strong> <input   type="text" placeholder="click to show datepicker"  name="edition" id="edition" autocomplete="off">
    </td>
	
	</tr>
	<?php if ($this->input->get('act') != 'update' && $this->input->get('act') != 'delete'){ ?>
	<tr>
		<td>Select a file to upload: <input type="file" value="" name="image_file" id="image_file"> </td>
	</tr>
	<?php } ?>
	<tr>
		<td>
		<button type="reset" value="Clear All">Clear All</button> 
		<!-- <?php if ($this->input->get('act') != 'update' && $this->input->get('act') != 'delete'){ ?> -->
		<input type="submit" value="Save" onClick="if(verifyFile()){document.fileUpForm.submit();}">
		<!-- <?php }?> -->
		
		<button type="cancel"  onclick="window.parent.close();">Cancel</button> </td>
	</tr>
		</form>
</table>
<script type="text/javascript">
<?php if ($this->input->get('act') != 'update' && $this->input->get('act') != 'delete'){ ?>
    function verifyFile()
	{
		var txt;
 		var r = confirm("Are you sure?");
  		if (r == true) {
			if(document.getElementById("image_file").value == "") {
	alert("Must choose a file first!");
	return false;
	}
	if(document.getElementById("image_file").value.length < 5) {
	alert("Invalid filename. Must contain proper extension.");
	return false;
	}
	if(document.getElementById("edition").value == "") {
	alert("Edition is required!");
	return false;
	}
	if(document.getElementById("att_name").value == "") {
	alert("Attachment name is required!");
	return false;
	}
	att_name = document.getElementById("att_name").value ;
	image_file = document.getElementById("image_file").value ;
	if (image_file) {
    var startIndex = (image_file.indexOf('\\') >= 0 ? image_file.lastIndexOf('\\') : image_file.lastIndexOf('/'));
    var filename = image_file.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
	}
	document.getElementById("form").action = "upload_buletin?id=<?php echo $this->input->get('id')?>&act=<?php echo $this->input->get('act')?>&upload=1&tag=<?=$this->input->get('tag')?>";
	return true;
 		 }
	
	}
<?php }?>

		$(document).ready(function () {
    $('#edition').datepicker({
           minViewMode: 1,
           autoclose: true,
           format: 'mm-yyyy'
    });  
            
});
</script>
<?php } ?>