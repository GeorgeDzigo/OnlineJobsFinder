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
                  $sql->bindValue(":ed", date('Y-m-d', strtotime($date. ' + 1 days')));
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

      public function delete() {
            $sql = $this->pdo()->query("SELECT expiration_date FROM vacancies");
            $date = date("Y-m-d");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($date == $row['expiration_date']) {
                        $del = $this->pdo()->query("DELETE FROM vacancies");
                        $del->execute();
                  }
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
}