<?php include '../../view/header.php'?>
<?php if(count($_SESSION) == 0 ) { 
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once '../../classes/inserter.class.php';
            $ins = new Insert();
            $ins->insert($_POST['usrfname'], $_POST['usrlname'], $_POST['usrpassword'], $_POST['usremail'], $_POST['usrphonenumber']);
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
                  <input type="text" name="usrfname" id="re" placeholder="First Name">
                  <input type="text" name="usrlname" id="re" placeholder="Last Name">
                  <input type="password" name="usrpassword" id="re" placeholder="Password">
                  <input type="email" name="usremail" id="re" placeholder="Email">
                  <input type="tel" name="usrphonenumber" id="re" placeholder="Phone Number">
                  <button type="submit" class='submit' id="resubmit">Submit</button>
                  <a href="./rpsrv.php?s=csignup" class="chngrsrcm" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Company Registration</a>
            </form>
            <a href="./rpsrv.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
      </center>
</div>
<?php } ?>