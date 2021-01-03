<?php
require_once "../functions.php";
$data = new Functions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <!-- STYLES -->
      <link rel="stylesheet" href="css/index.css">
      <link rel="stylesheet" href="css/reset.css">
      
      <link rel="stylesheet" href="css/add.css">

      <!-- FONT -->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Bangers&display=swap" rel="stylesheet">

      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,400&display=swap" rel="stylesheet">
</head>
<body>
<?php include './view/header.php'?>
      <section class="search-job">
            <center>
                  <form action="#" method="POST" class="form">
                  <input type="text" name="search" placeholder="Search For Jobs">
                        <input type="submit" value="Search">
                  </form>
            </center>
      </section>    
      <!-- WORKS -->
            <section class="works">
                  <center>
                        <div class='works-headings'>
                              <h3>Vacancy</h3>
                              <h3>Company Name</h3>
                              <h3>Country</h3>
                        </div>
                        <?php foreach($data->show() as $v){?>
                         <a href="./vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3>NONE</h3>
                              </div>
                        </a>
                        <?php }?>
                  </center>
            </section>
      <!-- END WORKS -->
<?php include './view/footer.php'?>