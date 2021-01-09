<?php
include_once '../cn.php';


class Functions extends DB{
      /*
       *    FUNCTION NAME: linkcreator()
       *    DESC: THIS FUNCTION CREATES PASSWORD
       *          RESET LINK FOR THE USER, AND 
       *          RETURNS THE LINK
       */ 
            public function linkcreator() {
            $chars = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-", 1);shuffle($chars);
            return join("", array_slice($chars, 0, 33));
      }  


      /*
      *     FUNCTION NAME: checkforemail()
      *     DESC: THIS FUNCTION SELECTS COMPANIES COMPANY'S name, 
      *           email AND 
      *           unique_id 
      *           AND RETURN THEM AS AN ARRAY
      *           (FROM companies DB)
      */
      protected $info = [];
      protected function checkforEmail($cemail){
            $getem = $this->pdo()->query("SELECT company_name, company_email, unique_id FROM companies");
            while($row = $getem->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_email'] == $cemail)  {
                        $this->info['email'] = $row['company_email'];
                        $this->cn['name'] = $row['company_name'];
                        $this->ui['uniq_id'] = $row['unique_id'];
                  }
                  return $this->info;
            }
      }

      
      /*
      *     FUNCTION NAME: resetpass()
      *     DESC: THIS FUNCTION TAKES USERS EMAIL
      *           CHECKS IF THE EMAIL EXISTS IN COMPANIES EMAIL
      */ 
      public function resetpass($cemail) {
            $d = "";
            $info = $this->checkforEmail($cemail);
            
            if(strlen($info['email']) == 0 ) {
                  $d = "Email Can Not Be Found";
                  echo $d;
            }
            else {
                  $date = date("Y")."-".date("m")."-".date("d");
                  $sql = $this->pdo()->prepare("INSERT INTO resetpassword (company_name, company_unique_id, reset_password_link, link_creation_date, link_expiration_date)
                        VALUES (:cn, :cpi, :rpl, :lcd, :led)");
                  $sql->bindValue(":cn", $info['name']);
                  $sql->bindValue(":cpi", $info['uniq_id']);
                  $sql->bindValue(":rpl", $this->linkcreator());
                  $sql->bindValue(":lcd", $date);
                  $sql->bindValue(":led", date('Y-m-d', strtotime($date. ' + 3 days')));
                  $sql->execute();
                  $this->sendemails($info['name'], $cemail); 
                  echo "Email has been sent succesfully";
           }
      }


      /*
      *     FUNCTION NAME: passLink()
      *     DESC: THIS FUNCTON TAKES company's name as a parameter
      *           AND RETURNS IT'S RESEST PASSWORD LINK (FROM resetpassword TABLE)
      */ 

      protected $password_link = '';

      protected function passlink($cname){
            $sql = $this->pdo()->query("SELECT company_name, reset_password_link FROM resetpassword");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname) return $row['reset_password_link'];
            }
      }
      /*
      *     FUNCTION NAME: sendemails()
      *     DESC: THIS FUNCTION TAKES COMPANY'S name, email
      *           AND SENDS THEM RESET PASSWORD LINK THEM
      *           TO RESET THE PASSWORD
      */

      public function sendemails($cname, $cemail) {
            $link = $this->passlink($cname);

      // subject
      $subject = 'Password Reset';

      $message = '
      <html>
      <head>
        <title>Birthday Reminders for August</title>
      </head>
      <body>
      <h3>Click the link below to change the password</h3>
      <a href=http://localhost/OnlineJobsFinder/public/reset.php?v='.$link.'>Click Me To Reset The Password</a>
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
      *     FUNCTION NAME: checkLinkAndReset()
      *     DESC: THIS FUNCTION CHECKS QUERY AND 
      *           IF THE QUERY MATCHES THE ONE 
      *           IN THE TABLE THEN THE USER
      *           WILL BE ABLE TO RESET PASSWORD
      */

      protected $link = "";
      protected $uniq_id = "";

      public function checkLinkAndReset($l, $newpassword) {
            $sql = $this->pdo()->query('SELECT company_name, company_unique_id, reset_password_link FROM resetpassword');
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['reset_password_link'] == $l) {
                        $this->link = $l;
                        $this->uniq_id = $row['company_unique_id'];
                  }
            }

            $sql2 = $this->pdo()->query('SELECT company_name, unique_id FROM companies');
            while($row2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
                  if($row2['unique_id'] == $this->uniq_id) {
                        $company_name = $row2['company_name'];
                        break;
                  }
            }     
            if ($this->pdo()->query("UPDATE companies SET company_password = '$newpassword' WHERE company_name = '$company_name'")) echo "SUCCESS";
      }

      /*
      *     FUNCTION NAME: delete_password_reset_links()
      *     DESC: THIS FUNCTION DELETES THE LINK AUTOMATICALLY
      *           AFTER THE LINK GETS EXPIRED (IN resetpassword TABLE)
      */ 

      public function delete_password_reset_links(){
            $date = date("Y-m-d");
            $sql = $this->pdo()->query("SELECT id, link_expiration_date FROM resetpassword");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['link_expiration_date'] == $date) {
                        $this->pdo()->query("DELETE FROM resetpassword WHERE id = $row[id]");
                  }
            }
            $this->pdo()->query("DELETE FROM resetpassword");
      }

      
      /*
      *     FUNCTION NAME: delete()
      *     DESC: THIS FUNCTION DELETES VACANCY AUTOMATICALLY 
      *           AFTER SPECIFIC AMOUNTS OF DAYS/IT GETS EXPIRED
      */ 
      public function delete() {
            $sql = $this->pdo()->query("SELECT id, expiration_date FROM vacancies");
            $date = date("Y-m-d");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($date == $row['expiration_date']) {
                        $this->pdo()->query("DELETE FROM vacancies WHERE id = " . $row['id']);
                  }
            }
      }
}