<?php
session_start();
      // Including Classes
            require_once "../../classes/verify.class.php";
      // Classes Def Clld Funcs
            // functions.class.php
            $ver = new Verify();
$ver->verify($_GET['cc'], $_GET['v']);
?>
            
   
<center style="margin-top: 7%;">    
            <pre class="success">
Your Account Has Been Verified 
You will be redirected to main page in 10 seconds
            </pre>
</center>
<?= "<script>setTimeout(function(){ window.location.replace('./index.php') }, 10000);</script>"?>