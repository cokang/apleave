</div>
<!-- /#wrapper --> 

<!-- Core Scripts - Include with every page --> 
<script src="<?php echo base_url(); ?>/js/jquery-1.10.2.js"></script> 
<script src="<?php echo base_url(); ?>/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>/js/jquery.metisMenu.js"></script> 

<!-- Page-Level Plugin Scripts - Forms --> 

<!-- SB Admin Scripts - Include with every page --> 
<!-- <script src="http://serverfordemo.com/green_leave//js/sb-admin.js"></script>  -->

<!-- Page-Level Demo Scripts - Forms - Use for reference -->
<link href="<?php echo base_url(); ?>/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery9.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery-ui.js"></script>



<!-- pdf -->
<script src="<?=base_url();?>js/pdfviewer.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".pdf-container").pdfviewer({
			scale: 2,
			onDocumentLoaded: function() {
				var num = $(this).data('pdfviewer').pages();
				$(this).data('pdfviewer').autoFit();
				//alert('onDocumentLoaded:'+num);		
			},
			onPrevPage: function() { 
				//alert('onPrevPage'); 
				return true; 
			},
			onNextPage: function() { 
				//alert('onNextPage'); 
				return true; 
			},
			onBeforeRenderPage: function(num) {
				//alert('onBeforeRenderPage'); 
				return true;
			},
			onRenderedPage: function(num) {
				//alert('onRenderedPage'); 
			}
		});
	});
</script>



<script type="text/javascript">
//$(document).ready(function() {	
	//$( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });				
	//$( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
//});
</script>
</body>
</html>