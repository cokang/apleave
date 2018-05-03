 <?php echo form_open('add_leave_limit_ctrl') ?>
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
          <div class="panel-heading"> LEAVE LIMIT </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6"> <span class="error_message" id="message_sp" style="display:none;"> </span>
                  <div class="form-group">
                    <label>Total Entitlement of Family Sick Leave</label>
                    <input name="family_sick_l" id="family_sick_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Maternity Leave</label>
                    <input name="maternity_l" id="maternity_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Paternity Leave</label>
                    <input name="paternity_l" id="paternity_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Marriage Leave</label>
                    <input name="marriage_l" id="marriage_l" type="text" class="form-control" value=""/>
                  </div>
              </div>
               <div class="col-lg-6">
                  <div class="form-group">
                    <label>Total Entitlement of Unrecorded Leave</label>
                    <input name="unrecorded_l" id="unrecorded_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Study Leave</label>
                    <input name="study_l" id="study_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Transfer Leave</label>
                    <input name="transfer_l" id="transfer_l" type="text" class="form-control" value=""/>
                  </div>
                  <div class="form-group">
                    <label>Total Entitlement of Hajj Leave</label>
                    <input name="hajj_l" id="hajj_l" type="text" class="form-control" value=""/>
                  </div>
                  <input type="submit" value="Submit" name="Button" class="btn btn-default" id="button" onclick="return validate_form();">
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