<?php
include_once 'cn.php';
function id($n) {
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $str = str_split($str, 1);
      shuffle($str);
      $str = array_slice($str, 0, $n);
      return join("", $str);
}

class Functions extends DB{
      protected function get_unique_id($cname) {
            $sql = $this->pdo()->query("SELECT company_name, unique_id FROM companies");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) if($row['company_name'] == $cname) return $row['unique_id'];
      }

      public function insert($fname, $lname, $vname, $category, $keywords, $info, $cname) {
            $cmtable = $this->pdo()->query("SELECT company_name, unique_id FROM companies");
            while($row = $cmtable->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname){
                        $cn = $row['company_name'];
                        $ci = $row['unique_id'];
                  }
            }
            $date = date("Y")."-".date("m")."-".date("d");
            $sql = $this->pdo()->prepare("INSERT INTO vacancies (first_name, last_name, vacancy_name, vacancy_category, keywords, info, publish_date, expiration_date, vacancy_id, company_name, company_id)
            values(:fn, :ln, :vn, :vc, :ke, :info, :pd, :ed, :vi, :cn, :ci)");
            $sql->bindValue(":fn", $fname);
            $sql->bindValue(":ln", $lname);
            $sql->bindValue(":vn", $vname);
            $sql->bindValue(":vc", $category);
            $sql->bindValue(":ke", $keywords);
            $sql->bindValue(":info", $info);
            // DATE
                  $sql->bindValue(":pd", $date);
                  $sql->bindValue(":ed", date('Y-m-d', strtotime($date. ' + 7 days')));
            $sql->bindValue(":vi", id(8));
            $sql->bindValue(':cn', $cn);
            $sql->bindValue(':ci', $ci);
            $sql->execute();
      }
      // SHOW VACANCIES
      protected $datas = [];

      public function show() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, publish_date FROM vacancies");
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->datas[] = $row;
            return $this->datas;
      }

      // Show my vacancies
      protected $myvacas = [];
      public function myvacas() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, publish_date, company_id FROM VACANCIES");
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_id'] === $this->get_unique_id($_SESSION['cmpn_name'])) {
                        array_pop($row);
                        $this->myvacas[] = $row;
                  }
            };
            return $this->myvacas;
      }
      // Show Vacancy On Page
      protected $vdata = [];

      public function vacashow($id) {
            $sql = $this->pdo()->query("SELECT company_name, vacancy_name, info FROM vacancies where id = " . $id);
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->vdata[] = $row;
            return $this->vdata;
      }
      // GET KEYWORDS
      protected $vacas = [];

      public function vacaByKeywords($s = '', $c = '') {
            if($s != 0 && $c == 0) {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies");
                  $s = join(" ",explode("-", strtolower($s)));
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $key = array_values(array_unique(explode(", ",join(" ",explode("-", $row['keywords'])))));
                        for($i = 0; $i < count($key); $i++) {
                              if($s == $key[$i]) $this->vacas[] = $row;
                        }
                  }
                  return $this->vacas;
            }
            else if($s == 0 && $c != 0) {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies WHERE '$c' = vacancy_category");
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->vacas[] = $row;
                  return $this->vacas;
            }
            else {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies WHERE '$c' = vacancy_category");
                  $s = join(" ",explode("-", strtolower($s)));
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $key = array_values(array_unique(explode(", ",join(" ",explode("-", $row['keywords'])))));
                        for($i = 0; $i < count($key); $i++) {
                              if($s == strtolower($key[$i])) $this->vacas[] = $row;
                        }
                  }
                  return $this->vacas;
            }
      }

      // CHECK AND REGISTER FUNCTION
      protected $errors = [];

      public function checkAnRegister($cname,$cpass, $cemail,$pnumber) {
            $sql = $this->pdo()->query("SELECT company_name, company_email, company_phone FROM companies");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        if ($row['company_name'] == $cname) {
                              $this->errors['company_name'] = "Name is already taken"; 
                              $this->errors['name'] = $cname;
                        }
                        else if ($row['company_email'] == $cemail) {
                              $this->errors['company_email'] = "Email is already taken";
                              $this->errors['email'] = $cemail;
                        }
                        else if ($row['company_phone'] == $pnumber) {
                              $this->errors['company_phone'] = "Phone number is already taken";
                              $this->errors['phone'] = $pnumber;
                        } 
            }
            if(count($this->errors) != 0) return $this->errors;
            else  $this->register($cname, $cpass, $cemail, $pnumber);
      }

      public function register($cname,$cpass, $cemail,$pnumber) {
            $sql = $this->pdo()->prepare("INSERT INTO companies (company_name, company_password, company_email, company_phone, unique_id)
                                                       VALUES (:cn, :cp, :ce, :cphone, :ud)");
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(":cp", $cpass);
            $sql->bindValue(":ce", $cemail);
            $sql->bindValue(':cphone', $pnumber);
            $sql->bindValue(":ud", id(8));
            $sql->execute();
            return $_SESSION['cmpn_name'] = $cname;
      }
      
      public function signin($cname, $cpass) {
            $pass = $this->pdo()->query("SELECT company_name, company_password FROM companies");
            while($row = $pass->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname && $row['company_password'] == $cpass) {
                        return $_SESSION['cmpn_name'] = $row['company_name'];
                  }
            }
      }
      // Password reset side
      public function linkcreator() {
            $chars = str_split("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-", 1);shuffle($chars);
            return join("", array_slice($chars, 0, 33));
      }  
      protected $email = "";
      protected $cn = "";
      protected $ui = "";
      public function resetpass($cemail) {
            $getem = $this->pdo()->query("SELECT company_name, company_email, unique_id FROM companies");
            while($row = $getem->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_email'] == $cemail)  {
                        $this->email = $row['company_email'];
                        $this->cn = $row['company_name'];
                        $this->ui = $row['unique_id'];
                        break;
                  }
            }
            $d = "";
            if(strlen($this->email) == 0 ) {
                  $d = "Email Can Not Be Found";
                  echo $d;
            }
            else {
                  $date = date("Y")."-".date("m")."-".date("d");
                  $sql = $this->pdo()->prepare("INSERT INTO resetpassword (company_name, company_unique_id, reset_password_link, link_creation_date, link_expiration_date)
                        VALUES (:cn, :cpi, :rpl, :lcd, :led)");
                  $sql->bindValue(":cn", $this->cn);
                  $sql->bindValue(":cpi", $this->ui);
                  $sql->bindValue(":rpl", $this->linkcreator());
                  $sql->bindValue(":lcd", $date);
                  $sql->bindValue(":led", date('Y-m-d', strtotime($date. ' + 3 days')));
                  $sql->execute();
                  $this->sendemails($this->cn, $cemail); 
                  echo "Email has been sent succesfully";
           }
      }

      // Sending Emails
      protected $password_link = '';

      public function sendemails($cname, $cemail) {
            $sql = $this->pdo()->query("SELECT company_name, reset_password_link FROM resetpassword");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname) {
                        $this->password_link = $row['reset_password_link'];
                        break;
                  }
            }



      // subject
      $subject = 'Password Reset';

      $message = '
      <html>
      <head>
        <title>Birthday Reminders for August</title>
      </head>
      <body>
      <h3>Click the link below to change the password</h3>
      <a href=http://localhost/OnlineJobsFinder/public/reset.php?v='.$this->password_link.'>Click Me To Reset The Password</a>
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