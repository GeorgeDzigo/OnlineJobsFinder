<?php
session_start();
      // Including Classes
            require_once "../../classes/verify.class.php";
      // Classes Def Clld Funcs
            // functions.class.php
            $ver = new Verify();

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
      
      <link rel="stylesheet" href="../css/verify.css">

      <link rel="stylesheet" href="../fa/css/font-awesome.min.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
<?php include '../view/header.php'?>

<?php if(count($_SESSION) == 1 && $_GET['v'] != NULL) { 
            $ver->verify($_GET['v']);
?>   
      <center style="margin-top: 7%;">    
            <pre class="success">
Your Account Has Been Verified 
You will be redirected to main page in 10 seconds
            </pre>
      </center>
<?php 
      echo "<script>setTimeout(function(){ window.location.replace('./index.php') }, 10000);</script>";
      } 
?>
<?php include '../view/footer.php'?>