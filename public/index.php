<?php require '../header.php'?>
      <!-- HEADER -->
            <header class="header">
                  <h1 class='logo'>Jobs Finder</h1>

                  <nav class="nav">
                        <li class="nav-li"> <a href="./index.php" class="nav-li-a" style="color:lightslategray; font-weight:bold;">Vacancies</a></li>
                        <li class="nav-li"> <a href="./add.php" class="nav-li-a">Publish Vacancies</a></li>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                  
                  </nav>
            </header>
      <!-- END HEADER -->

      <section class="search-job">
            <center>
                  <form action="#" method="POST" class="form">
                  <input type="text" name="search" placeholder="Search For Jobs">
                        <input type="submit" value="Search">
                  </form>
            </center>
      </section>
      
<?php require '../footer.php'?>