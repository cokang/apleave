<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Administrative</h1>
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
						<a href="<?php echo base_url(); ?>index.php/Controllers/unprocess_listing?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/unrecoded_leave.png">
								<br>
								Unpaid Leave
							</div>
						</a>
						<?php if( $hrrow=='HR' ){ ?>
						<a href="<?php echo base_url(); ?>index.php/Controllers/report_summary?tab=<?=$this->input->get('tab');?>&parent=1" class="left box">
							<div align="center">
								<img height="99px" src="<?=base_url()?>images/icon/report.png">
								<br>
								Report Summary
							</div>
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>