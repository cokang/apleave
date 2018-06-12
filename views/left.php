 <div class="navbar-default navbar-static-side" role="navigation" >
      <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
		<?php $num = 1?>
		<?php $num2 = 1?>
          <?= (($this->input->get('tab') == $num2++) or ($this->uri->slash_segment(1) .$this->uri->slash_segment(2) == 'Controllers/apply_leave/')or ($this->uri->slash_segment(1) .$this->uri->slash_segment(2) == 'Controllers/do_upload/')) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/apply_leave?tab=<?=$num++?>" class="ahref"><i class="fa fa-windows fa-fw"></i>Apply Leave</a></li>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/leave_listing?tab=<?=$num++?>" class="ahref"><i class="fa fa-pencil fa-fw"></i>Leave Requests</a></li>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/leave_account_view?tab=<?=$num++?>" class="ahref"><i class="fa fa-paperclip fa-fw"></i>Leave Balance</a></li>
          <?php if (($hrrow == 1) OR ($headrow > 0)){ ?>
           <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/date_calender?tab=<?=$num++?>" class="ahref"><i class="fa fa-calendar fa-fw"></i>Date Calendar</a></li>
          <?php } ?> 
          <?php if ($hrrow == 1) { ?> 
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/add_employee?tab=<?=$num++?>" class="ahref"><i class="fa fa-user-md fa-fw"></i>Add Employees</a></li>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/add_leaves?tab=<?=$num++?>" class="ahref"><i class="fa fa-edit fa-fw"></i>Add Leaves</a></li>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/leave_Limit?tab=<?=$num++?>" class="ahref"><i class="fa fa-exchange fa-fw"></i>Leave Limit</a></li>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/employee_listing?tab=<?=$num++?>" class="ahref"><i class="fa fa-users fa-fw"></i>Manage Employees</a></li>
          <?php } ?>
          <!--<li><a href="<?php echo base_url(); ?>index.php/Controllers/update_constants" class="active" ><i class="fa fa-table fa-fw"></i>Update Settings</a></li>-->
          <?php if ($headrow > 0){ ?>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/leave_approved?tab=<?=$num++?>" class="ahref"><i class="fa fa-exchange fa-fw"></i>Leave Approval</a></li>
          <?php } ?>
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/change_password?tab=<?=$num++?>" class="ahref"><i class="fa fa-lock fa-fw"></i>Change Password</a></li>
          <!-- code by bazli on 3/5/18 -->
          <?= ($this->input->get('tab') == $num2++) ? '<li class="active">' : '<li>'?><a href="<?php echo base_url(); ?>index.php/Controllers/employee_guide?tab=<?=$num++?>" class="ahref"><i class="fa fa-book fa-fw"></i>Employee Guide</a></li>
        </ul>
        <!-- /#side-menu --> 
      </div>
      <!-- /.sidebar-collapse --> 
    </div>
    <!-- /.navbar-static-side --> 
  </nav>