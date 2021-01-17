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
// ONLINESJOBSFINDERCOMPANIES
      /*
      *     FUNCTION NAME: cmpncheck()
      *     DESC: THIS FUNCTION CHECKS IF GIVEN
      *           PARAMETERS VALUES ALREADY EXIST
      *           IN CMPN TABLE
      */ 

      private function cmpncheck($name = '', $mail, $pnumber) {
            $errors = [];
            $cmpn = $this->cmp()->query("SELECT company_name, company_email, company_phone FROM companies");
            while($row = $cmpn->fetch(PDO::FETCH_ASSOC)) {
                  if ($row['company_name'] == $name && $name != '') {
                        $errors['name'] = "Name is already taken";
                  } 
                  else if ($row['company_email'] == $mail) {
                        $errors['email'] = 'Email is already taken';
                  }
                  else if ($row['company_phone'] == $pnumber) {
                        $errors['phone'] = "Phone number is already taken";
                  }
            }
            if(count($errors) == 0) return null;
            else return $errors;
      }      

      
      /*
      *     FUNCTION NAME: img_upload()
      *     DESC: THIS FUNCTION TAKES IMG FILE, 
      *           WILL CHECK FILE TYPE, SIZE AND 
      *           WILL MOVE TO UPLOADS FILE AND 
      *           WILL RETURN THE LINK/PATH.
      */ 
      protected function img_upload($img) {
            $format = end(explode('.', $img['name']));
            $allowed = ['jpeg', "jpg", "png"];
            if(in_array($format, $allowed)) {
                  if($img['size'] < 600000) {
                        $filename = uniqid('', true) .'.'. $format;
                        $newdest = '../uploads/' . $filename;
                        move_uploaded_file($img['tmp_name'], $newdest);
                        return $newdest;
                  }
                  else {
                        echo "Too Big Img";
                  }
            } else {
                  echo "Please Select PNG, JPEG or JPG format files only";
            }
      }


      /*
      *     FUNCTION NAME: insert()
      *     DESC: THIS FUNCTION INSERTS VACANCY
      *           IN vacancies TABLE
      *
      */

      public function insert($fname, $lname, $vname, $category, $keywords, $info, $img, $cname) {
            $cmtable = $this->cmp()->query("SELECT company_name, unique_id FROM companies");
            while($row = $cmtable->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname){
                        $cn = $row['company_name'];
                        $ci = $row['unique_id'];
                  }
            }
            $date = date("Y")."-".date("m")."-".date("d");
            $sql = $this->cmp()->prepare("INSERT INTO vacancies (first_name, last_name, vacancy_name, vacancy_category, keywords, info, logo_lnk, publish_date, expiration_date, vacancy_id, company_name, company_id)
            values(:fn, :ln, :vn, :vc, :ke, :info, :ll, :pd, :ed, :vi, :cn, :ci)");
            $sql->bindValue(":fn", $fname);
            $sql->bindValue(":ln", $lname);
            $sql->bindValue(":vn", $vname);
            $sql->bindValue(":vc", $category);
            $sql->bindValue(":ke", $keywords);
            $sql->bindValue(":info", $info);
            $sql->bindValue(":ll", $this->img_upload($img));
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
            $sql = $this->cmp()->prepare("INSERT INTO companies (company_name, company_password, company_email, company_phone, unique_id)
                                                       VALUES (:cn, :cp, :ce, :cphone, :ud)");
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(":cp", $cpass);
            $sql->bindValue(":ce", $cemail);
            $sql->bindValue(':cphone', $pnumber);
            $sql->bindValue(":ud", id(8));
            $sql->execute();
            return $_SESSION['cmpn_name'] = $cname;
      }

      
      // ONLINESJOBSFINDERUSERS

      /*
      *     FUNCTION NAME: insertu()
      *     DESC: THIS FUNCTION GETS VALUES
      *           FROM $_POST SUPERGLOBAL 
      *           VARIABLE AND INSERTS THEM
      *           IN users TABLE
      */

      private function insertu($fname, $lname, $pass, $email, $num) {
            $ins = $this->usr()->prepare('INSERT INTO users (user_fname, user_lname, usr_pass, user_email, user_phone, unique_id, verify) VALUES
                                 (:uf, :ul, :upa, :ue, :up, :ui, :v)');
            $ins->bindValue(":uf", $fname);
            $ins->bindValue(":ul", $lname);
            $ins->bindValue(":upa", $pass);
            $ins->bindValue(":ue", $email);
            $ins->bindValue(":up", $num);
            $ins->bindValue(":ui", id(8));
            $ins->bindValue(":v", 0);
            $ins->execute();
            return $_SESSION['usr_name'] = "$fname $lname";
      }


      /*
      *     FUNCTION NAME: usrcheck()
      *     DESC: THIS FUNCTION CHECKS IF GIVEN PARAMETERS
      *           ALREADY EXIST IN users TABLE, IF
      *           EXISTS IT WILL RETURN ARRAY WITH 
      *           ERRORS!
      */

      private function usrcheck($email, $pnumber) {
            $errors = [];
            $usr = $this->usr()->query('SELECT user_email, user_phone FROM users');
            while($row = $usr->fetch(PDO::FETCH_ASSOC)) {
                  if($row['user_email'] == $email) {
                        $errors['email'] = "Email is already Taken";
                  }
                  if ($row['user_phone'] == $pnumber) {
                        $errors['phone'] = "Phone number is Already Taken";
                  }
            }
            if(count($errors) != 0) return $errors;
            else return null;
      }

      // GENERAL CODES

      /*
      *     FUNCTION NAME: checkAnRegister()
      *     DESC: THIS FUNCTION TAKES SUBMITTED FORM
      *           FROM THE USER AND CHECKS IF THE SAME
      *           INFORMATION EXISTS IN THE TABLE, IF NOT
      *           USER WILL BE REGISTERED (IN companies DB)
      *           
      */

      public function checkAnRegister($to, $cname, $cpass, $cemail,$pnumber) {
            if($to == "usr") {
                  $res = $this->checkfornull($this->usrcheck($cemail, $pnumber), $this->cmpncheck('', $cemail, $pnumber));
                  if ($res != null) return $res;
                  else {
                        $fl= explode(" ", $cname);
                        $this->insertu($fl[0], $fl[1], $cpass, $cemail, $pnumber);
                  }
                   
            }
            else if ($to == 'cmpn') {
                  if($this->usrcheck($cemail, $pnumber) != null) {
                        if($this->cmpncheck($cname, $cpass, $cemail, $pnumber) != null) $this->cmpncheck($cname, $cpass, $cemail, $pnumber);
                  }
                  else $this->register($cname, $cpass, $cemail, $pnumber);
            }
            else if ($to == "cmpn") {
                  $res = $this->checkfornull($this->usrcheck($cemail, $pnumber), $this->cmpncheck($cname, $cemail, $pnumber));
                  if ($res != null) return $res;
                  else $this->register($cname, $cpass, $cemail, $pnumber);
            }
      }


      /*
      *     FUNCTION NAME: checkfornull()
      *     DESC: THIS FUNCTION TAKES TWO FUNCTIONS
      *           AS PARAMETERS AND CHECKS IF THEIR
      *           RESULT IS NOT NULL/ERRORS ARRAY
      */ 
      
      private function checkfornull($a, $b) {
            if($a != null && $b == null) return $a;
            else if ($b != null && $a == null) return $b;
            else if ($b != null && $a != null) return $a;
            else return null;
      }
}