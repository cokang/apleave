<?php echo form_open('logincontroller/chgPassword');?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">CHANGE PASSWORD</h1>
      </div>
      
      <!-- /.col-lg-2 --> 
      
    </div>
    
    <!-- /.row -->
    
    <div class="row">
      <div class="col-lg-5">
        <div class="panel panel-default">
          <div class="panel-heading"> CHANGE PASSWORD </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12"> <span class="error_message" id="message_sp" style="display:none;"> </span>
                <form role="form">
                  <div class="form-group">
                    <label>New Password</label>
                    <input name="npassword" id="pass" type="password" class="form-control" value=""/ >
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input name="cpassword" id="confirm_pass" type="password" class="form-control" value=""/ >
                  </div>
                  <button type="submit" name="submit" class="btn btn-default" id="button" value="Submit" onClick="return validate_form();">Submit</button>
                  <!--<input name="submit" type="button" class="btn btn-default" id="button" value=" Submit " onClick="return validate_form();"/>-->
                  
                  <!--<button type="submit" class="btn btn-default">Submit Button</button>-->
                  
                  <input type="reset" name="reset" value="Reset" class="btn btn-default"/>
                  <input type="hidden" name="hid_id" value="" />
                </form>
              </div>
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