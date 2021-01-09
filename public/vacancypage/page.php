<?php
require_once '../../classes/functions.php';
$data = new Functions();
$data = $data->vacashow($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- STYLES -->
      <link rel="stylesheet" href=".././css/index.css">
      <link rel="stylesheet" href=".././css/reset.css">
      
      <link rel="stylesheet" href=".././css/add.css">

      <link rel="stylesheet" href="css/page.css">

      <link rel="stylesheet" href="fa/css/font-awesome.min.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
      <!-- HEADER -->
            <header class="header">
                  <h1 class='logo'><a href=".././index.php">Jobs Finder</h1>

                  <nav class="nav">
                        <li class="nav-li"> <a href="../index.php" class="nav-li-a">Vacancies</a></li>
                        <li class="nav-li"> <a href="../add.php" class="nav-li-a">Publish Vacancies</a></li>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                  
                  </nav>
            </header>
      <!-- END HEADER -->

      <section class="vacainfo">
            <div class="vacainfo-info">
                  <h3>Vacancy name: <i><?= $data[0]["vacancy_name"]?></i></h3>
                  <h3>Company: <i><?= $data[0]["company_name"]?></i></h3>
            </div>
            
            <pre class="info"><?=$data[0]["info"]?></pre>
      </section>
      <center class="center"><hr style="width: 97%; background-color: lightgrey;">
      <footer class='footer'>© jobfinder.com. all rights reserved</footer>
      </center>

      <!-- SCRIPT DROPDOWN -->
      <script src="js/profiledropdown.js"></script>
</body>
</html>