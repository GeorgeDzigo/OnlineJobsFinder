<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $f = $ins->checkAnRegister('cmpn', $_POST['companyname'], $_POST['password'], $_POST['companyemail'], $_POST['phonenumber']);
      if($f == null) {
            $ver->sendVerifyLink('cmpn', $_POST['companyname'], $_POST['companyemail']);
?>

      <center style="margin-top: 7%;">    
            <pre class="success">
You Registered successfully! 
Please check your email to verify your account, in order to start publishing your vacancies
You will redirected to main page in 10 seconds
            </pre>
      </center>

<?php echo "<script>setTimeout(function() {window.location.replace('./index.php')}, 10000)</script>"; }
      }
?>
            <div class="formholder">
                  <!-- USER COMPANY UP -->
                  <div class="headersholder">
                       <p id="cmpn_usr"class="headersholder-h1">Company Registration</p>
                  </div>
                  <center id="cmpn">
                        <form action="<?php $_SERVER['PHP_SELF'] . "?tab=signup"?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="companyname" id="csiup" placeholder="Company Name" <?= "value=".$_POST['companyname']?>>  <span class='errors'><?= $f['name']?></span>
                              <input type="email" name="companyemail" id="csiup" placeholder="Company Email" <?= "value=".$_POST['companyemail']?>>  <span class='errors'><?= $f['email']?></span>
                              <input type="password" name="password" id="csiup" placeholder="Password">
                              <input type="tel" name="phonenumber" id="csiup" placeholder="Company Number" <?= "value=".$_POST['phonenumber']?>>  <span class='errors'><?= $f['phone']?></span>
                              <button type="button" class='submit' id="resubmit">Submit</button>
                              <a href="./rpsrv.php?tab=usignup" class="chngrsrcm" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">User Registration</a>
                        </form>
                        <a href="./rpsrv.php?tab=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
                  </center>
                  <p id="reerrors"></p>
            </div>
            <!-- COMPANY SIGN UP -->
<!-- script -->
<script src="../js/signup/csignup.js"></script>