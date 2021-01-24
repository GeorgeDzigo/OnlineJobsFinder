<?php if(count($_SESSION) == 0 ) { 
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dt = $ins->checkAnRegister('usr', $_POST['usrfname'] . " " . $_POST['usrlname'], $_POST['usrpassword'], $_POST['usremail'], $_POST['usrphonenumber']);
            if($dt == null) {
                  $ver->sendVerifyLink('usr', $_POST['usrfname'] . " " . $_POST['usrlname'], $_POST['usremail']);
                  
            
?>  
<center style="margin-top: 7%;">    
            <pre class="success">
You Registered successfully! 
Please check your email to verify your account
You will redirected to main page in 10 seconds
            </pre>
</center>
      
<?php  
            echo "<script>setTimeout(function(){ window.location.replace('./index.php') }, 10000);</script>";
            }
      }
?>
<div class="formholder">
      <!-- USER COMPANY UP -->
      <div class="headersholder">
            <p id="cmpn_usr"class="headersholder-h1">User Registration</p>
      </div>
      <center id="cmpn">
            <form action="<?php $_SERVER['PHP_SELF'] . "?tab=signup"?>" method="POST" class="add" autocomplete="off">
                  <input type="text" name="usrfname" id="usiup" placeholder="First Name" <?="value=" . $_POST['usrfname']?>>
                  <input type="text" name="usrlname" id="usiup" placeholder="Last Name" <?= "value=" . $_POST['usrlname']?>>
                  <input type="password" name="usrpassword" id="usiup" placeholder="Password" <?= "value=" . $_POST['usrpassword']?>>
                  <input type="email" name="usremail" id="usiup" placeholder="Email" <?="value=" . $_POST['usremail']?>> <span class='errors'><?= $dt['email']?></span>
                  <input type="tel" name="usrphonenumber" id="usiup" placeholder="Enter Phone Number, With Country Code"<?= "value=" . $_POST['usrphonenumber']?>><span class='errors' style='margin-left: 9%;'><?= $dt['phone']?></span>
                  <button type="button" class='submit' id="resubmit" onclick='usignup()'>Submit</button>
                  <a href="./rpsrv.php?tab=csignup" class="chngrsrcm" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Company Registration</a>
                  
            </form>
            <a href="./rpsrv.php?tab=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
      </center>
      <p id="reerrors"></p>
</div>
<?php } ?>
<script src="../js/signup/usignup.js"></script>