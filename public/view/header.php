      <!-- HEADER -->
      <header class="header">
      <h1 class='logo'><a href="./index.php">Jobs Finder</h1>
                  <nav class="nav">
                        <li class="nav-li"> <a href="./index.php" class="nav-li-a">Vacancies</a></li>
                        <li class="nav-li"> <a href="./add.php?s=publish" class="nav-li-a">Publish Vacancies</a></li>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                        <?php if(count($_SESSION) != 0) { ?>
                              <li class="nav-li" id="profile-drop"><center><i class="fa fa-user-o" id="profile" aria-hidden="true"></i></center>
                              <div id="dropdown" style="display:none">
                              <center>
                                    <div class="company_name"><?= $_SESSION['cmpn_name']?></div>
                                    <div class="signout"><a href="./signout.php">Sign Out</a></div>
                              </center>
                              </div>
                              
                        </li>
                        <?php }?>
                  </nav>
      </header>
      <!-- END HEADER -->