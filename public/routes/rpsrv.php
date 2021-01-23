<?php session_start(); ?>
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
            if(!isset($_SESSION['cmpn_name']) && !isset($_SESSION['cmpn_name']) && $_GET['s'] == 'publish') {
                  echo "<script>window.location.replace('./rpsrv.php?s=signin')</script>";    
            }
            /*DEFAULT*/
                  /* COMPANY */ 
                        if(isset($_SESSION['cmpn_name'])) {
                              
                              /* PUBLISH */
                                    if($_GET['s'] == "publish") {
                                          include './publish/publish.php';     
                                    }
                              /* END PUBLISH */

                              /* RESET */
                                    else if(isset($_GET['c'])) {
                                          $lnk = $_GET['c'];
                                          include "./authentication/reset.php?c=$lnk";  
                                    }
                              /* END RESET */

                              /* VERIFY */ 
                                    else if(isset($_GET['v'])) {
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
                              /* RESET */
                                    if (isset($_GET['u'])) {
                                          $lnk = $_GET['u'];
                                          include "./authentication/reset.php?u=$lnk";
                                    }
                              /* END RESET */
                              
                              /* VERIFY */ 
                                    else if(isset($_GET['v'])) {
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
                              if ($_GET['s'] == "csignup") {
                                    include './authentication/cmpn/register.php';
                              }
                        /* END COMPANY REGISTER */

                        /* USER REGISTER */
                              else if ($_GET['s'] == "usignup") {
                                    include './authentication/usr/signup.php';
                              }
                        /* END USER REGISTER */
                        
                        /* SIGN IN */
                              else if($_GET['s'] == 'signin') {
                                    include './authentication/signin.php';
                              }
                        /* END SIGN IN */ 
                        
                        /* RESET PASSWORD */
                              else if($_GET['s'] == 'resetpassword') {
                                    include './authentication/reset.php';
                              }
                        /* END RESET PASSWORD*/ 
                        
                        /* 404 ERROR PAGE*/ 
                              else {
                                    echo "PAGE WASN'T FOUND. 404"; 
                              } 
                        /* END 404 ERROR PAGE*/
                  }
      ?>

<script src="../js/add.js"></script>
<?php include '../view/footer.php'?>