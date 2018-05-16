<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">ADD LEAVES </h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> ADD LEAVES </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6"> <span class="error_message" id="message_sp" style="display:none;"> </span>
                <form action="" method="GET"><!--<form role="form">-->
                  <div class="form-group">
                    <label>Employee</label>
                    <?php 
                    $emp_name[0] = 'Select';
                    foreach ($stafflist as $row){
                      $emp_name[$row->v_UserID] = $row->v_UserName;
                    }
                    ?>
                    <?php echo form_dropdown('employee_name', $emp_name, set_value('employee_name',isset($username) ? $username : 'N/A') ,  ' id="employee_name" class="form-control" onchange="javascript: submit()"');?>
        
                    <!--<select name="employee_name" id="emp"  class="form-control" >
                      <option value="0">Select</option>
                      <?php foreach($stafflist as $row): ?>
                      <option value='<?=$row->v_UserID?>'<?php echo set_select('employee_name', $row->v_UserID )?>><?=$row->v_UserName?></option>  
                      <?php endforeach; ?>
                    </select>-->
                  </div>
                  <div class="form-group">
                    <label>Year</label>

                    <?php 
                    for($y=2015;$currentyear>=$y;$currentyear--){
                      $selectyear[$currentyear] = $currentyear;
                    }
                    ?>
                    <?php echo form_dropdown('sel_year', $selectyear, set_value('sel_year',isset($year) ? $year : 'N/A') ,  ' id="sel_year" class="form-control" onchange="javascript: submit()"');?>

                    <!--<select name="sel_year" id="sel_year" class="form-control" onchange="javascript: submit()">
                      <?php for($y=2015;$currentyear>=$y;$currentyear--){ ?>
                      <option value='<?= $currentyear ?>'<?php echo set_select('sel_year', $year)?>><?= $currentyear ?></option>
                      <?php } ?>
                    </select>-->
                  </div>
                </form> 
                <form action="" method="POST" name="myform">
                  <div class="form-group">
                    <label>Annual Leaves</label>
                    <input name="n_casual" id="n_casual" type="text" class="form-control" value="<?php echo set_value('n_casual',isset($leaveacc[0]->annual_leave) ? $leaveacc[0]->annual_leave : '' ) ?>"/  >
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Carry Foward Leaves</label>
                  <input name="n_carryfoward" id="n_carryfoward" type="text" class="form-control" value="<?php echo set_value('n_carryfoward',isset($leaveacc[0]->carry_fwd_leave) ? $leaveacc[0]->carry_fwd_leave : (isset($ALbalance) ? $ALbalance : 0) ) ?>"/  >
                </div>
                <div class="form-group">
                  <label>Sick Leaves</label>
                  <input name="n_sick" id="n_sick" type="text" class="form-control" value="<?php echo set_value('n_sick',isset($leaveacc[0]->sick_leave) ? $leaveacc[0]->sick_leave : '' ) ?>"/ >
                </div>
                <!--<div class="form-group">
                  <label>Earned Leaves</label>
                  <input name="n_earned" id="n_earned" type="text" class="form-control" value="<?php echo set_value('n_earned',isset($leaveacc[0]->earned_leave) ? $leaveacc[0]->earned_leave : '' ) ?>"/ >
                </div>-->
                <div class="form-group">
                  <label>Reason</label>
                  <textarea name="reason" id="reason" type="text" class="form-control" rows='3'/><?php echo set_value('reason',isset($leaveacc[0]->remarks) ? $leaveacc[0]->remarks : '' ) ?></textarea>
                </div>
                <input name="submit" type="submit" class="btn btn-default" id="button" value=" Submit "  onClick="return validate_form();"/>
                <input type="hidden" name="hid_id" value="" />
              </div>
              </form>
            </div>
            <!-- /.row (nested) --> 
          </div>
          <!-- /.panel-body --> 
        </div>
        <!-- /.panel --> 
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /#page-wrapper --> 