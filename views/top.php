<?php //echo "<pre>";var_export($this->session->all_userdata());die;?>
<div id="wrapper">
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;" id="header-color">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"> 
        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> 
        <span class="icon-bar"></span> <span class="icon-bar"></span> 
      </button>
			<?php 
			if ($this->session->userdata('passvalidity') == "invalid") {
				$urlx = "index.php/Controllers/change_password";
			} else {
				$urlx = "index.php/Controllers/apply_leave";
			}
			 ?>
      <a class="navbar-brand" href="<?php echo base_url(); ?><?=$urlx?>">ADVANCE PACT e-Leave</a> 
      <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown"> 
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Hi, <?php echo ucwords($this->session->userdata('v_UserName'))?> </a> </li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url(); ?>/Logincontroller/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
          </ul>
          <!-- /.dropdown-user --> 
        </li>
        <li><font style="font-weight:bold; color:white;">Welcome <?php echo ucwords($this->session->userdata('v_Name'))?> (<?php echo ucwords($this->session->userdata('apsb_no'))?>)</font></li>
        <!-- /.dropdown -->
      </ul>
      <!-- /.navbar-top-links -->
    </div>
    <!-- /.navbar-header -->
    <?php if ( $this->uri->slash_segment(1) .$this->uri->slash_segment(2) == 'Controllers/print_out/'){?>
    <div style="float:right; margin:7px;"><input type="button" name="Print" value="Print" class="btn btn-default" onClick="window.print()"/></div>
    <div style="float:right; margin:7px;">
      <a href="<?=base_url()?>index.php/Controllers/unprocess_listing?tab=<?=$this->input->get('tab')?>&parent=<?=$this->input->get('parent')?>">
        <button type="button" name="Back" class="btn btn-default">< Back</button>
      </a>
    </div>
    <?php }else{ ?>
    <div style="float:right; margin:7px;"><img src="<?php echo base_url();?>images/logo.png" class="img-heading-top"/></div>
    <?php } ?>