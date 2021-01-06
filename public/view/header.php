<?php
      if(count($_SESSION) != 0) echo "<a href='./signout.php'>SIGN OUT</a>";
?>
      <!-- HEADER -->
      <header class="header">
      <h1 class='logo'><a href="./index.php">Jobs Finder</h1>
                  <nav class="nav">
                        <li class="nav-li"> <a href="./index.php" class="nav-li-a">Vacancies</a></li>
                        <li class="nav-li"> <a href="./add.php?s=publish" class="nav-li-a">Publish Vacancies</a></li>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                  </nav>
      </header>
      <!-- END HEADER -->