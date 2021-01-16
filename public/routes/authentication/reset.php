<?php if(count($_SESSION) == 0 && $_GET['s'] == "resetpassword") {
            require_once '../../classes/functions.class.php';
            $fun = new Functions();
            // RESET PASSWORD
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $fun->resetpass($_POST['companyemail']);
            }      
      ?>
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Reset Password</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "s=resetpassword"?>" method="POST" class="add" autocomplete="off">
                        <input type="email" name="companyemail" id="re" placeholder="Company Email" >
                        <button type="button" class='submit' id="resubmit" onclick="resetpassword()" style='width:16%;'>Reset Password</button>
                        </form>
                         
                        <a href="./rpsrv.php?s=csignup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
            <!-- END RESET PASSWORD -->
<?php } ?>