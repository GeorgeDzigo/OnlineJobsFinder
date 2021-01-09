<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- STYLES -->
      <link rel="stylesheet" href="../css/index.css">
      <link rel="stylesheet" href="../css/reset.css">
      
      <link rel="stylesheet" href="../css/add.css">

      <link rel="stylesheet" href="../fa/css/font-awesome.min.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
      <?php include '../view/header.php';
      require_once '../../functions.php';
      $fn = new Functions();
      $fn->delete_password_reset_links();
      ?>

      
      <?php
            if(count($_SESSION) == 1 && $_GET['s'] != "publish") header("Location: ./add.php?s=publish");
            if(count($_SESSION) == 1 && $_GET['s'] == 'publish') { 
                  if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $fn->insert($_POST['firstname'], $_POST['lastname'], $_POST['vacancyname'], $_POST['category'], $_POST['keywords'], $_POST['info'], $_SESSION['cmpn_name']);
                        echo '<script>window.location.replace("./index.php")</script>';
                  }
      ?><!-- PUBLISH  -->
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Fill Your Vacancy</h1>
                  </div>
                  <center>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?s=publish";?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="firstname" id="in" placeholder="First Name" style='width: 15%; display: inline-block'>
                              <input type="text" name="lastname" id="in" placeholder="Last Name" style="width:15%; display: inline-block">
                              <div></div>
                              <input type="text" name="vacancyname" id="in"placeholder="Vacancy Name" style="width: 20%; display: inline-block">
                              <!-- CATEGORY -->
                              <select class="custom-select" id="in" style="width: 10%;" name="category">
                                    <option>Category</option>
                                    <option placeholder="Developer">Developer</option>
                                    <option placeholder="Engineer">Engineer</option>
                                    <option placeholder="Designer">Designer</option>
                                    <option placeholder="Doctor">Doctor</option>
                              </select>
                              <!-- End CATEGORY -->
                              <input type="text" id="in" placeholder="Keywords" name="keywords">
                              <textarea name="info" id="in" class='info' placeholder="Requirements"></textarea>
                              <button type="button" class='submit' id="submit" onclick='inputChecker()'>Submit</button>
                        </form>
                  </center>
                  <p id="errors"> </p>
            </div>
            <!-- END PUBLISH -->
      <?php }
      
      else if(count($_SESSION) == 0 && $_GET['s'] == 'publish') echo "<script>window.location.replace('./add.php?s=signup')</script>";
      ?>
      
      
      <?php 
      if (count($_SESSION) == 0 && $_GET['s'] == 'signup') {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $fn = $fn->checkAnRegister($_POST['companyname'], $_POST['password'], $_POST['companyemail'], $_POST['phonenumber']);
                  if($fn == null) echo "<script>window.location.replace('./add.php?s=publish')</script>";
            }
      ?><!-- SIGN UP -->
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Company Registration</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "?s=signup"?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="companyname" id="re" placeholder="Company Name"  <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($fn != null) echo "value='".$fn['name']."'>" . "<h4 class='nptrrs'>".$fn['company_name']."</h4>"; echo ">"?>
                              <input type="email" name="companyemail" id="re" placeholder="Company Email" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($fn != null) echo "value='".$fn['email']."'>" . "<h4 class='nptrrs'>".$fn['company_email']."</h4>"; echo ">"?>
                              <input type="password" name="password" id="re" placeholder="Password">
                              <input type="tel" name="phonenumber" id="re" placeholder="Company Number" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($fn != null) echo "value='".$fn['phone']."'>" . "<h4 class='nptrrs'>".$fn['company_phone']."</h4>"; echo ">"?>
                              <button type="button" class='submit' id="resubmit" onclick='register()'>Submit</button>
                        </form>
                        <a href="./add.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
            <!-- END SIGN UP -->
      <?php }?>
      
      
      <?php if (count($_SESSION) == 0 && $_GET['s'] == 'signin') {
                  if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $d = "";
                        if($fn->signin($_POST['companyname'], $_POST['password']) == $_POST['companyname']) {
                              $fn->signin($_POST['companyname'], $_POST['password']);
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
                              <input type="text" name="companyname" id="re" placeholder="Company Name" value=''>
                              <input type="password" name="password" id="re" placeholder="Password" value=''>
                              <button type="button" class='submit' id="resubmit" onclick='register()'>Submit</button>
                        </form>
                         
                        <a href="./add.php?s=signup" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a><span style='font-size: 30px;'>|</span>
                        <a href="./add.php?s=resetpassword" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Reset Password</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
            <!-- END SIGN IN -->
      <?php }?>


      <?php if(count($_SESSION) == 0 && $_GET['s'] == "resetpassword") {
            // RESET PASSWORD
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $fn->resetpass($_POST['companyemail']);
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
                         
                        <a href="./add.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
            <!-- END RESET PASSWORD -->
      <?php } ?>

      
<!-- Scripts -->
<script src="../js/add.js"></script>
<?php include '../view/footer.php'?>