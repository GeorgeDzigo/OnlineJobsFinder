<?php
      // RESET PASSWORD
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $res->sendpasswordresetlink($_POST['companyemail']);
}      
?>
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Reset Password</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "?tab=resetpasswordl"?>" method="POST" class="add" autocomplete="off">
                        <input type="email" name="companyemail" id="re" placeholder="Company Email" >
                        <button type="submit" class='submit' id="resubmit" style='width:16%;'>Send Password Reset Link </button>
                        </form>
                         
                        <a href="./rpsrv.php?tab=csignup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
      <!-- END RESET PASSWORD -->