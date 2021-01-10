<?php
require_once 'cn.php';

class Verify extends DB {
      /*
      *    FUNCTION NAME: linkcreator()
      *    DESC: THIS FUNCTION CREATES PASSWORD
      *          RESET LINK FOR THE USER, AND 
      *          RETURNS THE LINK
      */ 
      protected function linkcreator() {
            $chars = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-", 1);shuffle($chars);
            return join("", array_slice($chars, 0, 33));
      }

      /*
      *     FUNCTION NAME: saveVerifyLink()
      *     DESC: THIS FUNCTION SAVES VERIFY LINK IN verify DB
      */ 
      protected function saveVerifyLink($cname,$cemail) {
            $link = $this->linkcreator();
            $sql = $this->pdo()->prepare("INSERT INTO verify (company_name, company_email, verify_link) VALUES (:cn, :cm, :vl)");
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(':cm', $cemail);
            $sql->bindValue(":vl", $link);
            $sql->execute();
            return $link;
      }

      /*
      *     FUNCTION NAME: sendVerifyLink()
      *     DESC: THIS FUNCTION SENDS VERIFICAION LINK
      *           TO CLIENTS EMAIL WHEN THEY GET REGISTERED
      */          
      public function sendVerifyLink($cname,$cemail) {
      // subject
      $subject = 'Account Verification';

      $message = '
      <html>
      <head>
        <title>Account Verification Link</title>
      </head>
      <body>
      <h3>Click the link below to verify your account '.ucfirst($cname).'</h3>
      <a href=http://localhost/OnlineJobsFinder/public/routes/verify.php?v='.$this->saveVerifyLink($cname, $cemail).'>Click Me To Verify Your Account</a>
      </body>
      </html>
      ';

      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


      $headers .= 'From: OnlineJobsFinder' . "\r\n";
      // Mail it
      mail($cemail, $subject, $message, $headers);
      }

      /*
      *     FUNCTION NAME: verify()
      *     DESC: THIS FUNCTION WILL VERIFY 
      *           THE ACCOUNT, WHEN THE CMPN CLICKS 
      *           ON THE LINK THAT WAS SENT TO ITS EMAIL 
      */ 
      public function verify($l) {
            $ver = $this->pdo()->query("SELECT * FROM verify");
            while($row = $ver->fetch(PDO::FETCH_ASSOC)) {
                  if($row['verify_link'] == $l) {
                        $name = $row['company_name'];
                        $email = $row['company_email'];
                  }
            }
            $this->pdo()->query("UPDATE companies SET verified = 1 WHERE company_name = '$name'");
            $this->pdo()->query("DELETE FROM verify WHERE company_name = '$name'");
      }
}