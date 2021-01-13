<?php 
      session_start();
      include '../view/header.php';
      // Including Classes
      require_once "../../classes/functions.class.php";
      require_once '../../classes/inserter.class.php';
      require_once '../../classes/getter.class.php';
      require_once '../../classes/verify.class.php';
      // Classes Def Clld Funcs 
            // getter.class.php
                  $get = new Getter();
            // inserter.class.php
                  $ins = new Inserting();   
            // verify.class.php
                  $ver = new Verify();
            // functions.class.php    
                  $fun = new Functions();
                  $fun->delete_password_reset_links();
?>
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

      
      <?php
      if(count($_SESSION) == 1 && $fun->checkverify($_SESSION['cmpn_name']) == 0 && $_GET['s'] == "publish") {
      ?>
      <!-- For unverified Accounts -->
      <center style="margin-top: 7%;">    
            <pre class="success">
You need to verify your account to publish vacancy
            </pre>
      </center>
      <!-- End for unverified Accounts -->
      <?php }
            else if(count($_SESSION) == 1 && $_GET['s'] != "publish") header("Location: ./add.php?s=publish");
            else if(count($_SESSION) == 1 && $_GET['s'] == 'publish') { 
                  if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $ins->insert($_POST['firstname'], $_POST['lastname'], $_POST['vacancyname'], $_POST['category'], $_POST['keywords'], $_POST['info'], $_FILES['file'],$_SESSION['cmpn_name']);
                        echo '<script>window.location.replace("./index.php")</script>';
                  }
      ?><!-- PUBLISH  -->
            <div class="formholder">
            
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Fill Your Vacancy</h1>
                  </div>
                  <center>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?s=publish";?>" method="POST" class="add" autocomplete="off" enctype="multipart/form-data">
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
                              <div class="img-upload">
                                    <!-- actual upload which is hidden -->
                                    <input type="file" id="actual-btn" name="file" style="visibility: hidden">

                                    <!-- our custom upload button -->
                                    <label for="actual-btn" class="label">Choose File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>
                              </div>
                              <textarea name="info" id="in" class='info' placeholder="Requirements"></textarea>
                              <button type="button" class='submit' id="submit" onclick='inputChecker()'>Submit</button>
                              
                        </form>
                        
                  </center>
                  <p id="errors"> </p>
            </div>
            <script> 
                  const actualBtn = document.getElementById('actual-btn');

                  const fileChosen = document.getElementById('file-chosen');

                  actualBtn.addEventListener('change', function(){
                  fileChosen.textContent = this.files[0].name
                  })
            </script>
            <!-- END PUBLISH -->
      <?php }
      
      else if(count($_SESSION) == 0 && $_GET['s'] == 'publish') echo "<script>window.location.replace('./add.php?s=signup')</script>";
      ?>
      <?php 
      if (count($_SESSION) == 0 && $_GET['s'] == 'signup') {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $f = $ins->checkAnRegister($_POST['companyname'], $_POST['password'], $_POST['companyemail'], $_POST['phonenumber']);
                  $ver->sendVerifyLink($_POST['companyname'], $_POST['companyemail']);
                  if($f == null) {?>
      <center style="margin-top: 7%;">    
            <pre class="success">
You Registered successfully! 
Please check your email to verify your account, in order to start publishing your vacancies
You will redirected to main page in 10 seconds
            </pre>
      </center>
                  <?php echo "<script>setTimeout(function() {window.location.replace('./index.php')}, 10000)</script>"; }
            }
      ?><!-- SIGN UP -->
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Company Registration</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "?s=signup"?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="companyname" id="re" placeholder="Company Name"  <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($f != null) echo "value='".$fn['name']."'>" . "<h4 class='nptrrs'>".$f['company_name']."</h4>"; echo ">"?>
                              <input type="email" name="companyemail" id="re" placeholder="Company Email" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($f != null) echo "value='".$fn['email']."'>" . "<h4 class='nptrrs'>".$f['company_email']."</h4>"; echo ">"?>
                              <input type="password" name="password" id="re" placeholder="Password">
                              <input type="tel" name="phonenumber" id="re" placeholder="Company Number" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($f != null) echo "value='".$fn['phone']."'>" . "<h4 class='nptrrs'>".$f['company_phone']."</h4>"; echo ">"?>
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
                        if($get->signin($_POST['companyname'], $_POST['password']) == $_POST['companyname']) {
                              $get->signin($_POST['companyname'], $_POST['password']);
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
                         
                        <a href="./add.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Don't have an account yet? Create one!</a>
                  </center>
                  <p id="reerrors"> </p>
            </div>
            <!-- END RESET PASSWORD -->
      <?php } ?>

      
<!-- Scripts -->
<script src="../js/add.js"></script>
<?php include '../view/footer.php'?>