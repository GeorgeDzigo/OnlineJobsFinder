<?php
require_once 'cn.php';
function id($n) {
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $str = str_split($str, 1);
      shuffle($str);
      $str = array_slice($str, 0, $n);
      return join("", $str);
}
class Inserting extends DB {
      /*
      *     FUNCTION NAME: insert()
      *     DESC: THIS FUNCTION INSERTS VACANCY
      *           IN vacancies TABLE
      *
      */

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

      
      /*
      *     FUNCTION NAME: register()
      *     DESC: THIS FUNCTION TAKES SUBMITTED INFO
      *           FORM AND INSERTS/REGISTERS USER
      *           (IN companies TABLE)
      *     
      */

      protected function register($cname,$cpass, $cemail,$pnumber) {
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


      /*
      *     FUNCTION NAME: checkAnRegister()
      *     DESC: THIS FUNCTION TAKES SUBMMITED FORM
      *           FROM THE USER AND CHECKS IF THE SAME
      *           INFORMATION EXISTS IN THE TABLE, IF NOT
      *           USER WILL BE REGISTERED (IN companies DB)
      *           
      */

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
}