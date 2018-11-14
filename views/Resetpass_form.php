<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>Reset Password</title>
   </head>

   <body>
      <?php
         echo $this->session->flashdata('reset_sent');
         echo form_open('/resetpass/send_reset');
         if ($this->session->userdata('v_UserName') == "harun") {
           $ekses = "";
         } else {
           $ekses = "disabled";
           header('Location: Controllers/apply_leave');
         }
      ?>

      <input type = "text" name = "email" required <?=$ekses?>/>
      <input type = "submit" value = "RESET USERID" <?=$ekses?>/>

      <button onclick="location.href = 'Controllers/apply_leave';" id="myButton" class="float-left submit-button" >Back to apleave</button>

      <?php
         echo form_close();
      ?>
   </body>

</html>
