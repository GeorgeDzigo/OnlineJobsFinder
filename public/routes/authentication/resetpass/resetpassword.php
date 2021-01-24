<?php
// RESET PASSWORD
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $reset->resetpassword($_POST['companyemail']);
}      
?>
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Reset Password</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "?tab=resetpassword"?>" method="POST" class="add" autocomplete="off">
                        <input type="password" name="password" id="re" placeholder="Enter new password" >
                        <button type="submit" class='submit' id="resubmit" style='width:16%;'>Reset Password</button>
                        </form>
                         
                        <a href="./rpsrv.php?tab=csignup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
      <!-- END RESET PASSWORD -->