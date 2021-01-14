<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="../../css/index.css">
      <link rel="stylesheet" href="../../css/add.css">
</head>
<body>
      <?php include '../../view/header.php'?>
      <?php if(count($_SESSION) == 0 ) { ?>
            <div class="formholder">
                  <!-- USER COMPANY UP -->
                  <div class="headersholder">
                       <p id="cmpn_usr"class="headersholder-h1">User Registration</p>
                  </div>
                  <center id="cmpn">
                        <form action="<?php $_SERVER['PHP_SELF'] . "?s=signup"?>" method="POST" class="add" autocomplete="off">
                              <input type="text" name="companyname" id="re" placeholder="Company Name"  <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {if($f != null) echo "value='".$fn['name']."'>" . "<h4 class='nptrrs'>".$f['company_name']."</h4>";}else echo ">";?>
                              <input type="email" name="companyemail" id="re" placeholder="Company Email" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') if($f != null) {echo "value='".$fn['email']."'>" . "<h4 class='nptrrs'>".$f['company_email']."</h4>";}else echo ">";?>>
                              <input type="password" name="password" id="re" placeholder="Password">
                              <input type="tel" name="phonenumber" id="re" placeholder="Company Number" <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {if($f != null) echo "value='".$fn['phone']."'>" . "<h4 class='nptrrs'>".$f['company_phone']."</h4>";} 
                              else echo ">";?>
                              <button type="button" class='submit' id="resubmit" onclick='register()'>Submit</button>
                              <a href="../add.php?s=signup" class="chngrsrcm">Company Registration</a>
                        </form>
                        <a href="../add.php?s=signin" style="text-decoration: none; font-weight: bolder; color:black; font-size: 20px;">Have An Account? Sign In Then</a>
                  </center>
            </div>
      <?php } ?>
      <script src="../../js/add.js"></script>
</body>
</html>