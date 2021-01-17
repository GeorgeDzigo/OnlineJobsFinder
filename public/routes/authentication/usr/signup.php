<?php include '../../view/header.php'?>
<?php if(count($_SESSION) == 0 ) { 
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once '../../classes/inserter.class.php';
            $ins = new Inserting();
            $dt = $ins->checkAnRegister('usr', $_POST['usrfname'] . " " . $_POST['usrlname'], $_POST['usrpassword'], $_POST['usremail'], $_POST['usrphonenumber']);
            header("location: ./index.php");
      }
?>
<div class="formholder">
      <!-- USER COMPANY UP -->
      <div class="headersholder">
            <p id="cmpn_usr"class="headersholder-h1">User Registration</p>
      </div>
      <center id="cmpn">
            <form action="<?php $_SERVER['PHP_SELF'] . "?s=signup"?>" method="POST" class="add" autocomplete="off">
                  <input type="text" name="usrfname" id="re" placeholder="First Name" <?="value=" . $_POST['usrfname']?>>
                  <input type="text" name="usrlname" id="re" placeholder="Last Name" <?= "value=" . $_POST['usrlname']?>>
                  <input type="password" name="usrpassword" id="re" placeholder="Password" <?= "value=" . $_POST['usrpassword']?>>
                  <input type="email" name="usremail" id="re" placeholder="Email" <?="value=" . $_POST['usremail']?>> <span class='errors'><?= $dt['email']?></span>
                  <input type="tel" name="usrphonenumber" id="re" placeholder="Phone Number"<?= "value=" . $_POST['usrphonenumber']?>><span class='errors' style='margin-left: 9%;'><?= $dt['phone']?></span>
                  <button type="submit" class='submit' id="resubmit">Submit</button>
                  <a href="./rpsrv.php?s=csignup" class="chngrsrcm" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Company Registration</a>
                  
            </form>
            <a href="./rpsrv.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
      </center>
</div>
<?php } ?>