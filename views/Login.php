<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url()?>css/login.css">
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css">
    </head>

    <body>

        <div class="wrapper">
            <div class="container">
                <div class="col-sm-12" style="top:40%;">
                    <div class="col-sm-6">
                        <h2>AdvancePact e-Leave</h2>
                        <img src="<?php echo base_url();?>images/login_image.png" class="m-b-0">
                    </div>
                    <div class="col-sm-6">
                        <h4>Login To AdvancePact e-Leave <i class="fa fa-lock" area-hidden="true"></i></h4>
                        <h5>Enter Your Username And Password To Log On</h5>
                        <?php echo $errormsg;?>
                        <?php $hidden = array('class' => 'login-form','role' => 'form');?>
                        <?php echo form_open('logincontroller/validate_credentials',$hidden);?>
                            <input type="text" placeholder="Username" id="form-username" name="name">
                            <input type="password" placeholder="Password" id="form-password" name="password">
                            <button type="submit" id="login-button">Login</button>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>

        </div>
        
        <script src='<?php echo base_url()?>js/jquery-1.11.1.min.js'></script>
    </body>
</html>
