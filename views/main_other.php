<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Staff Handbook</h1>
		</div>
	<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<!-- /.col-lg-6 -->
		<div class="col-lg-6" style="width:80%">
			<div class="panel panel-default">
				<!-- <div class="panel-heading">
				</div> -->

				<div class="panel-body">
					<div class="table-responsive inline-block">
						<a href="<?php echo base_url(); ?>index.php/Controllers/system_manual?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/guide.png">
								<br>
								StaffHandbook
							</div>
						</a>
						<!-- <?php if( $hrrow=='HR' ){ ?>
						<a href="<?php echo base_url(); ?>index.php/Controllers/report_summary?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="left">
								<img height="99px" src="<?=base_url()?>images/icon/report.png">
								<br>
								Report Summary
							</div>
						</a>
						<?php } ?> -->
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Archive e-Buletin</h1>
		</div>
	<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<!-- /.col-lg-6 -->
		<div class="col-lg-6" style="width:80%">
			<div class="panel panel-default" >
				<!-- <div class="panel-heading">
				</div> --><form method="get" action="" id="editionform">
				<table style="width:100%" ><tr>
				<td style="padding-left: 50px;padding-top: 10px;">	Year :
				<?php
                                    $year[0] = 'All';
                                    foreach ($editions as $edition){
                                    $year[$edition->vol] = $edition->vol;
                                    }
									?>
									
				<?php echo form_dropdown('edition', $year, set_value('edition',$this->input->get('edition')) ,  'id="edition" onchange="submitForm();"');?>
			</td><?php if( $this->input->get('act')=='edit' ){ ?>
				<td align="right" style="padding-right: 50px;width:10%">
				<div >
				<a  href="javascript:void(0)" onclick="fCallLocationa('buletin')" ><span class="fa fa-plus fa-fw" style="font-size:12px; color:green;" ></span> Add </a></div>
				</td>
			<?php }?>
			<?php if( $hrrow=='HR' ){ ?>
				<td align="right" style="padding-right: 50px;width:10%;">
				<div >
				<a  href="<?php echo base_url(); ?>index.php/Controllers/others?<?=$this->input->get('act')!='edit'?'act=edit':''?>"  ><span class="fa fa-pencil-square-o" style="font-size:12px; color:green;" ></span> Edit </a></div>
				</td>
			<?php }?>
			
			</tr></table>
				<div class="panel-body">
					<div class="table-responsive grid-container scrolloverflow" >
						
							<?php  foreach($buletins as $buletin){ ?>
							<div style="width:70%">
							<?php if( $this->input->get('act')=='edit' ){ ?>
							<a  class="fa fa-times " style=" color:red;" href="javascript:void(0)" onclick="deleteBuletin('<?=$buletin->Id?>','<?=$buletin->bul_name?>')" > </a>	
							<?php }?>
							<a href="<?php echo base_url(); ?>index.php/Controllers/e_buletin?name=<?=$buletin->bul_id?>" class="left box">
							
									<img height="99px" src="<?=base_url()?>images/icon/newspaper.png">
									<br>
									<!-- e-Buletin (Jan2020) -->
									<?= $buletin->bul_name?>
								
							</a>
								</div>
							<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">SOP/Work Instruction</h1>
		</div>
	<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<!-- /.col-lg-6 -->
		<div class="col-lg-6" style="width:80%">
			<div class="panel panel-default">
				<!-- <div class="panel-heading">
				</div> -->

				<div class="panel-body">
					<div class="table-responsive inline-block">
						<a href="" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/suitcase.png">
								<br>
								SOP
							</div>
						</a>
						<a href="<?php echo base_url(); ?>index.php/Controllers/system_manual?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/suitcase.png">
								<br>
								System Manual
							</div>
						</a>
						<!-- <?php if( $hrrow=='HR' ){ ?>
						<a href="<?php echo base_url(); ?>index.php/Controllers/report_summary?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="left">
								<img height="99px" src="<?=base_url()?>images/icon/report.png">
								<br>
								Report Summary
							</div>
						</a>
						<?php } ?> -->
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Archive Photos</h1>
		</div>
	<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<!-- /.col-lg-6 -->
		<div class="col-lg-6" style="width:80%">
			<div class="panel panel-default">
				<!-- <div class="panel-heading">
				</div> -->

				<div class="panel-body">
					<div class="table-responsive inline-block ">
						<a href="" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/imagelibrary.png">
								<br>
								Photo Library
							</div>
						</a>
						<!-- <?php if( $hrrow=='HR' ){ ?>
						<a href="<?php echo base_url(); ?>index.php/Controllers/report_summary?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="left">
								<img height="99px" src="<?=base_url()?>images/icon/report.png">
								<br>
								Report Summary
							</div>
						</a>
						<?php } ?> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	function fCallLocationa(tag){
	winProp = 'width=450,height=300,left=' + ((screen.width - 600) / 2) +',top=' + ((screen.height - 400) / 2) + ',menubar=no, directories=no, location=no, scrollbars=yes, statusbar=no, toolbar=no, resizable=no';
	Win = window.open('<?php   echo "upload_buletin";?>?act=addnew' + '&tag=' + tag, 'Location', winProp);
	Win.window.focus();
	}
	function deleteBuletin(id,filename){
		var txt;
 		var r = confirm('Delete file '+filename+'?');
  		if (r == true) {
			$(document).ready(function() {
            
            //  alert(selectedText); //exit();
            if(id) {
                $.ajax({
                    url: 'deleteBuletin/'+id,
                    type: "POST",
					success:function() {
                        alert('File '+filename+' deleted');
                    },
					error:function(){
						alert('Fail to delete file '+filename);
					}
                });
				location.reload();
            }
       
    });
		  }
	}
	function submitForm(){ 
  // Call submit() method on <form id='myform'>
  document.getElementById('editionform').submit(); 
} 
	</script>

</div>
