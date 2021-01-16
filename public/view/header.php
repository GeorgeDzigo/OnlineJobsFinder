      <!-- HEADER -->
      <header class="header">
      <h1 class='logo'><a href="./index.php">Jobs Finder</h1>
                  <nav class="nav">
                        <li class="nav-li"> <a href="./index.php" class="nav-li-a">Vacancies</a></li>
                        <?php if(!isset($_SESSION['usr_name'])) {?>
                              <li class="nav-li"> <a href="./rpsrv.php?s=publish" class="nav-li-a">Publish Vacancies</a></li>
                        <?php } ?>
                        <li class="nav-li"> <a href="#" class="nav-li-a">Contact</a></li>
                        <?php if(count($_SESSION) == 1) { ?>
                              <li class="nav-li" id="profile-drop"><i class="fa fa-user-o" id="profile" aria-hidden="true"></i>
                              <div id="dropdown" style="display:none">
                              <center>
                                    <div class="company_name"><?= $_SESSION['cmpn_name']?></div>
                                    <div class="signout"><a href="<?= $_SERVER['PHP_SELF'].'?si=sig'?>">Sign Out</a></div>
                                    <?php if(isset($_GET['si']) && $_GET['si'] == 'sig') {
                                                session_start();
                                                session_destroy();      
                                          }
                                    ?>
                                    <div class="myvacancy"><a href="./index.php?m=mv">My Vacancies</a></div>
                              </center>
                              </div>
                              
                        </li>
                        <?php }?>
                  </nav>
      </header>
      <!-- END HEADER -->