<?php
require_once "../functions.php";
$data = new Functions();
$data = $data->show();
echo "<pre>"; 
var_dump($data);
echo "</pre>";
?>
<?php include './view/header.php'?>
      <section class="search-job">
            <center>
                  <form action="#" method="POST" class="form">
                  <input type="text" name="search" placeholder="Search For Jobs">
                        <input type="submit" value="Search">
                  </form>
            </center>
      </section>    
<?php include './view/footer.php'?>