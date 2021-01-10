<?php
session_start();
      // Including Classes
            require_once "../../classes/functions.class.php";
      // Classes Def Clld Funcs
            // functions.class.php
            $fn = new Functions();
            $fn->delete_password_reset_links();
            $fn->delete();

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
<?php include '../view/header.php'?>

<?php if(count($_SESSION) == 0) { 
      $link = $_GET['v'];
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fn->checkLinkAndReset($link, $_POST['password']);
      }      
?>
<!-- Reset Password -->
            <div class="formholder">
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Reset Password</h1>
                  </div>
                  <center>
                        <form action="<?php $_SERVER['PHP_SELF'] . "?v=" . $link?>" method="POST" class="add" autocomplete="off">
                              <input type="password" name="password" id="re" placeholder="Password">
                              <button type="submit" class='submit' id="resubmit">Submit</button>
                        </form>
                         
                  </center>
                  <p id="reerrors"> </p>
            </div>
<!-- End reset password -->
<?php } ?>
<?php include '../view/footer.php'?>