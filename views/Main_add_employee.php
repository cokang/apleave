<?php echo form_open('add_employee_ctrl') ?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ADD EMPLOYEE(S) </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ADD EMPLOYEE
                        </div>
                        <?php if( $this->session->flashdata("msg") ){?>
                        <?="<div class='alert alert-warning alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Failed!</strong>   ".$this->session->flashdata("msg")."</div>";?>
                        <?php }?>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <span class="error_message" id="message_sp" style="display:none;">  </span>
                                    <form role="form">
                                    <div class="form-group">
                                            <label>APSB No.</label>
                                            <input name="emp_apsb" id="emp_apsb" type="text" class="form-control" value="<?= isset($employeedet[0]->apsb_no) ? $employeedet[0]->apsb_no : '' ?>"/ >
                                    </div>
                                    <div class="form-group">
                                            <label>Name</label>
                                            <input name="emp_name" id="emp_name" type="text" class="form-control" value="<?= isset($employeedet[0]->v_UserName) ? $employeedet[0]->v_UserName : '' ?>"/ >
                                    </div>
                                    <div class="form-group">
                                            <label>Department Code</label>
                                            <input name="dept_code" id="dept_code" type="text" class="form-control" value="<?= isset($employeedet[0]->v_GroupID) ? $employeedet[0]->v_GroupID : '' ?>"/ >
                                    </div>
                                    
                                    <div class="form-group">
                                    <label>State</label>
                                    <?php 
                                    $state[0] = 'Select';
                                    foreach ($statelist as $list){
                                    $state[$list->state_code] = $list->state;
                                    }
                                    ?>
                                    <?php echo form_dropdown('state', $state, set_value('state',isset($employeedet[0]->v_hospitalcode) ? $employeedet[0]->v_hospitalcode : '0') ,  'id="statelist" class="form-control"');?>
                                    </div>

                                    <div class="form-group">
                                        <label>Office Group</label>
                                        <?php 
                                        $hosp_l[0] = 'Select';
                                        foreach ($hosplist as $hlist){
                                        $hosp_l[$hlist->officegrp_code] = $hlist->officegrp_name;
                                        }
                                        ?>
                                        <?php echo form_dropdown('hosp_code', $hosp_l, set_value('hosp_code',isset($employeedet[0]->site_state) ? $employeedet[0]->site_state : '0') ,  'id="hosp_code" class="form-control"');?>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Hospital</label>
                                        <?php 
                                        $hosp_l[0] = 'Select';
                                        foreach ($hosplist as $hlist){
                                        $hosp_l[$hlist->v_HospitalCode] = $hlist->v_HospitalName;
                                        }
                                        ?>
                                        <?php echo form_dropdown('hosp_code', $hosp_l, set_value('hosp_code',isset($employeedet[0]->site_state) ? $employeedet[0]->site_state : '0') ,  'id="hosp_code" class="form-control"');?>
                                    </div> -->
                                    <!--<div class="form-group">
                                            <label>Hospital</label>
                                            <input name="hosp_code" id="hosp_code" type="text" class="form-control" value=""/ >
                                    </div>-->
                                    <div class="form-group">
                                            <label>Telephone Number</label>
                                            <input name="phone_no" id="phone_no" type="text" class="form-control" value="<?= isset($employeedet[0]->phone_no) ? $employeedet[0]->phone_no : '' ?>"/ >
                                    </div>
                                    
                                    
                                    
                        
                                      <!--<input type="submit" value=" Cancel " id="button" class="btn" name="cancel">-->              
                                    
                                    <input type="hidden" name="hid_id" value="" />
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                            <label>Grade</label>
                                            <input name="emp_grade" id="emp_grade" type="text" class="form-control" value="<?= isset($employeedet[0]->grade) ? $employeedet[0]->grade : '' ?>"/ >
                                    </div>
                                    <div class="form-group">
                                            <label>Designation</label>
                                            <input name="emp_desg" id="emp_desg" type="text" class="form-control" value="<?= isset($employeedet[0]->design_emp) ? $employeedet[0]->design_emp : '' ?>"/ >
                                    </div>
                                    <div class="form-group">
                                    <label>Type</label>
                                    <?php 
                                    $emp_type = array (
                                        "0" => "Select",
                                        "Head" => "Head",
                                        "Employee" => "Employee")
                                    ?>
                                    <?php echo form_dropdown('emp_type', $emp_type, set_value('emp_type',isset($employeetype) ? $employeetype : '0') ,  'id="emp_type" class="form-control" onchange="return check_emptype(this.value)"');?>
                                        <!--<select name="emp_type" id="emp_type" class="form-control" onchange="return check_emptype(this.value)">
                                        <option value="0">Select</option>
                                        <option value="Head" >Head</option>
                                        <option value="Employee" >Employee</option>
                                        </select>-->
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                    <input name="emp_email" id="emp_email" type="text" class="form-control" value="<?= isset($employeedet[0]->v_email) ? $employeedet[0]->v_email : '' ?>"/ >
                                    </div>
                                    
                                    
                                    <?php if (($employeetype) && $employeetype == 'Head'){ ?>
                                    <div class="form-group" id="report_to" style="display:block;">
                                    <?php } else {  ?>   
                                    <div class="form-group" id="report_to" style="display:none;">
                                    <?php } ?>
                                        <label>Report To</label>

                                        <?php 
                                        $report[0] = 'Select';
                                        foreach ($reportto as $row){
                                          $report[$row->group_sup_id] = $row->v_UserName;
                                        }
                                        ?>
                                        <?php echo form_dropdown('report_to', $report, set_value('report_to',isset($emptype[0]->report_to) ? $emptype[0]->report_to : '0') ,  'id="reportto" class="form-control"');?>

                                        <!--<select name="report_to" id="report_to"  class="form-control" >
                                        <option value="0">Select</option>
                                        <option value='1' >Test Head</option>                                      
                                        </select>-->

                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Username</label>
                                    <input name="emp_uname" id="emp_uname" type="text" class="form-control" value="<?= isset($employeedet[0]->v_UserID) ? $employeedet[0]->v_UserID : '' ?>"/ >
                                    </div>
          
                                    <?php if(!($employeedet)){ ?>
                                    <div class="form-group">
                                        <label>Password</label>
                                    <input name="emp_pass" id="emp_pass" type="password" class="form-control" value="<?= isset($employeedet[0]->v_password) ? $employeedet[0]->v_password : '' ?>"/ >
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <input type="checkbox" name="probation_stat" value="Y"<?= ($probation) ? 'checked' : ''?>> Probation Staff
                                    </div>
                                    <input name="submit" type="submit" class="btn btn-default" id="button" value=" Submit " onClick="return validate_form();"/>
                                </div>

                            </div>
                            </form>
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