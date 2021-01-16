<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../../classes/inserter.class.php';
      $f = new Inserting();
      require_once '../../classess/verify.class.php';
      $ver = new Verify();
      $f = $ins->checkAnRegister($_POST['companyname'], $_POST['password'], $_POST['companyemail'], $_POST['phonenumber']);
      $ver->sendVerifyLink($_POST['companyname'], $_POST['companyemail']);
      if($f == null) {
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
                        <form action="<?php $_SERVER['PHP_SELF'] . "?s=signup"?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="companyname" id="re" placeholder="Company Name"  <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {if($f != null) echo "value='".$fn['name']."'>" . "<h4 class='nptrrs'>".$f['company_name']."</h4>";}else echo ">";?>
                              <input type="email" name="companyemail" id="re" placeholder="Company Email" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($f != null) {echo "value='".$fn['email']."'>" . "<h4 class='nptrrs'>".$f['company_email']."</h4>";}else echo ">";?>>
                              <input type="password" name="password" id="re" placeholder="Password">
                              <input type="tel" name="phonenumber" id="re" placeholder="Company Number" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {if($f != null) echo "value='".$fn['phone']."'>" . "<h4 class='nptrrs'>".$f['company_phone']."</h4>";} 
                              else echo ">";?>
                              <button type="button" class='submit' id="resubmit" onclick='register()'>Submit</button>
                              <a href="./rpsrv.php?s=usignup" class="chngrsrcm" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">User Registration</a>
                        </form>
                        <a href="./rpsrv.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
                  </center>
            </div>
            <!-- COMPANY SIGN UP -->