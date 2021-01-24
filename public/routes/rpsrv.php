<?php session_start(); 
      require_once '../../classes/functions.class.php';
      $fun = new Functions();

      require_once '../../classes/getter.class.php';
      $get = new Getter();

      require_once '../../classes/inserter.class.php';
      $ins = new Inserting();

      require_once '../../classes/resetpassword.class.php';
      $res = new Reset();

      require_once '../../classes/verify.class.php';
      $ver = new Verify();
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- STYLES -->
      <link rel="stylesheet" href="../css/inputs.css">

      <link rel="stylesheet" href="../css/index.css">

      <link rel="stylesheet" href="../css/reset.css">
      
      <link rel="stylesheet" href="../css/header.css">

      <link rel="stylesheet" href="../css/verify.css">

      <link rel="stylesheet" href="../fa/css/font-awesome.min.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
<?php include '../view/header.php'; ?>

      <?php
            /* DEFAULT */
            if(!isset($_SESSION['cmpn_name']) && !isset($_SESSION['cmpn_name']) && $_GET['tab'] == 'publish') {
                  echo "<script>window.location.replace('./rpsrv.php?tab=signin')</script>";    
            }
            /*DEFAULT*/
                  /* COMPANY */ 
                        if(isset($_SESSION['cmpn_name'])) {
                              
                              /* PUBLISH */
                                    if($_GET['tab'] == "publish") {
                                          include './publish/publish.php';     
                                    }
                              /* END PUBLISH */

                              /* VERIFY */ 
                                    else if($_GET['tab'] == 'verify' && isset($_GET['v']) && isset($_GET['cc'])) {
                                          include "./authentication/verify.php";
                                    }
                              /* END VERIFY */                       
                              
                              /* 404 ERROR PAGE*/ 
                                    else {
                                          echo "PAGE WASN'T FOUND. 404"; 
                                    } 
                              /* END 404 ERROR PAGE*/ 
                        }
                  /* END COMPANY */ 

                  /* USER */
                        else if(isset($_SESSION['usr_name'])) {
                              /* VERIFY */ 
                              if($_GET['tab'] == 'verify' && isset($_GET['v']) && isset($_GET['cc'])) {
                                    include "./authentication/verify.php";
                              }
                              /* END VERIFY */ 
                              
                              /* 404 ERROR PAGE*/ 
                                    else {
                                          echo "PAGE WASN'T FOUND. 404"; 
                                    } 
                              /* END 404 ERROR PAGE*/ 
                        } 
                  /* END USER */ 

                  else {
                        
                        /* COMPANY REGISTER */
                              if ($_GET['tab'] == "csignup") {
                                    include './authentication/cmpn/register.php';
                              }
                        /* END COMPANY REGISTER */

                        /* USER REGISTER */
                              else if ($_GET['tab'] == "usignup") {
                                    include './authentication/usr/signup.php';
                              }
                        /* END USER REGISTER */
                        
                        /* SIGN IN */
                              else if($_GET['tab'] == 'signin') {
                                    include './authentication/signin.php';
                              }
                        /* END SIGN IN */ 
                        
                        /* RESET PASSWORD LINK */
                              else if($_GET['tab'] == 'resetpasswordl') {
                                    include './authentication/resetpass/resetlink.php';
                              }
                        /* END RESET PASSWORD LINK*/ 

                        /* PASSWORD RESET */
                              else if($_GET['tab'] == 'resetpassword') {
                                    include './authentication/resetpass/resetpassword.php';
                              }
                        /* END PASSWORD RESET */  

                        /* 404 ERROR PAGE*/ 
                              else {
                                    echo "PAGE WASN'T FOUND. 404"; 
                              } 
                        /* END 404 ERROR PAGE*/
                  }
      ?>

      <script src="../js/add.js"></script>
      <script src="../js/profiledropdown.js"></script>
</body>
</html>