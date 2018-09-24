<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>css/login.css">
    </head>

    <body>

        <div class="wrapper">
            <div class="container">
                <div class="col-md-12 loginbox">
                    <div class="col-md-6">
                        <img src="<?php echo base_url();?>images/logo.png" class="logo">
                        <h2>Advance Pact e-Leave<?php  //echo "version ci : " . CI_VERSION; ?></h2>
                        <img src="<?php echo base_url();?>images/login_image.png" class="login-img">
                    </div>
                    <div class="col-md-6">
                        <h4>Login To Advance Pact e-Leave <i class="fa fa-lock" area-hidden="true"></i></h4>
                        <h5>Enter Your Username And Password To Log On</h5>

                        <?php $hidden = array('class' => 'login-form','role' => 'form');?>
                        <?php echo form_open('logincontroller/validate_credentials',$hidden);?>
                            <input type="text" placeholder="Username" id="form-username" name="name">
                            <input type="password" placeholder="Password" id="form-password" name="password">
                            <button type="submit" id="login-button">Login</button>
                            <?php echo "<div class='errormsg'>$errormsg</div>";?>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>

        </div>
        
        <script src='<?php echo base_url()?>js/jquery-1.11.1.min.js'></script>
    </body>
</html>
