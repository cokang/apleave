<link rel="resource" type="application/l10n" href="<?=base_url();?>js/pdfjs/web/locale/locale.properties">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>js/pdfjs/css/style.css">
<script src="<?=base_url();?>js/pdfjs/build/pdf.js"></script>
<script src="<?=base_url();?>js/pdfjs/viewer.js"></script>
<?php

$system_manual = "system_manual";
?>
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
							<iframe src='<?=base_url()."js/pdfjs/web/viewer.html?file=".base_url()."images/$system_manual.pdf";?>' id="pdfviewer"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
