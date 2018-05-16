<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">UPDATE SETTINGS</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> UPDATE SETTINGS </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6"> <span class="error_message" id="message_sp" style="display:none;"> </span>
                <form role="form">                
                  
                  <div class="form-group">
                    <label>SMTP Host</label>
                    <input name="smtp_host" id="smtp_host" type="text" class="form-control" value="smtp.gmail.com"/  >
                  </div>
                  <div class="form-group">
                    <label>SMTP Port</label>
                    <input name="smtp_port" id="smtp_port" type="text" class="form-control" value="587"/ >
                  </div>
                  <div class="form-group">
                    <label>SMTP Username</label>
                    <input name="smtp_username" id="smtp_username" type="text" class="form-control" value="shijesh.b@greenlemon.in"/ >
                  </div>
                  <div class="form-group">
                    <label>SMTP Password</label>
                    <input name="smtp_password" id="smtp_password" type="text" class="form-control" value="glshijudasan"/ >
                  </div>
                  
                  <input name="submit" type="button" class="btn btn-default" id="button" value=" Submit "  onClick="return update_constants();"/>
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