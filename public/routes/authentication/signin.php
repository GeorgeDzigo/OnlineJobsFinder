<?php                  
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../../classes/getter.class.php';
      $get = new Getter();
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
                  <form action="<?php $_SERVER['PHP_SELF'] . "?s=signin"?>" method="POST" class="add" autocomplete="off">
                        <input type="email" name="usrcmpnemail" id="re" placeholder="email" value=''>
                        <input type="password" name="password" id="re" placeholder="Password" value=''>
                        <button type="button" class='submit' id="resubmit" onclick='register()'>Submit</button>
                  </form>
                        
                  <a href="./rpsrv.php?s=csignup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a><span style='font-size: 30px;'>|</span>
                  <a href="./rpsrv.php?s=resetpassword" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Reset Password</a>
            </center>
            <p id="reerrors"> </p>
      </div>
<!-- END SIGN IN -->