<?php
      session_start();
      // Including Classes
      require_once "../../classes/functions.class.php";
      require_once '../../classes/getter.class.php';
      // Classes Def Clld Funcs 
        // getter.class.php
            $get = new Getter();   
        // functions.class.php    
            $fun = new Functions();
            $fun->delete();
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
<?php include '../view/header.php'?>
      <section class="search-job">
            <p id="error"></p>
            <center>
                  <input type="text" name="search" placeholder="Search For Jobs" id="search-field">
                  <select id="category" style="width: 10%;" name="Category">
                              <option>Category</option>
                              <option placeholder="Developer">Developer</option>
                              <option placeholder="Engineer">Engineer</option>
                              <option placeholder="Designer">Designer</option>
                              <option placeholder="Doctor">Doctor</option>
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
                              <h3>Publish Date</h3>
                        </div>
                        <?php 
                              if(count($_GET) == 1 && $_GET['m'] == "mv") {
                              foreach($get->myvacas() as $v){
                                    $date =  explode("-", $v['publish_date']);
                                    $m = $date[1]; $d = $date[2];
                        ?>
                         <a href="../vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3><?= date("d". strtotime($d)) . " " . DateTime::createFromFormat('!m', date('m', strtotime($m)))->format('F')?></h3>
                              </div>
                        </a>
                        <?php } }?>
                        <?php 
                              if(count($_GET) == 0) {
                              foreach($get->show() as $v){
                                    $date =  explode("-", $v['publish_date']);
                                    $m = $date[1]; $d = $date[2];
                        ?>
                         <a href="../vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3><?= date("d". strtotime($d)) . " " . DateTime::createFromFormat('!m', date('m', strtotime($m)))->format('F')?></h3>
                              </div>
                        </a>
                        <?php 
                        }}
                        else {
                              $vacas = $get->vacaByKeywords($_GET['s'] == "-" ? 0 : $_GET['s'], $_GET['c'] == null ? 0 : $_GET['c']);
                              foreach($vacas as $v) {
                                    $date =  explode("-", $v['publish_date']);
                                    $m = $date[1]; $d = $date[2];
                        ?>
                         <a href="../vacancypage/page.php?id=<?= $v['id']?>" class="works-a">     
                              <div class='works-vacancies'>
                              
                                    <h3><?= $v['vacancy_name']?></h3>
                                    <h3><?= $v['company_name']?></h3>
                                    <h3><?= date("d". strtotime($d)) . " " . DateTime::createFromFormat('!m', date('m', strtotime($m)))->format('F')?></h3>
                                    
                              </div>
                              
                        </a>
                        <?php }}?>
                  </center>
            </section>
      <!-- END WORKS -->
<!-- scripts -->
<script src="../js/index.js"></script>
<!-- end scripts -->
<?php include '../view/footer.php'?>