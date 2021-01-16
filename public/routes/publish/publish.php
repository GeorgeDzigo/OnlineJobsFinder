<?php 
      session_start();
      // Including Classes
      require_once "../../classes/functions.class.php";
      require_once '../../classes/inserter.class.php';
      require_once '../../classes/getter.class.php';
      require_once '../../classes/verify.class.php';
      // Classes Def Clld Funcs 
            // getter.class.php
                  $get = new Getter();
            // inserter.class.php
                  $ins = new Inserting();   
            // verify.class.php
                  $ver = new Verify();
            // functions.class.php    
                  $fun = new Functions();
                  $fun->delete_password_reset_links();
?>


      
      <?php if($fun->checkverify($_SESSION['cmpn_name']) == 0) { ?>

      <center style="margin-top: 7%;">    
            <pre class="success">
You need to verify your account to publish vacancy
            </pre>
      </center>

      <?php 
      } 
      else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $ins->insert($_POST['firstname'], $_POST['lastname'], $_POST['vacancyname'], $_POST['category'], $_POST['keywords'], $_POST['info'], $_FILES['file'],$_SESSION['cmpn_name']);
                  echo '<script>window.location.replace("./index.php")</script>';
            }
      ?><!-- PUBLISH  -->
            <div class="formholder">
            
                  <div class="headersholder">
                        <h1 class="headersholder-h1">Fill Your Vacancy</h1>
                  </div>
                  <center>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?s=publish";?>" method="POST" class="add" autocomplete="off" enctype="multipart/form-data">
                              <input type="text" name="firstname" id="in" placeholder="First Name" style='width: 15%; display: inline-block'>
                              <input type="text" name="lastname" id="in" placeholder="Last Name" style="width:15%; display: inline-block">
                              <div></div>
                              <input type="text" name="vacancyname" id="in"placeholder="Vacancy Name" style="width: 20%; display: inline-block">
                              <!-- CATEGORY -->
                              <select class="custom-select" id="in" style="width: 10%;" name="category">
                                    <option>Category</option>
                                    <option placeholder="Developer">Developer</option>
                                    <option placeholder="Engineer">Engineer</option>
                                    <option placeholder="Designer">Designer</option>
                                    <option placeholder="Doctor">Doctor</option>
                              </select>
                              <!-- End CATEGORY -->
                              <input type="text" id="in" placeholder="Keywords" name="keywords">
                              <div class="img-upload">
                                    <!-- actual upload which is hidden -->
                                    <input type="file" id="actual-btn" name="file" style="visibility: hidden">

                                    <!-- our custom upload button -->
                                    <label for="actual-btn" class="label">Choose File</label>

                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>
                              </div>
                              <textarea name="info" id="in" class='info' placeholder="Requirements"></textarea>
                              <button type="button" class='submit' id="submit" onclick='inputChecker()'>Submit</button>
                              
                        </form>
                        
                  </center>
                  <p id="errors"> </p>
            </div>
            <script> 
                  const actualBtn = document.getElementById('actual-btn');

                  const fileChosen = document.getElementById('file-chosen');

                  actualBtn.addEventListener('change', function(){
                  fileChosen.textContent = this.files[0].name
                  })
            </script>
            <!-- END PUBLISH -->
      <?php } ?>
<!-- Scripts -->
