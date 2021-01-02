<?php include './view/header.php'?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once '../functions.php';
      $insert = new Functions();
      $insert->insert($_POST['firstname'], $_POST['lastname'], $_POST['companyname'], $_POST['companyemail'], $_POST['zipcode'], $_POST['phonenumber'], $_POST['vacancyname'], $_POST['category'], $_POST['keywords'], $_POST['info']);
}
?>
      <div class="formholder">
            <div class="headersholder">
                  <h1 class="headersholder-h1">Fill Your Vacancy</h1>
            </div>
            <center>
                  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="add" autocomplete="off">
                        <input type="text" name="firstname" id="fname" placeholder="First Name" style='width: 15%; display: inline-block'>
                        <input type="text" name="lastname" id="lname" placeholder="Last Name" style="width:15%; display: inline-block">
                        <input type="text" name="companyname" id="cname" placeholder="Company Name">
                        <input type="email" name="companyemail" id="cemail" placeholder="Company Email">
                        <input type="text" name="zipcode" id="zcode" placeholder="Zip Code"/>
                        <input type="tel" name="phonenumber" id="pnumber" placeholder="Phone Number">
                        <input type="text" name="vacancyname" placeholder="Vacancy Name" style="width: 20%; display: inline-block">
                        <!-- CATEGORY -->
                        <select class="custom-select" id="inputGroupSelect01" style="width: 10%;" name="category">
                              <option>Category</option>
                              <option>Developer</option>
                              <option>Engineer</option>
                              <option>Designer</option>
                        </select>
                        <!-- End CATEGORY -->
                        <input type="text" placeholder="Keywords, Please Seperate Keywords With Coma" name="keywords">
                        <textarea name="info" class='info'></textarea>
                        <input type="submit">
                  </form>
            </center>
      </div>
<?php include './view/footer.php'?>