<?php                  
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $d = "";
      if($get->signin($_POST['usrcmpnemail'], $_POST['password'])) {
            $get->signin($_POST['usrcmpnemail'], $_POST['password']);
            echo $d . "<script>window.location.replace('./index.php')</script>";
      }
      else {
            $d = '<p id="reerrors"><li>Wrong Username/Password</li></p>';
            echo $d;
      }
}
?>
<!-- SIGN IN -->
      <div class="formholder">
            <div class="headersholder">
                  <h1 class="headersholder-h1">Sign In</h1>
            </div>
            <center>
                  <form action="<?php $_SERVER['PHP_SELF'] . "?tab=signin"?>" method="POST" class="add" autocomplete="off">
                        <input type="email" name="usrcmpnemail" id="siin" placeholder="email" value=''>
                        <input type="password" name="password" id="siin" placeholder="Password" value=''>
                        <button type="submit" class='submit' id="resubmit">Submit</button>
                  </form>
                        
                  <a href="./rpsrv.php?tab=csignup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a><span style='font-size: 30px;'>|</span>
                  <a href="./rpsrv.php?tab=resetpasswordl" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Reset Password</a>
            </center>
            <p id="reerrors"> </p>
      </div>
<!-- END SIGN IN -->
<!-- SCRIPTS -->
<script src='../js/signin.js'></script>