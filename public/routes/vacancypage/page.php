<?php session_start();
      // Including Classes
            require_once '../../../classes/functions.class.php';
            require_once '../../../classes/getter.class.php';
      // Classes Deg Clld Functions
            // getter.class.php
                  $get = new Getter();
$get = $get->vacashow($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- STYLES -->
      <link rel="stylesheet" href="../../css/inputs.css">

      <link rel="stylesheet" href="../../css/index.css">

      <link rel="stylesheet" href="../../css/reset.css">
      
      <link rel="stylesheet" href="../../css/header.css">

      <link rel="stylesheet" href="../../css/verify.css">

      <link rel="stylesheet" href="./css/page.css">

      <link rel="stylesheet" href="../../fa/css/font-awesome.min.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
      <!-- HEADER -->
      <header class="header">
      <h1 class='logo'><a href="../index.php">Jobs Finder</h1>
                  <nav class="nav">
                        <li class="nav-li"> <a href="../index.php" class="nav-li-a">Vacancies</a></li>
                        <?php if(!isset($_SESSION['usr_name'])) {?>
                              <li class="nav-li"> <a href="../rpsrv.php?s=publish" class="nav-li-a">Publish Vacancies</a></li>
                        <?php } ?>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                        <?php if(count($_SESSION) == 1) { ?>
                              <li class="nav-li" id="profile-drop"><i class="fa fa-user-o" id="profile" aria-hidden="true"></i>
                              <div id="dropdown" style="display:none">
                              <center>
                              <?php if(isset($_SESSION['cmpn_name'])) { ?>
                                    <div class="company_name"><?= $_SESSION['cmpn_name']?></div>
                                    <div class="signout"><a href="<?= $_SERVER['PHP_SELF'].'?si=sig&id='. $_GET['id']?>">Sign Out</a></div>
                                    <div class="myvacancy"><a href="../index.php?m=mv">My Vacancies</a></div>
                              <?php } else if (isset($_SESSION['usr_name'])) {?>
                                    <div class="company_name"><?= $_SESSION['usr_name']?></div>
                                    <div class="signout" style='border-radius: 0px 0px 5px 5px'><a href="<?= $_SERVER['PHP_SELF'].'?si=sig&id='. $_GET['id']?>">Sign Out</a></div>
                              <?php }?>
                              <?php if(isset($_GET['si']) && $_GET['si'] == 'sig') {
                                    session_destroy();
                                    header("Location: ./page.php?id=$_GET[id]");
                                    } ?>
                              </center>
                              </div>
                              
                        </li>
                        <?php }?>
                  </nav>
      </header>
      <!-- END HEADER -->

      <section class="vacainfo">
            <div class="vacainfo-info">
                  <h3>Vacancy name: <i><?= $get[0]["vacancy_name"]?></i></h3>
                  <h3>Company: <i><?= $get[0]["company_name"]?></i></h3>
            </div>
            
            <pre class="info"><?=$get[0]["info"]?></pre>
      </section>
      <center class="center"><hr style="width: 97%; background-color: lightgrey;">
      <footer class='footer'>© jobfinder.com. all rights reserved</footer>
      </center>

      <!-- SCRIPT DROPDOWN -->
      <script src="../../js/profiledropdown.js"></script>
</body>
</html>