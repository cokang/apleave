<link rel="resource" type="application/l10n" href="<?=base_url();?>js/pdfjs/web/locale/locale.properties">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>js/pdfjs/css/style.css">
<script src="<?=base_url();?>js/pdfjs/build/pdf.js"></script>
<script src="<?=base_url();?>js/pdfjs/viewer.js"></script>
<script Language="javascript">

function printfile(id) {
    window.frames[id].focus();
    window.frames[id].print();
}

</script>


<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Staff Handbook</h1>
		</div>


	</div>


	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> Staff Handbook </div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<iframe src='<?=base_url()."js/pdfjs/web/viewer.html?file=".base_url()."buletin_file/APP.pdf";?>' id="pdfviewer"></iframe>
						</div>
					</div>
          <?php if (substr($this->session->userdata('v_UserName'), 0, 3) == "MGP") { ?>
					<iframe hidden src="/app2.pdf" id="objAdobePrint" name="objAdobePrint" height="95%" width="100%" frameborder=0></iframe><br>
          <?php } else {?>
          <iframe hidden src="/app.pdf" id="objAdobePrint" name="objAdobePrint" height="95%" width="100%" frameborder=0></iframe><br>
          <?php } ?>
					<button type="button" class="btn btn-default" value="Print" onclick="javascript:printfile('objAdobePrint');">Print Acknowledgment of Acceptance
</button>
				</div>
			</div>
		</div>
	</div>
</div>
