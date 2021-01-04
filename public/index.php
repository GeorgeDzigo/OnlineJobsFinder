<?php
require_once "../functions.php";
$vacas = new Functions();
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
            <p id="error"></p>
            <center>
                  <input type="text" name="search" placeholder="Search For Jobs" id="search-field">
                  <select id="category" style="width: 10%;" name="Category">
                        <option>Category</option>
                        <option placeholder="Developer">Developer</option>
                        <option placeholder="Engineer">Engineer</option>
                        <option placeholder="Designer">Designer</option>
                  </select>
                        <button type="submit" onclick="onbtnclick()">Search</button>
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
                        <?php 
                        if(count($_GET) == 0) {
                        foreach($vacas->show() as $v){
                        ?>
                         <a href="./vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3>NONE</h3>
                              </div>
                        </a>
                        <?php 
                        }}
                        else {
                              $vacas = $vacas->vacaByKeywords($_GET['s'] == "-" ? 0 : $_GET['s'], $_GET['c'] == null ? 0 : $_GET['c']);
                              foreach($vacas as $v) {
                        ?>
                         <a href="./vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3>NONE</h3>
                              </div>
                        </a>
                        <?php }}?>
                  </center>
            </section>
      <!-- END WORKS -->
<!-- scripts -->
<script src="js/index.js"></script>
<!-- end scripts -->
<?php include './view/footer.php'?>