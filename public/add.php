<?php include '../header.php'?>
      <div class="formholder">
            <div class="headersholder">
                  <h1 class="headersholder-h1">Fill Your Vacancy</h1>
            </div>
            <center>
                  <form action="#" method="POST" class="add">
                        <input type="text" name="firstname" id="fname" placeholder="First Name" >
                        <input type="text" name="lastname" id="lname" placeholder="Last Name">
                        <input type="text" name="companyname" id="cname" placeholder="Company Name">
                        <input type="email" name="companyemail" id="cemail" placeholder="Company Email">
                        <input type="text" name="zipcode" id="zcode" placeholder="Zip Code"/>
                        <input type="tel" name="phonenumber" id="pnumber" placeholder="Phone Number">
                        <input type="text" name="vacancyname" placeholder="Vacancy Name">
                        <textarea name="desc" id="" cols="30" rows="10"></textarea>
                        <input type="submit">
                  </form>
            </center>
      </div>

<?php include '../footer.php'?>