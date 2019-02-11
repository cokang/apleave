
<?php $hidden = array('name' => 'myForm' ); ?>
<?php echo form_open_multipart('apply_leave_ctrl',$hidden) ?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"></h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> APPLY LEAVE </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6"> <span class="error_message" id="message_sp" style="display:none;"> </span>
                <?php $hidden = array('name' => 'myForm');?>
                <?php echo form_open_multipart('apply_leave_ctrl',$hidden);?>
                <div class="form-group">
                  <label>Leave Type:</label>

                  <?php
                  $whatimg = array('2','3','5','6','7','8','9','11','13','14');
                  $leaveT[0] = 'Select';
                  foreach ($leave_type as $row){
                    $leaveT[$row->id] = $row->leave_name;
                  }
                  ?>
                  <?php echo form_dropdown('leave_type', $leaveT, set_value('leave_type') ,  'id="leave_type" class="form-control" onchange="return check_leave_availability(this.value,'.$year.','.count($probationchk).')" ');?> <!--,'<?=$year?>'-->

                  <!--<select name="leave_type" id="leave_type"  class="form-control" onchange="return check_leave_availability(this.value,'<?=$year?>')">
                    <option value="0">Select</option>
                    <option value="Casual Leave"<?php echo set_select('leave_type', 'Casual Leave')?>>Casual Leave</option>
                    <option value="Sick Leave"<?php echo set_select('leave_type', 'Sick Leave')?>>Sick Leave</option>
                    <option value="Emergency Leave"<?php echo set_select('leave_type', 'Emergency Leave')?>>Emergency Leave</option>
                    <option value="Unpaid Leave"<?php echo set_select('leave_type', 'Unpaid Leave')?>>Unpaid Leave</option>
                    <option value="Compassionate Leave"<?php echo set_select('leave_type', 'Compassionate Leave')?>>Compassionate Leave</option>
                  </select>-->
                </div>
                <div class="form-group">
                  <label>Duration:</label>
                  <select name="duration" id="duration"  class="form-control"> <!--onchange="return check_duration(this.value)"-->
                    <option value="0">Select</option>
                    <option selected="selected" value="Full Day"<?php echo set_select('duration', 'Full Day')?>>Full Day</option>
                    <?php if ($this->input->post('leave_type') == '11') { ?>
                    <option value="Half Day"<?php echo set_select('duration', 'Half Day')?>>Half Day</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Relief</label>

                  <?php
                  $alt[0] = 'Select';
                  foreach ($alternate as $row){
                    $alt[$row->v_UserID] = $row->v_UserName;
                  }
                  ?>
                  <?php echo form_dropdown('alt', $alt, set_value('alt') ,  'class="form-control"');?>

                
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Leave From</label>
                  <?php if (in_array($this->input->post('leave_type'), $whatimg)) { ?>
                  <input name="from_leavedate" id="from" type="text" class="form-control" value="<?php echo set_value('from_leavedate') ?>"/ onchange="fromChange(this.value)" autocomplete="off">
                  <?php } else { ?>
                  <input name="from_leavedate" id="from" type="text" class="form-control" value="<?php echo set_value('from_leavedate') ?>"/ disabled="disabled" onchange="fromChange(this.value)" autocomplete="off">
                  <?php } ?>
                </div>
                <div class="form-group" id="to_date">

                  <?php if ((in_array($this->input->post('leave_type'), $whatimg)) AND $this->input->post('duration') == 'Full Day') { ?>
                  <label>To</label>
                  <input name="to_leavedate" id="to" type="text" class="form-control" value="<?php echo set_value('to_leavedate') ?>" onchange="return check_days_available()" autocomplete="off" />
                  <?php } elseif ((in_array($this->input->post('leave_type'), $whatimg)) AND $this->input->post('duration') == 'Half Day') { ?>
                  <input name="to_leavedate" id="to" type="text" class="form-control" value="" onchange="return check_days_available()" style="display:none" autocomplete="off" />
                  <?php } else { ?>
                  <label>To</label>
                  <input name="to_leavedate" id="to" type="text" class="form-control" value="<?php echo set_value('to_leavedate') ?>" onchange="return check_days_available()" disabled="disabled" autocomplete="off" />
                  <?php } ?>
                </div>
                <div class="form-group">
                  <label>Reason</label>
                  <textarea name="reason" id="reason" type="text" class="form-control" rows='3'/><?php echo set_value('reason') ?></textarea>
                </div>
                <script type="text/javascript"></script>

                <?php // $whatimg = array('2','3','5','6','7','8','9','11','13'); if (isset($image) AND ($this->input->post('leave_type') == '2' OR $this->input->post('leave_type') == '3')){ ?>
                <?php if (isset($image) AND (in_array($this->input->post('leave_type'), $whatimg))){ ?>
                <div class="form-group" id="sick_leave_img">
                  <label>Image Reference</label><br />
                  <img src="<?php echo base_url(); ?>sick_leave_img/<?=$image?>" width="100%" title="Choose Your Picture" onclick="getFile()" name="file_name" id="file_name" value="picture"/>
                </div>
                <?php }else{ ?>
                <div class="form-group" id="sick_leave_img" style="display: none;">
                  <label>Image Reference</label><br />
                  <div id="yourBtn"><img src="<?php echo base_url(); ?>sick_leave_img/<?= isset($image) == TRUE ? $image : 'No_image_available.jpg'?>" class="col-lg-12" title="Choose Your Picture" id="file_name" onclick="getFile()" name="file_name" value="<?= isset($image) == TRUE ? $image : 'No_image_available.jpg'?>"/></div>

                  <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" type="file" value="upload" name="userfile" onchange="sub(this)"/></div>
                </div>
                <?php } ?>
                <input type="submit" value="Submit" name="Button" class="btn btn-default" id="button" onclick="return validate_form();">
                <input type="reset" name="reset" value="Reset" class="btn btn-default"/>
                <input type="hidden" name="hid_id" value="" />
              </div>
            </form>
            <?php echo form_hidden(isset($upload_data) ? $upload_data : '' ) ?>
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
<?php echo form_close(); ?>
